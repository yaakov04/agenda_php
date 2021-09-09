<?php
namespace App\libs;

class HttpRequest{
    protected $url;
    protected $urlParams;
    protected $requestMethod;
    protected $requestBody;
    public function __construct(){
        $url=$_SERVER['REQUEST_URI'];
        $url === '/' ? $this->url=$url : $this->url=rtrim($url, '/');
        $urlArr= explode('/', $this->url);
        $this->urlParams=array_slice($urlArr,2);
        $this->requestMethod=$_SERVER['REQUEST_METHOD'];
        $this->requestBody=json_decode(file_get_contents('php://input'),true);
    }

	public function getUrl(){
		return $this->url;
	}
	public function getMethod(){
		return $this->requestMethod;
	}
	public function getRequestBody(){
		return $this->requestBody;
	}

	public function getParams(){
	   return $this->urlParams??null;
	}

	public function getParam(int $index=0){
	   return $this->urlParams[$index]??null;
	}
}
