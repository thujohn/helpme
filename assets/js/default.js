jQuery(document).ready(function(){
	if (jQuery('.bs-docs-sidenav').length){
		jQuery('.bs-docs-sidenav').affix({
			offset: {
				top: function () { return jQuery(window).width() <= 980 ? 90 : 70 },
				bottom: 90
			}
		});
	}

	if (jQuery('.redactor_content').length){
		jQuery('.redactor_content').redactor({
			lang: 'fr',
			autoresize: false,
			buttons: ['html', '|', 'bold', 'italic', 'deleted', 'link', '|', 'alignleft', 'aligncenter', 'alignright', 'justify', '|', 'table', 'unorderedlist', 'orderedlist', 'outdent', 'indent', '|', 'horizontalrule']
		});
	}
});