<form action="#" method="post">
<?= $form->input('titre'); ?>
<?= $form->input('contenu'); ?>
<?= $form->select('category_id', $categories); ?>
<?= $form->submit(); ?>
</form>
