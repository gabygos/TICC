const page_obj = {
	search_key : '',
	sliders : {}
}
jQuery(document).ready(function () {
	// console.time('FirstWay');
	// accessible contact form 7 focus validation
	// list of contact form 7 DOM events: https://contactform7.com/dom-events/
	var cf7_form = jQuery(".wpcf7");
	cf7_form.on("wpcf7invalid ", function (event) {
		jQuery(this).find(".wpcf7-not-valid").first().focus();
	});

	mobile_header_menu();

	news_header_slider();
	build_page_background();
	build_header_submenu();
	theme_search_field();

	jQuery('.header-menu-class').hfNav({
		'dropDownAttr' : true,
	});

	theme_events_slider();

	go_to_page_part();

	post_filter_submit();

	// accessibility handle browser zoom level


	single_page_old_gallery_sliders();
	single_page_gallery_sliders();

	load_more_posts();
	theme_more_get_events();
	question_and_answer_section();
	accordion_and_content();
	faculties_section_events();
	search_button_event();

	registration_form_popup();
	create_molecule_bg();
	lightbox_out_windows();

	mobile_slider_wrapper();
	// console.timeEnd('FirstWay');

	featured_scientists_list();

	related_posts_section();

	home_page_slider();

	page_sliders_height();

	theme_text_content();

	theme_mobile_news_slider();
});
jQuery(window).resize(function () {
	var browserZoomLevel = Math.round(window.devicePixelRatio * 100);
	// console.log(browserZoomLevel);
	if (browserZoomLevel < 401) {
		jQuery("body").removeClass(
			"zoom-level-90 zoom-level-100 zoom-level-110 zoom-level-120 zoom-level-130 zoom-level-140 zoom-level-150 zoom-level-160 zoom-level-170 zoom-level-180 zoom-level-190 zoom-level-200 zoom-level-210 zoom-level-220 zoom-level-230 zoom-level-240 zoom-level-250 zoom-level-260 zoom-level-270 zoom-level-280 zoom-level-290 zoom-level-300 zoom-level-310 zoom-level-320 zoom-level-330 zoom-level-340 zoom-level-350 zoom-level-360 zoom-level-370 zoom-level-380 zoom-level-390 zoom-level-400"
		);
		jQuery("body").addClass("zoom-level-" + browserZoomLevel);
	}
	theme_text_content();
});

function theme_mobile_news_slider(){
	jQuery(document).on('click', '.trigger-mobile-news-box', function(){
		const wrapp = jQuery(this).closest('.trigger-news-slider');
		if( wrapp.length ){
			if( wrapp.hasClass('mobile-height') ){
				wrapp.removeClass('mobile-height');
				// wrapp.find('');
			} else {
				wrapp.addClass('mobile-height');
				// wrapp.find('');
			}
		}
	});
}

function theme_text_content(){
	const wrapper   = jQuery('.trigger-text-content-wrapper');
	const title_box = jQuery('.trigger-title-content-box');
	const box       = jQuery('.trigger-text-content-row');
	if( wrapper.length && title_box.length && box.length ){
		// const wrapper_h = wrapper.height();
		// const title_box_h = title_box.height();
		const wrapper_h = wrapper.outerHeight();
		const title_box_h = title_box.outerHeight();
		if( title_box_h ){
			box_h = wrapper_h - title_box_h;
			box.height( box_h+'px' );
			box.find('.text-content').css( 'max-height', box_h+'px' );
			// console.log( 'title_box_h', title_box_h );
		}
	}
}

function related_posts_section(){
	// trigge-related-posts-section
	const posts_slider = new Swiper('.trigge-related-posts-section', {
		loop: true,
		loopedSlides: 10,
		breakpoints: {
			320: {
				loop: true,
				slidesPerView: 1.2,
				loopedSlides: 10,
			},
			861: {
				loop: true,
				slidesPerView: 2.4,
				loopedSlides: 10,
			},
			1024: {
				loop: true,
				slidesPerView: 3,
				loopedSlides: 10,
			}
		},
		pagination: {
			el: ".swiper-pagination",
		},
	});
}

function featured_scientists_list(){

	const users_slider = new Swiper('.trigger-featured-scientists-list', {
		loop: true,
		slidesPerView: 4,
		breakpoints: {
			320: {
				slidesPerView: 1.4,
			},
			861: {
				slidesPerView: 2.4,
			},
			1024: {
				slidesPerView: 4,
			}
		},
		pagination: {
			el: ".swiper-pagination",
		},
	});
}

