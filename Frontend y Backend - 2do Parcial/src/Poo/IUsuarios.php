<?php 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

interface IUsuarios
{
    function AltaUsuarios(Request $request, Response $response, array $args) : Response;
    function ListadoUsuarios(Request $request, Response $response, array $args) : Response;
    function LoginJSON(Request $request, Response $response, array $args) : Response;
}