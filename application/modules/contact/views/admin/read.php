<h2><?php echo anchor('admin/contact', 'Contact'); ?> &raquo; <em><?php echo $contact->subject; ?></em></h2>
<?php echo br(); ?>
<p><strong>De :</strong> <?php echo mb_strtoupper($contact->lastname).' '.$contact->firstname.' <em>('.$contact->email.')</em>'; ?></p>
<p><strong>Envoyé le :</strong> <?php echo mdate("%d/%m/%Y à %Hh%i", strtotime($contact->date_sent)); ?></p>
<?php echo br(); ?>
<p><?php echo nl2br($contact->message); ?></p>