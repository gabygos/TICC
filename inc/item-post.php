<?php

$item_post;
if( isset( $args['post']->ID ) ){
    $item_post = $args['post'];
} elseif ( isset( $post->ID ) ) {
    $item_post = $post;
}

if( $item_post ):

    // the_time('d M Y');

    $author_data = get_field( 'post_author', $item_post->ID );

    if( isset( $args['tax'] ) && $args['tax'] ){
        $tags = get_the_terms( $item_post->ID, $args['tax'] );
    } else {
        $tags = get_the_tags( $item_post );
    }


    $day   = get_the_date( 'd', $item_post );
    $month = get_the_date( 'M', $item_post );

    $thumbnail = get_the_post_thumbnail_url( $item_post->ID, 'post-item' );
    if( !$thumbnail ){
        $default_image = get_field('default_image', 'option');
        $thumbnail = ( isset( $default_image['sizes']['post-item'] ) ) ? $default_image['sizes']['post-item'] : '';
    } ?>

     <article class="post-item-block">
         <a href="<?php echo get_permalink( $item_post->ID ); ?>" class="item-link" title="<?php echo $item_post->post_title; ?>" aria-label="<?php echo $item_post->post_title; ?>">
             <div class="post-item-container">
                 <div class="post-image">
                     <picture class="picture-box">
                         <img src="<?php echo $thumbnail; ?>" alt="<?php echo $item_post->post_title; ?>">
                     </picture>
                 </div>
                 <div class="item-post-title">
                     <div class="date-meta">
                         <div class="date-meta-box">
                             <div class="day-part">
                                 <?php echo $day; ?>
                             </div>
                             <div class="month-part">
                                 <?php echo $month; ?>
                             </div>
                         </div>
                     </div>
                     <h3 class="item-title">
                         <?php echo wp_trim_words( $item_post->post_title, '12', '...' ); ?>
                     </h3>
                 </div>
                 <?php if( isset( $author_data->ID ) ): ?>
                     <div class="item-author-containet">
                         <div class="author-label">
                             <?php esc_html_e('Author', 'greyowl'); ?>
                         </div>
                         <div class="author-name">
                             <?php echo $author_data->post_title; ?>
                         </div>
                     </div>
                 <?php endif; ?>
                 <?php if( $tags ): ?>
                     <div class="tags-container">
                         <div class="author-label">
                             <?php esc_html_e('Tags', 'greyowl'); ?>
                         </div>
                         <ul class="item-tags-list">
                             <?php foreach ( $tags as $tag_data ): ?>
                                 <li class="item-tag">
                                     <div class="item-tag-box">
                                         <?php echo $tag_data->name; ?>
                                     </div>
                                 </li>
                             <?php endforeach; ?>
                         </ul>
                     </div>
                 <?php endif; ?>
             </div>
         </a>
     </article>

<?php endif; ?>
