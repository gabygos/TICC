<?php

if( isset( $args['top_post'] ) && isset( $args['top_post']->ID ) ){
    $top_post = $args['top_post'];
} else {
    $top_post = get_field('top_post');
}

if ( isset( $top_post->ID ) ):

    $author       = get_field( 'post_author', $top_post->ID );
    $author_image = get_field( 'banner_author_image', $top_post->ID );

    $day   = get_the_date( 'd', $top_post );
    $month = get_the_date( 'M', $top_post );

    if( isset( $top_post->post_type ) && $top_post->post_type == 'news' ){
        $tags = get_the_terms( $top_post->ID, 'news_tag' );
    } else {
        $tags = get_the_tags( $top_post );
    }

    if( isset( $author_image['sizes']['post-item'] ) ){
        $post_image_url = $author_image['sizes']['post-item'];
    } else {
        $post_image_url = get_the_post_thumbnail_url( $top_post->ID, 'post-item' );
        if( !$post_image_url ){
            $default_image = get_field('default_image', 'option');
            $post_image_url = ( isset( $default_image['sizes']['post-item'] ) ) ? $default_image['sizes']['post-item'] : '';
        }
    } ?>
    <section class="top-main-post-section">
        <div class="top-main-post-container">

            <article class="article-content">
                <div class="authot-block">
                    <picture class="image-wrapp">
                        <img src="<?php echo $post_image_url; ?>" alt="<?php sanitize_text_field( $top_post->post_title ); ?>">
                    </picture>
                    <div class="article-data">
                        <div class="day">
                            <?php echo $day; ?>
                        </div>
                        <div class="month">
                            <?php echo $month; ?>
                        </div>
                    </div>
                </div>
                <div class="post-block">
                    <a href="<?php echo get_permalink( $top_post->ID ); ?>" class="top-post-link">
                        <h3 class="article-title">
                            <?php echo $top_post->post_title; ?>
                        </h3>
                        <p class="description-article"><?php echo wp_trim_words( $top_post->post_content, '100', '...' ); ?></p>
                        <div class="meta-row">

                            <?php if( isset( $author->ID ) ): ?>
                                <div class="label-row">
                                    <?php esc_html_e('Author:', 'greyowl'); ?>
                                </div>
                                <div class="author-name">
                                    <?php echo $author->post_title; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( $tags ): ?>
                                <div class="label-row">
                                    <?php esc_html_e('Tags:', 'greyowl'); ?>
                                </div>
                                <ul class="tags-list">
                                    <?php foreach ( $tags as $tag_data ): ?>
                                        <li class="item-tag">
                                            <div class="item-tag-box">
                                                <?php echo $tag_data->name; ?>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                        </div>
                    </a>
                </div>

            </article>
        </div>
    </section>
<?php endif; ?>
