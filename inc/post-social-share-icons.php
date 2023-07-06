<?php


$label = ( isset( $args['label'] ) && !$args['label'] ) ? false : true;

$facebook = '/wp-content/themes/qs-starter/images/facebook_v.svg';
$twitter  = '/wp-content/themes/qs-starter/images/twitter_v.svg';
$linkedin = '/wp-content/themes/qs-starter/images/linkedin_v.svg';
$mail     = '/wp-content/themes/qs-starter/images/mail_v.svg';
$whatsapp = '/wp-content/themes/qs-starter/images/whatsapp_v.svg';

$white = ( isset( $args['white'] ) && $args['white'] ) ? true : false;

if( $white ){
    $facebook = '/wp-content/themes/qs-starter/images/facebook_w.svg';
    $twitter  = '/wp-content/themes/qs-starter/images/twitter_w.svg';
    $linkedin = '/wp-content/themes/qs-starter/images/linkedin_w.svg';
    // $mail     = '/wp-content/themes/qs-starter/images/mail_w.svg';
    $whatsapp = '/wp-content/themes/qs-starter/images/whatsapp_w.svg';
}

?>

<div class="social-share-icons-block <?php echo ( $white ) ? 'white' : ''; ?>">

    <?php if( $label ): ?>
        <div class="label-box">
            <?php esc_html_e('Share:', 'greyowl'); ?>
        </div>
    <?php endif; ?>

    <ul class="social-list">
        <?php if( 1 ): ?>
            <li class="share-item">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_page_link(); ?>" class="social-link-icon facebook-jssdk" title="<?php esc_html_e('Share in fasebook', 'greyowl'); ?>" aria-label="<?php esc_html_e('Share in fasebook', 'greyowl'); ?>" target="_blank">
                    <img src="<?php echo get_site_url( null, $facebook ); ?>" alt="icon" role="presentation">
                </a>
            </li>
        <?php endif; ?>

        <?php if( 0 ): ?>
            <li class="share-item">
                <a href="#" class="social-link-icon" title="<?php esc_html_e('Share in twitter', 'greyowl'); ?>" aria-label="<?php esc_html_e('Share in twitter', 'greyowl'); ?>">
                    <img src="<?php echo get_site_url( null, $twitter ); ?>" alt="icon" role="presentation">
                </a>
            </li>
        <?php endif; ?>

        <?php if( 1 ): ?>
            <li class="share-item">
                <a href="https://www.linkedin.com/shareArticle?url=<?php echo get_page_link(); ?>&title=<?php the_title(); ?>" class="social-link-icon" title="<?php esc_html_e('Share in linkedin', 'greyowl'); ?>" aria-label="<?php esc_html_e('Share in linkedin', 'greyowl'); ?>" target="_blank">
                    <img src="<?php echo get_site_url( null, $linkedin ); ?>" alt="icon" role="presentation">
                </a>
            </li>
        <?php endif; ?>

        <?php if( 0 ): ?>
            <li class="share-item">
                <a href="mailto:" class="social-link-icon" title="<?php esc_html_e('Share in mail', 'greyowl'); ?>" aria-label="<?php esc_html_e('Share in mail', 'greyowl'); ?>">
                    <img src="<?php echo get_site_url( null, $mail ); ?>" alt="icon" role="presentation">
                </a>
            </li>
        <?php endif; ?>

        <?php if( 1 ):
            $whatsapp_text = htmlentities( urlencode( get_the_title().' - '.get_page_link()  ) ); ?>
            <li class="share-item">
                <a href="https://wa.me/?text=<?php echo $whatsapp_text; ?>" class="social-link-icon" title="<?php esc_html_e('Share in whatsapp', 'greyowl'); ?>" aria-label="<?php esc_html_e('Share in whatsapp', 'greyowl'); ?>" target="_blank">
                    <img src="<?php echo get_site_url( null, $whatsapp ); ?>" alt="icon" role="presentation">
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>
