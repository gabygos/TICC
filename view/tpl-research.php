<?php
/**
 * Template Name: Research Template
 *
 * @package WordPress
 */

$tpl_thumbnails = get_the_post_thumbnail_url( get_the_ID(), 'tpl-thumbnails' );

$item_text_columns   = get_field('item_text_columns');

get_header(); ?>


<div class="research-page-main-container">

    <?php get_template_part('inc/page-banner'); ?>

    <div class="template-details-content-section">
        <div class="template-details-content">
            <div class="text-container">
                <div class="text-content">
                    <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('Details', 'greyowl'), 'details-section' ); ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php the_content(); ?>

                    <?php endwhile; ?>
                </div>
            </div>
            <div class="image-content">
                <picture>
                    <img src="<?php echo $tpl_thumbnails; ?>" alt="">
                </picture>
            </div>

        </div>
    </div>

    <?php if( $item_text_columns ): ?>
        <div class="columns-text-section">
            <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('Statistics', 'greyowl'), 'skin-cancer-Statistics-section', true ); ?>
            <div class="columns-text-container">
                <?php
                $rows_counter = 1;
                $items_counter = 1;
                foreach ( $item_text_columns as $item ):
                    if( $items_counter == 1): ?>
                        <div class="container-row">
                    <?php endif; ?>
                        <div class="columns-text-item">
                            <div class="text-box">
                                <?php echo $item['text']; ?>
                            </div>
                        </div>
                    <?php
                    if( 2 <= $items_counter ): ?>
                        </div>
                    <?php endif;

                    if( 2 <= $items_counter ){
                        $rows_counter++;
                        $items_counter = 1;
                    } else {
                        $items_counter++;
                    }

                endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php get_template_part( 'inc/featured-scientists-section', null, array( 'link' => 'block' ) ); ?>

</div>

<?php get_footer();
