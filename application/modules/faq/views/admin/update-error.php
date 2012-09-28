<div id="container_error">
	<h2>Erreur lors de la mise à jour de la question</h2>
	<?php if (!empty($errors)) : ?>
	<?php foreach ($errors as $error) : ?>
	<div>- <?php echo $error; ?></div>
	<?php echo br(); ?>
	<?php endforeach; ?>
	<?php endif; ?>
	<?php echo br(); ?>
	<div><a href="javascript:history.go(-1);" class="btn">Retour</a></div>
	<?php echo br(); ?>
</div>