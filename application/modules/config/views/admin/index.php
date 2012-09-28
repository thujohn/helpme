<h2>Configuration</h2>
<br />
<?php echo form_open('', array('class' => 'form-horizontal')); ?>
	<div class="control-group">
		<label class="control-label" for="sitename">Nom du Site</label>
		<div class="controls">
			<input type="text" class="span4" name="sitename" id="sitename" value="<?php echo $config->sitename; ?>" />
			<?php echo form_error('sitename'); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="noreply">E-mail de réponse</label>
		<div class="controls">
			<input type="text" class="span4" name="noreply" id="noreply" value="<?php echo $config->noreply; ?>" />
			<?php echo form_error('noreply'); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="system_email">E-mail système</label>
		<div class="controls">
			<input type="text" class="span4" name="system_email" id="system_email" value="<?php echo $config->system_email; ?>" />
			<?php echo form_error('system_email'); ?>
		</div>
	</div>
	<br />
	<input class="btn btn-danger" type="submit" value="Enregistrer la configuration" />
</form>