function mobile_slider_wrapper(){

	const sliders = jQuery('.mobile-slider-wrapper');
	if( sliders.length ){
		let counter = 1;
		sliders.each(function(){

			const slider_name = 'trigger_sl_'+counter;

			const mobile_size = 1024;
			const slider_wrapper = jQuery(this);
			const wrapp = jQuery('.trigger-slider-items-wrapper');
			const items = wrapp.find('.trigger-slider-item');

			items.each(function(){
				if( document.body.clientWidth > mobile_size ){
					jQuery(this).removeClass('swiper-slide');
				} else {
					jQuery(this).addClass('swiper-slide');
				}
			});

			if( document.body.clientWidth > mobile_size ){
				slider_wrapper.removeClass(['swiper', slider_name]);
				wrapp.removeClass('swiper-wrapper');
				// slider_wrapper.
				if( typeof page_obj.sliders[ slider_name ] != 'undefined' ){

				}
			} else {

				if( typeof page_obj.sliders[ slider_name ] == 'undefined' ){
					slider_wrapper.addClass(['swiper', slider_name]);
					wrapp.addClass('swiper-wrapper');

					page_obj.sliders[ slider_name ] = new Swiper( '.'+slider_name, {
						loop: true,
						spaceBetween: 16,
						// loopedSlides: 10,
						breakpoints: {
							320: {
								slidesPerView: 1.1,
							},
							861: {
								slidesPerView: 2,
							}
						},
				      // pagination: {
				      //   el: ".swiper-pagination",
				      // },
				    });

					let slider_h = 0;
					wrapp.find('.swiper-slide').each(function(){
						const this_h = jQuery(this).height();
						if( slider_h < this_h ){
							slider_h = this_h;
						}
					});
					console.log( 'test', slider_h );
					///admin-test
				}
			}
		});
	}
}

function mobile_header_menu(){

	jQuery('#menu-main-top-nav li.menu-item-has-children').each(function(){
		const text = jQuery(this).find('.main-link-text').text();
		const btn_back = '<button type="button" class="mobile-bact-to-menu trigger-mobile-bact-to-menu only-mobile" aria-hidden="true" tabindex="-1">back to '+text+'</button>';
		jQuery(this).find('.sub-menu').prepend(btn_back);
	});
	jQuery(document).on('click', '.trigger-mobile-menu-button-open-close', function(){
		const wrpper = jQuery(this).closest('.main-header-container');
		if ( wrpper.length ) {
			if( wrpper.hasClass('open-mobile') ){
				wrpper.removeClass('open-mobile');
				jQuery('#header').removeClass('mobile-nav-opened');
			} else {
				wrpper.addClass('open-mobile');
				jQuery('#header').addClass('mobile-nav-opened');
			}
		}
	});
	jQuery(document).on('click', '.trigger-mobile-open-submenu', function(e){

		e.preventDefault();
		const parent = jQuery(this).closest('.menu-item');
		// console.log('ADMIN ETST');
		if( parent.length ){
			parent.addClass('mobile-submenu-opened');
		}
	});
	jQuery(document).on('click', '.trigger-mobile-bact-to-menu', function(e){

		e.preventDefault();
		const parent = jQuery(this).closest('.menu-item');
		// console.log('ADMIN ETST');
		if( parent.length ){
			parent.removeClass('mobile-submenu-opened');
		}
	});
}

function news_header_slider(){
	const progressCircle  = document.querySelector(".autoplay-progress svg");
	// const progressContent = document.querySelector(".autoplay-progress span");
	const news_slider = new Swiper(".trigger-news-slider", {
		// spaceBetween: 30,
		// centeredSlides: true,
		loop: true,
		autoplay: {
			delay: 3500,
			disableOnInteraction: false
		},
		// pagination: {
		// 	el: ".swiper-pagination",
		// 	clickable: true
		// },
		// navigation: {
		// 	nextEl: ".swiper-button-next",
		// 	prevEl: ".swiper-button-prev"
		// },
		on: {
			autoplayTimeLeft(s, time, progress) {
				// console.log( 's', s );
				// console.log( 'time', time );
				// console.log( 'progress', progress );
				progressCircle.style.setProperty("--progress", 1 - progress);
				// progressContent.textContent = `${Math.ceil(time / 1000)}s`;
			}
		}
	});

	jQuery(document).on('click', '.trigger-slider-stop-and-play', function( e ){

		e.preventDefault();

		const button_play = jQuery(this);
		if( button_play.hasClass('play') ){

			button_play.removeClass('play');
			news_slider.autoplay.stop();
		} else {

			button_play.addClass('play');
			news_slider.autoplay.start();
		}
	});
}

