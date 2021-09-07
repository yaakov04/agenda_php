<?php
namespace Model;

use DateTime;

class Token extends ActiveRecord{
	protected static $table = 'tokens';
    protected static $columnsDB=['id','token','fecha','activo','usuario_id'];
    public $id;
    public $token;
    public $fecha;
    public $activo;
    public $usuario_id;
    
    public function __construct(Array $args=[]){
		$this->id=$args['id']??null;
        $this->token=$args['token']??null;
        $this->fecha=$args['fecha']??null;
        $this->activo=$args['activo']??null;
        $this->usuario_id=$args['usuario_id']??null;
	}
	
	public static function setDataToken($usuario_id){
		$dataToken=[
					'token'			=>self::generateToken(),
					'fecha'			=>self::getDate(),
					'activo'		=>1,
					'usuario_id'	=>$usuario_id
				];
		return $dataToken;
	}
	
	public static function generateToken(){
		//Generate a random string.
		$token = openssl_random_pseudo_bytes(16);
		//Convert the binary data into hexadecimal representation.
		$token = bin2hex($token);
		//Print it out for example purposes.
		return $token;
	}
	
	public static function getDate(){
		$currentDate= new DateTime();
		$date=$currentDate->format('Y-m-d H:i:s');
		return $date;
	}
	
}
