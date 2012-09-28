jQuery(document).ready(function(){
	jQuery(function() {
		jQuery("table").sortable({
			items: 'tr',
			opacity: 0.6,
			cursor: 'move',
			update: function() {
				var order = jQuery(this).sortable("serialize");
				var cct = jQuery.cookie('helpme_cookie');
				jQuery.post(current_url+'/sort', {"recordsArray" : order, "helpme_token" : cct}, function(theResponse){
					jQuery("#result").html(theResponse);
				});
			}
		});
	});
});