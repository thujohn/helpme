<div class="span12">
	<h2>Contactez-nous</h2>
	<div class="alert"><strong>Attention !</strong> Aucun support n'est assuré via cette page !</div>
	<div id="note"></div>
	<?php echo form_open('', array('id' => 'ajax-contact-form', 'class' => 'form-horizontal clearfix')); ?>
		<div class="control-group pull-left">
			<div class="input-prepend"><span class="add-on" style="width:50px;">Nom</span><input type="text" class="span5" name="lastname" id="prependedInput" size="16" /></div>
			<?php echo form_error('lastname'); ?>
		</div>
		<div class="control-group pull-right">
			<div class="input-prepend"><span class="add-on" style="width:50px;">E-mail</span><input type="text" class="span5" name="email" id="prependedInput" size="16" /></div>
			<?php echo form_error('email'); ?>
		</div>
		<div class="control-group pull-left">
			<div class="input-prepend"><span class="add-on" style="width:50px;">Prénom</span><input type="text" class="span5" name="firstname" id="prependedInput" size="16" /></div>
			<?php echo form_error('firstname'); ?>
		</div>
		<div class="control-group pull-right">
			<div class="input-prepend"><span class="add-on" style="width:50px;">Objet</span><input type="text" class="span5" name="subject" id="prependedInput" size="16" /></div>
			<?php echo form_error('subject'); ?>
		</div>
		<div class="control-group">
			<textarea name="message" id="message" cols="30" rows="10" style="width:99%;" placeholder="Laissez-nous votre message..."></textarea>
			<?php echo form_error('message'); ?>
		</div>
		<button href="submit" class="btn btn-info pull-right">Envoyer le message</button>
	</form>
</div>