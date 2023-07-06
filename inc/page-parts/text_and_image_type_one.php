<?php

$data = ( isset( $args['data'] ) && $args['data'] ) ? $args['data'] : array();
$name = ( isset( $args['name'] ) && $args['name'] ) ? $args['name'] : '';

$position = ( isset( $args['data']['text_position'] ) && $args['data']['text_position'] == 'left_text' ) ? 'reverse' : '';
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

<div class="<?php echo $name ?> text-and-image-type-one-section">
    <div class="text-and-image-one-container <?php echo $position; ?>">
        <div class="image-one">
            <?php if( isset( $data['image']['sizes']['medium_gallery'] ) ): ?>
                <picture>
                    <img src="<?php echo $data['image']['sizes']['medium_gallery']; ?>" alt="<?php echo $data['image']['alt']; ?>">
                </picture>
            <?php endif; ?>
        </div>
        <div class="text-one <?php echo $vertical; ?>">
            <div class="text-one-container">
                <?php if( isset( $data['text'] ) ): ?>
                    <?php echo $data['text']; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>
