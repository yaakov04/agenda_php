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
	
	public function saveToken($usuario_id){
		if ($this->tokenExist($usuario_id)->num_rows){
			return $this->update();
		}else{
			return $this->create();
		}
	}
	
	public function update(){
		$properties = $this->sanitizeProperties();
		$values = [];
		foreach($properties as $key => $value){
			$values[] = "{$key} = '{$value}'";
		}
		$query =" UPDATE ". static::$table ." SET ";
		$query .= join(', ', $values);
		$query .= " WHERE usuario_id = '".$this->usuario_id ."' ";
		$query .= " LIMIT 1 ";
		$queryDB= self::$db->query($query);
		return $queryDB;
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
	
	protected static function generateToken(){
		//Generate a random string.
		$token = openssl_random_pseudo_bytes(16);
		//Convert the binary data into hexadecimal representation.
		$token = bin2hex($token);
		//Print it out for example purposes.
		return $token;
	}
	
	protected static function getDate(){
		$currentDate= new DateTime();
		$date=$currentDate->format('Y-m-d H:i:s');
		return $date;
	}
	
	protected function tokenExist($usuario_id){
		$query="SELECT * FROM ". self::$table ." WHERE usuario_id = '{$usuario_id}'";
		$queryDB= self::$db->query($query);
		return $queryDB;
	}
	
}
