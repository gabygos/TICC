<?php

$submenu        = array();
$before_submenu = '';

$submenu = array();


if( is_archive() ){

    $post_id = get_query_var('post_id');
    if( $post_id ){
        $before_submenu = wp_trim_words( get_the_title( $post_id ), '9', '...' );
    }
} elseif ( is_single() ){

    if( get_post_type() == 'researchers' ){

        $first_name = get_field('first_name');
        $last_name  = get_field('last_name');

        $before_submenu = $first_name . ' ' . $last_name;

        // $submenu[] = array(
        //     'title'  => esc_html__('About', 'greyowl'),
        //     'link'   => '#about-section',
        //     'inside' => true,
        // );
        //
        // $submenu[] = array(
        //     'title'  => esc_html__('Research Interests', 'greyowl'),
        //     'link'   => '#research-interests',
        //     'inside' => true,
        // );
        //
        // if ( get_query_var('selected_publications') ) {
        //     $submenu[] = array(
        //         'title'  => esc_html__('Selected Publications', 'greyowl'),
        //         'link'   => '#selected-publications',
        //         'inside' => true,
        //     );
        // }
    } elseif ( get_post_type() == 'publications' || get_post_type() == 'events' ) {

        $before_submenu = wp_trim_words( get_the_title(), '9', '...' );

    } else {

        // $before_submenu = rtrim( wp_trim_words( get_field('banner_text'), '9', '' ), ',' );
        $before_submenu = wp_trim_words( get_field('banner_text'), '9', '...' );

        // $submenu[] = array(
        //     'title'  => esc_html__('Details', 'greyowl'),
        //     'link'   => '#details-section',
        //     'inside' => true,
        // );
        //
        // $related_posts_list = get_field('related_posts_list');
        // if( $related_posts_list ){
        //     $submenu[] = array(
        //         'title'  => esc_html__('Related news', 'greyowl'),
        //         'link'   => '#related-news-section',
        //         'inside' => true,
        //     );
        // }
    }
} elseif ( is_page() ) {

    $before_submenu = wp_trim_words( get_the_title(), '9', '...' );

}

$event_dates       = get_field('event_dates');
$registration_form = get_field('select_registration_form');

if( 1 ): // $submenu || $before_submenu ?>

<div class="header-submenu-block">
    <div class="header-submenu-content">
        <?php if ( $before_submenu ): ?>
            <div class="before-submenu">
                <?php echo $before_submenu; ?>
            </div>
        <?php endif; ?>

        <ul class="submenu-list">

            <?php if( is_post_type_archive('news') || is_post_type_archive('post') ):

                $all_tags = get_post_type_tags( get_post_type() );

                $post_tags   = ( isset( $_GET['post_tags'] ) && $_GET['post_tags'] && is_numeric( $_GET['post_tags'] ) ) ? $_GET['post_tags'] : false;
                $post_author = ( isset( $_GET['post_author'] ) && $_GET['post_author'] && is_numeric( $_GET['post_author'] ) ) ? $_GET['post_author'] : false;
                $args_scientists = array(
                    'post_type'      => 'scientists',
                    'posts_per_page' => -1,
                );
                $authors_list = new WP_Query( $args_scientists ); ?>
                <form class="top-submenu-select" action="" method="get">
                    <li class="submenu-item">
                        <label for="post-author-selct" class="select-label-text"><?php esc_html_e('Author:', 'greyowl'); ?></label>
                        <select id="post-author-selct" class="" name="post_author">
                            <option value="all"><?php esc_html_e('All', 'greyowl'); ?></option>
                            <?php while ( $authors_list->have_posts() ): $authors_list->the_post(); ?>
                                <option value="<?php echo get_the_ID(); ?>" <?php echo selected( $post_author, get_the_ID() ); ?>><?php echo the_title(); ?></option>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </select>
                    </li>
                    <li class="submenu-item">
                        <label for="post-tags-selct" class="select-label-text"><?php esc_html_e('Tags:', 'greyowl'); ?></label>
                        <select id="post-tags-selct" class="" name="post_tags">
                            <option value="all"><?php esc_html_e('All', 'greyowl'); ?></option>
                            <?php foreach ( $all_tags as $tag_data ): ?>
                                <option value="<?php echo $tag_data->term_taxonomy_id; ?>" <?php echo selected( $post_tags, $tag_data->term_taxonomy_id ) ?>><?php echo $tag_data->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </li>
                </form>
            <?php endif; ?>
            <?php /*
            $counter = 1;
            foreach ( $submenu as $submenu_part ):
                $part_num = ( $counter < 10 ) ? '0'.$counter : $counter;
                $link_class_list = array('submenu-link');
                if( isset( $submenu_part['inside'] ) && $submenu_part['inside'] ){
                    $link_class_list[] = 'trigger-go-to-page-part';
                } ?>
                <li class="submenu-item">
                    <a href="<?php echo $submenu_part['link']; ?>" class="<?php echo implode( ' ', $link_class_list ); ?>">
                        <span class="item-number"><?php echo $part_num; ?></span>
                        <span class="item-text"><?php echo $submenu_part['title']; ?></span>
                    </a>
                </li>
                <?php $counter++;
            endforeach;
            */?>
        </ul>

        <?php if( is_singular('events') && $event_dates > date('Ymd') && $registration_form ): ?>
            <a href="#registration-form" class="registration-to-event-link trigger-registration-to-event">
                <img src="<?php echo get_site_url( null, '/wp-content/themes/qs-starter/images/registration.svg' ); ?>" alt="icon" role="presentation">
                <?php esc_html_e('Registration', 'greyowl'); ?>
            </a>
        <?php endif; ?>
    </div>
</div>

<?php endif; ?>
