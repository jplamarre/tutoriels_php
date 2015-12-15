<?php
namespace App\Controller\Admin;

use Core\HTML\Form;

class PostsController extends AppController{


	public function __construct(){
		parent::__construct();
		$this->loadModel('Article');
	}

	public function index(){
		$articles = $this->Article->all();
		$this->render('admin.posts.index', compact('articles'));
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

	public function add(){
		
		$result = null;
		
		if (!empty($_POST)){
			$result = $this->Article->create([
				'titre' => $_POST['titre'],
				'contenu' => $_POST['contenu'],
				'category_id' => $_POST['category_id']
			]);	
		}

		if ($result){
			 return $this->index();
		}

		$this->loadModel('Category');
		$categories = $this->Category->extract('id', 'titre');
		$form = new Form($_POST);
		$this->render('admin.posts.edit', compact('categories', 'form'));
	}

	public function delete(){
		
		if(!empty($_POST)){
			$result = $this->Article->delete($_POST['id']);
			return $this->index();
		}
	}

	public function edit(){

		$result = null;

		if (!empty($_POST)){
			$result = $this->Article->update($_GET['id'],[
				'titre' => $_POST['titre'],
				'contenu' => $_POST['contenu'],
				'category_id' => $_POST['category_id']
			]);	
		}

		if ($result){
			$this->index();
		}


		$post = $this->Article->find($_GET['id']);
		$this->loadModel('Category');
		$categories = $this->Category->extract('id', 'titre');
		$form = new Form($post);
		$this->render('admin.posts.edit', compact('categories', 'form'));
	}
}

?>

