<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


use Slim\Views\Twig;

use Slim\Views\TwigMiddleware;

require __DIR__ . '/../../vendor/autoload.php';

$scaloneta = AppFactory::create();

require_once __DIR__ . "/../Poo/usuario.php";
require_once __DIR__ . "/../Poo/auto.php";
require_once __DIR__ . "/../Poo/middleware.php";

use \Slim\Routing\RouteCollectorProxy;

$twig = Twig::create('../src/views', ['cache'=> false]);

$scaloneta->add(TwigMiddleware::create($scaloneta,$twig));
  
$scaloneta->post('/usuarios', \Usuario::class . ':AltaUsuarios')->add(\MW::class . ":VerificarCorreoBD")->add(\MW::class . "::VerificarCorreoClaveVacios");
$scaloneta->get('/', Usuario::class . ':ListadoUsuarios');

$scaloneta->get('/autos', \Auto::class . ':ListadoAutos');
$scaloneta->post('/', Auto::class . ':AltaAutos');

$scaloneta->post('/login', \Usuario::class . ':LoginJSON')->add(\MW::class . ":VerificarCorreoClaveBD")->add(\MW::class . "::VerificarCorreoClaveVacios"); 

$scaloneta->group('/cars', function (RouteCollectorProxy $grupo1)
{ 
    $grupo1->delete('/{id_auto}', Auto::class . ':BorrarAuto');
    $grupo1->put('/{auto}', Auto::class . ':ModificarAuto');
});

$scaloneta->get('/front-end-login', function (Request $request, Response $response, array $args) : Response {  

    $view = Twig::fromRequest($request);
  
    return $view->render($response, 'login.php', [
    ]);
    
});

$scaloneta->get('/front-end-registro', function (Request $request, Response $response, array $args) : Response {  

    $view = Twig::fromRequest($request);
  
    return $view->render($response, 'registro.php', [
    ]);
    
});

$scaloneta->get('/front-end-principal', function (Request $request, Response $response, array $args) : Response {  

    $view = Twig::fromRequest($request);
  
    return $view->render($response, 'principal.php', [
    ]);
    
});

$scaloneta->run();
