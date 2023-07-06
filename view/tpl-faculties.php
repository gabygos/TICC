<?php
/**
 * Template Name: Faculties Template
 *
 * @package WordPress
 */

$tpl_thumbnails = get_the_post_thumbnail_url( get_the_ID(), 'tpl-thumbnails' );

$accordion      = get_field('accordion_and_content');
$faculties      = get_field('faculties');

$content_title  = get_field('content_title');

get_header(); ?>


<div class="faculties-page-main-container">

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

    <?php if( $faculties ): ?>
        <section class="faculties-section">
            <div class="faculties-container">
                <div class="faculties-list-wrapper only-desktop">
                    <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('faculties', 'greyowl'), 'faculties-section' ); ?>
                    <div class="faculties-list">
                        <div class="part-label">
                            <?php esc_html_e('Faculty of:', 'greyowl'); ?>
                        </div>
                        <?php
                        $item_counter = 1;
                        foreach ( $faculties as $item ): ?>
                            <div class="faculty-item">
                                <button class="faculty-btn <?php echo ( $item_counter == 1 ) ? 'active' : ''; ?> trigger-faculty-button" type="button" data-id="<?php echo $item_counter; ?>">
                                    <?php echo $item['faculty']; ?>
                                </button>
                            </div>
                            <?php $item_counter++;
                        endforeach; ?>
                    </div>
                </div>
                <div class="faculties-info">
                    <div class="faculties-info-content">
                        <?php
                        $item_counter = 1;
                        foreach ( $faculties as $item ): ?>
                            <div id="faculty-<?php echo $item_counter; ?>" class="faculty-item-info <?php echo ( $item_counter == 1 ) ? 'active' : ''; ?>">
                                <button class="faculty-btn <?php echo ( $item_counter == 1 ) ? 'active' : ''; ?> trigger-faculty-button" type="button" data-id="<?php echo $item_counter; ?>">
                                    <?php echo $item['faculty']; ?>
                                </button>
                                <div class="faculty-item-info-wrapp">
                                    <?php if( isset( $item['logo']['sizes']['icon_height'] ) ): ?>
                                        <div class="faculty-logo">
                                            <picture>
                                                <img src="<?php echo $item['logo']['sizes']['icon_height']; ?>" alt="">
                                            </picture>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( isset( $item['text'] ) ): ?>
                                        <div class="faculty-text">
                                            <?php echo $item['text']; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( isset( $item['researchers'] ) && $item['researchers'] ): ?>
                                        <div class="researchers-list">
                                            <?php if( isset( $item['researchers'] ) ): ?>
                                                <?php foreach ( $item['researchers'] as $user ):
                                                    $thumbnail = get_the_post_thumbnail_url( $user->ID, 'small-square' );
                                                    if( !$thumbnail ){
                                                        $default_image = get_field('default_image', 'option');
                                                        $thumbnail = ( isset( $default_image['sizes']['small-square'] ) ) ? $default_image['sizes']['small-square'] : '';
                                                    } ?>
                                                    <div class="researcher-col">
                                                        <a href="<?php echo get_permalink( $user->ID ); ?>" class="researcher-link">
                                                            <div class="name-researcher">
                                                                <?php echo $user->post_title; ?>
                                                            </div>
                                                            <div class="rol-researcher">
                                                                <?php the_field('researcher_role', $user->ID ); ?>
                                                            </div>
                                                            <div class="thumbnail-block">
                                                                <picture>
                                                                    <img src="<?php echo $thumbnail; ?>" alt="">
                                                                </picture>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php $item_counter++;
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if( $accordion ):
        $left_side  = array();
        $right_side = array();
        foreach ( $accordion as $item ) {
            $left_side[] = array(
                'image'       => ( isset( $item['image']['sizes']['medium_gallery'] ) ) ? $item['image']['sizes']['medium_gallery'] : '',
                'name'        => $item['name'],
                'description' => $item['description'],
            );
            $right_side[] = array(
                'image'       => ( isset( $item['image']['sizes']['medium_gallery'] ) ) ? $item['image']['sizes']['medium_gallery'] : '',
                'logo'        => ( isset( $item['logo']['sizes']['icon_height'] ) ) ? $item['logo']['sizes']['icon_height'] : '',
                'name'        => $item['name'],
                'description' => $item['description'],
                'text'        => $item['text'],
                'researchers' => $item['researchers']
            );
        } ?>
        <section class="accordion-and-content-section">

            <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('hospitals', 'greyowl'), 'hospitals-section', true ); ?>

            <div class="accordion-and-content-container">
                <div class="image-col only-desktop">
                    <?php
                    $part_counter = 1;
                    foreach ( $left_side as $part ): ?>
                        <div class="item-image">
                            <button id="accordion-image-<?php echo $part_counter; ?>" data-id="<?php echo $part_counter; ?>" type="button" class="accordion-button <?php echo ( $part_counter == 1 ) ? 'active' : ''; ?> trigger-accordion-content">
                                <div class="image-box">
                                    <picture>
                                        <img src="<?php echo $part['image']; ?>" alt="" role="presentation">
                                    </picture>
                                    <div class="button-text">
                                        <div class="name-part">
                                            <?php echo $part['name']; ?>
                                        </div>
                                        <div class="description-part">
                                            <?php echo $part['description']; ?>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <?php $part_counter++;
                    endforeach; ?>
                </div>
                <div class="content-col trigger-max-h">
                    <?php
                    $part_counter = 1;
                    foreach ( $right_side as $part ): ?>
                        <div id="accordion-content-<?php echo $part_counter; ?>" class="item-content <?php echo ( $part_counter == 1 ) ? 'active' : ''; ?> trigger-item-content">
                            <button id="accordion-image-<?php echo $part_counter; ?>" data-id="<?php echo $part_counter; ?>" type="button" class="only-mobile accordion-button <?php echo ( $part_counter == 1 ) ? 'active' : ''; ?> trigger-accordion-content" tabindex="-1" aria-hidden="true">
                                <div class="image-box">
                                    <picture>
                                        <img src="<?php echo $part['image']; ?>" alt="" role="presentation">
                                    </picture>
                                    <div class="button-text">
                                        <div class="name-part">
                                            <?php echo $part['name']; ?>
                                        </div>
                                        <div class="description-part">
                                            <?php echo $part['description']; ?>
                                        </div>
                                    </div>
                                </div>
                            </button>
                            <div class="mobile-accordion-content">
                                <div class="title-row">
                                    <div class="title-box">
                                        <div class="title-col">
                                            <h3 class="title-box">
                                                <?php echo $part['name']; ?>
                                            </h3>
                                            <p class="description-box">
                                                <?php echo $part['description']; ?>
                                            </p>
                                        </div>
                                        <div class="logo-col">
                                            <?php if( $part['logo'] ): ?>
                                                <picture>
                                                    <img src="<?php echo $part['logo']; ?>" alt="">
                                                </picture>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-row">
                                    <?php echo $part['text']; ?>
                                </div>
                                <div class="researchers-rows">
                                    <?php if( $part['researchers'] ): ?>
                                        <div class="researchers-list">
                                            <?php foreach ( $part['researchers'] as $user ): ?>
                                                <div class="researcher-part">
                                                    <a href="<?php echo get_permalink( $user->ID ); ?>" class="researcher-link">
                                                        <div class="neme-researcher">
                                                            <?php echo $user->post_title; ?>
                                                        </div>
                                                        <div class="researcher-role">
                                                            <?php the_field('researcher_role', $user->ID ); ?>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php $part_counter++;
                    endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

</div>

<?php get_footer();
