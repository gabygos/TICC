<?php

$data = ( isset( $args['data'] ) && $args['data'] ) ? $args['data'] : array();
$name = ( isset( $args['name'] ) && $args['name'] ) ? $args['name'] : '';

if( $data ): ?>

<div class="<?php echo $name ?> text-editor-section">
    <div class="text-editor-block">
        <div class="text-editor-container">
            <?php if( isset( $data['text'] ) ): ?>
                <?php echo $data['text']; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php endif; ?>
