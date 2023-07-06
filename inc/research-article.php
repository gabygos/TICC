<?php

if( isset( $args['obj']->ID ) ){

    $post_id    = $args['obj']->ID;
    $post_title = $args['obj']->post_title;
} else {

    $post_id    = get_the_ID();
    $post_title = get_the_title();
}

$added_class = ( isset( $args['class'] ) ) ? $args['class'] : '';

$key = ( isset( $args['key'] ) ) ? $args['key'] : '';

$post_author   = get_field('post_author', $post_id );
$author_name   = ( isset( $post_author->post_title ) ) ? $post_author->post_title : '';
$thumbnail     = get_the_post_thumbnail_url( $post_id, 'post-item' );
$category      = theme_get_primary_taxonomy( $post_id, 'research_category' );
$category_name = ( isset( $category[0]->name ) ) ? $category[0]->name : '';



if( !$thumbnail ){
    $default_image = get_field('default_image', 'option');
    $thumbnail = ( isset( $default_image['sizes']['post-item'] ) ) ? $default_image['sizes']['post-item'] : '';
} ?>

<article class="research-article <?php echo $added_class; ?>">
    <div class="research-article-container">
        <div class="image-box">
            <picture>
                <img src="<?php echo $thumbnail; ?>" alt="<?php echo $post_title; ?>">
            </picture>
        </div>
        <div class="research-meta">
            <p class="category-text"><?php echo $category_name; ?></p>
            <h2 class="research-title"><?php echo $post_title; ?></h2>

            <div class="meta-row">
                <div class="autor-box">
                    <?php if( $author_name ): ?>
                        <div class="label-text">
                            <?php esc_html_e('Assistant Professor', 'greyowl'); ?>
                        </div>
                        <div class="author-text">
                            <?php echo $author_name; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="link-box">
                    <a href="<?php echo get_permalink( $post_id ); ?>" class="research-article-link">
                        <?php esc_html_e('Read more', 'greyowl'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</article>
