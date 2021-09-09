<?php
namespace Controllers;

use App\Router;
use App\libs\ErrorResponse;
use Model\Token;

abstract class Controller{
	protected static $router;
	protected static $requestBody;
	protected static $requestMethod;
	
	
	public static function start(Router $router)
	{
		self::$router=$router;
		self::$requestMethod=$router->getRequestMethod();
	}
	
	public static function validateRequestBody(){
        self::$requestBody=self::$router->getRequestBody();
        if (!self::$requestBody) {
            die(ErrorResponse::error_400('El cuerpo de la petición no puede ir vacio.', 'Se proporcionó una sintaxis no válida para esta solicitud.'));
        }
    }
    
    public static function validateRequestMethod($requestMethodExpected){
        if(!($requestMethodExpected===self::$requestMethod)){
            die( ErrorResponse::error_405('El metodo de la petición es invalido'));
        }
    }
    
    public static function validateToken(){
		$headerToken=getallheaders()['agenda_php_token']??null;
		if (!$headerToken){
			die( ErrorResponse::error_401('El token enviado es invalido. Por favor Iniciar sesión.','No tiene autorización para acceder al recurso solicitado.'));
		}
		return $headerToken;
	}
	
	public static function verifyToken($token){
		$token=Token::verifyToken($token)->fetch_object();
		if (!($token&&Token::verifyTokenDate($token)&&Token::verifyTokenActive($token))){
			die( ErrorResponse::error_401('El token enviado es invalido. Por favor Iniciar sesión.','No tiene autorización para acceder al recurso solicitado.'));
		}
		return $token;
	}
}
