<?php
/**
* Main theme functions
*
* @package WordPress
*/

add_filter('doing_it_wrong_trigger_error', function () {return false;}, 10, 0);

get_template_part( 'functions/theme-dependencies' );

if ( ! isset( $content_width ) ) {
	$content_width = 1024;
}
if ( function_exists( 'add_theme_support' ) ) {
	// Add Menu Support.
	add_theme_support( 'menus' );
	// Add Thumbnail Theme Support.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'banner-image', 1920, 952, true );
	add_image_size( 'banner-mobile', 450, 710, true );
	add_image_size( 'large', 1000, '', true );
	add_image_size( 'medium', 408, 408, true );
	add_image_size( 'small', 250, '', true );
	add_image_size( 'small-square', 250, 250, true );

	add_image_size( 'post-item', 554, 600, true );
	add_image_size( 'ivent-item', 216, 216, true );
	add_image_size( 'tpl-thumbnails', 797, 1080, true );

	add_image_size( 'icon', 96, 96, true );
	add_image_size( 'icon_height', '', 56, true );
	add_image_size( 'medium_height', '', 150, true );
	add_image_size( 'medium_gallery', 960, 600, true );
	// Theme Support fot yoast.
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'gallery', 'script', 'style' ) );

}

// Remove default galleries css style.
add_filter( 'use_default_gallery_style', '__return_false' );

// Remove admin bar.
// add_filter('show_admin_bar', '__return_false');.

// // Allow SVG
// add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
//
// 	global $wp_version;
// 	if ( $wp_version !== '4.7.1' ) {
// 		return $data;
// 	}
//
// 	$filetype = wp_check_filetype( $filename, $mimes );
//
// 	return [
// 		'ext'             => $filetype['ext'],
// 		'type'            => $filetype['type'],
// 		'proper_filename' => $data['proper_filename']
// 	];
//
// }, 10, 4 );
//
// add_filter('upload_mimes', 'add_file_types_to_uploads');
// function add_file_types_to_uploads($file_types){
// 	$new_filetypes        = array();
// 	$new_filetypes['svg'] = 'image/svg+xml';
// 	$file_types           = array_merge( $file_types, $new_filetypes );
// 	return $file_types;
// }
//
// add_action( 'admin_head', 'fix_svg' );
// function fix_svg() {
// 	echo '<style type="text/css">
// 	.attachment-266x266, .thumbnail img {
// 		width: 100% !important;
// 		height: auto !important;
// 	}
// 	</style>';
// }





/*************************************************
* Add thumbnail to all posts dashboard
*************************************************/
add_action('init', 'add_post_thumbs_in_post_list_table', 20 );
function add_post_thumbs_in_post_list_table(){
	// $supports = get_theme_support('post-thumbnails');
	$ptype_names = array( 'post', 'page', 'news', 'researchers', 'research', 'events' );
	if( !isset($ptype_names) ){
		if( $supports === true ){
			$ptype_names = get_post_types(array( 'public' => true ), 'names' );
			$ptype_names = array_diff( $ptype_names, array('attachment') );
		}
		elseif( is_array($supports) ){
			$ptype_names = $supports[0];
		}
	}
	foreach( $ptype_names as $ptype ){
		add_filter( "manage_{$ptype}_posts_columns", 'rticc_add_thumb_column', 10, 1 );
		add_action( "manage_{$ptype}_posts_custom_column", 'rticc_add_thumb_value', 10, 2 );
	}
}
function rticc_add_thumb_column( $columns ){
	// подправим ширину колонки через css
	add_action('admin_notices', function(){
		echo '
		<style>
		.column-thumbnail{ width:80px; text-align:center; }
		.column-thumbnail img{ width: 100%; max-width: 100%; height: auto; }
		.column-thumbnail img[src$=".svg"]{ width:32px; padding: 5px; box-sizing: border-box; }
		</style>';
	});
	$num = 1;
	$new_columns = array( 'thumbnail' => __('Thumbnail', 'greyowl') );
	return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
}
function rticc_add_thumb_value( $colname, $post_id ){
	if( 'thumbnail' == $colname ){
		$thumb = '';
		$width = $height = 45;
		$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
		if( $thumbnail_id ){
			$thumb = wp_get_attachment_image( $thumbnail_id, array( $width, $height ), true );
		} else {
			$attachments = get_children( array(
				'post_parent'    => $post_id,
				'post_mime_type' => 'image',
				'post_type'      => 'attachment',
				'numberposts'    => 1,
				'order'          => 'DESC',
			) );
			if( $attachments ){
				$attach = array_shift( $attachments );
				$thumb = wp_get_attachment_image( $attach->ID, array( $width, $height ), true );
			} else {
				$def_thumb_data = get_field('default_image', 'option');
				if( isset( $def_thumb_data['ID'] ) && $def_thumb_data['ID'] ){
					$thumb = wp_get_attachment_image( $def_thumb_data['ID'], array( $width, $height ), true );
				}
			}
		}
		echo $thumb;
	}
}

