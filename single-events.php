<?php

$hosted_by     = get_field('hosted_by');
$lectures_by   = get_field('lectures_by');
$event_dates   = get_field('event_dates');
$event_time    = get_field('event_time');
$duration_time = get_field('duration_time');
$location      = get_field('location');

$primary_term      = theme_get_primary_taxonomy( get_the_ID(), 'event_cat' );
$primary_term_name = ( isset( $primary_term[0]->name ) ) ? $primary_term[0]->name : '';

$registration_form = get_field('select_registration_form');

add_action( 'wp_head', 'theme_head_event_add_script' );

$event_time_data = explode( ' ', $event_time );
if ( isset( $event_time_data[1] ) ) {

    $time_h_m   = explode( ':', $event_time_data[0] );
    $start_hour = $time_h_m[0];
    $end_hour   = $time_h_m[0] + $duration_time;
    $minutes    = theme_number_to_string( $time_h_m[1] );

    switch ( $event_time_data[1] ) {

        case 'am':

            $start_hour = theme_number_to_string( $start_hour );
            $end_hour   = theme_number_to_string( $end_hour );

            $start_share_time = $start_hour . ':' . $minutes;
            $end_share_time   = $end_hour . ':' . $minutes;
            break;

        case 'pm':

            $start_hour = $start_hour + 12;
            $end_hour   = $end_hour + 12;

            $start_share_time = $start_hour . ':' . $minutes;
            $end_share_time   = $end_hour . ':' . $minutes;
            break;

        default:
            $share_time = '';
            break;
    }
}


get_header(); ?>



<div class="events-main-container">

    <div class="banner-page-content background-blue-and-bubble">
        <div class="banner-page-container">

            <?php if( $primary_term_name ): ?>
                <div class="primary-category">
                    <?php echo $primary_term_name; ?>
                </div>
            <?php endif; ?>

            <h1 class="title-event page-banner-title">
                <?php the_title(); ?>
            </h1>
            <p class="short-banner-text"><?php echo nl2br( get_field('short_description') ); ?></p>
        </div>
    </div>
    
    <section class="content-event-data">
        <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('Details', 'greyowl'), 'details-section' ); ?>
        <div class="event-data-container">

                <div class="left-meta-col <?php echo ( $event_dates > date('Ymd') ) ? '' : 'no-share'; ?>">

                    <?php if( $event_dates > date('Ymd') ): ?>
                        <div class="part-label">
                            <?php esc_html_e('Add to:', 'greyowl'); ?>
                        </div>

                        <add-to-calendar-button
                          name="<?php the_title(); ?>"
                          description="<?php echo get_field('short_description'); ?>"
                          startDate="<?php echo date( 'Y-m-d', strtotime( $event_dates ) ); ?>"
                          startTime="<?php echo $start_share_time; ?>"
                          endTime="<?php echo $end_share_time; ?>"
                          timeZone="Israel"
                          location="<?php echo $location; ?>"
                          options="'Google','Outlook.com'"
                          buttonStyle="round"
                          hideTextLabelButton
                          buttonsList
                          hideBackground
                          size="10"
                        ></add-to-calendar-button>

                        <?php /*
                        <ul class="add-to-links">
                            <li class="add-to-link-item">
                                <a href="https://calendar.google.com/calendar/embed?<?php echo get_page_link(); ?>" class="add-to-link" title="<?php esc_html_e('add to google calendar', 'greyowl'); ?>" aria-label="<?php esc_html_e('add to google calendar', 'greyowl'); ?>" target="_blank">
                                    <img src="<?php echo get_site_url( null, '/wp-content/themes/qs-starter/images/google_calendar.png' ); ?>" alt="icon" role="presentation">
                                </a>
                            </li>
                            <li class="add-to-link-item">
                                <a href="" class="add-to-link" title="<?php esc_html_e('add to outlook', 'greyowl'); ?>" aria-label="<?php esc_html_e('add to outlook', 'greyowl'); ?>">
                                    <img src="<?php echo get_site_url( null, '/wp-content/themes/qs-starter/images/outlook.png' ); ?>" alt="icon" role="presentation">
                                </a>
                            </li>

                        </ul>
                        */ ?>
                    <?php endif; ?>
                </div>
                <div class="all-meta-date">
                    <div class="event-meta-data-block">

                        <div class="col-data">

                            <?php if ( $hosted_by ): ?>
                                <div class="part-label">
                                    <?php esc_html_e('Hosted by:', 'greyowl'); ?>
                                </div>
                                <div class="part-content">
                                    <?php echo $hosted_by; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( $lectures_by ): ?>
                                <div class="part-label">
                                    <?php esc_html_e('Lectures by:', 'greyowl'); ?>
                                </div>
                                <div class="part-content lectures-block">
                                    <?php echo $lectures_by; ?>
                                </div>
                            <?php endif; ?>

                        </div>

                        <div class="col-data">

                            <div class="part-content-full">
                                <div class="second-row">

                                    <div class="col-data">
                                        <?php if ( $event_dates ): ?>
                                            <div class="part-label">
                                                <?php esc_html_e('Dates:', 'greyowl'); ?>
                                            </div>
                                            <div class="part-content">
                                                <?php echo date( 'd M Y', strtotime( $event_dates ) ); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-data">
                                        <?php if ( $event_time ): ?>
                                            <div class="part-label">
                                                <?php esc_html_e('Time:', 'greyowl'); ?>
                                            </div>
                                            <div class="part-content">
                                                <?php echo $event_time; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <?php if ( $location ): ?>
                                <div class="part-label">
                                    <?php esc_html_e('Location:', 'greyowl'); ?>
                                </div>
                                <div class="part-content">
                                    <?php echo $location; ?>
                                </div>
                            <?php endif; ?>

                            <div class="part-content">
                                <div id="map" class="mini-map-section"></div>
                            </div>

                        </div>

                    </div>
                </div>

        </div>
    </section>

    <?php if( $event_dates > date('Ymd') && $registration_form ): ?>
        <div class="registration-to-event-row">
            <div class="registration-to-event">
                <?php esc_html_e('To register for the event follow the link', 'greyowl'); ?>
                <a href="#registration-form" class="registration-to-event-link trigger-registration-to-event">
                    <img src="<?php echo get_site_url( null, '/wp-content/themes/qs-starter/images/registration.svg' ); ?>" alt="icon" role="presentation">
                    <?php esc_html_e('Registration', 'greyowl'); ?>
                </a>
            </div>
        </div>
    <?php endif; ?>


    <div class="event-page-main-content">
        <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('agenda', 'greyowl'), 'agenda-section' ); ?>
        <div class="page-content page-content-text">
            <?php while ( have_posts() ) : the_post(); ?>

    			<?php the_content(); ?>

    		<?php endwhile; ?>
        </div>
    </div>
