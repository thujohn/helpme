jQuery(document).ready(function(){
	jQuery('.bs-docs-sidenav').affix({
		offset: {
			top: function () { return $(window).width() <= 980 ? 90 : 70 },
			bottom: 90
		}
	});
});