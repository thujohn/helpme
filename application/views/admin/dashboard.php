<?php
$_contacts = '';
if (!empty($last_contacts)){
	$cpt = 1;
	$_contacts .= '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">';
	$_contacts .= '<thead><tr><th colspan="4">Derniers contacts</th></tr></thead>';
	foreach ($last_contacts as $contact) {
		if ($cpt%2 == 0){
			$_contacts .= '<tr class="odd">';
		}else{
			$_contacts .= '<tr class="even">';
		}
		$_contacts .= '<td class="table_id"><div class="tcenter"><a href="'.site_url('admin/contact/read/'.$contact->id).'">#'.$contact->id.'</a></div></td>';
		$_contacts .= '<td class="table_date"><div class="tcenter">'.anchor('admin/contact/read/'.$contact->id, mdate('%d/%m/%Y', strtotime($contact->date_sent))).'</div></td>';
		$_contacts .= '<td class="table_email"><div>'.anchor('admin/contact/read/'.$contact->id, $contact->email).'</div></td>';
		$_contacts .= '<td><div>'.anchor('admin/contact/read/'.$contact->id, $contact->subject).'</div></td>';
		$_contacts .= '</tr>';
		$cpt++;
	}
	$_contacts .= '</table>';
}

$_tickets_open = '';
if ($last_tickets_open){
	$cpt = 1;
	$_tickets_open .= '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">';
	$_tickets_open .= '<thead><tr><th colspan="4">Derniers tickets ouverts</th></tr></thead>';
	foreach ($last_tickets_open as $ticket) {
		if ($cpt%2 == 0){
			$_tickets_open .= '<tr class="odd">';
		}else{
			$_tickets_open .= '<tr class="even">';
		}
		$_tickets_open .= '<td class="table_id"><div class="tcenter"><a href="'.site_url('admin/ticket/'.$ticket->id).'">#'.$ticket->id.'</a></div></td>';
		$_tickets_open .= '<td class="table_date"><div class="tcenter">'.anchor('admin/ticket/'.$ticket->id, mdate('%d/%m/%Y', strtotime($ticket->date_add))).'</div></td>';
		$_tickets_open .= '<td><div>'.anchor('admin/ticket/'.$ticket->id, $ticket->title).'</div></td>';
		$_tickets_open .= '</tr>';
		$cpt++;
	}
	$_tickets_open .= '</table>';
}

$_tickets_closed = '';
if ($last_tickets_closed){
	$cpt = 1;
	$_tickets_closed .= '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">';
	$_tickets_closed .= '<thead><tr><th colspan="4">Derniers tickets fermés</th></tr></thead>';
	foreach ($last_tickets_closed as $ticket) {
		if ($cpt%2 == 0){
			$_tickets_closed .= '<tr class="odd">';
		}else{
			$_tickets_closed .= '<tr class="even">';
		}
		$_tickets_closed .= '<td class="table_id"><div class="tcenter"><a href="'.site_url('admin/ticket/'.$ticket->id).'">#'.$ticket->id.'</a></div></td>';
		$_tickets_closed .= '<td class="table_date"><div class="tcenter">'.anchor('admin/ticket/'.$ticket->id, mdate('%d/%m/%Y', strtotime($ticket->date_add))).'</div></td>';
		$_tickets_closed .= '<td><div>'.anchor('admin/ticket/'.$ticket->id, $ticket->title).'</div></td>';
		$_tickets_closed .= '</tr>';
		$cpt++;
	}
	$_tickets_closed .= '</table>';
}
?>
<h2>Tableau de bord</h2>
<?php echo $_contacts; ?>
<?php echo $_tickets_open; ?>
<?php echo $_tickets_closed; ?>