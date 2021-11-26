<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once "AccesoDatos.php";
require_once "IAuto.php";

class Auto implements IAuto
{
	public $id;
 	public $color;
  	public $marca;
	public $precio;
  	public $modelo;

	public function AltaAutos(Request $request, Response $response, array $args): Response 
	{
		$verificar = new stdClass();
		$verificar->exito = false;
		$verificar->mensaje = "Fallo al agregar un auto.";
		$verificar->status = 418; 

		$arrayDeParametros = $request->getParsedBody();

		$newResponse = $response->withStatus(418, "ERROR");

		if(isset($arrayDeParametros))
		{
			$obj = json_decode($arrayDeParametros['auto']);  

			$this->color = $obj->color;
			$this->marca = $obj->marca;
			$this->precio = $obj->precio;
			$this->modelo = $obj->modelo;
	
			$acceso = $this->AgregarAuto();
	
			if($acceso != false)
			{
				$verificar->exito = true;
				$verificar->mensaje = "Exito al agregar un auto.";
				$verificar->status = 200;

				$newResponse = $response->withStatus(200, "EXITO");
			}	
		}

        $newResponse->getBody()->write(json_encode($verificar));

      	return $newResponse->withHeader('Content-Type', 'application/json');
    }

	public function AgregarAuto()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into autos (ID,COLOR,MARCA,PRECIO,MODELO)values(:id,:color,:marca,:precio,:modelo)");
		
		$consulta->bindValue(':id',0, PDO::PARAM_INT);
		$consulta->bindValue(':color', $this->color, PDO::PARAM_STR);
		$consulta->bindValue(':marca',$this->marca, PDO::PARAM_STR);
		$consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
		$consulta->bindValue(':modelo', $this->modelo, PDO::PARAM_STR);
		
		$retorno = $consulta->execute();	

		return $retorno;
	}

	public function ListadoAutos(Request $request, Response $response, array $args): Response 
	{
		$autos = Auto::TraerAutos();

		$verificar = new stdClass();
		$verificar->exito = false;
		$verificar->mensaje = "Fallo al listar los autos.";
		$verificar->dato = "No se encontraron datos...";
		$verificar->status = 424;

		if($autos == false)
		{
			$newResponse = $response->withStatus(424, "Fallo");
		}
		else
		{
			//echo json_encode($autos);

			$verificar->exito = true;
			$verificar->mensaje = "Se listaron los autos.";
			$verificar->status = 200;
			$verificar->dato = json_encode($autos);
			$newResponse = $response->withStatus(200, "Exito");
		}

		$newResponse->getBody()->write(json_encode($verificar));

		return $newResponse->withHeader('Content-Type', 'application/json');			
	}

	public static function TraerAutos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT ID as id, COLOR as color, MARCA as marca, PRECIO as precio, MODELO as modelo from autos");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Auto");		
	}


	public function BorrarAuto(Request $request, Response $response, array $args): Response 
	{
		$retorno = new stdClass();
        $id = $args["id_auto"];
     
		$autos = Auto::BuscarAutoID($id);

        if($autos > 0)
        {
            $retorno->exito   = true;
            $retorno->status  = 200;
            $retorno->mensaje = "Exito al borrar de la base de datos.";
            $newResponse = $response->withStatus(200);
        }
        else
        {
            $retorno->exito   = false;
            $retorno->status  = 418;
            $retorno->mensaje = "Fallo al borrar de la base de datos.";
            $newResponse = $response->withStatus(418);
        }
		
        $newResponse->getBody()->write(json_encode($retorno));

        return $newResponse->withHeader('Content-Type', 'application/json');
	}

	public static function BuscarAutoID($id)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

        $consulta = $objetoAccesoDato -> RetornarConsulta("DELETE FROM autos WHERE id=".$id."");

        $consulta -> execute();

        return $consulta->rowCount();
	}
	
	public function ModificarAuto(Request $request, Response $response, array $args): Response 
	{
		$retorno = new stdClass();
        $auto = json_decode($args["auto"]);

		$autos = Auto::ModificarAutoID($auto);

        if($autos > 0)
        {
            $retorno->exito   = true;
            $retorno->status  = 200;
            $retorno->mensaje = "Exito al modificar de la base de datos.";
            $newResponse = $response->withStatus(200);
        }
        else
        {
            $retorno->exito   = false;
            $retorno->status  = 418;
            $retorno->mensaje = "Fallo al modificar de la base de datos.";
            $newResponse = $response->withStatus(418);
        }
		
        $newResponse->getBody()->write(json_encode($retorno));

        return $newResponse->withHeader('Content-Type', 'application/json');
	}

	public static function ModificarAutoID($auto)
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE autos SET color=:color,marca=:marca,precio=:precio,modelo=:modelo WHERE id=:id");

        $consulta->bindValue(':id',$auto->id_auto,PDO::PARAM_INT);
        $consulta->bindValue(':color',$auto->color,PDO::PARAM_STR);
        $consulta->bindValue(':marca',$auto->marca,PDO::PARAM_STR);
        $consulta->bindValue(':precio',$auto->precio,PDO::PARAM_STR);
        $consulta->bindValue(':modelo',$auto->modelo,PDO::PARAM_STR);

        $consulta -> execute();

        return $consulta->rowCount();
	}
}