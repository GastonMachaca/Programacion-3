<?php 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

interface IAuto
{
    function AltaAutos(Request $request, Response $response, array $args) : Response;
    function ListadoAutos(Request $request, Response $response, array $args) : Response;
    function BorrarAuto(Request $request, Response $response, array $args) : Response;
    function ModificarAuto(Request $request, Response $response, array $args) : Response;
}