function theme_search_field(){

	jQuery('.trigger-search-field').keyup(function(){

		const input     = jQuery(this);
		const input_val = input.val().trim();
		const type      = jQuery('[name="search_type"]:checked').val();

		if( input_val.length >= 3 ){
			page_obj.search_key = randomString();
			get_search_post( input_val, type );
		} else {
			jQuery('.trigger-search-content').html('');
		}
	});

	jQuery('[name="search_type"]').change(function() {

		const input_val = jQuery('#search-input-field[name="s"]').val();
		const type      = jQuery(this).val();

		if( input_val.length >= 3 ){
			page_obj.search_key = randomString();
			get_search_post( input_val, type );
		} else {
			jQuery('.trigger-search-content').html('');
		}
	});
}
function get_search_post( input_val, type ){

	// console.log( 'type', typeof page_obj );
	// console.log( 'page_obj', page_obj );

	const obj = {
		'key'   : page_obj.search_key,
		'value' : input_val,
		'type'  : type
	}

	// console.log( 'type', type );

	const search_content = jQuery('.trigger-search-content');

	jQuery.ajax({
		type     : "post",
		dataType : "json",
		url      : site_settings.ajax_url,
		data     : {
			action : 'theme_search_get_posts',
			data   : obj,
			nonce  : site_settings.nonce_token
		},
		beforeSend: function(){
			search_content.addClass('loading');
		},
		success: function( result ) {
			const { error, html, key } = result;

			// console.log( 'error', error );
			// console.log( 'html', html );
			// console.log( 'key 1', key );
			// console.log( 'key 2', page_obj.search_key );

			if( error === false && key == page_obj.search_key ){
				search_content.html( html );
			} else {
				search_content.html('');
			}
			search_content.removeClass('loading');
		}
	});
}
function randomString( lenString = 10 ) {

	const characters = "ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";

	let randomstring = '';

	for ( let i = 0; i < lenString; i++ ){
		var rnum = Math.floor(Math.random() * characters.length);
		randomstring += characters.substring(rnum, rnum+1);
	}

	return randomstring;
}

function search_button_event(){

	jQuery(document).on('click', '.trigger-search-button', function( e ){

		e.preventDefault();

		open_search_field()
	});
	jQuery(document).on('click', '.trigger-close-search-block', function( e ){

		close_search_field()
	});
	jQuery(document).on('click', '.trigger-bg-search-block', function( e ){

		close_search_field()
	});
}

function close_search_field(){

	const search_wrappper = jQuery('.trigger-search-wrappper');
	jQuery('.trigger-news-header-row').css('display','block');
	search_wrappper.removeClass('open').attr('aria-hidden', 'true');
}
function open_search_field(){

	const search_wrappper = jQuery('.trigger-search-wrappper');
	jQuery('.trigger-news-header-row').css('display','none');
	search_wrappper.addClass('open').attr('aria-hidden', 'false');

	jQuery('.main-header-container').removeClass('open-mobile');
	jQuery('#header').removeClass('mobile-nav-opened');
}

function home_page_slider(){

	var home_page_slider = new Swiper('.trigger-top-page-banner', {
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
			renderBullet: function ( index, className ) {
				// console.log('TEST', slider_nav[ index ] );
				// console.log('TEST 2', className );
				// console.log('TEST 3', index );
				return '<span class="pagination-name-item ' + className + '">' + slider_nav[ index ] + '</span>';
			},
		},
	});
}

function initMap() {
	// The location of Uluru
	const uluru = {
		lat: Number( site_settings.google_map.lat ),
		lng: Number( site_settings.google_map.lng )
	};
	// The map, centered at Uluru
	const map = new google.maps.Map( document.getElementById("map"), {
		zoom: Number( site_settings.google_map.zoom ),
		center: uluru,
	});
	// The marker, positioned at Uluru
	const marker = new google.maps.Marker({
		position: uluru,
		map: map,
	});
}
window.initMap = initMap;


function theme_events_slider(){

	var slider_page = new Swiper( '.trigger-events-slider', {
		slidesPerView: 2,
		spaceBetween: 16,
		autoHeight: true,
		loop: true,
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		breakpoints: {
			1025: {
				slidesPerView: 2,
			},
			860: {
				slidesPerView: 1.5,
			},
			300: {
				slidesPerView: 1.1,
			}
		}
	});
}

