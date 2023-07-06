<?php

$tpl_thumbnails    = get_the_post_thumbnail_url( get_the_ID(), 'tpl-thumbnails' );

$item_text_columns = get_field('item_text_columns');

$content_title     = get_field('content_title');

$selected_publications = get_field('selected_publications');

get_header(); ?>


<div class="research-page-main-container">

    <?php get_template_part('inc/page-banner'); ?>

    <div class="template-details-content-section">
        <div class="template-details-content">
            <div class="text-container">
                <div class="text-content-wrapper trigger-text-content-wrapper">
                    <div class="title-content-box trigger-title-content-box">
                        <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('Details', 'greyowl'), 'details-section' ); ?>
                        <?php if( $content_title ): ?>
                            <h2 class="title-content">
                                <?php echo $content_title; ?>
                            </h2>
                        <?php endif; ?>
                    </div>
                    <div class="text-content-row trigger-text-content-row">
                        <div class="text-content scroll-bar-side">
                            <div class="text-content-direction">
                                <?php while ( have_posts() ) : the_post(); ?>

                                    <?php the_content(); ?>

                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
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
        <div class="columns-text-section background-blue-and-bubble">
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

    <?php if( $selected_publications ): ?>
        <section class="selected-publications-section">
            <div class="molecule-bg" data-bg-rows="5"></div>
            <div class="selected-publications">
                <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('Selected Publications', 'greyowl'), 'selected-publications' ); ?>
                <div class="publications-list">
                    <?php foreach ( $selected_publications as $publication ): ?>
                        <article class="publication-item">
                            <a href="<?php echo get_permalink( $publication->ID ); ?>" class="publication-link">
                                <h3 class="publication-name">
                                    <?php echo $publication->post_title; ?>
                                </h3>
                                <p class="meta-text"><?php the_field('publicated', $publication->ID ); ?></p>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>

                <?php if ( isset( $publications_page->ID ) ): ?>
    				<div class="all-posts-link-row">
    					<a href="<?php echo get_permalink( $publications_page->ID ) ?>" class="all-posts-link">
    						<span class="text"><?php esc_html_e('All Publications', 'greyowl'); ?></span>
    						<span class="corner"><img src="<?php echo get_site_url(); ?>/wp-content/themes/qs-starter/images/arrow_w.svg" alt="icon" role="presentation">
    						</span>
    					</a>
    				</div>
    			<?php endif; ?>

            </div>
        </section>
    <?php endif; ?>

    <?php get_template_part( 'inc/featured-scientists-section', null, array( 'link' => 'block' ) ); ?>

</div>

<?php get_footer();
