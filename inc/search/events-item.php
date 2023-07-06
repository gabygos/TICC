<?php

$search_val = ( isset( $args['s'] ) ) ? $args['s'] : '';

$post_type = esc_html__('Event', 'greyowl');

$thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
$img_class = ( $thumbnail ) ? 'have-image' : 'no-image';
// if( !$thumbnail ){
//     $default_image = get_field('default_image', 'option');
//     $thumbnail = ( isset( $default_image['sizes']['medium'] ) ) ? $default_image['sizes']['medium'] : '';
// }

$event_cat = theme_get_primary_taxonomy( get_the_ID(), 'event_cat' );
$event_cat_name = ( isset( $event_cat[0]->name ) ) ? $event_cat[0]->name : '';

$event_dates = get_field('event_dates');
$e_day       = date( 'd', strtotime( $event_dates ) );
$e_month     = date( 'M', strtotime( $event_dates ) );
$time        = get_field('event_time');
$location    = get_field('location');

$show_type = ( isset( $args['show_type'] ) ) ? $args['show_type'] : true;
?>

<article class="search-article events-item">

    <div class="search-item-container">

        <?php if( $show_type ): ?>
            <div class="post-type">
                <?php echo $post_type; ?>
            </div>
        <?php endif; ?>

        <a href="<?php echo get_permalink( get_the_ID() ); ?>" class="search-article-link">
            <div class="post-content">
                <div class="image-box <?php echo $img_class; ?>">
                    <?php if( $thumbnail ): ?>
                        <picture class="picture-box">
                            <source media="( max-width: 480px )" srcset="">
                            <img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>">
                        </picture>
                    <?php endif; ?>
                    <div class="date-box">
                        <div class="day">
                            <?php echo $e_day; ?>
                        </div>
                        <div class="month">
                            <?php echo $e_month; ?>
                        </div>
                    </div>
                    <?php if( $event_cat_name ): ?>
                        <div class="event-category">
                            <?php echo $event_cat_name; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="text-box">
                    <h2 class="item-title"><?php echo theme_search_highlight( get_the_title(), $search_val ); ?></h2>
                    <div class="event-meta-row">
                        <div class="date-col">
                            <div class="label-event">
                                <?php esc_html_e('Dates:', 'greyowl'); ?>
                            </div>
                            <div class="content-bold">
                                <?php echo date( 'd M Y', strtotime( $event_dates ) ); ?>
                            </div>
                        </div>
                        <div class="time-col">
                            <div class="label-event">
                                <?php esc_html_e('Time:', 'greyowl'); ?>
                            </div>
                            <div class="content-bold">
                                <?php echo $time; ?>
                            </div>
                        </div>
                        <div class="location-col">
                            <div class="label-event">
                                <?php esc_html_e('Location:', 'greyowl'); ?>
                            </div>
                            <div class="content-bold">
                                <?php echo $location; ?>
                            </div>
                        </div>
                    </div>
                    <p class="item-excerpt"><?php echo theme_search_highlight( get_the_excerpt(), $search_val ); ?></p>
                </div>
            </div>
        </a>
    </div>
</article>
