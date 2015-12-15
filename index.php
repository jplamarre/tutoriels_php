<?php

define('ROOT', dirname(__DIR__).'/www');

require ROOT . '/app/App.php';

App::load();

$app  = App::getInstance();

if (isset($_GET['p'])){
	$p = $_GET['p'];
} else {
	$p = 'posts.index';
} 

$page = explode('.', $p);

if ($page[0] == 'admin'){
	$controller = '\App\Controller\Admin\\' . ucfirst($page[1]) . 'Controller';
	$action = $page[2];
}else {	
	$action = $page[1];
	$controller = '\App\Controller\\' .ucfirst($page[0]) . 'Controller';
}
$controller = new $controller();

$controller->$action();
?>

