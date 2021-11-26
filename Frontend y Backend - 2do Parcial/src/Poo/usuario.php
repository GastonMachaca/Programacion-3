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
		$arrayDeParametros = $request->getParsedBody();

        $json = json_decode($arrayDeParametros['usuario']);

        $path = "";
        $extension ="";

        $miUsuario = new Usuario();
        $miUsuario -> clave    = $json -> clave;
        $miUsuario -> correo   = $json -> correo;
        $miUsuario -> nombre   = $json -> nombre;
        $miUsuario -> perfil   = $json -> perfil;
        $miUsuario -> apellido = $json -> apellido;

        $retorno = new stdClass();
        $retorno -> exito   = false;
        $retorno -> status  = 418;
        $retorno -> mensaje = "Error al ingresar el usuario en la base de datos...";

        $archivos = $request->getUploadedFiles();
        $destino = __DIR__ . "/../../public/fotos/";

        if(isset($archivos['foto']))
        {
            $nombreAnterior = $archivos['foto']->getClientFilename();
            $extension = explode(".", $nombreAnterior);

            $extension = array_reverse($extension);

            $path = $miUsuario -> correo . "";
        }

        $id_agregado = $miUsuario->AgregarUsuario($miUsuario, $path, $extension);

        if(isset($archivos['foto']))
        {
            $archivos['foto'] -> moveTo($destino . $miUsuario -> correo . "_" . $id_agregado  . "." . $extension[0]);
        }

        $newResponse = $response->withStatus(418);

        if($id_agregado > 0)
        {
            $retorno -> exito   = true;
            $retorno -> status  = 200;
            $retorno -> mensaje = "Exito al ingresar el usuario en la base de datos!";

            $newResponse = $response->withStatus(200, "OK");
        }

        $newResponse->getBody()->write(json_encode($retorno));

        return $newResponse->withHeader('Content-Type', 'application/json');
    }

	public function AgregarUsuario($miUsuario,$path,$extension)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (id, foto, clave, nombre, correo, perfil, apellido)
                                                                values(:id, :foto, :clave, :nombre, :correo, :perfil, :apellido)");

        $consulta -> bindValue(':id'      , 0, PDO::PARAM_INT);
        $consulta -> bindValue(':foto'    , 0, PDO::PARAM_STR);
        $consulta -> bindValue(':clave'   , $miUsuario -> clave   , PDO::PARAM_STR);
        $consulta -> bindValue(':perfil'  , $miUsuario -> perfil  , PDO::PARAM_STR);
        $consulta -> bindValue(':correo'  , $miUsuario -> correo  , PDO::PARAM_STR);
        $consulta -> bindValue(':nombre'  , $miUsuario -> nombre  , PDO::PARAM_INT);
        $consulta -> bindValue(':apellido', $miUsuario -> apellido, PDO::PARAM_STR);

        $consulta -> execute();

        $retorno = $objetoAccesoDato -> RetornarUltimoIdInsertado();

        if($retorno)
        {
            $todosLosUsuarios = Usuario::TraerUsuarios();

            if($todosLosUsuarios != false)
            {
                $lastId = $todosLosUsuarios[count($todosLosUsuarios)-1]->id;
            }

            $pathxd =  "./fotos/".$path.$lastId.".".$extension[0];

            $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuarios SET foto='".$pathxd."' WHERE id=".$lastId."");

            $consulta -> execute();
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
			//echo json_encode($usuarios);

			$verificar->exito = true;
			$verificar->mensaje = "Se listaron los usuarios.";
			$verificar->status = 200;
			$verificar->dato = json_encode($usuarios);
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