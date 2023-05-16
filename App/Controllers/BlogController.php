<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;


//os models
use App\Models\Produto;
use App\Models\Info;


class BlogController extends Action {

	public function index() {

		$ModelPost = Container::getModel('Post');

		$posts = $ModelPost->getPosts();

		@$this->view->dados = $posts;

		$this->render('index', 'mainLayout');
	}

	public function cadastrarPostView() {
		$this->render('cadastro-post', 'mainLayout');
	}
	
}

?>