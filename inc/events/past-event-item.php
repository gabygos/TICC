<?php

$event_dates = get_field('event_dates' );
$e_day       = date( 'd', strtotime( $event_dates ) );
$e_month     = date( 'M', strtotime( $event_dates ) );
// $time        = get_field( 'event_time' );
$description = get_field( 'short_description' );
// $lectures_by = get_field( 'hosted_by' );

$lectures_by   = get_field('lectures_by');

$location    = get_field( 'location' );

$primar_term      = theme_get_primary_taxonomy( get_the_ID(), 'event_cat' );
$primar_term_name = ( isset( $primar_term[0]->name ) ) ? $primar_term[0]->name : '';

$thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'ivent-item' );
$img_style = ( !$thumbnail ) ? 'no-img': ''; ?>

<article class="past-event-article">
    <a href="<?php echo get_permalink(); ?>" class="past-event-link">
        <div class="past-event-container">
            <div class="image-date-box <?php echo ( !$thumbnail ) ? 'no-img': 'have-img'; ?>">
                <div class="image-box <?php echo $img_style; ?>">
                    <?php if( $thumbnail ): ?>
                        <picture>
                            <img src="<?php echo $thumbnail; ?>" alt="icon" role="presentation">
                        </picture>
                    <?php endif; ?>
                    <?php if( $primar_term_name ): ?>
                        <div class="event-cat">
                            <?php echo $primar_term_name; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="date-box">
                    <div class="day">
                        <?php echo $e_day; ?>
                    </div>
                    <div class="month">
                        <?php echo $e_month; ?>
                    </div>
                </div>
            </div>
            <h3 class="past-event-title">
                <?php the_title(); ?>
            </h3>
            <div class="event-meta-row">
                <div class="date-col">
                    <div class="label-event">
                        <?php esc_html_e('Dates:', 'greyowl'); ?>
                    </div>
                    <div class="content-bold">
                        <?php echo date( 'd M Y', strtotime( $event_dates ) ); ?>
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
            <p class="short-event-des">
                <?php echo wp_trim_words( $description, 20, '...' ); ?>
            </p>
            <div class="event-by">
                <div class="label-event">
                    <?php esc_html_e('By:', 'greyowl'); ?>
                </div>
                <div class="content-bold">
                    <?php echo $lectures_by; ?>
                </div>
            </div>
        </div>
    </a>
</article>
