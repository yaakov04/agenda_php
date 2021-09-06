<?php
namespace App\libs;

class Response{
	
	 protected static function response($message,$description,$code,$messageHttpCode){
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
    
}
