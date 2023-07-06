<?php
/**
 * Theme HOOKS
 *
 * @package WordPress
 */

add_action( 'after_setup_theme', 'qstheme_textdomain' );
add_filter( 'body_class', 'add_body_class' );

// Rest Api.
// add_action( 'rest_api_init', 'disabled_rest_api_init' );.
// add_action( 'rest_authentication_errors', 'disabled_rest_api', 0 );.

add_action( 'acf/init', 'google_api_acf_init' );
add_action( 'wp_head', 'qs_add_header_scripts' );
add_action( 'wp_footer', 'qs_add_footer_scripts', 100 );
// Add Theme Stylesheet To ADMIN.
add_action( 'admin_enqueue_scripts', 'qs_load_custom_admin_style' );
// Register THEME Navigation.
add_action( 'init', 'register_theme_menus' );

// Remove Actions.
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds.
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed.
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link.
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // Index link.
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Prev link.
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Start link.
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version.
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
// Add Filters.
add_filter( 'widget_text', 'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar.
add_filter( 'widget_text', 'shortcode_unautop' ); // Remove <p> tags in Dynamic Sidebars (better!).
add_filter( 'the_excerpt', 'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only).
add_filter( 'the_excerpt', 'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only).
add_filter( 'wp_calculate_image_srcset_meta', '__return_null' ); // Remove thumbnail src set for responsive images.
// Remove Filters.
remove_filter( 'the_excerpt', 'wpautop' ); // Remove <p> tags from Excerpt altogether.

add_action( 'wp_enqueue_scripts', 'qs_theme_styles' );
add_action( 'wp_enqueue_scripts', 'qs_theme_scripts' );

// HTML Email.
add_filter( 'wp_mail_content_type', 'qsemail_set_content_type' );

// add_filter( 'wpcf7_validate_tel*', 'custom_tel_confirmation_validation_filter', 20, 2 );.

add_filter(
	'jpeg_quality',
	function( $arg ) {
		return 100;
	}
);

add_filter(
	'doing_it_wrong_trigger_error',
	function () {
		return false;
	},
	10,
	0
);

add_filter( 'wp_nav_menu_objects', 'modify_home_in_nav_menu_objects', 10, 2 );
function modify_home_in_nav_menu_objects( $items, $args ) {

	$parent_id   = 0;
	$news_page   = get_field('news_page_data', 'option');
	$events_page = get_field('events_page_data', 'option');
	$blog_page   = get_field('blog_page_date', 'option');

	foreach ( $items as $object ) {

		if( get_post_type() == 'post' || get_post_type() == 'news' || get_post_type() == 'events' ||
			is_singular('post') || is_singular('news') || is_singular('events') ){

			switch ( get_post_type() ) {
				case 'news':
					$archive_id = ( isset( $news_page->ID ) ) ? $news_page->ID : 0;
					break;

				case 'events':
					$archive_id = ( isset( $events_page->ID ) ) ? $events_page->ID : 0;
					break;

				default:
					$archive_id = ( isset( $blog_page->ID ) ) ? $blog_page->ID : 0;
					break;
			}
			if( $object->object_id == $archive_id ){

				$parent_id = $object->menu_item_parent;
				$object->classes[] = 'current-menu-item';
				$object->current = 1;
			}
		}

		$icon = get_field('navigation_icons', $object );

		// if( in_array( 'menu-item-has-children', $object->classes ) ){
		// 	echo '<pre class="kung-fu-panda" style="direction:ltr;text-align:left;">';
		// 	print_r(  );
		// 	echo '</pre>';
		// }

		$text_class = array('nav-text-box');
		if( !$object->menu_item_parent ){
			$text_class[] = 'main-link-text';
		}

		$title_nav = '<span class="'.Implode( ' ', $text_class ).'">'. $object->title.'</span>';

		if( isset( $icon['sizes']['icon'] ) ){

			$title_nav = '<span class="nav-icon-box"><img src="'.$icon['sizes']['icon'].'" alt="" role="presentation"></span>'.$title_nav;
		}

	    $object->title = $title_nav;
	}

	if( $parent_id ){
		foreach ( $items as $object ) {
			if( $parent_id == $object->ID ){
				$object->classes[] = 'current-menu-item';
				$object->classes[] = 'current-menu-parent';
				$object->current = 1;
			}
		}
	}

	return $items;
}

// add_filter( 'nav_menu_item_args', 'wp_kama_nav_menu_item_args_filter', 10, 3 );
// function wp_kama_nav_menu_item_args_filter( $args, $menu_item, $depth ){
//
// 	if( in_array( 'menu-item-has-children', $menu_item->classes ) ){
// 		$args->before = '<button class="mobile-open-submenu" title="'.esc_html__('open submenu', 'greyowl').'" aria-label="'.esc_html__('open submenu', 'greyowl').'" aria-hidden="true" tabindex="-1"></button>';
// 	}
//
// 	return $args;
// }

add_filter( 'walker_nav_menu_start_el', 'theme_add_button_to_mobile_menu', 10, 4 );
function theme_add_button_to_mobile_menu( $item_output, $menu_item, $depth, $args ){

	if( in_array( 'menu-item-has-children', $menu_item->classes ) ){
		$item_output = $item_output . '<button type="button" class="mobile-open-submenu trigger-mobile-open-submenu only-mobile" title="'.esc_html__('open submenu', 'greyowl').'" aria-label="'.esc_html__('open submenu', 'greyowl').'" aria-hidden="true" tabindex="-1"></button>';
	}

	return $item_output;
}

// // свой класс построения меню:
// class My_Walker_Nav_Menu extends Walker_Nav_Menu {
//
// 	// add classes to ul sub-menus
// 	function start_lvl( &$output, $depth = 0, $args = NULL ) {
// 		// depth dependent classes
// 		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
// 		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
// 		$classes = array(
// 			'sub-menu',
// 			( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
// 			( $display_depth >=2 ? 'sub-sub-menu' : '' ),
// 			'menu-depth-' . $display_depth
// 		);
// 		$class_names = implode( ' ', $classes );
//
// 		// build html
// 		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
// 	}
// }

add_shortcode( 'footer_social_lins', 'theme_footer_socilal_link' );
function theme_footer_socilal_link(  ){

	$footer_social_lins = get_field('footer_social_lins', 'option');
	$html = '';

	if( $footer_social_lins ){

		$html .= '<div class="social-list">';

		foreach ( $footer_social_lins as $part ) {

			$new_tab = ( isset( $part['new_tab'] ) && $part['new_tab'] ) ? ' target="_blank"' : '';

			$html .= '<a href="'.$part['link'].'" class="social-list-item" title="'.$part['label'].'" aria-label="'.$part['label'].'"'.$new_tab.'><img src="'.$part['icon']['sizes']['icon'].'" alt="icon" role="presentation"></a>';
		}

		$html .= '</div>';
	}

	return $html;
}


add_filter( 'parse_query', 'theme_the_search_query_filter' );
function theme_the_search_query_filter( $query_object  ){


	if( $query_object->is_search() ){

		if( isset( $_GET['search_type'] ) ){

			$post_tye_data = theme_get_query_post_type( $_GET['search_type'] );
			$post_tye      = ( isset( $post_tye_data['post_tye'] ) && $post_tye_data['post_tye'] ) ? $post_tye_data['post_tye'] : '';

			if( $post_tye ){
				$query_object->set( 'post_type', $post_tye );
			}
		}
	}

	return $query_object ;
}
