<?php

namespace App\Table;

use Core\Table\Table;

class ArticleTable extends Table{

	public function last() {
		return $this->query("
			SELECT articles.id, articles.titre, contenu, categories.titre AS categorie 
			FROM articles 
			LEFT JOIN categories ON articles.category_id = categories.id 
			ORDER BY articles.date DESC");
	}

	public function find($id) {
		return $this->query("
			SELECT articles.id, articles.titre, contenu, categories.titre AS categorie, articles.category_id 
			FROM articles 
			LEFT JOIN categories ON articles.category_id = categories.id 
			WHERE articles.id = ?",
			[$id],
			true
		);
	}
	public function getLastByCategory($category_id){
		return $this->query("
			SELECT articles.id, articles.titre, contenu, categories.titre AS categorie 
			FROM articles 
			LEFT JOIN categories ON articles.category_id = categories.id 
			WHERE articles.category_id = ?"
			, [$category_id]
		);
	}
}
?>
