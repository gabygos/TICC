<?php

$search_val = ( isset( $args['s'] ) ) ? $args['s'] : '';

$post_type = esc_html__('Publications', 'greyowl');

$thumbnail = get_the_post_thumbnail_url( $item_post->ID, 'medium' );

$show_type = ( isset( $args['show_type'] ) ) ? $args['show_type'] : true;

if( !$thumbnail ){
    $default_image = get_field('default_image', 'option');
    $thumbnail = ( isset( $default_image['sizes']['medium'] ) ) ? $default_image['sizes']['medium'] : '';
} ?>

<article class="search-article publications-item">

    <div class="search-item-container">

        <?php if( $show_type ): ?>
            <div class="post-type">
                <?php echo $post_type; ?>
            </div>
        <?php endif; ?>

        <a href="<?php echo get_permalink( get_the_ID() ); ?>" class="search-article-link">
            <div class="post-content">
                <div class="image-box">
                    <picture class="picture-box">
                        <source media="( max-width: 480px )" srcset="">
                        <img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>">
                    </picture>
                </div>
                <div class="text-box">
                    <h2 class="item-title"><?php echo theme_search_highlight( get_the_title(), $search_val ); ?></h2>
                    <p class="item-excerpt"><?php echo theme_search_highlight( get_the_excerpt(), $search_val ); ?></p>
                </div>
            </div>
        </a>
    </div>
</article>
