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

	public function validate(){
		$columns=array_slice(static::$columnsDB,1);
			foreach($columns as $element){
				if (!$this->$element)
				{
					 static::$errors[]="El campo {$element} es obligatorio";
				}
			}
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
    
}
