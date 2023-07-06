<?php

// $post_id = ( isset( $args['post_id'] ) ) ? $args['post_id'] : '';
// $author  = ( isset( $args['author'] ) ) ? $args['author'] : '';
// $tags    = ( isset( $args['tags'] ) ) ? $args['tags'] : '';

$posts = ( isset( $args['posts'] ) ) ? $args['posts'] : '';

// $args_posts = array(
//     'post_type'      => 'post',
//     'posts_per_page' => 3,
//     'post__not_in'   => array( get_the_ID() )
// );
// $related_posts = new WP_Query( $args_posts );

if( $posts ): // $related_posts->have_posts() ?>

<section class="related-posts-section">

    <div class="swiper trigge-related-posts-section">
        <div class="related-posts-section-container swiper-wrapper">
            <?php /*
            while ( $related_posts->have_posts() ): $related_posts->the_post();
                $post_data = array( 'post' => $post );
                get_template_part('inc/item-post', null, $post_data );
            endwhile;
            */ ?>
            <?php foreach ( $posts as $post_obj ):
                $post_data = array( 'post' => $post_obj ); ?>
                <div class="swiper-slide">
                    <?php get_template_part('inc/item-post', null, $post_data ); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</section>

<?php endif; // wp_reset_postdata(); ?>
