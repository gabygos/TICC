<?php
/**
* Template Name: Homepage Template
*
* @package WordPress
*/

$banner_slider = get_field('home_banner_slider');

get_header(); ?>

<div class="home-page-main-container">

    <h1 class="screen-reader-text">
        <?php bloginfo( 'name' ); ?>
    </h1>

    <div class="banner-headre-section">
        <?php if( $banner_slider ): ?>
            <div class="top-page-banner-slider">
                <div class="swiper trigger-top-page-banner">
                    <div class="swiper-wrapper">
                        <?php
                        $pagination_text = array();
                        foreach ( $banner_slider as $slide ):
                            $pagination_text[] = $slide['pagination_text'] ?>
                            <div class="swiper-slide">
                                <?php echo $slide['text']; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
            <script type="text/javascript">const slider_nav = <?php echo json_encode( $pagination_text ); ?>;</script>
        <?php endif; ?>

        <div class="home-page-content-wrapper">

            <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('who we are', 'greyowl'), 'who-we-are-section', true ); ?>

            <div class="home-page-content-content">
                <?php while ( have_posts() ) : the_post(); ?>

            		<?php the_content(); ?>

            	<?php endwhile; ?>
            </div>

        </div>
    </div>

    <?php
    $args_ = array( 'label_counter_num' => label_counter($label_counter) );
    get_template_part('inc/research-section', null, $args_  ); ?>

    <?php
    $args_data = array(
        'color'             => 'gradient',
        'link'              => 'block',
        'label_text'        => esc_html__('Meet Our Members', 'greyowl'),
        'label_counter_num' => label_counter($label_counter),
    );
    get_template_part('inc/featured-scientists-section', null, $args_data ); ?>

    <?php
    $event_args = array(
        'archive'           => true,
        'label_text'        => esc_html__('events', 'greyowl'),
        'label_counter_num' => label_counter($label_counter),
        'added_style'       => 'bg-transparent'
    );
    get_template_part('inc/future-events-section', null, $event_args ); ?>



</div>

<?php get_footer();
