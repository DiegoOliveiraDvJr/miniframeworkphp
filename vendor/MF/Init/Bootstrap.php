<?php

namespace MF\Init;

abstract class Bootstrap {
	private $routes;

	abstract protected function initRoutes(); 

	public function __construct() {
		$this->initRoutes();
		$this->run($this->getUrl());
	}

	public function getRoutes() {
		return $this->routes;
	}

	public function setRoutes(array $routes) {
		$this->routes = $routes;
	}

	protected function run($url) {
		foreach ($this->getRoutes() as $key => $route) {

			

			if($url == $route['route']) {
		
				$this->methodNotAllowed($route);

				$class = "App\\Controllers\\".ucfirst($route['controller']);

				$controller = new $class;
				
				$action = $route['action'];

				$controller->$action();
			}
		}
	}

	protected function methodNotAllowed($route) {
		if(isset($route['method']) && strtoupper($route['method']) !== strtoupper($_SERVER['REQUEST_METHOD'])){
			header('HTTP/1.1 405 Method Not Allowed');
			echo '405 Method Not Allowed - The requested method is not supported for this resource.';
			die();
		}
	}

	protected function getUrl() {
		return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}
}

?>