</div>

<?php if( $event_dates > date('Ymd') && $registration_form ): ?>
    <section id="registration-form" class="registration-form-section trigger-registration-form-section" aria-hidden="true">
        <div class="registration-form-wrapper">
            <div class="close-form-lightbox-box">
                <button class="close-form-lightbox trigger-close-form-lightbox" type="button" title="<?php esc_html_e('close lightbox', 'greyowl'); ?>" aria-label="<?php esc_html_e('close lightbox', 'greyowl'); ?>">
                    <img src="<?php echo get_site_url( null, '/wp-content/themes/qs-starter/images/close-circle.svg' ) ?>" alt="icon" role="presentation">
                </button>
            </div>
            <div class="registration-form-container">
                <div class="event-description">
                    <?php if( $primary_term_name ): ?>
                        <div class="event-category">
                            <?php echo $primary_term_name; ?>
                        </div>
                    <?php endif; ?>

                    <h3 class="title-event-popup">
                        <?php the_title(); ?>
                    </h3>
                    <div class="meta-row">
                        <div class="meta-column date-col">
                            <div class="label-event">
                                <?php esc_html_e('Dates:', 'greyowl'); ?>
                            </div>
                            <div class="content-bold">
                                <?php echo date( 'd M Y', strtotime( $event_dates ) ); ?>
                            </div>
                        </div>
                        <div class="meta-column col-data">
                            <?php if ( $event_time ): ?>
                                <div class="label-event">
                                    <?php esc_html_e('Time:', 'greyowl'); ?>
                                </div>
                                <div class="content-bold">
                                    <?php echo $event_time; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="meta-row">
                        <div class="location-col">
                            <div class="label-event">
                                <?php esc_html_e('Location:', 'greyowl'); ?>
                            </div>
                            <div class="content-bold">
                                <?php echo $location; ?>
                            </div>
                        </div>
                    </div>
                    <div class="meta-row">
                        <?php if ( $hosted_by ): ?>
                            <div class="by-col">
                                <div class="label-event">
                                    <?php esc_html_e('By:', 'greyowl'); ?>
                                </div>
                                <div class="content-bold">
                                    <?php echo $hosted_by; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="event-form">
                    <h3 class="popup-title"><?php esc_html_e('registration', 'greyowl'); ?></h3>
                    <div class="event-form-container trigger-event-form-container">
                        <?php echo $registration_form; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="registration-popup-bg trigger-registration-popup-bg"></div>
    </section>
<?php endif; ?>

<?php get_footer();
