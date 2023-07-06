<?php
/**
* Template Name: About Template
*
* @package WordPress
*/

$tpl_thumbnails     = get_the_post_thumbnail_url( get_the_ID(), 'tpl-thumbnails' );

$columns            = get_field('columns');

$who_we_are_text    = get_field('who_we_are_text');
$who_we_are_authors = get_field('who_we_are_authors');

$content_title      = get_field('content_title');

get_header(); ?>

<div class="about-page-main-container">

    <?php get_template_part('inc/page-banner'); ?>

    <?php if( $columns ): ?>
        <div class="columns-section background-blue-and-bubble">

            <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('Impact by numbers', 'greyowl'), 'impact-by-numbers-section', true ); ?>

            <ul class="list-columns">
                <?php foreach ( $columns as $item ): ?>
                    <li class="column-item">
                        <?php echo $item['text']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>


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

    <?php if( have_rows('what_we_do_section') ): ?>
        <section class="">

            <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('What we do', 'greyowl'), 'what-we-do-section' ); ?>

            <?php
            // Loop through rows.
            while ( have_rows('what_we_do_section') ): the_row();

                $field_name = get_row_layout();
                $file       = "inc/page-parts/".$field_name;
                $located    = locate_template( $file.'.php' );

                if( !empty( $located  ) ){

                    $args_section = array(
                        'name' => $field_name,
                        'data' => get_sub_field('options'),
                    );

                    get_template_part( $file, null, $args_section );
                }
            endwhile; ?>
        </section>
    <?php endif; ?>

    <?php if( $who_we_are_text && $who_we_are_authors ): ?>
        <section class="who-we-are-section">
            <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('Who we are', 'greyowl'), 'who-we-are-section' ); ?>
            <div class="who-we-are-container">
                <div class="text-column">
                    <?php echo $who_we_are_text; ?>
                </div>
                <div class="author-column">
                    <div class="researcher-list">
                        <?php
                        foreach ( $who_we_are_authors as $author ){

                            get_template_part('inc/item-researcher', null, array( 'author' => $author ) );
                        } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

</div>

<?php get_footer();
