<?php
/**
 * Template Name: Events Template
 *
 * @package WordPress
 */

global $post;

$page_ID = get_the_ID();

get_header(); ?>

<div class="events-page-main-container">

    <?php
    $args_ = array( 'label_counter_num' => label_counter($label_counter), 'title' => esc_html__('Events', 'greyowl') );
    get_template_part('inc/future-events-section', null, $args_ ); ?>

    <?php $past_events = theme_get_events( false, 4 );
    if ( $past_events->have_posts() ): ?>
        <section class="past-events-section">
            <!-- width-1760 -->
            <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('Previous events', 'greyowl'), 'previous-events-section' ); ?>
            <div class="past-events-container trigger-all-past-events-container">
                <?php
                while ( $past_events->have_posts() ):
                    $past_events->the_post();

                    get_template_part('inc/events/past-event-item');

                endwhile; wp_reset_postdata(); ?>
            </div>

            <div class="load-more-button-row">
                <?php if( $past_events->max_num_pages > 1 ): ?>

                    <button type="button" class="load-more-posts button-blue trigger-load-more-events" data-page="1" data-items="4">
                        <?php esc_html_e('load more', 'greyowl'); ?>
                    </button>

                <?php endif; ?>
            </div>

        </section>
    <?php endif; ?>

</div>

<?php
$post = get_post( $page_ID );

get_footer();
