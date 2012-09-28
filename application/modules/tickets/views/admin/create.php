<div style="margin:10px 0 30px 0;padding:0 20px 10px 20px;border:1px solid #ddd;-webkit-border-radius:6px;-moz-border-radius:6px;border-radius:6px;">
	<h2>Nouveau ticket</h2>
	<br />
	<?php echo form_open_multipart('', array('id' => 'frm_create', 'class' => 'form-horizontal clearfix')); ?>
		<div class="control-group">
			<label class="control-label" for="title">Titre</label>
			<div class="controls">
				<input type="text" name="title" id="title" class="span4" />
				<?php echo form_error('title'); ?>
			</div>
		</div>
		<div class="control-group">
			<textarea name="text" id="text" cols="30" rows="10" style="width:98.5%;" placeholder="Merci d'apporter le plus de précisions possible..."></textarea>
			<?php echo form_error('text'); ?>
		</div>
		<div class="control-group">
			<label class="control-label" for="attachment">Pièce jointe</label>
			<div class="controls">
				<input type="file" name="attachment" id="attachment" />
				<?php echo form_error('attachment'); ?>
			</div>
		</div>
		<button href="submit" class="btn btn-info pull-right">Créer</button>
	</form>
</div>