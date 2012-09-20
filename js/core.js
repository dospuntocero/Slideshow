;(function($) {
	$(document).ready(function() {
		$('#slideshow').append('<div class="pager"></div>');
		$('#slideshow').append('<div class="prev"></div>');
		$('#slideshow').append('<div class="next"></div>');
		$('#slideshow ul').cycle({
			fx:'fade',
			timeout:5000,
			pager:'#slideshow .pager',
			next:'#slideshow .next',
			prev:'#slideshow .prev'
		});
	})
})(jQuery);
