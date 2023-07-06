<?php

$item_args = array();

$color             = ( isset( $args['color'] ) ) ? $args['color'] : '';
$link              = ( isset( $args['link'] ) ) ? $args['link'] : '';
$label_text        = ( isset( $args['label_text'] ) ) ? $args['label_text'] : esc_html__('Featured Scientists', 'greyowl');
$label_counter_num = ( isset( $args['label_counter_num'] ) ) ? $args['label_counter_num'] : label_counter($label_counter);

$item_args['link'] = $link;
$label_white = false;

switch ( $color ) {

    case 'blue':
        $item_args['color'] = 'blue';
        $label_white = true;
        break;

    case 'gradient':
        $item_args['color'] = 'gradient';
        $label_white = true;
        break;

    default:
        $color_style = '';
        break;
}

$featured_scientists_page = get_field('featured_scientists_page', 'option');

$featured_scientists = get_field('featured_scientists');

if( $featured_scientists ): ?>
    <div class="featured-scientists-section">
        <div class="featured-scientists-container">
            <?php theme_the_page_part_label( $label_counter_num , $label_text, 'featured-scientists-section', $label_white ); ?>
            <div class="featured-scientists-list swiper trigger-featured-scientists-list">
                <div class="swiper-wrapper">
                    <?php foreach ( $featured_scientists as $author ):
                        $item_args['author'] = $author; ?>

                        <div class="swiper-slide">
                            <?php get_template_part('inc/item-researcher', null, $item_args ); ?>
                        </div>

                    <?php endforeach; ?>
                </div>

            </div>

            <?php if ( isset( $featured_scientists_page->ID ) ): ?>
                <div class="all-members-btn-row">
                    <a href="<?php echo get_permalink( $featured_scientists_page->ID ) ?>" class="all-members button-white ">
                        <?php esc_html_e('All Members', 'greyowl'); ?>
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </div>
<?php endif; ?>
