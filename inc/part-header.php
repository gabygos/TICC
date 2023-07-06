<?php

$logo = get_field('main_site_logo', 'option');

if( is_super_admin() ){
    echo '<pre class="kung-fu-panda" style="direction:ltr;text-align:left;">';
    print_r($logo);
    echo '</pre>';
    die();
}

?>
<div class="main-header-wrapper">
    <div class="main-header-container">
        <div class="logo-block">

        </div>
        <div class="main-nav-block">

        </div>
        <div class="second-nav-block">

        </div>
    </div>
</div>
