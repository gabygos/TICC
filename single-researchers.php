<?php

$thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' );

$first_name = get_field('first_name');
$last_name  = get_field('last_name');

$role       = get_field('researcher_role');
$laboratory = get_field('laboratory');
$website    = get_field('website');
$phone      = get_field('phone');
$email      = get_field('email');
$address    = get_field('address');

$short_info = get_field('short_info');

$media_list = get_field('media_list');
// $hav_publications = ( $media_list ) ? true : false;

$selected_publications = get_field('selected_publications');
$hav_publications = ( $selected_publications ) ? true : false;
set_query_var( 'selected_publications', $hav_publications );

$publications_page = get_field('publications_page_data', 'option');
$posts_page        = get_field('blog_page_date', 'options');

$contact_quote = get_field('after_contact_quote');
$quote_image   = get_field('after_contact_quote_image');

$tags_list  = array();

$author_tags_list = get_field('tags_list');
if ( $author_tags_list ) {
    foreach ( $author_tags_list as $tag ) {
        $tags_list[ $tag->term_id ] = $tag;
    }
}

// $args_posts = array(
//     'post_status'    => 'publish',
//     'post_type'      => 'post',
//     'posts_per_page' => -1,
//     'meta_query'     => array(
//         array(
//             'key'   => 'post_author',
//             'value' => get_the_ID(),
//         )
//     )
// );
// $posts_list = new WP_Query( $args_posts );
//
// while ( $posts_list->have_posts() ): $posts_list->the_post();
//     $tags = get_the_tags( get_the_ID() );
//     if( $tags ){
//         foreach ( $tags as $tag_data ) {
//             $tags_list[ $tag_data->term_id ] = $tag_data;
//         }
//     }
// endwhile; wp_reset_postdata();

get_header(); ?>

