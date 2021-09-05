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
    
}
