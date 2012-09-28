<?php
if ($ticket->state == 'open'){
	$state = '<span class="badge badge-success pull-right">Ouvert</span>'."\n";
}else{
	$state = '<span class="badge badge-important pull-right">Fermé</span>'."\n";
}
?>
<div id="doc-tpl">
	<h2><?php echo $state.' '.$ticket->title; ?></h2>
	<div class="bs-docs-example first-post">
		<div class="date"><span><?php echo mdate('%d/%m/%Y à %Hh%i', strtotime($ticket->date_add)); ?></span></div>
		<?php echo nl2br($ticket->text); ?>
	</div>
	<?php if (!empty($ticket->attachment_id)) : ?>
	<div class="prettyprint"><?php echo anchor('attachment/get/ticket/'.$ticket->id, 'Pièce jointe', 'class="btn btn-small btn-danger"'); ?></div>
	<?php endif; ?>
	<?php foreach ($responses as $response) : ?>
	<hr id="post-<?php echo $response->id; ?>" />
	<div class="bs-docs-example">
		<div class="date"><span><?php echo mb_strtoupper($response->lastname).' '.$response->firstname; ?></span>, <?php echo mdate('%d/%m/%Y à %Hh%i', strtotime($response->date_add)); ?></div>
		<?php echo nl2br($response->text); ?>
	</div>
	<?php if (!empty($response->attachment_id)) : ?>
	<div class="prettyprint"><?php echo anchor('attachment/get/response/'.$response->id, 'Pièce jointe', 'class="btn btn-small btn-danger"'); ?></div>
	<?php endif; ?>
	<?php endforeach; ?>
	<?php if ($ticket->state == 'open') : ?>
	<hr />
	<?php echo form_open_multipart('', array('id' => 'frm_reply', 'class' => 'form-horizontal clearfix')); ?>
		<legend>RÉPONDRE</legend>
		<div class="control-group">
			<textarea name="text" id="text" cols="30" rows="10" style="width:98.5%;"></textarea>
			<?php echo form_error('text'); ?>
		</div>
		<div class="control-group">
			<label class="control-label" for="attachment">Pièce jointe</label>
			<div class="controls">
				<input type="file" name="attachment" id="attachment" />
				<?php echo form_error('attachment'); ?>
			</div>
		</div>
		<?php echo anchor('tickets/close/'.$ticket->id, 'Fermer', 'class="btn btn-success"'); ?>
		<button href="submit" class="btn btn-info pull-right">Répondre</button>
	</form>
	<?php endif; ?>
</div>