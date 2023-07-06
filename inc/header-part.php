<?php

$logo = get_field('main_site_logo', 'option');
$logo_url = ( isset( $logo['sizes']['icon_height'] ) ) ? $logo['sizes']['icon_height'] : '';

$second_menu = get_field('second_header_menu', 'option');

$news_header_row = get_field('news-header-row', 'option');

?>
<?php if( $news_header_row ): ?>
    <div class="news-header-row trigger-news-header-row">
        <div class="news-header-slider-container">
            <div class="swiper trigger-news-slider">
                <div class="swiper-wrapper">
                    <?php foreach ( $news_header_row as $key => $value ):
                        $text = $value['text'];
                        $meta = $value['meta'];
                        $link = trim( $value['link'] ); ?>
                        <div class="swiper-slide">
                            <div class="news-box trigger-mobile-news-box">

                                <span class="news-text">
                                    <span class="before-text"><?php esc_html_e('News:', 'greyowl'); ?></span>
                                    <?php echo $text; ?>
                                    <span class="news-meta"><?php echo $meta; ?></span>

                                    <?php echo ( $link ) ? '<a href="'.$link.'" class="" title="" aria-label="">' : ''; ?>

                                        <?php if( $link ): ?>
                                            <span class="link-img">
                                                <img src="<?php echo get_site_url(); ?>/wp-content/themes/qs-starter/images/link_arrow.png" alt="icon" role="presentation">
                                            </span>
                                        <?php endif; ?>

                                    <?php echo ( $link ) ? '</a>' : ''; ?>
                                </span>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="autoplay-progress">
                    <svg viewBox="0 0 48 48" style="--progress:0.8932;">
                        <circle cx="24" cy="24" r="20"></circle>
                    </svg>
                    <?php /*<span>1s</span>*/ ?>
                    <button type="button" class="slider-stop trigger-slider-stop-and-play play" title="<?php esc_html_e('stop or play', 'greyowl'); ?>" aria-label="<?php esc_html_e('stop or play', 'greyowl'); ?>">
                        <img src="<?php echo get_site_url() ?>/wp-content/themes/qs-starter/images/pause.png" alt="<?php esc_html_e('stop or play', 'greyowl'); ?>">
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="main-header-wrapper">
    <div class="main-header-container">
        <div class="logo-block">
            <div class="logo-block-mobile-wrapp">
                <!-- mobile menu button -->
                <div class="mobile-menu-button mobile-header-col" aria-hidden="false">
                    <button class="mobile-menu-button-open-close trigger-mobile-menu-button-open-close" type="button" title="<?php esc_html_e('open menu', 'greyowl'); ?>" aria-label="<?php esc_html_e('open menu', 'greyowl'); ?>" tabindex="-1">
                        <span class="menu-icon">
                            <span class="menu-icon-item icon-item-1"></span>
                            <span class="menu-icon-item icon-item-2"></span>
                            <span class="menu-icon-item icon-item-3"></span>
                        </span>
                    </button>
                </div>
                <!-- /mobile menu button -->
                <!-- logo -->
                <div class="logo mobile-header-col">
                    <a href="<?php echo esc_url( home_url() ); ?>" role="logo">
                        <picture>
                            <source media="( max-width: 480px )" srcset="">
                            <img src="<?php echo $logo_url; ?>" alt="<?php echo get_bloginfo(); ?>">
                        </picture>
                    </a>
                </div>
                <!-- /logo -->
                <!-- added mobile link -->
                <div class="mobile-added-links mobile-header-col">
                    <?php if( $second_menu ): ?>
                        <?php foreach ( $second_menu as $nav_item ):
                            if( $nav_item['show_in_mobile_header'] ):
                                $icon_url = ( isset( $nav_item['icon']['sizes']['icon'] ) ) ? $nav_item['icon']['sizes']['icon'] : ''; ?>
                                <a href="<?php echo $nav_item['link']; ?>" class="second-menu-link <?php echo $nav_item['added_class']; ?>" tabindex="-1">
                                    <?php if( $icon_url ): ?>
                                        <span class="icon-nav">
                                            <picture>
                                                <img src="<?php echo $icon_url; ?>" alt="icon" role="presentation">
                                            </picture>
                                        </span>
                                    <?php endif; ?>
                                </a>
                            <?php endif;
                        endforeach; ?>
                    <?php endif; ?>
                </div>
                <!-- /added mobile link -->
            </div>
        </div>
        <div class="header-nav-section">
            <div class="header-nav-container">
                <div class="header-nav-mobile-wrapper">
                    <div class="main-nav-block main-nav-block-wrapp">
                        <div class="main-nav-block">
                            <!-- nav -->
                            <nav class="main-nav-row" role="navigation">
                                <?php header_menu(); ?>
                            </nav>
                            <div class="search-button-box">
                                <button type="button" class="search-button trigger-search-button" title="<?php esc_html_e('Search', 'greyowl'); ?>" aria-label="<?php esc_html_e('Search', 'greyowl'); ?>">
                                    <img src="<?php echo get_site_url(); ?>/wp-content/themes/qs-starter/images/search.svg" alt="icon" role="presentation">
                                </button>
                            </div>
                            <!-- /nav -->
                        </div>
                        <div class="second-nav-block">
                            <?php if( $second_menu ): ?>
                                <div class="second-header-nav">
                                    <ul class="second-menu-list">
                                        <?php foreach ( $second_menu as $nav_item ):
                                            $icon_url = ( isset( $nav_item['icon']['sizes']['icon'] ) ) ? $nav_item['icon']['sizes']['icon'] : ''; ?>
                                            <li class="second-menu-item">
                                                <a href="<?php echo $nav_item['link']; ?>" class="second-menu-link <?php echo $nav_item['added_class']; ?> <?php echo ( $nav_item['show_in_mobile_header'] ) ? 'only-desktop' : ''; ?>">
                                                    <?php if( $icon_url ): ?>
                                                        <span class="icon-nav">
                                                            <picture>
                                                                <img src="<?php echo $icon_url; ?>" alt="icon" role="presentation">
                                                            </picture>
                                                        </span>
                                                    <?php endif; ?>
                                                    <span class="nav-text"><?php echo $nav_item['label']; ?></span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="page-submenu-row">
                        <?php get_template_part('inc/page-submenu-row'); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
