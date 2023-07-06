<?php
/**
 * Search page template
 *
 * @package WordPress
 */

$data_value = get_search_query();

$data_type     = ( isset( $_GET['search_type'] ) ) ? $_GET['search_type'] : '';
$post_tye_data = theme_get_query_post_type( $data_type );
$set_args = array(
	'show_type' => ( isset( $post_tye_data['show_type'] ) ) ? $post_tye_data['show_type'] : true,
	's'         => sanitize_text_field( $data_value )
);

get_header(); ?>

	<div class="search-page-container">
		<h1 class="search-page-title">
			<span class="page-title-number"><?php echo esc_html( $wp_query->found_posts ); ?></span>
			<span class="page-title-text"><?php esc_html_e('results for:', 'greyowl'); ?></span>
			<span class="page-title-search-text"><?php echo $data_value; ?></span>
		</h1>
		<div class="search-content">
			<?php while ( have_posts() ) : the_post();

				if ( get_post_type() == 'researchers' ) {
					get_template_part('inc/search/researchers-item', null, $set_args );
				}
				// elseif ( get_post_type() == 'publications' ) {
				//     get_template_part('inc/search/publications-item', null, array( 's' => sanitize_text_field( $data_value ) ) );
				// }
				elseif ( get_post_type() == 'events' ) {
					get_template_part('inc/search/events-item', null, $set_args );
				}
				else {
					get_template_part('inc/search/post-item', null, $set_args );
				}

			endwhile; ?>
		</div>
		<div class="page-pagination">
			<?php echo paginate_links(); ?>
		</div>
	</div>

<?php get_footer(); ?>
