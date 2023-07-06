<?php
/**
 * Helper functions
 *
 * @package WordPress
 */

/**
 * ACF Google API
 *
 * @return string api key
 */
function get_google_api_key() {
	if ( function_exists( 'get_field' ) ) {
		$google_api_key = get_field( 'google_api_key', 'option' );

		return $google_api_key;
	}

}
/**
 * Init ACF api key
 */
function google_api_acf_init() {
	acf_update_setting( 'google_api_key', get_google_api_key() );
}
/**
 * GLOBAL header scripts
 */
function qs_add_header_scripts() {
	if ( function_exists( 'get_field' ) ) {
		$header_scripts      = get_field( 'qs_header_scripts', 'option' );
		$page_header_scripts = get_field( 'page_header_scripts' );

		if ( $header_scripts ) {
			echo $header_scripts;
		}
		if ( $page_header_scripts ) {
			echo $page_header_scripts;
		}
	}
}
/**
 * Global Footer scripts
 */
function qs_add_footer_scripts() {
	if ( function_exists( 'get_field' ) ) {
		$footer_scripts      = get_field( 'qs_footer_scripts', 'option' );
		$page_footer_scripts = get_field( 'page_footer_scripts' );
		if ( $footer_scripts ) {
			echo $footer_scripts;
		}
		if ( $page_footer_scripts ) {
			echo $page_footer_scripts;
		}
	}
}
/**
 * Textdomain
 */
function qstheme_textdomain() {
	load_theme_textdomain( 'qstheme', THEME . '/languages' );
}

if ( ! function_exists( 'add_body_class' ) ) {
	/**
	 * Add body class
	 *
	 * @param array $classes classes.
	 * @return array classes
	 */
	function add_body_class( $classes ) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone, $is_winIE, $is_edge;
		if ( $is_lynx ) {
			$classes[] = 'lynx';
		} elseif ( $is_gecko ) {
			$classes[] = 'firefox-gecko';
		} elseif ( $is_opera ) {
			$classes[] = 'opera';
		} elseif ( $is_NS4 ) {
			$classes[] = 'ns4';
		} elseif ( $is_safari ) {
			$classes[] = 'safari';
		} elseif ( $is_chrome ) {
			$classes[] = 'chrome';
		} elseif ( $is_edge ) {
			$classes[] = 'ms-edge';
		} elseif ( $is_winIE ) {
			$classes[] = 'ms-winIE';
		} elseif ( $is_IE ) {
			$classes[] = 'ie';
			if ( preg_match( '/MSIE ( [0-11]+ )( [a-zA-Z0-9.]+ )/', $_SERVER['HTTP_USER_AGENT'], $browser_version ) ) {
				$classes[] = 'ie' . $browser_version[1];
			}
		} else {
			$classes[] = 'unknown';
		}
		if ( $is_iphone ) {
			$classes[] = 'iphone';
		}
		if ( stristr( $_SERVER['HTTP_USER_AGENT'], 'mac' ) ) {
			$classes[] = 'osx';
		} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'], 'linux' ) ) {
			$classes[] = 'linux';
		} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'], 'windows' ) ) {
			$classes[] = 'windows';
		}
		if ( defined( 'LANG' ) ) {
			$classes[] = 'lang-' . LANG;
		}
		if ( defined( 'ENV' ) ) {
			$classes[] = 'env-' . ENV;
		}
		if ( class_exists( 'WooCommerce' ) ) {
			$classes[] = 'woo-is-on';
		}
		if ( ! is_user_logged_in() ) {
			$classes[] = 'logged-out';
		}

		return $classes;
	}
}

function label_counter( &$label_counter ){
	if( empty( $label_counter ) ){
		$label_counter = 1;
	}

	$return = $label_counter;

	$label_counter++;

	return $return;
}

/**
 * Theme menus
 */
