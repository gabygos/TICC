<?php
/**
 * AJAX functions
 *
 * @package WordPress
 */


 /***************************************************************************
 *  Search posts
 ***************************************************************************/
 add_action( 'wp_ajax_nopriv_theme_search_get_posts', 'theme_search_get_posts' );
 add_action( 'wp_ajax_theme_search_get_posts', 'theme_search_get_posts' );
 function theme_search_get_posts(){

     $result = array(
         'error'       => true,
         'html'        => '',
         'key'         => '',
         'found_posts' => 0
     );

     $nonce      = ( isset( $_POST['nonce'] ) && is_string( $_POST['nonce'] ) ) ? $_POST['nonce'] : '';
     $data_key   = ( isset( $_POST['data']['key'] ) ) ? $_POST['data']['key'] : false;
     $data_value = ( isset( $_POST['data']['value'] ) ) ? $_POST['data']['value'] : false;
     $data_type  = ( isset( $_POST['data']['type'] ) ) ? $_POST['data']['type'] : false;

     if( $data_key && $data_value && wp_verify_nonce( $nonce, 'rticc_site_token' ) ){

         $post_tye_data   = theme_get_query_post_type( $data_type );
         $post_tye        = ( isset( $post_tye_data['post_tye'] ) ) ? $post_tye_data['post_tye'] : '';
         $search_post_tye = ( isset( $post_tye_data['search_post_tye'] ) ) ? $post_tye_data['search_post_tye'] : '';

         $posts_per_page = 10;

         $args = array(
             'post_type'      => $post_tye,
             'posts_per_page' => $posts_per_page,
             's'              => sanitize_text_field( $data_value ),
             // 'meta_query' => array(
             //     'relation' => 'OR',
             //     array(
             //         'key'     => 'laboratory',
             //         'value'   => sanitize_text_field( $data_value ),
             //         'compare' => 'LIKE'
             //     ),
             //     array(
             //         'key'     => 'researcher_role',
             //         'value'   => sanitize_text_field( $data_value ),
             //         'compare' => 'LIKE'
             //     ),
             // )
         );

         // if( is_super_admin() ){
         //     echo '<pre class="kung-fu-panda" style="direction:ltr;text-align:left;">';
         //     print_r( $args );
         //     echo '</pre>';
         //     die();
         // }

         $search_posts = new WP_Query( $args );

         $result['error'] = false;
         $result['key']   = $data_key;

         if ( $search_posts->have_posts() ):

             ob_start();

             $result['found_posts'] = $search_posts->found_posts;

             ?>

             <div class="search-num-row">
                <span class="number-posts"><?php echo $search_posts->found_posts; ?></span>
                <span class="text"><?php esc_html_e('results for:', 'greyowl'); ?></span>
                <span class="search-text"><?php echo $data_value; ?></span>
             </div>

             <?php

             // ( isset( $post_tye_data['search_post_tye'] ) ) ?

             $set_args = array(
                 'show_type' => ( isset( $post_tye_data['show_type'] ) ) ? $post_tye_data['show_type'] : true,
                 's'         => sanitize_text_field( $data_value )
             );

             while ( $search_posts->have_posts() ): $search_posts->the_post();

                 if ( get_post_type() == 'researchers' ) {
                     get_template_part('inc/search/researchers-item', null, $set_args );
                 }
                 // elseif ( get_post_type() == 'publications' ) {
                 //     get_template_part('inc/search/publications-item', null, array( 's' => sanitize_text_field( $data_value ) ) );
                 // }
                 elseif ( get_post_type() == 'events' ) {
                     get_template_part('inc/search/events-item', null, $set_args );
                 }
                 else {
                     get_template_part('inc/search/post-item', null, $set_args );
                 }

             endwhile; wp_reset_postdata();

             if( $search_posts->found_posts > $posts_per_page ): ?>

                 <div class="all-search-result">
                     <a href="<?php echo get_site_url() ?>?s=<?php echo urlencode( sanitize_text_field( $data_value ) ); ?>&type=<?php echo urlencode( $search_post_tye ); ?>" class="all-search-result-link button-blue">
                         <?php esc_html_e('All search result', 'greyowl'); ?>
                     </a>
                 </div>

             <?php
            endif;

             $result['html'] = ob_get_contents();

             ob_end_clean();

         else:

             $result['html'] = '<p class="posts-not-found">'.esc_html__('Sorry! Posts not found.', 'greyowl').'</p>';

         endif;
     }

     wp_send_json( $result );
 };

 /***************************************************************************
 *  load more posts
 ***************************************************************************/
 add_action( 'wp_ajax_nopriv_theme_more_get_events', 'theme_more_get_events' );
 add_action( 'wp_ajax_theme_more_get_events', 'theme_more_get_events' );
 function theme_more_get_events(){

     $result = array(
        'error'         => true,
        'html'          => '',
        'max_num_pages' => 0
    );

    $nonce = ( isset( $_POST['nonce'] ) && is_string( $_POST['nonce'] ) ) ? $_POST['nonce'] : '';
    $data  = ( isset( $_POST['data'] ) && is_array( $_POST['data'] ) ) ? $_POST['data'] : false;

    if( $data && wp_verify_nonce( $nonce, 'rticc_site_token' ) ){

        $items     = ( isset( $data['items'] ) && $data['items'] && is_numeric( $data['items'] ) ) ? $data['items'] : false;
        $page      = ( isset( $data['page'] ) && $data['page'] && is_numeric( $data['page'] ) ) ? $data['page'] : false;

        if( $page && $items ){

            $next_page = $page + 1;

            remove_all_actions('pre_get_posts');
            $events = theme_get_events( false, 4, '', $next_page );

            ob_start();

            if ( $events->have_posts() ):
                while ( $events->have_posts() ): $events->the_post();

                    get_template_part('inc/events/past-event-item');

                endwhile; wp_reset_postdata();
            endif;

            $result['html'] = ob_get_contents();

            ob_end_clean();

            $result['error'] = false;
            $result['max_num_pages'] = $events->max_num_pages;
        }
    }
     wp_send_json( $result );
 }

 /***************************************************************************
 *  load more posts
 ***************************************************************************/
 add_action( 'wp_ajax_nopriv_theme_load_more_posts', 'theme_load_more_posts' );
 add_action( 'wp_ajax_theme_load_more_posts', 'theme_load_more_posts' );
 function theme_load_more_posts(){

     $result = array(
        'error'         => true,
        'html'          => '',
        'max_num_pages' => 0
    );

    $nonce = ( isset( $_POST['nonce'] ) && is_string( $_POST['nonce'] ) ) ? $_POST['nonce'] : '';
    $data  = ( isset( $_POST['data'] ) && is_array( $_POST['data'] ) ) ? $_POST['data'] : false;

    if( $data && wp_verify_nonce( $nonce, 'rticc_site_token' ) ){

        $items     = ( isset( $data['items'] ) && $data['items'] && is_numeric( $data['items'] ) ) ? $data['items'] : false;
        $page      = ( isset( $data['page'] ) && $data['page'] && is_numeric( $data['page'] ) ) ? $data['page'] : false;
        $post_type = ( isset( $data['post_type'] ) && $data['post_type'] && is_string( $data['post_type'] ) ) ? $data['post_type'] : false;

        if( $page && $post_type ){

            $next_page = $page + 1;

            $added_data = array(
                'paged'          => $next_page,
                'posts_per_page' => $items
            );

            $posts_list = theme_get_post_to_archive( $post_type, $next_page, $added_data, $back_data );

            if( $posts_list->have_posts() ){

                ob_start();

                while ( $posts_list->have_posts() ){

                    $posts_list->the_post();
                    $post_data = array( 'post' => $post );
                    if( $post_type == 'news' ){
                        $post_data['tax'] = 'news_tag';
                    }

                    echo '<div class="blog-item-post">';
                    get_template_part('inc/item-post', null, $post_data );
                    echo '</div>';
                }
                wp_reset_postdata();

                $result['html'] = ob_get_contents();

                ob_end_clean();

                $result['error'] = false;
                $result['max_num_pages'] = $back_data['max_num_pages'];
            }
        }
    }

     wp_send_json( $result );
 }
