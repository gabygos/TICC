<?php
/**
* Template Name: Blog
*
* @package WordPress
*/

$post_data = array();

$post_type        = get_query_var('post_type');
$post_data['tax'] = get_query_var('taxonomy');
$post_type        = ( $post_type ) ? $post_type : 'post';

$archive_title = get_the_title();

$posts_per_page = get_field( $post_type.'_items_in_page', 'option');
$posts_per_page = ( $posts_per_page ) ? $posts_per_page : 6;

$post_author = ( isset( $_GET['post_author'] ) && $_GET['post_author'] && is_numeric( $_GET['post_author'] ) ) ? $_GET['post_author'] : false;
$post_tags   = ( isset( $_GET['post_tags'] ) && $_GET['post_tags'] && is_numeric( $_GET['post_tags'] ) ) ? $_GET['post_tags'] : false;

$top_post = get_field('top_post');

$added_data = array(
    'posts_per_page' => $posts_per_page,
    'author'         => $post_author,
    'tags'           => $post_tags,
);
$posts_list = theme_get_post_to_archive( $post_type, 1, $added_data );

// $all_tags = get_tags();
$all_tags = get_post_type_tags( $post_type );

$args_scientists = array(
    'post_type'      => 'researchers',
    'posts_per_page' => -1,
);
$authors_list = new WP_Query( $args_scientists );

get_header(); ?>

<div class="posts-archive-one">

    <div class="page-title-row">
        <h1 class="page-title">
            <?php echo $archive_title; ?>
        </h1>
    </div>

    <div class="filter-data-row">
        <form class="filter-form trigger-filter-posts" action="" method="get">

            <?php if( $authors_list->have_posts() ): ?>
                <label for="post-author">
                    <span class="label-text"><?php esc_html_e('Author:', 'greyowl'); ?></span>
                    <select id="post-author" class="" name="post_author">
                        <option value="all"><?php esc_html_e('All', 'greyowl'); ?></option>
                        <?php while ( $authors_list->have_posts() ): $authors_list->the_post(); ?>
                            <option value="<?php echo get_the_ID(); ?>" <?php echo selected( $post_author, get_the_ID() ); ?>><?php echo the_title(); ?></option>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </select>
                </label>
            <?php endif; ?>

            <?php if ( $all_tags ): ?>
                <label for="post-tags">
                    <span class="label-text"><?php esc_html_e('Tag:', 'greyowl'); ?></span>
                    <select id="post-tags" class="" name="post_tags">
                        <option value="all"><?php esc_html_e('All', 'greyowl'); ?></option>
                        <?php foreach ( $all_tags as $tag_data ): ?>
                            <option value="<?php echo $tag_data->term_taxonomy_id; ?>" <?php echo selected( $post_tags, $tag_data->term_taxonomy_id ) ?>><?php echo $tag_data->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            <?php endif; ?>

        </form>
    </div>

    <?php get_template_part( 'inc/top-main-post', null, array( 'top_post' => $top_post ) ); ?>

    <?php if( $posts_list->have_posts() ): ?>

        <section class="posts-archive-list trigger-posts-archive-list">
            <?php while ( $posts_list->have_posts() ): $posts_list->the_post();
            $post_data['post'] = $post; ?>

            <div class="blog-item-post">
                <?php get_template_part('inc/item-post', null, $post_data ); ?>
            </div>

        <?php endwhile; wp_reset_postdata(); ?>
    </section>

    <?php if ( $posts_list->max_num_pages > 1 ): ?>
        <div class="load-more-button-row">
            <button type="button" class="load-more-posts button-blue trigger-load-more-posts" data-type="<?php echo $post_type; ?>" data-page="1" data-items="<?php echo $posts_per_page; ?>">
                <?php esc_html_e('load more', 'greyowl'); ?>
            </button>
        </div>
    <?php endif; ?>

<?php endif; ?>

</div>

<?php get_footer();