function build_header_submenu(){

	const labels = jQuery('.trigger-page-part-label');
	const blocks_list = {}

	if( labels.length ){
		let submenu_html = '';
		let counter = 1;
		labels.each(function(){

			const text = jQuery(this).data('text');
			const href = jQuery(this).data('id');
			const key  = jQuery(this).data('key');

			blocks_list[ key ] = {
				'key' : key,
			}

			submenu_html += '<li class="submenu-item ">';
			submenu_html += '<a href="#'+href+'" class="submenu-link trigger-go-to-page-part link-submenu-'+key+'">';
			submenu_html += '<span class="item-number">'+counter+'</span>';
			submenu_html += '<span class="item-text">'+text+'</span>';
			submenu_html += '</a>';
			submenu_html += '</li>';

			counter++;
		});

		jQuery('.submenu-list').html( submenu_html );
	}


	// console.log( 'blocks_list', blocks_list );

	jQuery(document).scroll(function(){

		let position_top = jQuery(window).scrollTop();
		position_top = position_top + 251;
		let link_e = {
			'e'   : false,
			'top' : 0
		};
		jQuery('.trigger-page-part-label').each(function(){
			const offset = jQuery(this).offset();
			if( typeof offset.top != 'undefined' ){
				const top_pos = offset.top;

				if( top_pos < position_top && link_e.top < top_pos ){

					const key  = jQuery(this).data('key');
					const link = jQuery('.trigger-go-to-page-part.link-submenu-'+key);
					link_e.e   = link;
					link_e.top = top_pos;
					// console.log('element', jQuery('.trigger-go-to-page-part.link-submenu-'+key) );
					// console.log('position_top', position_top );
					// link.addClass('active');
					// return false;
				}
			}
		});

		jQuery('.trigger-go-to-page-part').removeClass('active');
		if( link_e.e ){
			link_e.e.addClass('active');
		};
	});
}

function go_to_page_part(){
	jQuery('.trigger-go-to-page-part').on('click', function( e ){
		e.preventDefault();
		const href = jQuery(this).attr('href');
		const section = jQuery( href );
		if(  section.length ){
			const scroll_to = section.offset().top - 250;
			jQuery([document.documentElement, document.body]).animate({
				scrollTop : scroll_to
			}, 1000 );
		}
	});
}

function single_page_old_gallery_sliders(){
	const galleries = jQuery('.trigger-create-gallery div.gallery');
	if( galleries.length ){
		let counter = 1;
		galleries.each(function(){

			const parent_gallery = jQuery(this);
			build_gallery( parent_gallery, '.gallery-item', counter );
		});
	}
}

function single_page_gallery_sliders(){
	const galleries = jQuery('.trigger-create-gallery figure.wp-block-gallery');
	if( galleries.length ){
		let counter = 1;
		galleries.each(function(){

			const parent_gallery = jQuery(this);

			const gallery_html = build_gallery( parent_gallery, '.wp-block-image', counter );

			counter++;
		});
	}

}

function build_gallery( obj = {}, name_part = '', counter = 0 ){
	if ( obj.length && counter ) {

		let gallery_html = '';
		let gallery_nav_html = '';

		obj.find( name_part ).each(function(){
			const img_url = jQuery(this).find('img').attr('src');
			const img_alt = jQuery(this).find('img').attr('alt');

			gallery_html += '<div class="swiper-slide"><img src="'+img_url+'" alt="'+img_alt+'"></div>';
			gallery_nav_html += '<div class="swiper-slide"><img src="'+img_url+'" class="nav-image" alt="'+img_alt+'"></div>';
		});

		if( gallery_html ){

			const slider_style = 'trigger-single-page-gallery-slider-'+counter;
			const slider_nav_style = 'trigger-single-page-gallery-nav-slider-'+counter;

			gallery_html = '<div class="swiper-wrapper">'+gallery_html+'</div>';
			gallery_html = '<div class="swiper '+slider_style+'">'+gallery_html+'</div>';
			gallery_html = '<div class="post-gallery-slider">'+gallery_html+'</div>';


			gallery_nav_html = '<div class="swiper-wrapper">'+gallery_nav_html+'</div>';
			gallery_nav_html = '<div class="swiper '+slider_nav_style+'">'+gallery_nav_html+'</div>';
			gallery_nav_html = '<div class="post-gallery-nav-slider">'+gallery_nav_html+'</div>';



			obj.after( gallery_html + gallery_nav_html );

			obj.remove();

			single_page_gallery_slider_fn( slider_style, slider_nav_style );
		}
	}
}

