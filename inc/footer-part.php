<?php

$footer_partners_list = get_field('footer_partners_list', 'option');
$second_footer_info = get_field('second_footer_info', 'option');

?>

<div class="main-footer-wrapper">
    <div class="breadcrumbs-row">
        <div class="breadcrumbs-container">
            <?php if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            } ?>
        </div>
    </div>
    <div class="main-footer-container">

        <div class="footer-nav-row footer-row">
            <div class="footer-menu-column">
                <nav class="footer-main-nav" role="navigation">
                    <?php footer_nain_menu(); ?>
                </nav>
            </div>
            <div class="footer-social-column">
                <div class="section-title-row">
                    <h3 class="section-columns-title">
                        <?php the_field('column_title', 'option'); ?>
                    </h3>
                </div>
                <?php if( $second_footer_info ): ?>
                    <div class="social-column-row">
                        <?php foreach ( $second_footer_info as $column ): ?>
                            <div class="social-column">
                                <?php echo do_shortcode( nl2br( $column['column_text'] ) ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if( $footer_partners_list ): ?>
            <div class="partners-list-row footer-row">
                <div class="text-label">
                    <?php esc_html_e('Our partners:', 'greyowl'); ?>
                </div>
                <?php foreach ( $footer_partners_list as $item_data ):
                    $img_url = ( isset( $item_data['logo']['medium_height'] ) ) ? $item_data['logo']['medium_height'] : $item_data['logo']['url']; ?>
                    <div class="item-image">
                        <picture>
                            <source media="( max-width: 480px )" srcset="">
                                <img src="<?php echo $img_url; ?>" alt="<?php echo $item_data['name']; ?>">
                            </picture>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="copyright-row footer-row">
                <div class="copyright-text-column">
                    <?php the_field('footer_copyright_text', 'option'); ?>
                </div>
                <div class="copyright-row-nav-column">
                    <nav class="footer-bottom-nav" role="navigation">
                        <?php footer_bottom_menu(); ?>
                    </nav>
                </div>
                <div class="image-column">
                    <a href="https://www.dooble.co.il/" class="" title="Dooble" aria-label="Dooble" target="_blank">
                        <picture>
                            <source media="( max-width: 480px )" srcset="">
                            <img src="<?php get_site_url(); ?>/wp-content/themes/qs-starter/images/dooble_small_logo.svg" alt="Dooble">
                        </picture>
                    </a>
                </div>
            </div>
        </div>
    </div>
