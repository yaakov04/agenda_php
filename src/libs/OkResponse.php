<?php

namespace App\libs;

class OkResponse extends Response{
	protected static $message200 = 'OK';
	protected static $message201 = 'CREADO';
	protected static $message202 = 'ACEPTADO';
	
	public static function success_200($description,$message=null,){
        return self::response($message??self::$message200,$description,'200',self::$message200);
    }
    
    public static function success_201($description,$message=null,){
        return self::response($message??self::$message201,$description,'201',self::$message201);
    }
	
	public static function success_202($description,$message=null,){
        return self::response($message??self::$message202,$description,'202',self::$message201);
    }
}
