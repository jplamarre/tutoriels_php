<?php

namespace App\Table; 


class Article extends Table {

	protected static $table = 'articles';

		public static function find($id){
    	return self::query('SELECT articles.id, articles.titre, contenu, category.titre AS categorie FROM ' . self::$table . ' LEFT JOIN category ON articles.category_id = category.id WHERE articles.id = ?', [$id], true);
	}

	public function getUrl(){
		return 'index.php?p=single&id=' . $this->id;
	}

	public function getExtrait(){
		$html =  '<p>' . substr($this->contenu, 0, 50) . '...</p>';
		$html .=  '<p><a href="' . $this->getUrl() . '">Voir la suite</a></p>';
		return $html;

	}

	public static function getLastByCategory($category_id){
		return self::query('SELECT articles.id, articles.titre, contenu, category.titre AS categorie FROM ' . self::$table . ' LEFT JOIN category ON articles.category_id = category.id WHERE category_id = ?', [$category_id]);
	}

	public static function getLast() {
			return self::query('SELECT articles.id, articles.titre, contenu, category.titre AS categorie FROM ' . self::$table . ' LEFT JOIN category ON articles.category_id = category.id');
				
	}
}