function single_page_gallery_slider_fn( slider_style, nav_slider_style ){

	// console.log( 'slider_style', slider_style );
	// console.log( 'nav_slider_style', nav_slider_style );

	var home_slider_nav = new Swiper( '.'+nav_slider_style, {
		spaceBetween: 25,
		slidesPerView: 6,
		freeMode: true,
		watchSlidesProgress: true,
		loop: true,
		// centeredSlides: true,
	});



	var home_slider_page = new Swiper( '.'+slider_style, {
		slidesPerView: 2,
		thumbs: {
			swiper: home_slider_nav,
		},
		// navigation: {
		// 	nextEl: ".swiper-button-next",
		// 	prevEl: ".swiper-button-prev",
		// },
		breakpoints: {
			320: {
				slidesPerView: 1,
			},
			861: {
				slidesPerView: 2,
			}
		}
	});


}

function post_filter_submit(){
	const filter_form = jQuery('.trigger-filter-posts');
	if( filter_form.length ){

		const selct_obj = {
			'post_tags'   : filter_form.find('select[name="post_tags"]').val(),
			'post_author' : filter_form.find('select[name="post_author"]').val(),
		}

		filter_form.find('select').change(function(){
			const select_val  = jQuery(this).val();
			const select_name = jQuery(this).attr('name');

			if( typeof selct_obj[ select_name ] != 'undefined' && selct_obj[ select_name ] != select_val ){
				filter_form.submit();
			}
		});
	}
	const submenu_form = jQuery('.top-submenu-select');
	if( submenu_form.length ){

		const selct_obj = {
			'post_tags'   : submenu_form.find('select[name="post_tags"]').val(),
			'post_author' : submenu_form.find('select[name="post_author"]').val(),
		}

		submenu_form.find('select').change(function(){
			const select_val  = jQuery(this).val();
			const select_name = jQuery(this).attr('name');

			if( typeof selct_obj[ select_name ] != 'undefined' && selct_obj[ select_name ] != select_val ){
				submenu_form.submit();
			}
		});
	}
}

function theme_more_get_events( e ){
	jQuery(document).on('click', '.trigger-load-more-events', function(e){
		e.preventDefault();
		const this_btn  = jQuery(this);
		const page      = this_btn.data('page');
		const items     = this_btn.data('items');

		if( page && items ){
			const obj = {
				'page'      : page,
				'items'     : items
			}

			jQuery.ajax({
				type     : "post",
				dataType : "json",
				url      : site_settings.ajax_url,
				data     : {
					action : 'theme_more_get_events',
					data   : obj,
					nonce  : site_settings.nonce_token
				},
				beforeSend: function(){
					this_btn.attr( 'disabled', 'disabled' );
					this_btn.addClass('loading');
				},
				success: function( result ) {
					const { error, html, max_num_pages } = result;

					if( error === false ){
						jQuery('.trigger-all-past-events-container').append( html );

						const next_page = page + 1;

						if( max_num_pages > next_page ){
							this_btn.data('page', next_page );
						} else {
							this_btn.remove();
						}
					}

					this_btn.removeClass('loading');
					this_btn.removeAttr('disabled');
				}
			});
		}
	});
}




function load_more_posts(){
	jQuery(document).on('click', '.trigger-load-more-posts', function(e){
		e.preventDefault();
		const this_btn  = jQuery(this);
		const post_type = this_btn.data('type');
		const page      = this_btn.data('page');
		const items     = this_btn.data('items');
		if( post_type && page ){

			const obj = {
				'post_type' : post_type,
				'page'      : page,
				'items'     : items
			}
			// console.log( 'obj', obj );
			const filter_form = jQuery('.trigger-filter-posts');
			if( filter_form.length ){
				obj['post_tags']   = filter_form.find('select[name="post_tags"]').val();
				obj['post_author'] = filter_form.find('select[name="post_author"]').val();
			}

			jQuery.ajax({
				type     : "post",
				dataType : "json",
				url      : site_settings.ajax_url,
				data     : {
					action : 'theme_load_more_posts',
					data   : obj,
					nonce  : site_settings.nonce_token
				},
				beforeSend: function(){
					this_btn.attr( 'disabled', 'disabled' );
					this_btn.addClass('loading');
				},
				success: function( result ) {
					const { error, html, max_num_pages } = result;

					if( error === false ){
						jQuery('.trigger-posts-archive-list').append( html );

						const next_page = page + 1;

						if( max_num_pages > next_page ){
							this_btn.data('page', next_page );
						} else {
							this_btn.remove();
						}
					}

					this_btn.removeClass('loading');
					this_btn.removeAttr('disabled');
				}
			});
		}
	});
}

