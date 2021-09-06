<?php
namespace Model;



class User extends ActiveRecord{
    protected static $table = 'usuarios';
    protected static $columnsDB=['id','username','email','password'];
    public $id;
    public $username;
    public $email;
    public $password;

    public function __construct(Array $args=[]){
        $this->id=$args['id']??null;
        $this->username=$args['username']??null;
        $this->email=$args['email']??null;
        $this->password=$args['password']??null;
    }
    
    public function validate(){
		$columns=array_slice(self::$columnsDB,1);
			foreach($columns as $element){
				if (!$this->$element)
				{
					 self::$errors[]="El campo {$element} no puede ir vacio";
				}
				$this->validateEmail($element);
			}
		return self::$errors;
		}
		
	protected function validateEmail($email)
		{
			if($email=== 'email'){
					if (!filter_var($this->$email, FILTER_VALIDATE_EMAIL))
					{
						self::$errors[]="El correo proporcionado no es valido";
					}
				}
		}
		
	public function passwordHash(){
		$options=['cost'=>12];
		$password = password_hash($this->password, PASSWORD_BCRYPT, $options);
		return $password;
	}
	
	public function usernameExist(){
		$query="SELECT id FROM ". self::$table ." WHERE username = '{$this->username}'";
		$queryDB= self::$db->query($query);
		return $queryDB->num_rows;
	}
	
	public function emailExist(){
		$query="SELECT id FROM ". self::$table ." WHERE email = '{$this->email}'";
		$queryDB= self::$db->query($query);
		return $queryDB->num_rows;
	}
	
}
