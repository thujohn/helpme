<div id="container_error">
	<h2>Erreur lors de la tentative de connexion</h2>
	<?php if (!empty($errors)) : ?>
	<?php foreach ($errors as $error) : ?>
	<div>- <?php echo $error; ?></div>
	<br />
	<?php endforeach; ?>
	<?php endif; ?>
	<br />
	<div><a href="javascript:history.go(-1);" class="btn">Retour</a></div>
	<br />
</div>