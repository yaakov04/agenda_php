<?php

namespace Controllers;

use App\Router;

class HomeController extends Controller{
	public static function index(Router $router)
	{
		self::start($router);
		var_dump(getallheaders());
		var_dump('index');
	}
}
