<?php

if( get_field('lightbox_enable', 'option') ): ?>

<section class="lightbox-out-window-wrapper trigger-lightbox-out-window-wrapper" role="dialog" aria-hidden="true">
    <div class="bg-lightbox trigger-lightbox-out-window-bg"></div>
    <div class="lightbox-out-window">
        <div class="close-lightbox-row">
            <button class="close-lightbox-btn trigger-close-lightbox-btn" title="<?php esc_html_e('close lightbox', 'greyowl'); ?>" aria-label="<?php esc_html_e('close lightbox', 'greyowl'); ?>">
                <img src="<?php echo get_site_url( null, '/wp-content/themes/qs-starter/images/close-circle-w.svg' ); ?>" alt="close" role="presentation">
            </button>
        </div>
        <div class="lightbox-out-window-content">
            <div class="content-bg"></div>
            <div class="content-text">
                <?php the_field('lightbox_text', 'option'); ?>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>
