<?php

namespace App\libs;

class ErrorResponse extends Response{
    protected static $message400='SOLICITUD INCORRECTA.';
    protected static $message401='NO AUTORIZADO.';
    protected static $message404='No pudimos encontrar el recurso que solicitó.';
    protected static $message405='MÉTODO NO PERMITIDO';
    protected static $message500='Error de servidor interno inesperado.';
    protected static $message501='NO SE HA IMPLEMENTADO.';

    public static function error_400($description,$message=null,){
        return self::response($message??self::$message400,$description,'400',self::$message400);
    }
    
    public static function error_401($description,$message=null,){
        return self::response($message??self::$message401,$description,'401',self::$message401);
    }

    public static function error_405($description,$message=null,){
        return self::response($message??self::$message405,$description,'405',self::$message405);
    }

    public static function error_501($description, $message=null){
        return self::response($message??self::$message501,$description,'501',self::$message501);
    }
    
    
}
