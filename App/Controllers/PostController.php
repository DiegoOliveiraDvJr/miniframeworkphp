<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;


//os models
use App\Models\Produto;
use App\Models\Info;


class PostController extends Action {

	public function create() {
        
		$post = Container::getModel('Post');
        if($post->save($_POST['title'], $_POST['content'], 1, [1,2])){
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['sucess' => true, 'redirect' => 'blog?create=true']);
        }else{
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['sucess' => false]);
        }
        
	}
	
}

?>