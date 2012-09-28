<?php
$_contacts = '';
if (!empty($contacts)){
	$cpt = 1;
	$_contacts .= '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">';
	foreach ($contacts as $contact) {
		if ($cpt%2 == 0){
			$_contacts .= '<tr class="odd">';
		}else{
			$_contacts .= '<tr class="even">';
		}
		$_contacts .= '<td class="table_id"><div class="tcenter"><a href="'.site_url('admin/contact/read/'.$contact->id).'">#'.$contact->id.'</a></div></td>';
		$_contacts .= '<td class="table_date"><div class="tcenter">'.anchor('admin/contact/read/'.$contact->id, mdate('%d/%m/%Y', strtotime($contact->date_sent))).'</div></td>';
		$_contacts .= '<td class="table_email">'.anchor('admin/contact/read/'.$contact->id, $contact->email).'</div></td>';
		$_contacts .= '<td><div>'.anchor('admin/contact/read/'.$contact->id, $contact->subject).'</div></td>';
		$_contacts .= '<td class="table_act"><div class="tcenter"><a href="'.site_url('admin/contact/read/'.$contact->id).'">'.image_asset('eye.png').'</a></div></td>';
		$_contacts .= '</tr>';
		$cpt++;
	}
	$_contacts .= '</table>';
}
?>
<h2>Contact</h2>
<?php echo $_contacts; ?>