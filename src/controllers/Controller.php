<?php
namespace Controllers;

use App\Router;
use App\libs\ErrorResponse;

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
}
