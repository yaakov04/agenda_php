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
		$contacto->editado = Controller::getDate();
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
	
	public static function update(Router $router){
		self::start($router);
		$id=self::$router->getUrlParam(1);
		self::validateParamInt($id);
		self::validateRequestMethod('PATCH');
		self::validateRequestBody();
		$token=self::verifyToken(self::validateToken());
		$errors=[];
		$contacto = Contacto::find($id, $token->usuario_id);
		self::existContacto($contacto, $id);
		$contacto->sync(self::$requestBody);
		$contacto->editado = Controller::getDate();
		$errors=$contacto->validate();
		if (empty($errors)){
			$queryDB = $contacto->update();
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
	
	public static function find(Router $router){
		self::start($router);
		$id=self::$router->getUrlParam(1);
		self::validateParamInt($id);
		self::validateRequestMethod('GET');
		$token=self::verifyToken(self::validateToken());
		$contacto = Contacto::find($id, $token->usuario_id);
		self::existContacto($contacto, $id);
		$contactoResultado=[
			'Contacto:'=>[
				'id'=> $contacto->id,
				'nombre'=> $contacto->nombre,
				'telefono'=> $contacto->telefono,
				'correo'=> $contacto->correo
			]
		];
		echo OkResponse::responseContent($contactoResultado);
	}
	
	public static function all(Router $router){
		self::start($router);
		self::validateRequestMethod('GET');
		$token=self::verifyToken(self::validateToken());
		$contactos = Contacto::all($token->usuario_id);
		if ($contactos){
			echo OkResponse::responseContent($contactos);
		}else{
			echo OkResponse::success_200(["La consulta arrojo un conjunto de valores vacío","Aun no se han agregado contactos"],'La peticion se ha procesado correctamente');
		}
	}
	
	protected static function existContacto($contacto, $id){
		if (!$contacto){
			die(ErrorResponse::error_404("El contacto con el id: {$id} no existe", 'No pudimos encontrar el recurso que solicitó.'));
		}
	}
	
	
}