function register_theme_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu', 'qstheme' ), // Main Navigation.
		)
	);
	register_nav_menus(
		array(
			'footer-nav' => __( 'Footer nav', 'qstheme' ), // Main Navigation.
		)
	);
	register_nav_menus(
		array(
			'footer-bottom-nav' => __( 'Footer bottom nav', 'qstheme' ), // Main Navigation.
		)
	);
}
/**
 * Header menu
 */
function header_menu() {
	wp_nav_menu(
		array(
			'theme_location' => 'header-menu',
			'menu_class'     => 'header-menu-class',
			'container'      => '',
			'container_id'   => 'main-navigation',
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		)
	);
}
/**
 * Footer nav
 */
function footer_nain_menu() {
	wp_nav_menu(
		array(
			'theme_location' => 'footer-nav',
			'menu_class'     => 'header-menu-class',
			'container'      => '',
			'container_id'   => 'footer-main-navigation',
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		)
	);
}
/**
 * Footer bottom nav
 */
function footer_bottom_menu() {
	wp_nav_menu(
		array(
			'theme_location' => 'footer-bottom-nav',
			'menu_class'     => 'footer-bottom-menu-class',
			'container'      => '',
			'container_id'   => 'footer-bottom-navigation',
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		)
	);
}

// get the the role object.
$role_object = get_role( 'editor' );

// add $cap capability to this role object.
$role_object->add_cap( 'edit_theme_options' );

/**
 * HTML Email
 *
 * @return string mail type
 */
function qsemail_set_content_type() {
	return 'text/html';
}
/**
 * Fix url uppercase urls
 *
 * @return boolean true/false
 */
function isPartUppercase() {
	$url = $_SERVER['REQUEST_URI'];
	if ( ! strpos( $_SERVER['REQUEST_URI'], '%' ) ) {
		return;
	}

	if ( preg_match( '/[A-Z]/', $url ) ) {
		$_SERVER['REQUEST_URI'] = strtolower( $url );
	}
	return false;
}
isPartUppercase();

/**
 * Remove visual composer shortcode from content
 *
 * @param string $excerpt text.
 */
function remove_vc_shortcodes_from_content( $excerpt ) {
	$excerpt = preg_replace( '/\[\/?vc_.*?\]/', '', $excerpt );
	echo $excerpt; //phpcs:ignore.
}
/**
 * Locate function definitio
 *
 * @param  string $function_name function name.
 */
function get_function_location( $function_name ) {
	$refl_func = new ReflectionFunction( $function_name );
	print $refl_func->getFileName() . ':' . $refl_func->getStartLine();
}

// add_action( 'wp_footer', 'qs_list_hooks_filters' );.
/**
 * Display hooks list
 */
function qs_list_hooks_filters() {

	if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG || ! current_user_can( 'administrator' ) ) {
		return;
	}
	global $wp_filter;

	$comment_filters = array();
	$h1              = '<h1>Current Filters list:</h1>';
	$out             = '';
	$toc             = '<ul>';

	foreach ( $wp_filter as $key => $val ) {
		if ( false !== strpos( $key, 'comment' ) ) {
			$comment_filters[ $key ][] = var_export( $val, true );
		}
	}

	foreach ( $comment_filters as $name => $arr_vals ) {
		$out .= "<h2 id=$name>$name</h2><pre>" . implode( "\n\n", $arr_vals ) . '</pre>';
		$toc .= "<li><a href='#$name'>$name</a></li>";
	}
	print "<pre style='direction:ltr; text-align:left;'>$h1$toc</ul>$out</pre>";
}

/**
 * Convert gregorian_date_to_jewesh
 *
 * @param  string $date date with 3 part format.
 * @return string       date
 */