function question_and_answer_section(){
	jQuery(document).on('click', '.trigger-open-close-answer', function( e ){
		e.preventDefault();

		const answer_id = jQuery(this).attr('href');
		const answer_block = jQuery( answer_id );
		if( answer_block.length ){
			if( answer_block.hasClass('open') ){
				answer_block.removeClass( 'open' );
				jQuery('.trigger-open-close-answer').removeClass( 'open' );
			} else {
				answer_block.addClass( 'open' );
				jQuery(this).addClass( 'open' );
			}
		}
	});
}

function accordion_and_content(){

	let max_h = 0;
	jQuery('.trigger-accordion-content').each(function(){
		max_h += jQuery(this).height();
	});
	jQuery('.trigger-max-h').css( 'max-height', max_h+'px' );
	// jQuery('.trigger-item-content').each(function(){
	// 	const item = jQuery(this);
	//
	// 	console.log( 'item', item.position() );
	//
	// 	item.css({
	// 		'max-height': max_h+'px',
	// 		'height': max_h+'px',
	// 	});
	//
	// 	// const title_row = item.find('.title-row').height();
	// 	// const text_row = item.find('.text-row').height();
	// 	//
	// 	// const max_list_h = max_h - title_row - text_row;
	// 	//
	// 	// console.log( 'max_list_h', max_list_h );
	//
	// 	// const title_row = item.find('.title-row').height();
	// });
	// console.log( 'max_h', max_h );

	jQuery(document).on('click', '.trigger-accordion-content', function(){

		const button     = jQuery(this);
		const button_id  = button.attr('id');
		const content_id = 'accordion-content-'+button.data('id');

		jQuery('.trigger-accordion-content').each(function(){

			const btn    = jQuery(this);
			const btn_id = btn.attr('id');
			// console.log( 'btn_id', btn_id );
			// console.log( 'button_id', button_id );
			if( btn_id == button_id ){
				btn.addClass('active');
			} else {
				btn.removeClass('active');
			}

			const key     = btn.data('id');
			const cont_id = '#accordion-content-'+key;

			if( btn_id == button_id ){
				jQuery(cont_id).addClass('active');
			} else {
				jQuery(cont_id).removeClass('active');
			}
		});


		// if( button.hasClass('active') ){
		// 	button.removeClass('active');
		// } else {
		// 	button.addClass('active');
		// }
	});
}

function faculties_section_events(){

	jQuery(document).on('click', '.trigger-faculty-button', function(e){

		e.preventDefault();

		const button   = jQuery(this);
		const id       = button.data('id');
		const block_id = 'faculty-'+id;

		jQuery('.trigger-faculty-button').each(function(){
			const btn    = jQuery(this);
			const btn_id = btn.data('id');
			if( id == btn_id ){
				btn.addClass('active');
			} else {
				btn.removeClass('active');
			}
		});

		jQuery('.faculty-item-info').each(function(){
			const block = jQuery(this);
			if( block.attr('id') == block_id ){
				block.addClass('active');
			} else {
				block.removeClass('active');
			}
		});
	});
}

