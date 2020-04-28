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

	        		 $('.lightening-loading').show();

	        		 setTimeout(function() {
	        		 	window.jQuery.post( 
							window.ajaxurl,
							{
								action: 'vgl_loadmore_blogs',
								data: {
									theID: id,
									isNext: 'true'
								}
							},
							{
								headers: {
									'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
									'Accept': 'text/html, */*; q=0.01'
								}
							}
						)
						.success( response => { 
							var res = JSON.parse(response); 

							if (res.status == 'ok') {
								$('.main-content').append(res.article); 
								$('.lightening-loading').hide(); 
								$('.blog-post-sidebar').empty().append(res.sidebar); 
							}

							window.load_more_poastAajx = true; 
						});
	        		 }, 500);
	        	}
	        } 
		}
	});

	/* Change Blog Sidebar posts when post scroll */
	$(window).on('scroll', function(e) {

		jQuery.each( $('body').find('.single-blog-container article'), (key, value) => {
			
			// console.log($(window).scrollTop());

			if ( $(value).offset().top > $(window).scrollTop() && $(value).offset().top < $(window).scrollTop() + $(window).height() ) {

				var id = $(value).data('id');

				var data = new Array();

				var _this = $(value);

				data.push({ 'id': $(_this).data('id'), 'featured_image': $(_this).find('.single-post-header .featured-image img').attr('src'), 'title': $(_this).find('.entry-title').text() });

				for (var i = 0; i < 3; i++) {
					if ( _this.next().length > 0 ) {

						_this = _this.next();

						data.push({ 'id': $(_this).data('id'), 'featured_image': $(_this).find('.single-post-header .featured-image img').attr('src'), 'title': $(_this).find('.entry-title').text() });

					} else {

						break;

					}
				}

				// console.log(data);

				if ( $('body').find('.blog-post-individual.active[data-id="' + id + '"]').length <= 0 ) {

					$('body').find('.blog-post-individual').not('.last').detach();

					$('body').find('.blog-post-individual.last').hide();

					var html = '';

					for (var i = 0; i < data.length; i++) {

						if ( i == 0 ) {
							html += '<div class="blog-post-individual active" data-id="' + data[i].id + '">' + '<div class="blog-post-individual-featuredimg" style="background-image:url(' + data[i].featured_image + ')"></div>' + '<div class="blog-post-individual-title">' + data[i].title + '</div>' + '</div>';
						} else {
							html += '<div class="blog-post-individual" data-id="' + data[i].id + '">' + '<div class="blog-post-individual-featuredimg" style="background-image:url(' + data[i].featured_image + ')"></div>' + '<div class="blog-post-individual-title">' + data[i].title + '</div>' + '</div>';
						}

					}

					for (var i = data.length; i < 4; i++) {

						$('body').find('.blog-post-individual.last').eq( i - data.length).show();

					}

					$('body').find('.blog-post-sidebar').prepend(html);

					console.log(html);

				}

				return false;
			}
		} );
	});

	/* Load Post When sidebar item clicked */
	$('body').on('click', '.blog-post-sidebar .blog-post-individual', function(e) {

		if ($('body').find('article[data-id="' + $(this).data('id') + '"]').length > 0 ) {
			$([document.documentElement, document.body]).animate({scrollTop: $("article[data-id=" + $(this).data('id') + "]").offset().top - 100}, 1000);
		}

		if ( window.load_more_poastAajx ) {

			 window.load_more_poastAajx = false;

			 var id = $(this).data('id');

			 $('.lightening-loading').show();

			 setTimeout(function() {
			 	window.jQuery.post( 
					window.ajaxurl,
					{
						action: 'vgl_loadmore_blogs',
						data: {
							theID: id,
							isNext: 'false'
						}
					},
					{
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
							'Accept': 'text/html, */*; q=0.01'
						}
					}
				)
				.success( response => { 
					var res = JSON.parse(response); 

					if (res.status == 'ok') {
						$('.main-content').append(res.article); 
						$('.lightening-loading').hide(); $('.blog-post-sidebar').empty().append(res.sidebar); window.load_more_poastAajx = true; $([document.documentElement, document.body]).animate({scrollTop: $("article[data-id=" + id + "]").offset().top - 100}, 1000);
					}

				});
			 }, 500);
		}
	});
});