function convert_gregorian_date_to_jewesh( $date ) {
	if ( $date ) {
		$date_exploded          = explode( '.', $date );
		$jewish_date_convertion = gregoriantojd( $date_exploded[1], $date_exploded[0], $date_exploded[2] );
		$jewish_date            = jdtojewish( $jewish_date_convertion, true, CAL_JEWISH_ADD_GERESHAYIM );
		$jewish_date_utf        = iconv( 'WINDOWS-1255', 'UTF-8', $jewish_date );

		return $jewish_date_utf;
	}
}
/**
 * Function add validation to cf7 submiting form to all "tel" tags
 *
 * @param  object $result results.
 * @param  object $tag tag.
 */
function custom_tel_confirmation_validation_filter( $result, $tag ) {
	$tel = isset( $_POST[ $tag->name ] ) ? trim( $_POST[ $tag->name ] ) : ''; //phpcs:ignore.
	$re  = '/^[\+]?[(]?[0-9]{2,3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/';

	if ( ! preg_match( $re, $tel, $matches ) || strlen( $tel ) > 10 ) {
		$result->invalidate( $tag, 'Please enter a valid phone number' );
	}

	return $result;
}
/**
 * Disable rest api by create error fo every request - invoke by hook - rest_authentication_errors
 *
 * @param  mixed (object|null) WP_Error $result on error.
 * @return object WP_Error $result
 */
function disabled_rest_api( $result ) {
	return new WP_Error( 'rest_is_disable', 'REST API is disabled.', array( 'status' => 401 ) );
}
/**
 * Disable rest api by before init rest - invoke by hook - rest_api_init
 */
function disabled_rest_api_init() {
	die( 'REST API is disabled.' );
}

/**
 * Print SVG - print_svg
 *
 * @param  mixed (string|int) $path svg path or attahment id.
 * @return string svg image
 */
function print_svg( $path ) {
	if ( ! empty( $path ) ) {
		if ( ! defined( 'THEMEPATH' ) ) {
			define( 'THEMEPATH', get_template_directory() );
		}
		if ( ! defined( 'THEME' ) ) {
			define( 'THEME', get_template_directory_uri() );
		}
		try {
			if ( is_numeric( $path ) ) {
				$path = get_attached_file( $path );
			} else {
				if ( false !== strpos( $path, 'http' ) ) {
					if ( false !== strpos( $path, THEME ) ) {
						$path = str_replace( THEME, THEMEPATH, $path );
					} else {
						if ( false !== strpos( $path, get_site_url() ) ) {
							$path = str_replace( get_site_url(), str_replace( '/wp-content/themes/' . get_stylesheet(), '', THEMEPATH ), $path );
						}
					}
				}
			}
			return file_get_contents( $path ); // phpcs:ignore.
		} catch ( \Exception $e ) {
			return '';
		}
	}
}

function theme_main_added_style(){

	$style = array();

	if( is_404() ){

		$style[] = 'background-blue-and-bubble';
	} elseif ( get_page_template_slug() == 'view/tpl-home.php' ) {

		$style[] = 'bg-blue-and-bubble';
	}

	$style_str = '';
	if( $style ){
		$style_str = implode( ' ', $style );
	}

	echo $style_str;
}


function theme_the_page_part_label( $part_num = 0, $text = '', $id = '', $white = false ){
	if ( $part_num && $text ):
		$part_num = ( $part_num < 10 ) ? '0'.$part_num : $part_num; ?>
		<div class="label-part-row <?php echo ( $white ) ? 'white' : ''; ?>">
			<div <?php echo ( $id ) ? 'id="'.$id.'"' : ''; ?> class="page-part-label trigger-page-part-label" data-key="<?php echo $part_num; ?>" data-text="<?php echo $text; ?>" data-id="<?php echo $id; ?>">
				<span class="number" aria-hidden="true"><?php echo $part_num; ?></span>
				<span class="label-text">
					<?php echo $text; ?>
				</span>
			</div>
		</div>
	<?php endif;
}

