<?php
namespace Model;

class ActiveRecord{
    protected static $db;

    protected static $columnsDB = [];

    protected static $table = '';

    protected static $errors = [];

    public static function setDB($database){
        self::$db = $database;
    }
    
    public function create(){
		$properties = $this->sanitizeProperties();
		$query = " INSERT INTO ". static::$table . " ( ";
		$query .= join(', ', array_keys($properties));
		$query .= " ) VALUES ( '";
		$query .= join("', '",array_values($properties));
		$query .= "') ";
		$queryDB= self::$db->query($query);
		return $queryDB;
	}
	
	public function update(){
		$properties = $this->sanitizeProperties();
		$values = [];
		foreach($properties as $key => $value){
			$values[] = "{$key} = '{$value}'";
		}
		$query =" UPDATE ". static::$table ." SET ";
		$query .= join(', ', $values);
		$query .= " WHERE id = '" .$this->id."' ";
		$query .= " LIMIT 1 ";
		$queryDB= self::$db->query($query);
		return $queryDB;
	}
	
	public static function all($usuario_id){
		$query= "SELECT * FROM ". static::$table ." WHERE usuario_id = {$usuario_id}";
		$queryDB=self::sqlQuery($query);		
		return $queryDB;
	}
	
	public static function find($id, $usuario_id){
		$query= "SELECT * FROM ". static::$table ." WHERE id = ${id} AND usuario_id = {$usuario_id}";
		$queryDB=self::sqlQuery($query);		
		return array_shift($queryDB);
	}
	
	public static function delete($id, $usuario_id){
		$query= "DELETE FROM ". static::$table ." WHERE id = ${id} AND usuario_id = {$usuario_id}";
		$queryDB= self::$db->query($query);	
		return $queryDB;
	}
	
	public  static function sqlQuery($query){
		$queryDB= self::$db->query($query);
		$arrayResult=[];
		while($result = $queryDB->fetch_assoc()){
			$arrayResult[]=self::createObject($result);
		}
		return $arrayResult;
	}
	
	public static function createObject($result){
		$obj= new static;
		foreach($result as $key => $value){
			if(property_exists($obj, $key)){
				$obj->$key=$value;
			}
		}
		return $obj;
	}

	public function validate(){
		$columns=array_slice(static::$columnsDB,1);
			foreach($columns as $element){
				if (!$this->$element){
					 static::$errors[]="El campo {$element} es obligatorio";
				}
			}
			return self::$errors;
		}
		
	public function properties()
	{
		$properties=[];
		foreach(static::$columnsDB as $column)
		{
			if($column === 'id') continue;
			$properties[$column]=$this->$column;
		}
		return $properties;
	}	
	
	public function sanitizeProperties()
	{
		$properties=$this->properties();
		$sanitized=[];
		foreach($properties as $key => $value)
		{
			$sanitized[$key]=self::$db->escape_string($value);
		}
		return $sanitized;
	}
    
    public function sync($args){
		foreach($args as $key => $value){
			if (property_exists($this, $key)&&!is_null($value)){
				$this->$key = $value;
			}
		}
	}
	
    
}