function build_page_background(){

	const data  = [
		[ 0, 50, 250, 0 ],
		[ 10, 125, 200, 4.7 ],
		[ 35, 10, 400, 2.5 ],
		[ 70, 0, 250, 7 ],
		[ 20, 450, 250, 1.3 ],
		[ -5, 1000, 500, 8.3 ],
		[ 15, 1150, 200, 2.6 ],
		[ 35, 1000, 400, 7.5 ],
		[ 70, 700, 250, 3.5 ],
		[ 70, 1200, 250, 9.5 ],
		[ 40, 1600, 250, 3.8 ],
		[ 45, 1700, 400, 5.4 ],
		[ 70, 2600, 250, 9.1 ],
		[ 35, 2600, 400, 0.7 ],
		[ 15, 2900, 250, 6.5 ],
		[ -5, 2000, 500, 0.8 ],
		[ 15, 2000, 200, 9.1 ],
		[ 35, 2800, 400, 1.5 ],
		[ 75, 2100, 450, 4.8 ],
		[ 70, 2000, 250, 8.2 ],
		[ 35, 2600, 400, 0.7 ],
		[ 15, 2900, 250, 6.5 ],
		[ -5, 2000, 500, 0.8 ],
		[ 15, 2000, 200, 9.1 ],
		[ 35, 2800, 400, 1.5 ],
		[ 75, 2100, 450, 4.8 ],
		[ 70, 2000, 250, 8.2 ],
		[ 40, 3600, 250, 3.8 ],
		[ 45, 3700, 400, 5.4 ],
		[ 70, 4600, 250, 9.1 ],
		[ 35, 4600, 400, 0.7 ],
		[ 15, 4900, 250, 6.5 ],
		[ -5, 4000, 500, 0.8 ],
		[ 15, 4000, 200, 9.1 ],
		[ 35, 4800, 400, 1.5 ],
		[ 75, 4100, 450, 4.8 ],
		[ 70, 4000, 250, 8.2 ],
		[ 35, 4600, 400, 0.7 ],
		[ 15, 4900, 250, 6.5 ],
		[ -5, 4000, 500, 0.8 ],
		[ 15, 4000, 200, 9.1 ],
		[ 35, 4800, 400, 1.5 ],
		[ 75, 4100, 450, 4.8 ],
		[ 70, 4000, 250, 8.2 ],

		[ 70, 6600, 250, 9.1 ],
		[ 35, 6600, 400, 0.7 ],
		[ 15, 6900, 250, 6.5 ],
		[ -5, 6000, 500, 0.8 ],
		[ 15, 6000, 200, 9.1 ],
		[ 35, 6800, 400, 1.5 ],
		[ 75, 6100, 450, 4.8 ],
		[ 70, 6000, 250, 8.2 ],
		[ 35, 6600, 400, 0.7 ],
		[ 15, 6900, 250, 6.5 ],
		[ -5, 6000, 500, 0.8 ],
		[ 15, 6000, 200, 9.1 ],
		[ 35, 6800, 400, 1.5 ],
		[ 75, 6100, 450, 4.8 ],
		[ 70, 6000, 250, 8.2 ],

	];

	const parts = data.reduce( ( acc, params ) => {

		acc += '<div class="bubble" style="left:'+params[0]+'%;top:'+params[1]+'px;width:'+params[2]+'px;height:'+params[2]+'px;border-radius:'+params[2]+'px;animation-delay:'+params[3]+'s;"></div>'

		return acc;
	}, '' );

	let html = '<div class="bubbles">'+parts+'</div>';
		html = '<div class="bubbles-background trigger-bubbles-background">'+html+'</div>';

	const blue_bg = jQuery('.background-blue-and-bubble');
	if( blue_bg.length ){

		blue_bg.each(function(){

			const element_html = jQuery(this).html();

			jQuery(this).html( '<div class="after-bg">' + element_html + '</div>' );

			jQuery(this).prepend( html );
		});

		// jQuery('.trigger-bubbles-background').html( html );
	}

	const blue_bg_ = jQuery('.bg-blue-and-bubble');
	if( blue_bg_.length ){

		blue_bg_.each(function(){

			jQuery(this).prepend( html );
		});

		// jQuery('.trigger-bubbles-background').html( html );
	}
}

function registration_form_popup(){

	close_lightbox_form_registration( false );

	jQuery('.trigger-event-form-container form label').each(function(){
		const this_label = jQuery(this);
		let text         = this_label.text();
		let input        = this_label.find('input');

		// this_label.text(function(i, currentText){
		// 	return '<span class="">'+currentText+'</span>';
		// });

		if( jQuery(this).find('input').hasClass('wpcf7-validates-as-required') ){
			// text = text+' *';
		} else {
			text = text+' (optional)';
		}
		input.attr( 'placeholder', text );
	});

	jQuery('.trigger-event-form-container form [type="submit"]').addClass('button-blue');

	jQuery(document).on('click', '.trigger-registration-popup-bg', function(e){
		e.preventDefault();
		close_lightbox_form_registration();
	});
	jQuery(document).on('click', '.trigger-close-form-lightbox', function(e){
		e.preventDefault();
		close_lightbox_form_registration();
	});
	jQuery(document).on('click', '.trigger-registration-to-event', function(e){
		e.preventDefault();
		open_lightbox_form_registration();
	});
}
function close_lightbox_form_registration( focus = true ){

	const lightbox = jQuery('.trigger-registration-form-section');

	lightbox.find('input, select, a, button, textarea').each(function(){
		jQuery(this).attr('tabindex', '-1');
	});
	lightbox.removeClass('open');
	lightbox.attr('aria-hidden', 'true');
	if( focus ){
		jQuery('.trigger-registration-to-event').focus();
	}
}
function open_lightbox_form_registration(){

	const lightbox = jQuery('.trigger-registration-form-section');

	lightbox.find('input, select, a, button, textarea').each(function(){
		jQuery(this).removeAttr('tabindex');
	});
	lightbox.addClass('open');
	lightbox.attr('aria-hidden', 'false');
	jQuery('.trigger-close-form-lightbox').focus();
}

