<?php

$show = get_field('show_newsletter_form');
$form = get_field('footer_newsletter_form', 'option');

$bg_color   = get_field('newsletter_background_color', 'option');
$text_color = get_field('newsletter_color_color', 'option');

$style = array();
if( 0 ){ // $bg_color
    $style[] = 'background-color:'.$bg_color.';';
}
if( $bg_color ){
    $style[] = 'color:'.$text_color;
}
$style_str = '';
if( $style ){
    $style_str .= implode( ' ', $style );
    $style_str = 'style="'.$style_str.'"';
}

$section_class = '';
if( get_page_template_slug() != 'view/tpl-home.php' ){
    $section_class = 'bg-blue-and-bubble';
}

if( $show ): ?>

<section class="newsletter-form-section <?php echo $section_class; ?> " <?php echo $style_str; ?>>
    <div class="newsletter-form">
        <?php echo $form; ?>
    </div>
</section>

<?php endif; ?>
