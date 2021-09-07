<?php
namespace Controllers;

use App\Router;
use Model\User;
use App\libs\OkResponse;
use App\libs\ErrorResponse;

class AuthController extends Controller{
    protected static $tokenExpires=7;
    
    
    public static function signup(Router $router){
		$errors=[];
		self::start($router);
		self::validateRequestMethod('POST');
		self::validateRequestBody();
		$user = new User(self::$requestBody);
		$errors=$user->validateSignup();
		$user->usernameExist()->num_rows?$errors[]='Este nombre de usuario ya esta en uso':null;
		$user->emailExist()?$errors[]='Este correo electronico ya esta en uso':null;
		if (empty($errors)){
			 $user->password = $user->passwordHash();
			 $queryDB = $user->create();
			 if ($queryDB){
				 echo OkResponse::success_201(['usuario'=>['username'=>$user->username,'email'=>$user->email]],'La peticion se ha procesado correctamente');
			 }
		}else{
			echo ErrorResponse::error_400($errors, 'Se proporcionó una sintaxis no válida para esta solicitud.');
		}
		//Construir el login
        var_dump('signup');
    }
    
    public static function signin(Router $router){
		$errors=[];
		self::start($router);
		self::validateRequestMethod('POST');
		self::validateRequestBody();
		$user = new User(self::$requestBody);
		$errors=$user->validateSignin();
		!$user->usernameExist()->num_rows?$errors[]='El nombre de usuario o la contraseña son incorrectos':null;
		if (empty($errors)){
			!$user->verifyPassword($user->usernameExist()) ? $errors[] ='El nombre de usuario o la contraseña son incorrectos':null;
			if (empty($errors)){
				//crear token
				var_dump('signin');
			}else{
				echo ErrorResponse::error_400($errors, 'Se proporcionó una sintaxis no válida para esta solicitud.');
			}
		}else{
			echo ErrorResponse::error_400($errors, 'Se proporcionó una sintaxis no válida para esta solicitud.');
		}
		
		
	}
    
}
