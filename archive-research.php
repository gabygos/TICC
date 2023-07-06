<?php

$research_page = get_field('research_page_data', 'option');

if( isset( $research_page->ID ) && $research_page->ID ){

    global $post;
    set_query_var( 'post_id', $research_page->ID );
    $post = get_post( $research_page->ID );

    if( get_page_template_slug( $post ) ){
        include_once get_page_template_slug( $post );
    } else {
        include_once 'page.php';
    }
}
