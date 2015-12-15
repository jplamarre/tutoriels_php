<?php
if ($errors) {
?>

<div class="alert alert-danger">
	Identifiant incorrect
</div>
<?php 
} 
?>


<form action="#" method="post">
<?= $form->input('username'); ?>
<?= $form->input('password'); ?>
<?= $form->submit(); ?>
</form>