/*************************************************
* Add event column to all events dashboard
*************************************************/
add_action('init', 'add_events_date_column_in_events_list_table', 20 );
function add_events_date_column_in_events_list_table(){

	$ptype = 'events';

	add_filter( "manage_{$ptype}_posts_columns", 'rticc_add_thumb_column_event', 10, 1 );
	add_action( "manage_{$ptype}_posts_custom_column", 'rticc_add_thumb_value_event', 10, 2 );
}
function rticc_add_thumb_column_event( $columns ){

	add_action('admin_notices', function(){
		echo '
		<style>
		.event-blue{ color: #005FCC;font-weight: bold; }
		.event-regular{ color: #cccccc; }
		</style>';
	});

	$num = 3;
	$new_columns = array( 'event_date' => __('Event', 'greyowl') );
	return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
}
function rticc_add_thumb_value_event( $colname, $post_id ){

	$event_dates = get_field( 'event_dates', $post_id );
	if( 'event_date' == $colname ){
		if( $event_dates < date('Ymd') ){
			echo '<span class="event-regular">';
			esc_html_e('past event:', 'greyowl');
			echo '<br>';
			echo date( 'd M Y', strtotime( $event_dates ) );
			echo '</span>';
		} else {
			echo '<span class="event-blue">';
			esc_html_e('future event:', 'greyowl');
			echo '<br>';
			echo date( 'd M Y', strtotime( $event_dates ) );
			echo '</span>';
		}
	}
}











add_action('add_meta_boxes', 'theme_add_added_meta_google_map', 15, 2 );
function theme_add_added_meta_google_map( $post_type, $post ){

	if( get_page_template_slug() == 'view/tpl-contact-us.php' || $post_type == 'events' ){

		$screens = array( 'page', 'events' );
		add_meta_box( 'theme_google_map', esc_html__('Google map', 'greyowl'), 'theme_add_added_meta_google_map_callback', $screens );
	}
}

function theme_add_added_meta_google_map_callback( $post, $meta  ){

	$map_address = get_post_meta( $post->ID, 'page_map_address', true );
	$map_lat     = get_post_meta( $post->ID, 'page_map_lat', true );
	$map_lng     = get_post_meta( $post->ID, 'page_map_lng', true );
	$map_zoom    = get_post_meta( $post->ID, 'page_map_zoom', true );

	$map_api_key = get_field('map_api_key', 'option');
	?>
	<style media="screen">
        .row-box{margin: 0 -15px 25px -15px;}
        .row-box:last-child{margin-bottom: 0;}
        .row-box::after{content: '';display: block;clear:both;}
        .column-box{float: left;padding: 0 15px;box-sizing: border-box;}
		.cl-70{width: 70%;}
        .cl-50{width: 50%;}
        .cl-33{width: 33.33%;}
        .cl-30{width: 30%;}
        .column-box input{width: 100%;height: 36px}
        .column-box .text-label{margin-bottom: 5px;min-height: 18px;}
		.row-box .added-data{padding: 0 15px;font-size: 16px;margin-bottom: 10px;}
    </style>
	<?php if( $map_api_key ): ?>
		<div class="row-box">
			<div class="column-box cl-70">
	            <label for="map-address">
	                <div class="text-label">
	                    <?php esc_html_e('Address:', 'greyowl'); ?>
	                </div>
	                <input id="map-address" type="text" name="google_map_address" value="<?php echo $map_address; ?>">
	            </label>
	        </div>
			<div class="column-box cl-30">
				<div class="text-label"></div>
				<input type="hidden" name="map_api_key" value="<?php echo $map_api_key; ?>">
				<input type="hidden" name="google_map_nonce" value="<?php echo wp_create_nonce('google-map-nonce'); ?>">
				<button type="button" class="components-button is-primary trigger-search-google-address">
					<?php esc_html_e('search address', 'greyowl'); ?>
				</button>
			</div>
		</div>
		<div class="row-box trigger-google-map-search-data"></div>
		<div class="row-box">
			<div class="column-box cl-33">
	            <label for="map-lat">
	                <div class="text-label">
	                    <?php esc_html_e('lat:', 'greyowl'); ?>
	                </div>
	                <input id="map-lat" type="text" name="google_map_lat" value="<?php echo $map_lat; ?>">
	            </label>
	        </div>
			<div class="column-box cl-33">
	            <label for="map-lng">
	                <div class="text-label">
	                    <?php esc_html_e('lng:', 'greyowl'); ?>
	                </div>
	                <input id="map-lng" type="text" name="google_map_lng" value="<?php echo $map_lng; ?>">
	            </label>
	        </div>
			<div class="column-box cl-33">
	            <label for="map-zoom">
	                <div class="text-label">
	                    <?php esc_html_e('Zoom:', 'greyowl'); ?>
	                </div>
	                <input id="map-zoom" type="number" name="google_map_zoom" value="<?php echo $map_zoom; ?>">
	            </label>
	        </div>
		</div>
	<?php else: ?>
		<div class="error">
			<?php esc_html_e('You need Google API key', 'greyowl'); ?>
		</div>
	<?php endif; ?>

	<?php
}

add_action( 'save_post', 'theme_save_added_meta_google_map' );
function theme_save_added_meta_google_map( $post_id ) {

	if ( empty( $_POST['google_map_nonce'] ) )
		return;

	if ( !wp_verify_nonce( $_POST['google_map_nonce'], 'google-map-nonce' ) )
		return;

	// если это автосохранение ничего не делаем
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return;

	// проверяем права юзера
	if( ! current_user_can( 'edit_post', $post_id ) )
		return;


	if( isset( $_POST['google_map_address'] ) ){
		$map_address = sanitize_text_field( $_POST['google_map_address'] );
		update_post_meta( $post_id, 'page_map_address', $map_address );
	}
	if( isset( $_POST['google_map_lat'] ) ){
		$map_lat = sanitize_text_field( $_POST['google_map_lat'] );
		update_post_meta( $post_id, 'page_map_lat', $map_lat );
	}
	if( isset( $_POST['google_map_lng'] ) ){
		$map_lng = sanitize_text_field( $_POST['google_map_lng'] );
		update_post_meta( $post_id, 'page_map_lng', $map_lng );
	}
	if( isset( $_POST['google_map_zoom'] ) ){
		$map_zoom = sanitize_text_field( $_POST['google_map_zoom'] );
		if( !$map_zoom ){
			$map_zoom = 16;
		}
		update_post_meta( $post_id, 'page_map_zoom', $map_zoom );
	}
}
