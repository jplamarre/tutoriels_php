<?php

$result = null;

$table = App::getInstance()->getTable('Category');
if (!empty($_POST)){
	$result = $table->create([
		'titre' => $_POST['titre']
	]);	
}

if ($result){
	header('Location: admin.php?p=categories.index');
?>
<div class="alert alert-success">La categorie a bien ete ajoute</div>
<?php
}
$form = new \Core\HTML\Form($_POST);
?>

<form action="#" method="post">
<?= $form->input('titre'); ?>
<?= $form->submit(); ?>
</form>
