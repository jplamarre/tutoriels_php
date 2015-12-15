<?php
namespace App\Controller;
use Core\Controller\Controller;


class PostsController extends AppController{


	public function __construct(){
		parent::__construct();
		$this->loadModel('Article');
		$this->loadModel('Category');
	}

	public function index(){
		$articles = $this->Article->last();
		$categories = $this->Category->all();
		$this->render('posts.index', compact('articles', 'categories'));
	}


	public function category(){
		$categorie = $this->Category->find($_GET['id']);

		if($categorie == null) {
			$this->notFound();
		}

		$articles = $this->Article->getLastByCategory($_GET['id']);

		$categories = $this->Category->all();
		$this->render('posts.index', compact('articles', 'categories', 'categorie'));
	}

	public function single(){
		$article = $this->Article->find($_GET['id']);
		$this->render('posts.single', compact('article'));
	}
}

?>
