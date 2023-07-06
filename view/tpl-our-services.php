<?php
/**
 * Template Name: Our Services Template
 *
 * @package WordPress
 */


$fields_of_research = array();
$terms_list         = array();
$icon_boxes         = array();
$term_data          = get_queried_object();

$args = array();
$content_class = '';

$fields_of_research = get_field('fields_of_research');
// if( is_super_admin() ){
//     echo '<pre class="kung-fu-panda" style="direction:ltr;text-align:left;">';
//     print_r( $fields_of_research_list );
//     echo '</pre>';
//     die();
// }

$cancer_types = get_field('cancer_types_section');

if( $cancer_types ){

    global $post;

    $page_ID     = get_the_ID();

    $the_content = $post->post_content;

    foreach ( $cancer_types as $item ) {

        $icon_data = get_field( 'icon_research', $item->ID );
        $icon_boxes[] = array(
            'icon_url'    => ( isset( $icon_data['sizes']['icon'] ) ) ? $icon_data['sizes']['icon'] : '',
            'title'       => $item->post_title,
            'description' => get_field('short_top_banner_text', $item->ID ),
            'link'        => get_permalink( $item->ID ),
        );
    }
    $section_title = esc_html__('Cancer types', 'greyowl');

} elseif ( isset( $term_data->term_id ) ){

    $content_class = 'column-two';
    $term_id  = $term_data->term_id;
    $taxonomy = $term_data->taxonomy;

    $the_content = $term_data->description;

    $args['title'] = $term_data->name;

    $args_research = array(
		'post_type'      => 'research',
		'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
    			'field'    => 'term_id',
    			'terms'    => $term_id,
            )
        )
	);

    // if( is_super_admin() ){
    //     echo '<pre class="kung-fu-panda" style="direction:ltr;text-align:left;">';
    //     print_r( $args_research );
    //     echo '</pre>';
    //     die('ADMIN PANDA');
    // }

	$research_query = new WP_Query( $args_research );

    if( $research_query->have_posts() ){
        while ( $research_query->have_posts() ){
            $research_query->the_post();

            $icon_data = get_field( 'icon_research' );
            $icon_boxes[] = array(
                'icon_url'    => ( isset( $icon_data['sizes']['icon'] ) ) ? $icon_data['sizes']['icon'] : '',
                'title'       => get_the_title(),
                'description' => get_field('short_top_banner_text'),
                'link'        => get_permalink( get_the_ID() ),
            );
        }
    } wp_reset_postdata();

    $section_title = esc_html__('Fields of research', 'greyowl');

} else {

    global $post;

    $page_ID     = get_the_ID();

    $the_content = $post->post_content;

    $args['title'] = $post->post_title;
    $args['id']    = $page_ID;

    $terms_list = get_terms( array(
        'taxonomy' => 'research_category',
    ));
    $section_title = esc_html__('Cancer types', 'greyowl');

    foreach ( $terms_list as $item ){

        $term_id  = $item->term_id;
        $taxonomy = $item->taxonomy;

        $icon_data = get_field( 'icon_category', $taxonomy.'_'.$term_id );
        $icon_boxes[] = array(
            'icon_url'    => ( isset( $icon_data['sizes']['icon'] ) ) ? $icon_data['sizes']['icon'] : '',
            'title'       => $item->name,
            'description' => get_field( 'short_description', $taxonomy.'_'.$term_id ),
            'link'        => get_term_link( $term_id, $taxonomy ),
        );
    }

    $section_title = esc_html__('Fields of research', 'greyowl');
}

get_header(); ?>


<div class="our-services-page-main-container">

    <?php get_template_part( 'inc/page-banner', null, $args ); ?>

    <?php if( $the_content ): ?>

        <div class="our-services-content-section">
            <div class="our-services-content">
                <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('Intro', 'greyowl'), 'details-section' ); ?>
                <div class="our-services-content-text <?php echo $content_class; ?>">
                    <?php echo $the_content; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <?php if( $icon_boxes ): ?>
        <div class="cancer-types-section background-blue-and-bubble">

            <?php theme_the_page_part_label( label_counter($label_counter), $section_title, 'cancer-types-section', true ); ?>
            <div class="mobile-slider-container">
                <div class="mobile-slider-wrapper">
                    <div class="trigger-slider-items-wrapper cancer-types-container">
                        <?php
                        $last_item_name = count( $icon_boxes );
                        $icon_counter   = 1;
                        $counter_item   = 1;
                        foreach ( $icon_boxes as $item ):

                            $col_class = '';
                            switch ( $icon_counter ) {
                                case 1:
                                    $col_class = 'start';
                                    break;

                                case 2:
                                    $col_class = 'middle';
                                    break;

                                case 3:
                                    $col_class = 'end';
                                    break;
                            }

                            if( $counter_item == $last_item_name ){
                                if( $col_class == 'start' ){
                                    $col_class = 'middle';
                                }
                                elseif ( $col_class == 'middle' ) {
                                    $col_class = 'end';
                                }
                            } ?>

                            <div class="trigger-slider-item term-item item-col <?php echo $col_class; ?>">
                                <a href="<?php echo $item['link']; ?>" class="item-col-link">
                                    <div class="icon-box">
                                        <picture class="icon-wrapper">
                                            <img src="<?php echo $item['icon_url']; ?>" alt="icon" role="presentation">
                                        </picture>
                                    </div>
                                    <div class="text-box">
                                        <h3 class="icon-title"><?php echo $item['title']; ?></h3>
                                        <p class="icon-text"><?php echo nl2br( $item['description'] ); ?></p>
                                    </div>
                                </a>
                            </div>
                            <?php
                            $counter_item++;

                            if( $icon_counter >= 3 ){
                                $icon_counter = 1;
                            } else {
                                $icon_counter++;
                            }
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if( $fields_of_research ): ?>
        <div class="fields-of-research-section">
            <div class="fields-of-research-content">
                <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('fields of research', 'greyowl'), 'fields-of-research-section', true ); ?>
                <div class="fields-of-research-list">
                    <?php foreach ( $fields_of_research as $part ):
                        $link_url = ( isset( $part['link']['url'] ) && trim( $part['link']['url'] ) ) ? trim( $part['link']['url'] ) : '';
                        $part_url = ( isset( $part['image']['sizes']['tpl-thumbnails'] ) ) ? $part['image']['sizes']['tpl-thumbnails'] : ''; ?>
                        <div class="fields-of-research-part">
                            <?php if( $link_url ): ?>
                                <a href="<?php echo $link_url; ?>" class="research-part-link">
                            <?php endif; ?>
                            <picture class="image-bg">
                                <img src="<?php echo $part_url; ?>" alt="" role="presentation">
                            </picture>
                            <div class="part-text">
                                <?php echo $part['text']; ?>
                            </div>
                            <?php if( $link_url ): ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php
if( empty( $term_data->term_id ) && $page_ID ){
    $post = get_post( $page_ID );
}

get_footer();