function create_molecule_bg(){



	jQuery('.molecule-bg').each(function(){

		let rows       = 16;
		const rows_num = jQuery(this).data('bgRows');
		if ( Number.isInteger( rows_num ) ) {
			rows = rows_num;
		}
		const columns   = 12;
		let html        = '';
		let img_counter = 1;

		let top_p = 0;

		for ( let r_i = 0; r_i < rows; r_i++ ) {

			const temp_col = columns - getRandomInt( 4 );

			for (var c_i = 0; c_i < temp_col; c_i++) {

				let top_style   = 'top:' + ( top_p + getRandomInt( 90 ) - 45 ) + 'px;';

				let left_p      = 90 / temp_col * c_i;
				let tleft_style = 'left:' + ( left_p + getRandomInt( 10 ) - 5 ) + '%;';
				let rotate      = 'transform: rotate(' + getRandomInt( 180 ) + 'deg);';
				let delay       = 'animation-delay:' + getRandomInt( 9, 1 ) + 's;';

				html += '<div class="molecule-box" data-row="'+r_i+'" style="'+top_style+tleft_style+rotate+delay+'background-image: url(/wp-content/themes/qs-starter/images/molecule_'+img_counter+'.svg);"></div>';

				if( img_counter >= 4 ){
					img_counter = 1;
				} else {
					img_counter++;
				}
			}

			top_p = top_p + 125;
		}

		jQuery(this).html( html );
	});
}

function getRandomInt( max, toFix = 0 ) {

	if ( toFix ) {
		const num = Math.random() * max;
		return num.toFixed( toFix );
	} else {
		return Math.floor( Math.random() * max );
	}
}

function lightbox_out_windows(){

	lightbox_out_windows_close();

	jQuery(document).mouseleave(function () {

		lightbox_out_windows_open();
	});

	jQuery(document).on('click', '.trigger-close-lightbox-btn', function(){
		lightbox_out_windows_close( true );
	});
	// jQuery(document).on('click', '.trigger-lightbox-out-window-bg', function(){
	// 	lightbox_out_windows_close( true );
	// });
}
function lightbox_out_windows_close( cookie = false ){
	jQuery('.trigger-lightbox-out-window-wrapper').fadeOut( 300, function() {
		jQuery(this).attr('aria-hidden', 'true');
		jQuery(this).find('a, input, select, textarea, button').each(function(){
			jQuery(this).attr('tabindex', '-1');
		});
		if( cookie ){
			setCookie( 'out_lightbox', 'true', 1 );
		}
	});
}
function lightbox_out_windows_open(){

	const out_lightbox = getCookie( 'out_lightbox' );
	// console.log( 'out_lightbox', out_lightbox );
	if( !out_lightbox ){

		jQuery('.trigger-lightbox-out-window-wrapper').fadeIn( 300, function() {
			jQuery(this).attr('aria-hidden', 'false');
			jQuery(this).find('a, input, select, textarea, button').each(function(){
				jQuery(this).removeAttr('tabindex');
			});
			jQuery('.trigger-close-lightbox-btn').focus();
		});
	}
};

/**
 * Set a cookie
 * @param {[string]} cname  [holds the name of the cookie]
 * @param {[string]} cvalue [the cookie value]
 * @param {[int]} exdays [number of days to hold the cookie]
 */
function setCookie( cname, cvalue, exdays ) {
    var d = new Date();
    d.setTime(d.getTime() + ( exdays*24*60*60*1000 ));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
/**
 * Get a saved cookie
 * @param  {[string]} cname [the nema of the cookie]
 * @return {[string]}       [returns the saved cookie data]
 */
function getCookie( cname ) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function page_sliders_height(){
	jQuery('.swiper').each(function(){

		let slide_h = 0;

		jQuery(this).find('.swiper-slide').each(function(){

			const el_h = jQuery(this).height();

			if( slide_h < el_h ){
				slide_h = el_h;
			}
		});
		jQuery(this).find('.swiper-slide').css('height', slide_h+'px' );
		// jQuery(this).find('.swiper-slide').each(function(){
		// 	console.log( slide_h );
		// 	jQuery(this).css('height', slide_h+'px' );
		// });


	});
}
