<?php


$post_types = array( 'All', 'Posts', 'Researchers', 'Events', 'News', 'Publications' );
?>

<div class="search-wrappper trigger-search-wrappper" aria-hidden="true" role="dialog">
    <div class="search-container">
        <div class="search-field-row">
            <div class="search-field-container">
                <form class="" class="search" method="get" action="<?php echo esc_url( home_url() ); ?>" role="search">
                    <label for="search-input-field" class="search-input-flabel">
                        <span class="screen-reader-text"><?php esc_html_e('Search', 'greyowl'); ?></span>
                        <input id="search-input-field" type="text" class="trigger-search-field" name="s" value="" placeholder="<?php esc_html_e('Search', 'greyowl'); ?>">
                        <button type="button" class="close-search-block trigger-close-search-block" title="" aria-label="">
                            <img src="<?php echo get_site_url( null, '/wp-content/themes/qs-starter/images/close-circle.svg' ); ?>" alt="close" role="presentation">
                        </button>
                    </label>
                    <?php if( $post_types ): ?>
                        <div class="search-types-list">
                            <?php foreach ( $post_types as $key => $value ):
                                $lower_srt = strtolower( $value ); ?>
                                <label for="search-type-<?php echo $lower_srt; ?>" class="label-part">
                                    <input id="search-type-<?php echo $lower_srt; ?>" type="radio" name="search_type" value="<?php echo $lower_srt; ?>" <?php echo checked( $key, 0 ); ?>>
                                    <span class="search-type-label"><?php echo $value; ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
        <div class="search-content trigger-search-content"></div>
    </div>
    <div class="bg-search-block trigger-bg-search-block"></div>
</div>
