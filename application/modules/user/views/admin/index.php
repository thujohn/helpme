<?php
$_users = '';
if (!empty($users)){
	$cpt = 1;
	$_users .= '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">';
	foreach ($users as $user) {
		if ($cpt%2 == 0){
			$_users .= '<tr class="odd">';
		}else{
			$_users .= '<tr class="even">';
		}
		if ($user->id == $this->session->userdata('id')){
				$online_img = 'bullet_blue';
		}else{
			if ($user->status == "active"){
				$online_img = 'bullet_green';
			}else{
				$online_img = 'bullet_red';
			}
		}
		$_users .= '<td class="table_id"><div class="tcenter"><a href="'.site_url('admin/user/update/'.$user->id).'">#'.$user->id.'</a></div></td>';
		$_users .= '<td class="table_act"><div class="tcenter"><a href="'.site_url('admin/user/status/'.$user->id).'">'.image_asset(''.$online_img.'.png').'</a></div></td>';
		$_users .= '<td><div><a href="'.site_url('admin/user/status/'.$user->id).'">'.$user->sitename.'</a></div></td>';
		$_users .= '<td><div>'.anchor('admin/user/update/'.$user->id, mb_strtoupper($user->lastname).' '.$user->firstname.' <em>('.$user->email.')</em>').'</div></td>';
		$_users .= '<td class="table_act"><div class="tcenter"><a href="'.site_url('admin/user/update/'.$user->id).'" title="Modifier l\'utilisateur">'.image_asset('pencil.png').'</a></div></td>';
		$_users .= '</tr>';
		$cpt++;
	}
	$_users .= '</table>';
}
?>
<div class="pull-right"><?php echo anchor('admin/user/create', '<i class="icon-plus"></i> Ajouter un utilisateur', 'class="btn"'); ?></div>
<h2>Les Utilisateurs</h2>
<div class="clear"></div>
<?php echo $_users; ?>