<?php
namespace App;

use App\libs\HttpRequest;

class Router{
	protected $routes=array();
	
	public function __construct(protected HttpRequest $request){
		
	}
	
	public function add($url, $fn, $method='GET'){
		$this->routes[$method][$url]=$fn;
	}
	public function run(){
		$url=$this->request->getUrl();
		$method=$this->request->getMethod();
		$fn=$this->routes[$method][$url]??null;
		if ($fn)
		{
			call_user_func($fn,$this);
		}else
		{
			echo 'Pagina no encontrada o metodo de envio incorrecto';
		}
	}
	
	public function getRequestMethod(){
		return $this->request->getMethod();
	}
	
	public function getRequestBody(){
        return $this->request->getRequestBody();
    }
    
    public function getUrlParams(){
        return $this->request->getParams();
    }
    public function getUrlParam(int $index=0){
        return $this->request->getParam($index);
    }
}
