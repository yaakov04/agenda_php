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
		$errors=$user->validate();
		$user->usernameExist()?$errors[]='Este nombre de usuario ya esta en uso':null;
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
        var_dump('signup');
    }
    
    

    
}
