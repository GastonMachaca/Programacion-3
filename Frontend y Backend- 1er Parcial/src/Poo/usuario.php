<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT;

require_once "AccesoDatos.php";
require_once "IUsuarios.php";

class Usuario implements IUsuarios
{
	public $id;
 	public $correo;
  	public $clave;
	public $nombre;
  	public $apellido;
	public $perfil;
	public $foto;

	public function AltaUsuarios(Request $request, Response $response, array $args): Response 
	{
		$verificar = new stdClass();
		$verificar->exito = false;
		$verificar->mensaje = "Fallo al agregar un usuario.";
		$verificar->status = 418; 

		$arrayDeParametros = $request->getParsedBody();

		$obj = json_decode($arrayDeParametros['usuario']);  

	    $this->correo = $obj->correo;
	    $this->clave = $obj->clave;
	    $this->nombre = $obj->nombre;
	    $this->apellido = $obj->apellido;
		$this->perfil = $obj->perfil;

		$this->perfil = strtolower($this->perfil);

		if($this->perfil == "propietario" || $this->perfil == "encargado" || $this->perfil == "empleado")
		{
			$archivos = $request->getUploadedFiles();
        	$destino = __DIR__ . "/../fotos/";

        	$nombreAnterior = $archivos['foto']->getClientFilename();
        	$extension = explode(".", $nombreAnterior);

        	$extension = array_reverse($extension);

			$this->foto = "null";

			$ingreso = $this->AgregarUsuario($extension);

			if($ingreso == true)
			{
				$this->foto = str_replace("./fotos/","",$this->foto);
				$archivos['foto']->moveTo($destino . $this->foto);
				$verificar->exito = true;
				$verificar->mensaje = "Exito al agregar un usuario.";
				$verificar->status = 200;
			}
		}
		else
		{
			$verificar->mensaje = "Fallo al agregar un usuario. No se puede agregar el perfil ingresado. El perfil solo puede ser de alguna de estas 3 opciones:  propietario, encargado y empleado.";
		}

        $response->getBody()->write(json_encode($verificar));

      	return $response;
    }

	public function AgregarUsuario($extension)
	{
		$retorno = false;

		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (ID,CORREO,CLAVE,NOMBRE,APELLIDO,PERFIL,FOTO)values(:id,:correo,:clave,:nombre,:apellido,:perfil,:foto)");
		
		$consulta->bindValue(':id',0, PDO::PARAM_INT);
		$consulta->bindValue(':correo', $this->correo, PDO::PARAM_STR);
		$consulta->bindValue(':clave',$this->clave, PDO::PARAM_INT);
		$consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
		$consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_STR);
		$consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
		
		$v1 = $consulta->execute();	

		$auxId = $objetoAccesoDato->RetornarUltimoIdInsertado();

		$this->id = $auxId;
		
		$this->foto = "./fotos/" . $this->correo . "_" . $auxId . "." . $extension[0];

		$updateFoto = $objetoAccesoDato->RetornarConsulta("UPDATE usuarios SET CORREO='$this->correo', CLAVE ='$this->clave', NOMBRE ='$this->nombre', APELLIDO ='$this->apellido', PERFIL ='$this->perfil', FOTO ='$this->foto' WHERE ID ='$this->id'");

		$v2 = $updateFoto->execute();

		if($v1 == true && $v2 == true)
		{
			$retorno = true;
		}

		return $retorno;
	}

	public function ListadoUsuarios(Request $request, Response $response, array $args): Response 
	{
		$usuarios = Usuario::TraerUsuarios();

		$verificar = new stdClass();
		$verificar->exito = false;
		$verificar->mensaje = "Fallo al listar los usuarios.";
		$verificar->dato = "No se encontraron datos...";
		$verificar->status = 424;

		if($usuarios == false)
		{
			$newResponse = $response->withStatus(424, "Fallo");
		}
		else
		{
			echo json_encode($usuarios);

			$verificar->exito = true;
			$verificar->mensaje = "Se listaron los usuarios.";
			$verificar->status = 200;
			$verificar->dato = $usuarios;
			$newResponse = $response->withStatus(200, "Exito");
		}

		$newResponse->getBody()->write(json_encode($verificar));

		return $newResponse->withHeader('Content-Type', 'application/json');	
	}

	public static function TraerUsuarios()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT ID as id, Correo as correo, CLAVE as clave, NOMBRE as nombre, APELLIDO as apellido, PERFIL as perfil, FOTO as foto from usuarios");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");		
	}

	public function LoginJSON(Request $request, Response $response, array $args): Response 
	{
		$verificar = new stdClass();
		$verificar->exito = false;
		$verificar->usuario = "null";
		$verificar->status = 403;

		$arrayDeParametros = $request->getParsedBody();

		$newResponse = $response->withStatus(424, "Fallo");

		if(isset($arrayDeParametros['user']))
		{
			$obj = json_decode($arrayDeParametros['user']);

			$this->correo = $obj->correo;
			$this->clave = $obj->clave;
	
			$token = Usuario::EncontrarUsuarioLogin($this->correo ,$this->clave);
	
			if($token != false)
			{
				$aux = get_object_vars($token);
	
				unset($aux['clave']);
		
				$verificar->exito = true;
				$verificar->usuario = json_encode($aux);
				$verificar->status = 200;

				$newResponse = $response->withStatus(200, "Exito");
			}
		}

		$newResponse->getBody()->write(json_encode($verificar));

		return $newResponse->withHeader('Content-Type', 'application/json');	
	}

	public static function EncontrarUsuarioLogin($correo,$clave)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT id,correo,nombre,apellido,perfil,foto from usuarios WHERE CORREO = '$correo' AND CLAVE = '$clave'");
		$consulta->execute();			
		return $consulta->fetchObject("Usuario");		
	}
}