<h2><?php echo anchor('admin/faq', 'FAQ'); ?> &raquo; <em>Nouvelle question</em></h2>
<?php echo br(); ?>
<?php echo form_open_multipart('', array('class' => 'form-horizontal')); ?>
	<fieldset>
		<div class="control-group">
			<label class="control-label" for="question">Question</label>
			<div class="controls">
				<input type="text" class="span4" name="question" id="question" value="" />
				<?php echo form_error('question'); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="answer">Réponse</label>
			<div class="controls">
				<textarea id="answer" name="answer" cols="30" rows="10" style="width:98.5%;"></textarea>
				<?php echo form_error('answer'); ?>
			</div>
		</div>
		<?php echo br(); ?>
		<input class="btn btn-danger" type="submit" value="Ajouter la question" />
	</fieldset>
</form>