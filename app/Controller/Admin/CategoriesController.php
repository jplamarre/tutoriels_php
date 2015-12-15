<?php
namespace App\Controller\Admin;

use Core\HTML\Form;

class CategoriesController extends AppController{


	public function __construct(){
		parent::__construct();
		$this->loadModel('Category');
	}

	public function index(){
		$items = $this->Category->all();
		$this->render('admin.categories.index', compact('items'));
	}

	public function add(){
		
		$result = null;
		
		if (!empty($_POST)){
			$result = $this->Category->create([
				'titre' => $_POST['titre']
			]);	
		}

		if ($result){
			 return $this->index();
		}

		$this->render('admin.categories.edit', compact('form'));
	}

	public function delete(){
		
		if(!empty($_POST)){
			$result = $this->Category->delete($_POST['id']);
			return $this->index();
		}
	}

	public function edit(){

		$result = null;

		if (!empty($_POST)){
			$result = $this->Category->update($_GET['id'],[
				'titre' => $_POST['titre']
			]);	
		}

		if ($result){
			return $this->index();
		}

		$category = $this->Category->find($_GET['id']);
		$form = new Form($category);
		$this->render('admin.categories.edit', compact('form'));
	}
}

?>

