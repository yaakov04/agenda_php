<?php
namespace Model;

class Contacto extends ActiveRecord{
	protected static $table = 'agenda';
    protected static $columnsDB=['id','nombre','telefono','correo','usuario_id', 'editado'];
    public $id;
    public $nombre;
    public $telefono;
    public $correo;
    public $usuario_id;
    public $editado;
    
    public function __construct($args=[]){
		$this->id = $args['id']??null;
		$this->nombre = $args['nombre']??null;
		$this->telefono = $args['telefono']??null;
		$this->correo = $args['correo']??null;
		$this->usuario_id = $args['usuario_id']??null;
		$this->editado = $args['editado']??null;
	}
	
	
	
	
}
