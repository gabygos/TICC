<?php

$data = ( isset( $args['data'] ) && $args['data'] ) ? $args['data'] : array();
$name = ( isset( $args['name'] ) && $args['name'] ) ? $args['name'] : '';

$position = ( isset( $args['data']['text_position'] ) && $args['data']['text_position'] == 'right_text' ) ? 'reverse' : '';
$vertical = ( isset( $args['data']['text_position_vertical'] ) ) ? $args['data']['text_position_vertical'] : '';
switch ( $vertical ) {
    case 'middle':
        $vertical = 'middle';
        break;

    default:
        $vertical = '';
        break;
}

if( $data ): ?>

<div class="<?php echo $name ?> text-and-image-type-two-section">
    <div class="text-and-image-two-container <?php echo $position; ?>">
        <div class="text-two <?php echo $vertical; ?>">
            <div class="text-two-container">
                <?php if( isset( $data['text'] ) ): ?>
                    <?php echo $data['text']; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="image-two">
            <?php if( isset( $data['image']['sizes']['medium_gallery'] ) ): ?>
                <picture class="image-wrapp">
                    <img src="<?php echo $data['image']['sizes']['medium_gallery']; ?>" alt="<?php echo $data['image']['alt']; ?>">
                </picture>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php endif; ?>
