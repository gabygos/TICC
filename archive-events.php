<?php

$events_page = get_field('events_page_data', 'option');

if( isset( $events_page->ID ) && $events_page->ID ){

    global $post;
    set_query_var( 'post_id', $events_page->ID );
    $post = get_post( $events_page->ID );

    if( get_page_template_slug( $post ) ){
        include_once get_page_template_slug( $post );
    } else {
        include_once 'page.php';
    }
}
