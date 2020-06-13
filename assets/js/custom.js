/*
 Sticky-kit v1.1.2 | WTFPL | Leaf Corcoran 2015 | http://leafo.net
*/
(function(){var b,f;b=this.jQuery||window.jQuery;f=b(window);b.fn.stick_in_parent=function(d){var A,w,J,n,B,K,p,q,k,E,t;null==d&&(d={});t=d.sticky_class;B=d.inner_scrolling;E=d.recalc_every;k=d.parent;q=d.offset_top;p=d.spacer;w=d.bottoming;null==q&&(q=0);null==k&&(k=void 0);null==B&&(B=!0);null==t&&(t="is_stuck");A=b(document);null==w&&(w=!0);J=function(a,d,n,C,F,u,r,G){var v,H,m,D,I,c,g,x,y,z,h,l;if(!a.data("sticky_kit")){a.data("sticky_kit",!0);I=A.height();g=a.parent();null!=k&&(g=g.closest(k));
if(!g.length)throw"failed to find stick parent";v=m=!1;(h=null!=p?p&&a.closest(p):b("<div />"))&&h.css("position",a.css("position"));x=function(){var c,f,e;if(!G&&(I=A.height(),c=parseInt(g.css("border-top-width"),10),f=parseInt(g.css("padding-top"),10),d=parseInt(g.css("padding-bottom"),10),n=g.offset().top+c+f,C=g.height(),m&&(v=m=!1,null==p&&(a.insertAfter(h),h.detach()),a.css({position:"",top:"",width:"",bottom:""}).removeClass(t),e=!0),F=a.offset().top-(parseInt(a.css("margin-top"),10)||0)-q,
u=a.outerHeight(!0),r=a.css("float"),h&&h.css({width:a.outerWidth(!0),height:u,display:a.css("display"),"vertical-align":a.css("vertical-align"),"float":r}),e))return l()};x();if(u!==C)return D=void 0,c=q,z=E,l=function(){var b,l,e,k;if(!G&&(e=!1,null!=z&&(--z,0>=z&&(z=E,x(),e=!0)),e||A.height()===I||x(),e=f.scrollTop(),null!=D&&(l=e-D),D=e,m?(w&&(k=e+u+c>C+n,v&&!k&&(v=!1,a.css({position:"fixed",bottom:"",top:c}).trigger("sticky_kit:unbottom"))),e<F&&(m=!1,c=q,null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),
h.detach()),b={position:"",width:"",top:""},a.css(b).removeClass(t).trigger("sticky_kit:unstick")),B&&(b=f.height(),u+q>b&&!v&&(c-=l,c=Math.max(b-u,c),c=Math.min(q,c),m&&a.css({top:c+"px"})))):e>F&&(m=!0,b={position:"fixed",top:c},b.width="border-box"===a.css("box-sizing")?a.outerWidth()+"px":a.width()+"px",a.css(b).addClass(t),null==p&&(a.after(h),"left"!==r&&"right"!==r||h.append(a)),a.trigger("sticky_kit:stick")),m&&w&&(null==k&&(k=e+u+c>C+n),!v&&k)))return v=!0,"static"===g.css("position")&&g.css({position:"relative"}),
a.css({position:"absolute",bottom:d,top:"auto"}).trigger("sticky_kit:bottom")},y=function(){x();return l()},H=function(){G=!0;f.off("touchmove",l);f.off("scroll",l);f.off("resize",y);b(document.body).off("sticky_kit:recalc",y);a.off("sticky_kit:detach",H);a.removeData("sticky_kit");a.css({position:"",bottom:"",top:"",width:""});g.position("position","");if(m)return null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),h.remove()),a.removeClass(t)},f.on("touchmove",l),f.on("scroll",l),f.on("resize",
y),b(document.body).on("sticky_kit:recalc",y),a.on("sticky_kit:detach",H),setTimeout(l,0)}};n=0;for(K=this.length;n<K;n++)d=this[n],J(b(d));return this}}).call(this);

