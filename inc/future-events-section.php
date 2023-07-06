<?php

$array_classes = array();

$page_title = ( isset( $args['title'] ) && $args['title'] ) ? $args['title'] : '';
if( $page_title ){
    $array_classes[] = 'have-title';
}

$events_page_data = get_field('events_page_data', 'option');

$archive           = ( isset( $args['archive'] ) && $args['archive'] ) ? true : false;
$label_text        = ( isset( $args['label_text'] ) && $args['label_text'] ) ? $args['label_text'] : esc_html__('Upcoming events', 'greyowl');
$label_counter_num = ( isset( $args['label_counter_num'] ) ) ? $args['label_counter_num'] : label_counter($label_counter);

$addet_style = ( isset( $args['added_style'] ) ) ? $args['added_style'] : '';

if( get_page_template_slug() != 'view/tpl-home.php' ){
    $addet_style .= ' background-blue-and-bubble';
}

$slider_events = array();
$future_events = theme_get_events( true, 0, 'ASC' );
if ( $future_events->have_posts() ){

    $sliders_counter  = 1;
    $events_in_slider = 1;
    while ( $future_events->have_posts() ){
        $future_events->the_post();

        if( $sliders_counter % 2 == 1 ){
            $slider_events[ $sliders_counter ][1] = get_post( get_the_ID() );
            $sliders_counter++;
        } else {
            if( $events_in_slider < 2 ){
                $slider_events[ $sliders_counter ][1] = get_post( get_the_ID() );
                $events_in_slider++;
            } else {
                $slider_events[ $sliders_counter ][2] = get_post( get_the_ID() );
                $events_in_slider = 1;
                $sliders_counter++;
            }
        }
    }
    wp_reset_postdata();
}

if( !$slider_events ){
    $array_classes[] = 'not-have-events';
}

if( $addet_style ){
    $array_classes[] = $addet_style;
}

if ( $slider_events ):

     ?>
    <section class="future-events-section <?php echo implode( '', $array_classes ); ?>">
        <?php if( $page_title ): ?>
            <h1 class="events-page-title"><?php echo $page_title; ?></h1>
        <?php endif; ?>
        <?php if( $slider_events ): ?>
            <!-- width-1760 -->
            <?php theme_the_page_part_label( $label_counter_num, $label_text, 'upcoming-events-section', true ); ?>

            <div class="future-events-container">
                <div class="future-events-in">
                    <div class="swiper trigger-events-slider">
                        <div class="swiper-wrapper">

                            <?php
                            $all_events = count( $slider_events );
                            foreach ( $slider_events as $slider ): ?>

                                <div class="swiper-slide">
                                    <div class="events-block parts-one <?php echo ( count( $slider ) == 1 ) ? '' : 'column-type'; ?>">
                                        <?php foreach ( $slider as $key => $event ):

                                            $event_dates = get_field('event_dates', $event->ID );
                                            $e_day       = date( 'd', strtotime( $event_dates ) );
                                            $e_month     = date( 'M', strtotime( $event_dates ) );
                                            $time        = get_field( 'event_time', $event->ID );
                                            $description = get_field( 'short_description', $event->ID );
                                            // $lectures_by = get_field( 'hosted_by', $event->ID );
                                            $lectures_by = get_field('lectures_by', $event->ID );
                                            $location    = get_field( 'location', $event->ID );

                                            $primar_term      = theme_get_primary_taxonomy( $event->ID, 'event_cat' );
                                            $primar_term_name = ( isset( $primar_term[0]->name ) ) ? $primar_term[0]->name : '';

                                            $thumbnail = get_the_post_thumbnail_url( $event->ID, 'ivent-item' );
                                            $img_style = ( !$thumbnail ) ? 'no-img': ''; ?>

                                            <div class="column-part <?php // echo ( count( $slider ) == 1 ) ? 'column-one' : 'column-two'; ?>">
                                                <article class="event-article part-<?php echo $key; ?> <?php echo ( count( $slider ) == 1 ) ? 'type-one' : 'type-two'; ?> ">
                                                    <a href="<?php echo get_permalink( $event->ID ); ?>" class="event-link">
                                                        <div class="image-date-box <?php echo ( $thumbnail ) ? 'have-img' : 'no-img';  ?>">
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
                                                        <div class="content-box">
                                                            <h3 class="event-title"><?php echo $event->post_title ?></h3>
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
                                            </div>

                                        <?php endforeach; ?>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                            <?php // ----------------------------------------- ?>
                            <?php
                            /*
                            foreach ( $slider_events as $slider ):
                                $count_events = count( $slider ); ?>
                                <div class="swiper-slide">
                                    <div class="events-block <?php echo ( $count_events > 1 ) ? 'parts-two' : 'parts-one'; ?>">

                                        <?php foreach ( $slider as $key => $event ):

                                            $event_dates = get_field('event_dates', $event->ID );
                                            $e_day       = date( 'd', strtotime( $event_dates ) );
                                            $e_month     = date( 'M', strtotime( $event_dates ) );
                                            $time        = get_field( 'event_time', $event->ID );
                                            $description = get_field( 'short_description', $event->ID );
                                            $lectures_by = get_field( 'hosted_by', $event->ID );
                                            $location    = get_field( 'location', $event->ID );

                                            $primar_term      = theme_get_primary_taxonomy( $event->ID, 'event_cat' );
                                            $primar_term_name = ( isset( $primar_term[0]->name ) ) ? $primar_term[0]->name : '';

                                            $thumbnail = get_the_post_thumbnail_url( $event->ID, 'ivent-item' );
                                            $img_style = ( !$thumbnail ) ? 'no-img': ''; ?>

                                            <?php if( $key == 1 ): ?>
                                                <div class="column-part column-one">
                                            <?php elseif ( $key == 2 ): ?>
                                                <div class="column-part column-two">
                                            <?php endif; ?>

                                                <article class="event-article part-<?php echo $key; ?> <?php echo ( $key == 1 || ( $key == 2 && $count_events == 2 ) ) ? 'type-one' : 'type-two'; ?>">
                                                    <a href="<?php echo get_permalink( $event->ID ); ?>" class="event-link">
                                                        <div class="image-date-box <?php echo ( $thumbnail ) ? 'have-img' : 'no-img';  ?>">
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
                                                        <div class="content-box">
                                                            <h3 class="event-title"><?php echo $event->post_title ?></h3>
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

                                            <?php if ( $key == 1 || $key == $count_events ): ?>
                                                </div>
                                            <?php endif; ?>

                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            <?php endforeach;
                            */ ?>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <?php if( $archive && isset( $events_page_data->ID ) ): ?>
                <div class="all-events-link-row">
                    <a href="<?php echo get_permalink( $events_page_data->ID ) ?>" class="all-events-link button-white">
                        <?php esc_html_e('Explore our Events', 'greyowl'); ?>
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

    </section>
<?php endif; ?>