function theme_get_post_to_archive( $type = '', $page = 1, $data = array(), &$back_data = array() ){

	$posts_list = false;

	if( $type && $page ){

		$post_author    = ( isset( $data['author'] ) && $data['author'] ) ? $data['author'] : false;
		$post_tags      = ( isset( $data['tags'] ) && $data['tags'] ) ? $data['tags'] : false;
		switch ( $type ) {
			case 'news':
				$tax_tags = 'news_tag';
				break;

			default:
				$tax_tags = 'post_tag';
				break;
		}
		// $tax_tags       = ( isset( $data['tags_tax'] ) && $data['tags_tax'] ) ? $data['tags_tax'] : 'post_tag';
		$posts_per_page = ( isset( $data['posts_per_page'] ) && $data['posts_per_page'] ) ? $data['posts_per_page'] : 6;
		$paged          = ( isset( $data['paged'] ) && $data['paged'] ) ? $data['paged']                            : 1;

		$args_posts = array(
			'post_status'    => 'publish',
		    'post_type'      => $type,
		    'posts_per_page' => $posts_per_page,
			'paged'          => $paged,
		    // 'post__not_in'   => array( get_the_ID() )
		);
		if( $post_tags ){
		    $args_posts['tax_query'] = array(
		        array(
		            'taxonomy' => $tax_tags,
		            'field'    => 'id',
		            'terms'    => $post_tags
		        )
		    );
		}
		if( $post_author ){
		    $args_posts['meta_query'] = array(
		        array(
		            'key'   => 'post_author',
		            'value' => $post_author,
		        )
		    );
		}

		$posts_list = new WP_Query( $args_posts );

		$back_data['max_num_pages'] = $posts_list->max_num_pages;
	}

	return $posts_list;
}


function theme_get_events( $future = true, $per_page = 0, $oredr = '', $paged = 1 ){

	$oredr    = ( $oredr == 'ASC' ) ? 'ASC' : 'DESC';
	$per_page = ( !$per_page ) ? -1 : $per_page;
	$future   = ( $future ) ? '>=' : '<';

	$args = array(
		'post_type'      => 'events',
		'posts_per_page' => $per_page,
		'meta_query'     => array(
			array(
				'key'     => 'event_dates',
				'value'   => date('Ymd'),
				'compare' => $future,
				'type'    => 'NUMERIC',
			),
		),
		'meta_key' => 'event_dates',
		'orderby'  => array( 'meta_value_num' => $oredr ),
		// 'order'    => $oredr,
		'paged'    => $paged
	);

	// echo '<pre class="kung-fu-panda" style="direction:ltr;text-align:left;">';
	// print_r( $args );
	// echo '</pre>';
	
	$events = new WP_Query( $args );
	wp_reset_postdata();

	return $events;
}

function theme_get_research( $posts = 6, $paged = 1, $offset = 0 ){

	$args_research = array(
	    'post_type'      => 'research',
	    'posts_per_page' => $posts,
		'paged'          => $paged
	);

	if( $offset ){
		$args_research['offset'] = $offset;
	}

	$research_query = new WP_Query( $args_research );

	return $research_query;
}

function theme_get_primary_taxonomy( $post_id = 0, $term = 'category', $return_all_categories = false ){

    $return = array();

	if( $term ){

		$post_id = ( $post_id ) ? $post_id : get_the_ID();

		if ( class_exists('WPSEO_Primary_Term') ){
	        // Show Primary category by Yoast if it is enabled & set
	        $wpseo_primary_term = new WPSEO_Primary_Term( $term, $post_id );
	        $primary_term = get_term($wpseo_primary_term->get_primary_term());

	        if (!is_wp_error($primary_term)){
	            $return[] = $primary_term;
	        }
	    }

	    if ( empty( $return[0] ) || $return_all_categories ){
	        $categories_list = get_the_terms( $post_id, $term );

	        if ( empty( $return[0] ) && !empty( $categories_list ) ){
	            $return[] = $categories_list[0];  //get the first category
	        }
	        if ($return_all_categories){

	            if (!empty($categories_list)){
	                foreach($categories_list as &$category){
	                    $return[] = $category->term_id;
	                }
	            }
	        }
	    }
	}

    return $return;
}

