<?php
namespace Controllers;

use App\Router;
use Model\User;
use App\libs\ErrorResponse;

class AuthController extends Controller{
    protected static $tokenExpires=7;
    
    
    public static function signup(Router $router){
		$errors=[];
		self::start($router);
		self::validateRequestMethod('POST');
		self::validateRequestBody();
		$user = new User(self::$requestBody);
		$errors=$user->validate();
		if (empty($errors))
		{
			$response = [
            'message'=>'CREADO',
            'description'=>'El usuario se creo correctamente',
            'code'=>201,
            'http_response'=>[
                'message'=>'CREADO',
                'code'=>201
            ]
        ];
        header("Content-Type: application/json;");
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
		}else
		{
			echo ErrorResponse::error_400($errors, 'Se proporcionó una sintaxis no válida para esta solicitud.');
		}
        var_dump('signup');
    }
    
    

    
}
