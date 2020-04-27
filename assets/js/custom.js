jQuery(document).ready(function($){
	jQuery('#searchform input[type="text"]').attr("placeholder", "What you are looking for?");
	window.load_more_poastAajx = true;
	/* autoload next post */
	$(window).on('scroll', function(e) {
		if ( $('.single-blog-container').length > 0 ) {
			if ($(window).scrollTop() >= $('.single-blog-container').offset().top + $('.single-blog-container').outerHeight() - window.innerHeight) {
	        	var id = $('body').find('article').last().attr('id');

	        	id = id.replace('post-', '');

	        	console.log(id);

	        	if ( window.load_more_poastAajx ) {

	        		 window.load_more_poastAajx = false;

	        		 window.jQuery.post( 
						window.ajaxurl,
						{
							action: 'vgl_loadmore_blogs',
							data: {
								theID: id
							}
						},
						{
							headers: {
								'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
								'Accept': 'text/html, */*; q=0.01'
							}
						}
					)
					.success( response => { $('.main-content').append(response); console.log(response); window.load_more_poastAajx = true; });
	        	}
	        } 
		}
	});
});