<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['blog'] = array(
			'route' => '/blog',
			'controller' => 'BlogController',
			'action' => 'index'
		);

		$routes['cadastrar_post'] = array(
			'route' => '/blog/cadastrar-post',
			'controller' => 'BlogController',
			'action' => 'cadastrarPostView'
		);

		
		$routes["api_post_create"] = array(
			'route' => '/api/post/create',
			'controller' => 'PostController',
			'action' => 'create',
			'method' => 'POST'
		);


		$this->setRoutes($routes);
	}

}

?>