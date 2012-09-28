<?php
$_questions = '';
if (!empty($questions)){
	$cpt = 1;
	$_questions .= '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">';
	foreach ($questions as $question) {
		if ($cpt%2 == 0){
			$_questions .= '<tr class="odd" id="recordsArray_'.$question->id.'">';
		}else{
			$_questions .= '<tr class="even" id="recordsArray_'.$question->id.'">';
		}
		$_questions .= '<td class="table_id"><div class="tcenter"><a href="'.site_url('admin/faq/update/'.$question->id).'">#'.$question->id.'</a></div></td>';
		$_questions .= '<td><div>'.anchor('admin/faq/update/'.$question->id, $question->question).'</div></td>';
		$_questions .= '<td class="table_act"><div class="tcenter"><a href="'.site_url('admin/faq/update/'.$question->id).'" title="Modifier la question">'.image_asset('pencil.png').'</a></div></td>';
		$_questions .= '<td class="table_act"><div class="tcenter"><a href="'.site_url('admin/faq/delete/'.$question->id).'" title="Supprimer la question" onclick="return confirm(\'Supprimer &quot;'.str_replace('\'','\\\'',$question->question).'&quot; ?\')">'.image_asset('cross.png').'</a></div></td>';
		$_questions .= '</tr>';
		$cpt++;
	}
	$_questions .= '</table>';
}
?>
<div class="pull-right"><?php echo anchor('admin/faq/create', '<i class="icon-plus"></i> Ajouter une question', 'class="btn"'); ?></div>
<h2>FAQ</h2>
<?php echo $_questions; ?>