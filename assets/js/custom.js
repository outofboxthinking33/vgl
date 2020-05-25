jQuery(document).ready(function($){
	jQuery('#searchform input[type="text"]').attr("placeholder", "What you are looking for?");
	window.load_more_poastAajx = true;

	const checkFixedHeader = () => {
		// change header color on scroll
		if($(window).scrollTop() > 10) {
	      $('.header').addClass('filled');
	      $('body').addClass('scrolled');

	      // handle border overlay
	      var mainPostColor = $('[data-post-color]').last().data('post-color');
	      $('header.filled .main-header').css('border-color', mainPostColor);
	    } else {
	      //remove the background property so it comes transparent again
	      $('.header').removeClass('filled');
	      $('body').removeClass('scrolled');
	      $('header .main-header').css('border-color', 'transparent');
	    }

	    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
	      	$('body').addClass('bottom');
	   	} else {
	   	    $('body').removeClass('bottom');
	   	} 	
	}

	checkFixedHeader();

	/* autoload next post */
	$(window).on('scroll', function(e) {
        checkFixedHeader();

		// Deal auto load on screen wider than 1024px width
		if ( $('.single-blog-container').length > 0 && $(window).width() >= 1024) {
			// At the End of blogs
			if ($(window).scrollTop() + $(window).height() >= $('.single-blog-container').offset().top + $('.single-blog-container').outerHeight()) {
	        	var id = $('body').find('article').last().attr('id');

	        	id = id.replace('post-', '');

	        	if ( window.load_more_poastAajx ) {

	        		 window.load_more_poastAajx = false;

	        		 $('.lightening-loading').show();

	        		 setTimeout(function() {

						 if ( id == $('body').find('.blog-post-sidebar .blog-post-individual:visible').last().data('id') ) {
						 	loadSidebarNextArticle = true;
						 } else {
						 	loadSidebarNextArticle = false;
						 }

	        		 	window.jQuery.post( 
							window.ajaxurl,
							{
								action: 'vgl_loadmore_blogs',
								data: {
									theID: id,
									isNext: 'true',
									loadSidebarNextArticle: loadSidebarNextArticle
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
								$('.main-content').append('<div class="zigzag"></div>'); 
								$('.main-content').append(res.article); 
								$('.lightening-loading').hide(); 

								console.log($('body').find('article').last().data('id'));
								console.log($('body').find('.blog-post-sidebar .blog-post-individual').last().data('id'));

								if ( $('body').find('article').last().data('id') == $('body').find('.blog-post-sidebar .blog-post-individual').last().data('id') ) {
									$('body').find('.blog-post-sidebar .blog-post-individual').first().remove();
									$('body').find('.blog-post-sidebar .blog-post-individual').last().remove();
									$('.blog-post-sidebar').append(res.sidebar);
								} else if ( id == $('body').find('.blog-post-sidebar .blog-post-individual').last().data('id') ) {
									$('body').find('.blog-post-sidebar .blog-post-individual').first().remove();
									$('body').find('.blog-post-sidebar .blog-post-individual').first().remove();
									$('.blog-post-sidebar').append(res.sidebar);
								}

								$('body').find('.blog-post-sidebar .blog-post-individual').removeClass('active');
								$('body').find('.blog-post-sidebar .blog-post-individual[data-id=' + res.currentPostId + ']').addClass('active');
							}

							window.load_more_poastAajx = true; 
						});
	        		 }, 500);
	        	}
	        } else { // Screen in the middle of blogs
	        	$.each($('body').find('.single-blog-container article'), (index, value) => {	

	        		var elementTop = $(value).offset().top;
					var elementBottom = elementTop + $(value).outerHeight();
					var viewportTop = $(window).scrollTop();
					var viewportBottom = viewportTop + $(window).height();

	        		if ( elementBottom > viewportTop && elementTop < viewportBottom && window.load_more_poastAajx) {

	        			var currentSideItems = '';
	        			var currentArticleID = $(value).data('id');
	        			var direction = 'append';

	        			$.each( $('body').find('.blog-post-individual'), (index, value) => {
	        				currentSideItems += $(value).data('id') + '|';
	        			} );

	        			if ( currentArticleID == $('body').find('.single-blog-container article').first().data('id') ) {
	        				if ( currentSideItems.indexOf(currentArticleID + '|') >= 0 ) {
	        					direction = 'middle';
	        				} else {
	        					direction = 'prepend';
	        				}
	        			} else if ( currentArticleID == $('body').find('.single-blog-container article').last().data('id') ) {
	        				if ( currentSideItems.indexOf(currentArticleID + '|') >= 0 ) {
	        					direction = 'middle';
	        				} else {
	        					direction = 'append';
	        				}
	        			} else {
	        				if ( currentSideItems.indexOf(currentArticleID + '|') >= 0 ) {
	        					direction = 'middle';
	        				} else {
	        					if ( $(value).prev().length > 0 ) {
	        						if ( currentSideItems.indexOf($(value).prev().data('id')) >= 0 ) direction = 'append';
	        					}

	        					if ( $(value).next().length > 0 ) {
	        						if ( currentSideItems.indexOf($(value).next().data('id')) >= 0 ) direction = 'prepend';
	        					}
	        				}
	        			}

	        			var html = '<div data-id="' + currentArticleID + '" class="blog-post-individual"><div class="blog-post-individual-featuredimg" style="background-image:url(' + $(value).find('.featured-image img').attr('src') + ')"></div><div class="blog-post-individual-title">' + $(value).find('.entry-title').text() + '</div></div>';

	        			if ( direction == 'append' ) {
	        				$('body').find('.blog-post-individual').first().remove();
	        				$('body').find('.blog-post-sidebar').append(html);
	        			} else if ( direction == 'prepend' ) {
	        				$('body').find('.blog-post-individual').last().remove();
	        				$('body').find('.blog-post-sidebar').prepend(html);
	        			}

	        			// Activate current sidebar
	        			$('body').find('.blog-post-individual').removeClass('active');
	        			$('body').find('.blog-post-individual[data-id=' + currentArticleID + ']').addClass('active');
	        		}
	        	});
	        }
		}
	});

	/* Load Post When sidebar item clicked */
	$('body').on('click', '.blog-post-sidebar .blog-post-individual', function(e) {

		if ($(window).width() >= 1024) {
			if ($('body').find('article[data-id="' + $(this).data('id') + '"]').length > 0 ) {
				$([document.documentElement, document.body]).animate({scrollTop: $("article[data-id=" + $(this).data('id') + "]").offset().top - 100}, 1000);
			} else {
				$([document.documentElement, document.body]).animate({scrollTop: $(".single-blog-container").offset().top + $(".single-blog-container").innerHeight()}, 1000);
			}
		} else {
			window.location = $(this).data('link');
		}
	});

	// Background Gradient Animation
	$(window).on('scroll', function(e) { 
		var bgStart = '';
		var bgEnd = '';
		var index = 0;

		jQuery.each( jQuery.find('.gradient-background') , (key, value) => {
			if ( ($(value).offset().top >= $(window).scrollTop() && $(value).offset().top < $(window).scrollTop() + $(window).height()) || ($(value).offset().top + $(value).outerHeight() >= $(window).scrollTop() && $(value).offset().top + $(value).outerHeight() < $(window).scrollTop() + $(window).height()) ) {
				bgStart = $(value).data('gradient-start');
				bgEnd = $(value).data('gradient-end');
				jQuery(jQuery.find('.gradient-background')).removeClass('active');
				$(value).addClass('active');
				// console.log($(value));
				return 0;
			}
		});

		if (jQuery.find('.gradient-background.active').length > 0) {
			jQuery.each( jQuery.find('.gradient-background'), (key, value) => {
				console.log(bgStart);
				console.log(bgEnd);

				if( !$(value).hasClass('active') ) {
					if ($(value).offset().top < jQuery(jQuery.find('.gradient-background.active')).offset().top) {
						var css = 'linear-gradient(' + bgStart + ' 0%, ' + bgStart + ' 100%)';
						$(value).css({'background-image': css});
					} else {
						$(value).css('background-image', 'linear-gradient(' + bgEnd + ' 0%, ' + bgEnd + ' 100%)');
					}
				} else {
					$(value).css('background-image', 'linear-gradient(' + bgStart + ' 0%, ' + bgEnd + ' 100%)');
				}
			});
		}

	});

	jQuery('.mode-dark').parents('body').addClass('mode-dark');
});