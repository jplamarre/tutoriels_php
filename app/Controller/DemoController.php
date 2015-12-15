<?php
namespace App\Controller;

class DemoController extends AppController{


	public function index(){
		require ROOT . '/Query.php';
		echo \Query::select('id', 'titre', 'contenu')->from('articles')->where('id = 1')->where('article.category_id = 1')->where('article.date > NOW()');
	}
}

?>
