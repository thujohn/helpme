<?php
$str_tickets = '';
if ($tickets){
	foreach ($tickets as $kT => $vT){
		if ($vT['state'] == 'open'){
			$str_tickets .= '<li class="ticket_open">'."\n";
		}else{
			$str_tickets .= '<li class="ticket_close">'."\n";
		}
		$str_tickets .= '<a href="'.site_url('ticket/'.$vT['id']).'" class="clearfix">'."\n";
		if ($vT['state'] == 'open'){
			$str_tickets .= '<span class="badge badge-success">Ouvert</span>'."\n";
		}else{
			$str_tickets .= '<span class="badge badge-important">Fermé</span>'."\n";
		}
		$str_tickets .= '<span class="muted pull-right">'.mdate('%d/%m/%Y', strtotime($vT['date_add'])).'</span>'."\n";
		$str_tickets .= '<strong class="title">'.$vT['title'].'</strong>'."\n";
		$ticket_text = strip_tags($vT['text']);
		if (strlen($ticket_text) > 400){
			$str_tickets .= '<p>'.substr($ticket_text, 0, 400).'...</p>'."\n";
		}else{
			$str_tickets .= '<p>'.$ticket_text.'</p>'."\n";
		}
		$str_tickets .= '<span class="pull-right">Lire le ticket</span>'."\n";
		$str_tickets .= '</a>'."\n";
		$str_tickets .= '</li>'."\n";
	}
}
?>
<ul class="unstyled nav nav-list ct-list">
	<li><h2>Recherche : <em class="text-success">"<?php echo $search; ?>"</em></h2></li>
	<?php echo $str_tickets; ?>
</ul>
<?php if (isset($pagination)) : ?>
<div class="pagination tcenter"><?php echo $pagination; ?></div>
<?php endif; ?>