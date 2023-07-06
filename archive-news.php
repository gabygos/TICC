<?php

$news_obj = get_field('news_page_data', 'option');

if( isset( $news_obj->ID ) && $news_obj->ID ){

    global $post;
    set_query_var( 'post_id', $news_obj->ID );
    set_query_var( 'post_type', 'news' );
    set_query_var( 'taxonomy', 'news_tag' );
    $post = get_post( $news_obj->ID );

    if( get_page_template_slug( $post ) ){
        include_once get_page_template_slug( $post );
    } else {
        include_once 'page.php';
    }
}
