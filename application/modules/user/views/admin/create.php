<?php
end($roles);
$key = key($roles);
?>
<h2><?php echo anchor('admin/user', 'Les Utilisateurs'); ?> &raquo; <em>Nouvel utilisateur</em></h2>
<br />
<?php echo form_open('', array('class' => 'form-horizontal')); ?>
	<div class="control-group">
		<label class="control-label" for="status">Statut</label>
		<div class="controls"><?php echo form_dropdown('status', $status, (set_value('status')) ? set_value('status') : 'actif', 'id="status" class="span4"'); ?></div>
		<?php echo form_error('status'); ?>
	</div>
	<div class="control-group">
		<label class="control-label" for="role">Rôle</label>
		<div class="controls"><?php echo form_dropdown('role', $roles, (set_value('role')) ? set_value('role') : $key, 'id="role" class="span4"'); ?></div>
		<?php echo form_error('role'); ?>
	</div>
	<div class="control-group">
		<label class="control-label" for="lastname">Nom</label>
		<div class="controls">
			<input type="text" class="span4" name="lastname" id="lastname" value="" />
			<?php echo form_error('lastname'); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="firstname">Prénom</label>
		<div class="controls">
			<input type="text" class="span4" name="firstname" id="firstname" value="" />
			<?php echo form_error('firstname'); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="email">Adresse e-mail</label>
		<div class="controls">
			<input type="text" class="span4" name="email" id="email" value="" />
			<?php echo form_error('email'); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="username">Nom d'utilisateur</label>
		<div class="controls">
			<input type="text" class="span4" name="username" id="username" value="" />
			<?php echo form_error('username'); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password">Mot de passe</label>
		<div class="controls">
			<input type="password" class="span4" name="password" id="password" value="" />
			<?php echo form_error('password'); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="sitename">Nom du site</label>
		<div class="controls">
			<input type="text" class="span4" name="sitename" id="sitename" value="" />
			<?php echo form_error('sitename'); ?>
		</div>
	</div>
	<br />
	<input class="btn btn-danger" type="submit" value="Ajouter l'utilisateur" />
</form>