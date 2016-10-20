jQuery(document).ready( function() {

	/*
	// Debug options see toEM function above;
	windowHeight = jQuery(window).innerHeight();
	test = jQuery().toEm('body');
	console.log(windowHeight);
	*/

	//Clone both menus to keep them intact
	var combinedMenu = jQuery('#nicholls-primary-navigation .menu ul').clone();
	var secondMenu = jQuery('#nicholls-secondary-navigation .menu ul').clone();
	var search_box = jQuery( '#nicholls-secondary-navigation .menu-search').clone();

	var new_list = jQuery('<ul id="n-new-secondary"></ul>');
	new_list.append( secondMenu.children('li') );
	var new_list_li = jQuery('<li>More&hellip;</li>');

	new_list_li.append( new_list );
	combinedMenu.append( new_list_li );
	jQuery('#nicholls-ui-mobile').append( search_box )

	combinedMenu.slicknav({
	    duplicate: false,
			label: 'Menu',
			prependTo: '#nicholls-ui-mobile',
			beforeOpen: function(trigger){
				jQuery('#nicholls-ui-mobile').addClass('menu-active');
			},
			beforeClose: function(trigger){

				var classList = trigger.attr('class').split(/\s+/);
				var test_search = jQuery.inArray('slicknav_item', classList);

				// console.log( test_search );

				if ( test_search != 0 ) {
					jQuery('#nicholls-ui-mobile').removeClass('menu-active');
				}

			},
	});

	// Set Transparency
	jQuery('.header-').addClass('transparent-black-50');

	jQuery('.n-button-search-').magnificPopup({
		items: {
			type: 'inline',
			preloader: false,
			midClick: true,
			src: '#form-gs-container'
		},
		callbacks: {
			beforeOpen: function() {
				jQuery('#form-gs-container').removeClass('hide');
			},
			open: function() {
				this.st.focus = '#q';
			}
		}
	});

/**
	// If you don't care about changing the height when the window resizes then you can use the following simplified version instead:

	// $(document).ready(function() {
	//   windowHeight = $(window).innerHeight();
	//   $('.sidebar').css('min-height', windowHeight);
	// });
	function setHeight() {
    windowHeight = jQuery(window).innerHeight();

		nicholls_header_height = jQuery( '#nicholls-header-wrapper').innerHeight();
		slider_photo_height = jQuery( '#n-slider-photo').innerHeight();
		slider_movie_height = jQuery( '#n-section-video').innerHeight();
		view_target_height = nicholls_header_height + slider_photo_height + slider_movie_height;

		if( windowHeight < view_target_height && windowHeight > view_target_height - slider_photo_height ) {
			view_make_height = windowHeight - ( slider_movie_height + nicholls_header_height );
			jQuery('#n-slider-photo .lSSlideOuter').css('max-height', view_make_height );
		}
		console.log( windowHeight - slider_movie_height );
  };
  setHeight();

  jQuery(window).resize(function() {
    setHeight();
  });
*/

/*
	if ( jQuery('html').hasClass('lt-ie8') ) {
		jQuery(window).responsinav({ breakpoint: 977 });
	}
*/

});


/*

Testing Functions
This is a fuction to convert pixal dimensitons to EM

*/
(function ($) {

	$.fn.toEm = function(settings){
	    settings = jQuery.extend({
	        scope: 'body'
	    }, settings);
	    var that = parseInt(this[0],10),
	        scopeTest = jQuery('<div style="display: none; font-size: 1em; margin: 0; padding:0; height: auto; line-height: 1; border:0;">&nbsp;</div>').appendTo(settings.scope),
	        scopeVal = scopeTest.height();
	    scopeTest.remove();
	    return (that / scopeVal).toFixed(8) + 'em';
	};
})(jQuery);