function theme_search_highlight( $string = '', $search_text = '' ){

	// if( is_super_admin() ){
	// 	echo '<pre class="kung-fu-panda" style="direction:ltr;text-align:left;">';
	// 	print_r( $string );
	// 	echo '<br>';
	// 	print_r( $search_text );
	// 	echo '</pre>';
	// 	die('ADMIN TEST');
	// }

	if( $string && $search_text ){

		return preg_replace_callback( "/$search_text/iu", static function( $match ) use ( $search_text ){
			return '<span class="search-highlight" style="background: #99ff66;">'. $match[0] .'</span>';
		}, $string );
	}
	return $string;
}

function get_post_type_tags( $post_type = '' ){

	switch ( $post_type ) {

		case 'news':
			$all_tags = get_terms( array(
				'taxonomy' => 'news_tag',
				'fields'   => 'all',
			));
			break;

		default:
			$all_tags = get_tags();
			break;
	}
	return $all_tags;
}

// function theme_search_highlight( $text ){
//
// 	// settings
// 	$styles = ['',
// 		'color: #000; background: #99ff66;',
// 		'color: #000; background: #ffcc66;',
// 		'color: #000; background: #99ccff;',
// 		'color: #000; background: #ff9999;',
// 		'color: #000; background: #FF7EFF;',
// 	];
//
// 	// for the search pages and the main loop only.
// 	if( ! is_search() || ! in_the_loop() )
// 		return $text;
//
// 	$query_terms = get_query_var( 'search_terms' );
//
// 	if( empty( $query_terms ) )
// 		$query_terms = array_filter( (array) get_search_query() );
//
// 	if( empty( $query_terms ) )
// 		return $text;
//
// 	$n = 0;
// 	foreach( $query_terms as $term ){
// 		$n++;
//
// 		$term = preg_quote( $term, '/' );
// 		$text = preg_replace_callback( "/$term/iu", static function( $match ) use ( $styles, $n ){
// 			return '<span style="'. $styles[ $n ] .'">'. $match[0] .'</span>';
// 		}, $text );
// 	}
//
// 	return $text;
// }

function theme_get_query_post_type( $data_type ){

	$post_tye        = '';
	$search_post_tye = '';
	$show_type       = '';

	switch ( $data_type ) {

		case 'posts':
			$post_tye        = array('post');
			$search_post_tye = 'post';
			$show_type       = false;
			break;

		// case 'faculty':
		//     $post_tye = array('');
		//     break;

		case 'researchers':
			$post_tye        = array('researchers');
			$search_post_tye = 'researchers';
			$show_type       = false;
			break;

		// case 'members':
		//     $post_tye = array('');
		//     break;

		case 'events':
			$post_tye        = array('events');
			$search_post_tye = 'events';
			$show_type       = false;
			break;

		case 'news':
			$post_tye        = array('news');
			$search_post_tye = 'news';
			$show_type       = false;
			break;

		case 'publications':
			$post_tye        = array('publications');
			$search_post_tye = 'publications';
			$show_type       = false;
			break;

		default:
			$post_tye        = array( 'post', 'researchers', 'events', 'news', 'publications' );
			$search_post_tye = 'all';
			$show_type       = true;
			break;
	}

	$return = array(
		'post_tye'        => $post_tye,
		'search_post_tye' => $search_post_tye,
		'show_type'       => $show_type,
	);

	return $return;
}

function theme_head_event_add_script(){
	?>
	<script src="https://cdn.jsdelivr.net/npm/add-to-calendar-button@2" async defer></script>
	<?php
}

function theme_number_to_string( $num = 0 ){

	if( is_numeric( $num ) && $num < 10 ){
		$num = '0'.intval( $num );
	}
	return $num;
}
