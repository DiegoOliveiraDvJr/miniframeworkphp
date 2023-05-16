<?php

namespace App\Models;

use MF\Model\Model;
use PDO;
use PDOException;

class Post extends Model {

	public function getPosts() {
		
		$requestData = array_merge($_GET, $_POST);
        
        $page = isset($requestData['index']) && intval($requestData['index']) ? $requestData['index'] : 1;

        $itensPorPagina = 10;

        $totalRegistrosQuery = "SELECT COUNT(*) as total FROM posts";
        $totalRegistrosResult =  $this->db->query($totalRegistrosQuery);
        $totalRegistrosRow = $totalRegistrosResult->fetch(PDO::FETCH_ASSOC);
        $totalRegistros = $totalRegistrosRow['total'];

        $totalPaginas = ceil($totalRegistros / $itensPorPagina);
        $totalPages = $totalPaginas;

        $paginaAtual = $page;

        $offset = ($paginaAtual - 1) * $itensPorPagina;

        $consultaQuery = "SELECT p.*, c.name AS category_name, GROUP_CONCAT(t.name) AS tag_names
        FROM posts AS p
        INNER JOIN categories AS c ON p.category_id = c.id
        LEFT JOIN post_tags AS pt ON p.id = pt.post_id
        LEFT JOIN tags AS t ON pt.tag_id = t.id
        GROUP BY p.id
        ORDER BY p.id DESC
        LIMIT $offset, $itensPorPagina";

		return $this->db->query($consultaQuery)->fetchAll(PDO::FETCH_OBJ);
	}


    public function save($title, $content, $category_id, $tag_ids)
    {
        try {
            // Insere o post na tabela "posts"
            $stmt = $this->db->prepare("INSERT INTO posts (title, content, category_id) VALUES (:title, :content, :category_id)");
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":content", $content);
            $stmt->bindParam(":category_id", $category_id);
            $stmt->execute();

            // Obtém o ID do post recém-inserido
            $post_id = $this->db->lastInsertId();

            // Insere as relações na tabela "post_tags"
            $stmt = $this->db->prepare("INSERT INTO post_tags (post_id, tag_id) VALUES (:post_id, :tag_id)");
            $stmt->bindParam(":post_id", $post_id);

            // Insere cada tag na tabela "post_tags"
            foreach ($tag_ids as $tag_id) {
                $stmt->bindParam(":tag_id", $tag_id);
                $stmt->execute();
            }
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>