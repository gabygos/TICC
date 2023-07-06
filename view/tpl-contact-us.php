<?php
/**
 * Template Name: Contact Us Template
 *
 * @package WordPress
 */

$administrator = get_field('administrator');
$phone         = get_field('phone');
$email         = get_field('email');
$address       = get_field('address');

get_header(); ?>


<div class="contact-page-main-container">
    <div class="contact-us-content-row">
        <div class="contact-us-col left">
            <h1 class="contact-us-title">
                <?php the_title(); ?>
            </h1>
            <div class="meta-content-row">
                <?php if( $administrator ): ?>
                    <div class="item-col w-50">
                        <div class="label label-admin">
                            <?php esc_html_e('Administrator:', 'greyowl'); ?>
                        </div>
                        <div class="item-text">
                            <?php echo $administrator; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if( $phone ): ?>
                    <div class="item-col w-50">
                        <div class="label label-phone">
                            <?php esc_html_e('Phone:', 'greyowl'); ?>
                        </div>
                        <div class="item-text">
                            <?php echo $phone; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if( $email ): ?>
                    <div class="item-col w-100">
                        <div class="label label-mail">
                            <?php esc_html_e('Email:', 'greyowl'); ?>
                        </div>
                        <div class="item-text">
                            <?php echo $email; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if( $address ): ?>
                    <div class="item-col w-100">
                        <div class="label label-address">
                            <?php esc_html_e('Address:', 'greyowl'); ?>
                        </div>
                        <div class="item-text">
                            <?php echo nl2br( $address ); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="contact-us-col right bg-blue-and-bubble">
            <div class="contet-form">
                <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('Contact form', 'greyowl'), 'contact-form-section', true ); ?>
                <?php echo do_shortcode( get_field('contact_form') ); ?>
            </div>
        </div>
    </div>
</div>

<!--The div element for the map -->
<div class="contact-map-wrapper">
    <div id="map" class="contact-map-section"></div>
    <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('Map', 'greyowl'), 'map-section' ) ?>
</div>



<?php /*

<div class="google-map-section">
    <div class="mapouter">
        <div class="gmap_canvas">
            <iframe class="google-map-iframe" width="600" height="500"
                    id="gmap_canvas" src="https://maps.google.com/maps?q=tel%20aviv&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0">

            </iframe>
            <a href="https://123movies-to.org"></a>
            <br>
            <style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style>
            <a href="https://www.embedgooglemap.net"></a>
            <style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style>
        </div>
    </div>
</div>

*/ ?>

<?php get_footer();
