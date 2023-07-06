<?php

$data = ( isset( $args['data'] ) && $args['data'] ) ? $args['data'] : array();
$name = ( isset( $args['name'] ) && $args['name'] ) ? $args['name'] : '';

if( $data ): ?>

<div class="<?php echo $name ?>">
    <?php if( is_super_admin() ){
        echo '<pre class="kung-fu-panda" style="direction: ltr;">';
        print_r( $name );
        echo '</pre>';
    } ?>
</div>

<?php endif; ?>
