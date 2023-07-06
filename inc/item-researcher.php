<?php



$author = ( isset( $args['author']->ID ) ) ? $args['author'] : false;
$color  = ( isset( $args['color'] ) ) ? $args['color'] : '';
$link   = ( isset( $args['link'] ) && $args['link'] ) ? $args['link'] : 'link';

$article_style = array( $link );
if( $color ){
    $article_style[] = $color;
}

if( $author ):

    $thumbnail = get_the_post_thumbnail_url( $author->ID, 'medium' );
    if( !$thumbnail ){
        $default_image = get_field('default_image', 'option');
        $thumbnail = ( isset( $default_image['sizes']['post-item'] ) ) ? $default_image['sizes']['post-item'] : '';
    } ?>

    <article class="researcher-article <?php echo ( $article_style ) ? implode( ' ', $article_style ) : ''; ?> ">
        <?php if( $link == 'block' ): ?>
            <a href="<?php echo get_permalink( $author->ID ); ?>" class="researcher-block-link">
        <?php endif; ?>
        <div class="researcher-image">
            <picture>
                <img src="<?php echo $thumbnail; ?>" alt="<?php echo $author->post_title; ?>">
            </picture>
        </div>
        <div class="meta-box">
            <div class="meta-text">
                <h3 class="researcher-name"><?php echo $author->post_title; ?></h3>
                <p class="researcher-role">
                    <?php the_field( 'researcher_role', $author->ID ); ?>
                </p>
                <?php if( $link == 'link' ): ?>
                    <a href="<?php echo get_permalink( $author->ID ); ?>" class="researcher-link">
                        <?php esc_html_e('View Faculty Profile', 'greyowl'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <?php if( $link == 'block' ): ?>
            </a>
        <?php endif; ?>
    </article>

<?php endif; ?>
