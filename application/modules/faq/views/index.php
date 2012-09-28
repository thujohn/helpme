<?php
$faq = '';
if (!empty($questions)) {
	$cpt = 1;
	$faq .= '<div class="accordion" id="accordion2">';
	foreach ($questions as $question) {
		$cls = 'accordion-body collapse';
		if ($cpt == 1){
			$cls .= ' in';
		}
		$faq .= '<div class="accordion-group">';
		$faq .= '<div class="accordion-heading"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$cpt.'">'.$question->question.'</a></div>';
		$faq .= '<div id="collapse'.$cpt.'" class="'.$cls.'">';
		$faq .= '<div class="accordion-inner">'.nl2br($question->answer).'</div>';
		$faq .= '</div>';
		$faq .= '</div>';
		$cpt++;
	}
	$faq .= '</div>';
}
?>
<h2>Foire Aux Questions</h2>
<?php echo $faq; ?>