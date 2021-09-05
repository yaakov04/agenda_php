<?php

namespace App\libs;

class ErrorResponse{
    protected static $message400='SOLICITUD INCORRECTA.';
    protected static $message401='No tiene autorización para acceder al recurso solicitado.';
    protected static $message404='No pudimos encontrar el recurso que solicitó.';
    protected static $message405='MÉTODO NO PERMITIDO';
    protected static $message500='Error de servidor interno inesperado.';
    protected static $message501='NO SE HA IMPLEMENTADO.';
    
    //crear una clase padre response con metodo response

    protected static function error($message,$description,$code,$messageHttpCode){
        $response = [
            'message'=>$message,
            'description'=>$description,
            'code'=>$code,
            'http_response'=>[
                'message'=>$messageHttpCode,
                'code'=>$code
            ]
        ];
        header("Content-Type: application/json;");
        return json_encode($response,JSON_UNESCAPED_UNICODE);
    }

    public static function error_400($description,$message=null,){
        return self::error($message??self::$message400,$description,'400',self::$message400);
    }

    public static function error_405($description,$message=null,){
        return self::error($message??self::$message405,$description,'405',self::$message405);
    }

    public static function error_501($description, $message=null){
        return self::error($message??self::$message501,$description,'501',self::$message501);
    }
    
    
}
