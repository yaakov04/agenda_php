<?php

namespace Controllers;

use App\Router;

class ContactosController extends Controller{
	public static function create(Router $router){
		self::start($router);
		self::validateRequestMethod('POST');
		self::validateRequestBody();
		$token=self::verifyToken(self::validateToken());
		$errors=[];
		
		var_dump(self::$requestBody);
		
		
		var_dump('crear contacto');
	}
	
	
}
