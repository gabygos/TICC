<?php

$term_data          = get_queried_object();

$title = ( isset( $args['title'] ) ) ? $args['title'] : get_the_title();
$id    = ( isset( $args['id'] ) ) ? $args['id'] : get_the_ID();

if( isset( $term_data->term_id ) ){

    $term_id  = $term_data->term_id;
    $taxonomy = $term_data->taxonomy;

    $banner_image   = get_field( 'banner_image', $taxonomy.'_'.$term_id );
    $banner_img_url = ( isset( $banner_image['sizes']['banner-image'] ) ) ? $banner_image['sizes']['banner-image'] : '';
    $banner_text    = get_field( 'short_description', $taxonomy.'_'.$term_id );

    $banner_mobile     = get_field( 'banner_image_mobile', $taxonomy.'_'.$term_id );
    $banner_mobile_url = ( isset( $banner_mobile['sizes']['banner-mobile'] ) ) ? $banner_mobile['sizes']['banner-mobile'] : '';

} else {

    $banner_image   = get_field('banner_image', $id );
    $banner_img_url = ( isset( $banner_image['sizes']['banner-image'] ) ) ? $banner_image['sizes']['banner-image'] : '';
    $banner_text    = get_field('short_top_banner_text', $id );

    $banner_mobile     = get_field( 'banner_image_mobile', $id );
    $banner_mobile_url = ( isset( $banner_mobile['sizes']['banner-mobile'] ) ) ? $banner_mobile['sizes']['banner-mobile'] : '';
}

if( !$banner_mobile_url && $banner_img_url ){
    $banner_mobile_url = ( isset( $banner_image['sizes']['banner-mobile'] ) ) ? $banner_image['sizes']['banner-mobile'] : '';
}

?>

<div class="banner-section">
    <div class="banner-container">
        <picture class="banner-image-wrapp">
            <?php if( $banner_mobile_url ): ?>
                <source media="( max-width: 480px )" srcset="<?php echo $banner_mobile_url; ?>">
            <?php endif; ?>
            <img src="<?php echo $banner_img_url; ?>" alt="" role="presentation">
        </picture>
        <div class="banner-content">
            <h1 class="main-page-title">
                <?php echo $title; ?>
            </h1>
            <p class="banner-short-text">
                <?php echo nl2br( $banner_text ); ?>
            </p>
            <div class="bg-image-box"></div>
        </div>
    </div>
</div>
