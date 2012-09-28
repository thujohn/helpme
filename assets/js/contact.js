jQuery("#ajax-contact-form").submit(function (){
	var str = jQuery(this).serialize();
	jQuery.ajax({
		type: "POST",
		url: base_url+"contact/send",
		data: str,
		beforeSend: function(){
			jQuery("#note").html('<div class="tcenter"><img src="'+assets_url+'img/ajax-loader.gif" alt="Envoi en cours..." /></div>');
		},
		success: function (msg){
			jQuery("#note").ajaxComplete(function (event, request, settings){
				if (msg == 'OK'){
					result = '<div>Votre message a été envoyé avec succès<br />Nous vous souhaitons une agréable journée.</div>';
					jQuery("#ajax-contact-form").hide();
				}else{
					result = msg;
				}
				jQuery(this).html(result);
			});
		}
	});
	return false;
});