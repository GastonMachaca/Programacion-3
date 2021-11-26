<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as ResponseMW;

class MW
{
    public static function VerificarCorreoClaveVacios(Request $request, RequestHandler $handler) : ResponseMW
    {
        $verificar = new stdClass();
		$verificar->mensaje = "El correo y la clave estan vacios.";
		$verificar->status = 409;

        $response = new ResponseMW();

        $aux = false;

        $response = $response->withStatus($verificar->status,"ERROR");

        $arrayDeParametros = $request->getParsedBody();

        if(isset($arrayDeParametros))
        {
            //$obj = json_decode($arrayDeParametros['usuario']);

            if(isset($arrayDeParametros['usuario']))
            {
                $obj = json_decode($arrayDeParametros['usuario']);
            }
            else
            {
                $obj = json_decode($arrayDeParametros['user']);
            }

            if(isset($obj))
            {
                $correo = isset($obj->correo) ? $obj->correo : NULL;
                $clave = isset($obj->clave) ? $obj->clave : NULL;

                if($correo != ""  &&  $clave != "")
                {
                    $aux = true;
                    $verificar->status = 200;
                    $response = $handler->handle($request);
                }

                if($correo != "")
                {
                    $verificar->mensaje = "La clave esta vacia.";
                }

                if($clave != "")
                {
                    $verificar->mensaje = "El correo esta vacio.";
                }
            }
        }

        if($aux == false)
        {
            $response->getBody()->write(json_encode($verificar));

            $response = $response->withHeader('Content-Type', 'application/json');
        }

        return $response;
    }

    public function VerificarCorreoClaveBD(Request $request, RequestHandler $handler) : ResponseMW
    {

        $verificar = new stdClass();
        $verificar->mensaje = "";
        $verificar->status = 403;

        $limite = 0;

		$arrayDeParametros = $request->getParsedBody();

        $response = new ResponseMW();

		$response = $response->withStatus(403,"Fallo");

        //$obj = json_decode($arrayDeParametros['usuario']);

        if(isset($arrayDeParametros['usuario']))
        {
            $obj = json_decode($arrayDeParametros['usuario']);
        }
        else
        {
            $obj = json_decode($arrayDeParametros['user']);
        }

		$correo = $obj->correo;
		$clave = $obj->clave;
	
		$vCorreo = MW::EncontrarCorreo($correo);

        $vClave = MW::EncontrarClave($clave);

        if($vClave == false && $vCorreo == false)
        {
            $verificar->status = 403;
            $verificar->mensaje = "No se encontro el correo ni la clave en la base de datos.";
            $limite++;
        }
        else
        {
            if($vCorreo == false)
            {
                $verificar->mensaje = "No se encontro el correo en la base de datos.";
                $verificar->status = 403;
                $limite++;
            }
    
            if($vClave == false)
            {
                $verificar->mensaje = "No se encontro la clave en la base de datos";
                $verificar->status = 403;
                $limite++;
            }
        }

        if($limite == 0)
        {
            $response = $handler->handle($request);
        }
        else
        {
            $response->getBody()->write(json_encode($verificar));

            $response = $response->withHeader('Content-Type', 'application/json');
        }

        return $response;
    }

	public static function EncontrarCorreo($correo)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from usuarios WHERE CORREO = '$correo'");
		$consulta->execute();			
		return $consulta->fetchObject("Usuario");		
	}
    
    public static function EncontrarClave($clave)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from usuarios WHERE CLAVE = '$clave'");
		$consulta->execute();			
		return $consulta->fetchObject("Usuario");		
	}


    public function VerificarCorreoBD(Request $request, RequestHandler $handler) : ResponseMW
    {

        $verificar = new stdClass();
        $verificar->mensaje = "Se encontro un correo identico en la base de datos";
        $verificar->status = 403;

        $limite = 0;

		$arrayDeParametros = $request->getParsedBody();

        $response = new ResponseMW();

		$response = $response->withStatus(403,"Fallo");

        if(isset($arrayDeParametros['usuario']))
        {
            $obj = json_decode($arrayDeParametros['usuario']);
        }
        else
        {
            $obj = json_decode($arrayDeParametros['user']);
        }

		$correo = $obj->correo;
		$clave = $obj->clave;
	
		$vCorreo = MW::EncontrarCorreo($correo);

        if($vCorreo == false)
        {
            $verificar->mensaje = "No se encontro el correo en la base de datos.";
            $verificar->status = 403;
        }
        else
        {
            $limite++;
        }

        if($limite == 0)
        {
            $response = $handler->handle($request);
        }
        else
        {
            $response->getBody()->write(json_encode($verificar));

            $response = $response->withHeader('Content-Type', 'application/json');
        }

        return $response;
    }
}