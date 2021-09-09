<?php

namespace Controllers;

use App\Router;
use Model\Contacto;
use App\libs\OkResponse;
use App\libs\ErrorResponse;

class ContactosController extends Controller{
	public static function create(Router $router){
		self::start($router);
		self::validateRequestMethod('POST');
		self::validateRequestBody();
		$token=self::verifyToken(self::validateToken());
		$errors=[];
		$contacto = new Contacto(self::$requestBody);
		$contacto->usuario_id = $token->usuario_id;
		$errors=$contacto->validate();
		if (empty($errors)){
			$queryDB = $contacto->create();
			if ($queryDB){
				$contactoResultado=[
					'Contacto creado:'=>[
						'nombre'=> $contacto->nombre,
						'telefono'=> $contacto->telefono,
						'correo'=> $contacto->correo
					]
				];
				 echo OkResponse::success_200($contactoResultado,'La peticion se ha procesado correctamente');
			 }
		}else{
			echo ErrorResponse::error_400($errors, 'Se proporcionó una sintaxis no válida para esta solicitud.');
		}
	
	}
	
	
}