/*!
 * jQuery Pretty Dropdowns Plugin v4.17.0 by T. H. Doan (https://thdoan.github.io/pretty-dropdowns/)
 *
 * jQuery Pretty Dropdowns by T. H. Doan is licensed under the MIT License.
 * Read a copy of the license in the LICENSE file or at https://choosealicense.com/licenses/mit/
 */
!function(e){e.fn.prettyDropdown=function(t){(t=e.extend({classic:!1,customClass:"arrow",width:null,height:50,hoverIntent:200,multiDelimiter:"; ",multiVerbosity:99,selectedMarker:"&#10003;",afterLoad:function(){}},t)).selectedMarker='<span aria-hidden="true" class="checked"> '+t.selectedMarker+"</span>",isNaN(t.width)&&!/^\d+%$/.test(t.width)&&(t.width=null),isNaN(t.height)?t.height=50:t.height<8&&(t.height=8),isNaN(t.hoverIntent)&&(t.hoverIntent=200),isNaN(t.multiVerbosity)&&(t.multiVerbosity=99);var a,i,s,r,l,d,n=["0","1","2","3","4","5","6","7","8","9",,,,,,,,"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"],c=function(a){var s,r=e(a),l=a.size,n=a.name||a.id||"";if(!r.data("loaded")){if(r.data("size",l).removeAttr("size"),r.css("visibility","hidden").outerHeight(t.height),d=1e14*performance.now(),a.id){var c=e("label[for="+a.id+"]");c.length&&(c.attr("id")&&!/^menu\d{13,}$/.test(c.attr("id"))?s=c.attr("id"):c.attr("id",s="menu"+d))}i=0;var v=e("optgroup, option",r),m=v.filter(":selected"),b=a.multiple,w="<ul"+(a.disabled?"":' tabindex="0"')+' role="listbox"'+(a.title?' title="'+a.title+'" aria-label="'+a.title+'"':"")+(s?' aria-labelledby="'+s+'"':"")+' aria-activedescendant="item'+d+'-1" aria-expanded="false" style="max-height:'+(t.height-2)+"px;margin:"+r.css("margin-top")+" "+r.css("margin-right")+" "+r.css("margin-bottom")+" "+r.css("margin-left")+';">';b?(w+=p(null,"selected"),v.each(function(){this.selected?w+=p(this,"",!0):w+=p(this)})):t.classic?v.each(function(){w+=p(this)}):(w+=p(m[0],"selected"),v.filter(":not(:selected)").each(function(){w+=p(this)})),w+="</ul>",r.wrap("<div "+(n?'id="prettydropdown-'+n+'" ':"")+'class="prettydropdown '+(t.classic?"classic ":"")+(a.disabled?"disabled ":"")+(b?"multiple ":"")+t.customClass+' loading"'+(b||l>1?' style="height:'+t.height+'px;"':"")+"></div>").before(w).data("loaded",!0);var k,y=r.parent().children("ul"),x=y.outerWidth(!0);if(v=y.children(),b?g(y):t.classic&&e('[data-value="'+m.val()+'"]',y).addClass("selected").append(t.selectedMarker),y.width()<=0){var C=y.parent().clone().css({position:"absolute",top:"-100%"});e("body").append(C),x=C.children("ul").outerWidth(!0),e("li",C).width(x),k=C.children("ul").outerWidth(!0),C.remove()}v.width(x).css("width",v.css("width")),t.width&&(y.parent().css("min-width",v.css("width")),y.css("width","100%"),v.css("width","100%")),v.click(function(){var a=e(this),i=y.children(".selected");if(!y.parent().hasClass("disabled"))if(!y.hasClass("active")||a.hasClass("disabled")||a.hasClass("label")||a.data("value")===i.data("value")||(b?(a.children("span.checked").length?a.children("span.checked").remove():a.append(t.selectedMarker),y.children(":not(.selected)").each(function(t){e("optgroup, option",r).eq(t).prop("selected",e(this).children("span.checked").length>0)}),g(y)):(i.removeClass("selected").children("span.checked").remove(),a.addClass("selected").append(t.selectedMarker),t.classic||y.prepend(a),y.removeClass("reverse").attr("aria-activedescendant",a.attr("id")),i.data("group")&&!t.classic&&y.children(".label").filter(function(){return e(this).text()===i.data("group")}).after(i),e("optgroup, option",r).filter(function(){return this.value+"|"+this.text==(a.data("value")||"")+"|"+a.contents().filter(function(){return 3===this.nodeType}).text()}).prop("selected",!0)),r.trigger("change")),!a.hasClass("selected")&&b||(y.toggleClass("active"),y.attr("aria-expanded",y.hasClass("active"))),y.hasClass("active")){e(".prettydropdown > ul.active").length>1&&f(e(".prettydropdown > ul.active").not(y)[0]);var s,d=window.innerHeight,n=y.offset().top,c=e(document).scrollTop(),o=y.outerHeight();l&&(s=l*(t.height-2))<o-2&&(o=s+2);var h=n-c+o;h>d&&(n-c>d-(n-c+t.height)?(y.addClass("reverse"),t.classic||y.append(i),n-c+t.height<o&&(y.outerHeight(n-c+t.height),y.scrollTop(o))):y.height(y.height()-(h-d))),s&&s<y.height()&&y.css("height",s+"px"),t.classic&&y.scrollTop(i.index()*(t.height-2))}else y.data("clicked",!0),f(y[0])}),y.on({focusin:function(){e(window).off("keydown",h).on("keydown",h)},focusout:function(){e(window).off("keydown",h)},mouseenter:function(){y.data("hover",!0)},mouseleave:f,mousemove:u}),t.hoverIntent<0&&e(document).click(function(e){y.data("hover")&&!y[0].contains(e.target)&&f(y[0])}),s&&e("#"+s).off("click",o).click(o),y.parent().width(t.width||k||y.outerWidth(!0)).removeClass("loading"),t.afterLoad()}},o=function(t){e("ul[aria-labelledby="+t.target.id+"]").focus()},h=function(i){var d=e(".prettydropdown > ul.active, .prettydropdown > ul:focus");if(d.length)if(9!==i.which){i.preventDefault(),i.stopPropagation();var c,o=d.children(),h=d.hasClass("active"),u=d.height()/(t.height-2),p=u%1<.5?Math.floor(u):Math.ceil(u);switch(s=Math.max(0,d.children(".hover").index()),r=o.length-1,a=o.eq(s),d.data("lastKeypress",+new Date),i.which){case 13:h||(a=o.filter(".selected"),v(a,1)),a.click();break;case 27:h&&f(d[0]);break;case 32:h?c=" ":(a=o.filter(".selected"),v(a,1),a.click());break;case 33:h&&(v(a,0),v(o.eq(Math.max(s-p-1,0)),1));break;case 34:h&&(v(a,0),v(o.eq(Math.min(s+p-1,r)),1));break;case 35:h&&(v(a,0),v(o.eq(r),1));break;case 36:h&&(v(a,0),v(o.eq(0),1));break;case 38:h&&(v(a,0),v(s?o.eq(s-1):o.eq(r),1));break;case 40:h&&(v(a,0),v(s===r?o.eq(0):o.eq(s+1),1));break;default:h&&(c=n[i.which-48])}if(c){clearTimeout(l),d.data("keysPressed",void 0===d.data("keysPressed")?c:d.data("keysPressed")+c),l=setTimeout(function(){d.removeData("keysPressed")},300);var g=[],m=a.index();if(o.each(function(t){0===e(this).text().toLowerCase().indexOf(d.data("keysPressed"))&&g.push(t)}),g.length)for(var b=0;b<g.length;++b){if(g[b]>m){v(o,0),v(o.eq(g[b]),1);break}b===g.length-1&&(v(o,0),v(o.eq(g[0]),1))}}}else f(d[0])},u=function(t){var a=e(t.currentTarget);"LI"!==t.target.nodeName||!a.hasClass("active")||new Date-a.data("lastKeypress")<200||(v(a.children(),0,1),v(e(t.target),1,1))},p=function(a,s,r){var l,n="",c="";if(s=s||"",a){switch(a.nodeName){case"OPTION":"OPTGROUP"===a.parentNode.nodeName&&(n=a.parentNode.getAttribute("label")),c=(a.getAttribute("data-prefix")||"")+a.text+(a.getAttribute("data-suffix")||"");break;case"OPTGROUP":s+=" label",c=(a.getAttribute("data-prefix")||"")+a.getAttribute("label")+(a.getAttribute("data-suffix")||"")}(a.disabled||n&&a.parentNode.disabled)&&(s+=" disabled"),l=a.title,n&&!l&&(l=a.parentNode.title)}return'<li id="item'+d+"-"+ ++i+'"'+(n?' data-group="'+n+'"':"")+(a&&(a.value||t.classic)?' data-value="'+a.value+'"':"")+(a&&"OPTION"===a.nodeName?' role="option"':"")+(l?' title="'+l+'" aria-label="'+l+'"':"")+(s?' class="'+e.trim(s)+'"':"")+(50!==t.height?' style="height:'+(t.height-2)+"px;line-height:"+(t.height-4)+'px;"':"")+">"+c+(r||"selected"===s?t.selectedMarker:"")+"</li>"},f=function(a){if(!(t.hoverIntent<0&&"mouseleave"===a.type)){var i=e(a.currentTarget||a);i.data("hover",!1),clearTimeout(l),l=setTimeout(function(){i.data("hover")||(i.hasClass("reverse")&&!t.classic&&i.prepend(i.children(":last-child")),i.removeClass("active reverse").removeData("clicked").attr("aria-expanded","false").css("height",""),i.children().removeClass("hover nohover"),i.attr("aria-activedescendant",i.children(".selected").attr("id")))},"mouseleave"!==a.type||i.data("clicked")?0:t.hoverIntent)}},v=function(e,i,s){if(i){var l=e.parent();if(e.removeClass("nohover").addClass("hover"),l.attr("aria-activedescendant",e.attr("id")),1===e.length&&a&&!s){var d=l.outerHeight(),n=e.offset().top-l.offset().top-1;0===e.index()?l.scrollTop(0):e.index()===r?l.scrollTop(l.children().length*t.height):n+t.height>d?l.scrollTop(l.scrollTop()+t.height+n-d):n<0&&l.scrollTop(l.scrollTop()+n)}}else e.removeClass("hover").addClass("nohover")},g=function(a){var i,s=a.parent().children("select"),r=e("option",s).map(function(){if(this.selected)return this.text}).get();if(i=t.multiVerbosity>=r.length?r.join(t.multiDelimiter)||"None selected":r.length+"/"+e("option",s).length+" selected"){var l=(s.attr("title")?s.attr("title"):"")+(r.length?"\nSelected: "+r.join(t.multiDelimiter):"");a.children(".selected").text(i),a.attr({title:l,"aria-label":l})}else a.children(".selected").empty(),a.attr({title:s.attr("title"),"aria-label":s.attr("title")})};return this.refresh=function(t){return this.each(function(){var t=e(this);t.prevAll("ul").remove(),t.unwrap().data("loaded",!1),this.size=t.data("size"),c(this)})},this.each(function(){c(this)})}}(jQuery);


jQuery(document).ready(function($){
	
	if($(window).width() >= 768) {
		$('.sticky_block').stick_in_parent({offset_top: 80, bottoming: true});
		$('.sticky_ads').stick_in_parent({bottoming: true});
	}

	$(window).bind('grid:items:added', function(){ 
		jQuery('.vc_grid-filter-select').prettyDropdown({ customClass: 'vgl-select arrow' });
	});	

	$('#searchform input[type="text"]').attr("placeholder", "What you are looking for?");
	
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
	};

	checkFixedHeader();


	/* autoload next post */
	$(window).on('scroll', function(e) {
        checkFixedHeader();
        return;

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

	/* search bar */
	$('body').on('click', '.search-mobile', function(e){
		event.preventDefault();
		$('.search-bar').stop().toggleClass('active');
	});

	/* Load Post When sidebar item clicked */
	$('body').on('click', '.blog-post-sidebar .blog-post-individual', function(e) {
		window.location = $(this).data('link');
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