<div class="researchers-main-container">

    <div class="banner-top-info background-blue-and-bubble">

        <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('About', 'greyowl'), 'about-section', true ); ?>

        <div class="banner-top-info-container">
            <div class="researchers-social-links only-desktop">
                <?php get_template_part('inc/post-social-share-icons', null, array('label' => false, 'white' => true)); ?>
            </div>

            <div class="researcher-info-block">
                <div class="researcher-info">

                    <div class="researcher-image">
                        <picture>
                            <source media="( max-width: 480px )" srcset="">
                            <img src="<?php echo $thumbnail_url; ?>" alt="<?php the_title(); ?>">
                        </picture>
                    </div>
                    <div class="researcher-data">
                        <div class="researcher-data-container">

                            <h2 class="researcher-main-name title-col">
                                <span class="first-name"><?php echo $first_name; ?></span>
                                <span class="last-name"><?php echo $last_name; ?></span>
                            </h2>

                            <?php if( $role ): ?>
                                <div class="data-col">
                                    <div class="data-text">
                                        <?php echo $role; ?>
                                    </div>
                                    <div class="data-label">
                                        <?php esc_html_e('Role', 'greyowl'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if( $laboratory ): ?>
                                <div class="data-col">
                                    <div class="data-text">
                                        <?php echo $laboratory; ?>
                                    </div>
                                    <div class="data-label">
                                        <?php esc_html_e('Laboratory', 'greyowl'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if( $website ): ?>
                                <div class="data-col">
                                    <div class="data-text">
                                        <a href="<?php echo $website; ?>" class="website-link" target="_blank">
                                            <?php echo $website; ?>
                                        </a>
                                    </div>
                                    <div class="data-label">
                                        <?php esc_html_e('Website', 'greyowl'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if( $phone ): ?>
                                <div class="data-col">
                                    <div class="data-text">
                                        <?php echo $phone; ?>
                                    </div>
                                    <div class="data-label">
                                        <?php esc_html_e('Phone', 'greyowl'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if( $email ): ?>
                                <div class="data-col">
                                    <div class="data-text">
                                        <?php echo $email; ?>
                                    </div>
                                    <div class="data-label">
                                        <?php esc_html_e('Email', 'greyowl'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if( $address ): ?>
                                <div class="data-col">
                                    <div class="data-text">
                                        <?php echo $address; ?>
                                    </div>
                                    <div class="data-label">
                                        <?php esc_html_e('Address', 'greyowl'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                    <?php if( $short_info ): ?>
                        <div class="short-info">
                            <?php echo nl2br( $short_info ); ?>
                        </div>
                    <?php endif; ?>


                </div>
            </div>
        </div>

    </div>

    <div class="research-interests-wrapp">
        <div class="molecule-bg"></div>
        <div class="research-interests">

            <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('Research Interests', 'greyowl'), 'research-interests' ); ?>

            <div class="research-interests-content">
                <div class="social-col">
                    <?php get_template_part('inc/post-social-share-icons', null, array('label' => false)); ?>
                </div>
                <div class="main-content-col">
                    <div class="inside-content">
                        <?php while ( have_posts() ) : the_post(); ?>

                			<?php the_content(); ?>

                		<?php endwhile; ?>
                    </div>
                </div>
                <div class="sidebar-col">
                    <div class="label-sidebar">
                        <?php esc_html_e('Tags:', 'greyowl'); ?>
                    </div>
                    <?php if( $tags_list ): ?>
                        <ul class="author-tags-list">
                            <?php foreach ( $tags_list as $tag_data ): ?>
                                <li class="author-item-tag">
                                    <a href="<?php echo get_term_link( $tag_data ); ?>" class="author-tag-link">
                                        <?php echo $tag_data->name; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if( $contact_quote && $quote_image ): ?>
        <section class="quote-image-section">
            <div class="quote-image-content">
                <div class="quote-column">
                    <blockquote>
                        <p><?php echo nl2br( $contact_quote['text'] ); ?></p>
                        <cite><?php echo nl2br( $contact_quote['cite'] ); ?></cite>
                    </blockquote>
                </div>
                <div class="imaege-column">
                    <picture>
                        <img src="<?php echo $quote_image['sizes']['medium_gallery']; ?>" alt="<?php echo $quote_image['alt'] ?>">
                    </picture>
                </div>
            </div>
        </section>
    <?php endif; ?>


    <?php if( $selected_publications ): ?>
        <section class="selected-publications-section">
            <div class="molecule-bg" data-bg-rows="5"></div>
            <div class="selected-publications">
                <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('Selected Publications', 'greyowl'), 'selected-publications' ); ?>
                <div class="publications-list">
                    <?php foreach ( $selected_publications as $publication ): ?>
                        <article class="publication-item">
                            <a href="<?php echo get_permalink( $publication->ID ); ?>" class="publication-link">
                                <h3 class="publication-name">
                                    <?php echo $publication->post_title; ?>
                                </h3>
                                <p class="meta-text"><?php the_field('publicated', $publication->ID ); ?></p>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>

                <?php if ( isset( $publications_page->ID ) ): ?>
    				<div class="all-posts-link-row">
    					<a href="<?php echo get_permalink( $publications_page->ID ) ?>" class="all-posts-link">
    						<span class="text"><?php esc_html_e('All Publications', 'greyowl'); ?></span>
    						<span class="corner"><img src="<?php echo get_site_url(); ?>/wp-content/themes/qs-starter/images/arrow_w.svg" alt="icon" role="presentation">
    						</span>
    					</a>
    				</div>
    			<?php endif; ?>

            </div>
        </section>
    <?php endif; ?>

    <?php if ( $media_list ): ?>

        <div class="media-section">
            <div class="molecule-bg" data-bg-rows="8"></div>
            <div class="media-section-wrapp">
                <?php theme_the_page_part_label( label_counter($label_counter), esc_html__('Media', 'greyowl'), 'selected-media' ); ?>

                <?php get_template_part( 'inc/related-posts-section', null, array( 'posts' => $media_list ) ); ?>

                <?php if ( isset( $posts_page->ID ) ): ?>
                    <div class="all-posts-link-row">
                        <a href="<?php echo get_permalink( $posts_page->ID ) ?>" class="all-posts-link">
                            <span class="text"><?php esc_html_e('All posts', 'greyowl'); ?></span>
                            <span class="corner"><img src="<?php echo get_site_url(); ?>/wp-content/themes/qs-starter/images/arrow_w.svg" alt="icon" role="presentation">
                            </span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    <?php endif; ?>

</div>

<?php get_footer();
