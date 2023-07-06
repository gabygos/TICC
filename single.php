<?php
/**
 * Default single post template
 *
 * @package WordPress
 */

// $author = get_post_meta( get_the_ID(), 'post_author', true );
$tags = get_the_tags();

$author_data = get_field('post_author');

$related_posts_list = get_field('related_posts_list');

switch ( get_post_type() ) {
	case 'post':
		$posts_page = get_field('blog_page_date', 'options');
		break;

	case 'news':
		$posts_page = get_field('news_page_data', 'options');
		break;

	default:
		$posts_page = get_field('blog_page_date', 'options');
		break;
}


get_header(); ?>

	<div class="single-content-container <?php echo get_post_type(); ?> trigger-create-gallery">
		<div class="molecule-bg" data-bg-rows="15"></div>
		<div class="single-content-container-conatainer">

			<?php if( isset( $author_data->ID ) ):

				$banner_image_data = get_field('banner_author_image');
				$banner_image = ( isset( $banner_image_data['sizes']['medium_gallery'] ) ) ? $banner_image_data['sizes']['medium_gallery'] : '';

				$banner_text = get_field('banner_text');

				if( $banner_image && $banner_text ): ?>

					<div class="author-banner-wrapper">
						<div class="author-banner">
							<div class="author-excerpt-box">
								<div class="author-excerpt">
									<div class="author-excerpt-text">
										<p><?php echo $banner_text; ?></p>
									</div>
								</div>
							</div>
							<?php if( $banner_image ): ?>
								<div class="author-image-box">
									<picture>
										<img src="<?php echo $banner_image; ?>" alt="<?php echo $author_data->post_title; ?>">
									</picture>
								</div>
							<?php endif; ?>
						</div>
					</div>

				<?php endif;
			endif; ?>

			<?php theme_the_page_part_label( label_counter($label_counter), esc_html__('details', 'greyowl'), 'details-section' ); ?>

			<div class="top-single-content">
				<div class="social-box">
					<?php get_template_part('inc/post-social-share-icons'); ?>
				</div>
				<div class="meta-data-box">
					<div class="author-and-date-row">

						<?php if( isset( $author_data->ID ) ): ?>
							<div class="author-box meta-row-col">
								<div class="label-box">
									<?php esc_html_e('Author:', 'greyowl'); ?>
								</div>
								<div class="meta-content author" rel="author">
									<a href="<?php echo get_permalink( $author_data->ID ); ?>" class="author-link">
										<?php echo $author_data->post_title; // get_the_author(); ?>
									</a>
								</div>
							</div>
						<?php endif; ?>


						<div class="date-box meta-row-col">
							<div class="label-box">
								<?php esc_html_e('Publish date:', 'greyowl'); ?>
							</div>
							<div class="meta-content date" pubdate datetime="<?php the_time('Y-m-j'); ?>">
								<?php the_time('d M Y'); ?>
							</div>
						</div>
					</div>
					<?php if( $tags ): ?>
						<div class="tags-row">
							<div class="label-box">
								<?php esc_html_e('Tags:', 'greyowl'); ?>
							</div>
							<ul class="tags-list">
								<?php foreach ( $tags as $tag_data ):
									$tag_id       = $tag_data->term_id;
									$tag_taxonomy = $tag_data->taxonomy; ?>
									<li class="item-tag">
										<div class="tag-box">
											<?php echo $tag_data->name; ?>
										</div>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

					<div class="title-row">
						<h1 class="content-title">
							<?php the_title(); ?>
						</h1>
					</div>

				</div>
			</div>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>

			<?php endwhile; ?>



			<?php if( $related_posts_list ): ?>
				<?php theme_the_page_part_label( label_counter($label_counter), esc_html__('related news', 'greyowl'), 'related-news-section' ); ?>
				<div class="related-posts-section">
					<?php get_template_part( 'inc/related-posts-section', null, array( 'posts' => $related_posts_list ) ); ?>
				</div>
				<?php if ( isset( $posts_page->ID ) ): ?>
					<div class="all-posts-link-row">
						<a href="<?php echo get_permalink( $posts_page->ID ) ?>" class="all-posts-link">
							<span class="text"><?php esc_html_e('All posts', 'greyowl'); ?></span>
							<span class="corner"><img src="<?php echo get_site_url(); ?>/wp-content/themes/qs-starter/images/arrow_w.svg" alt="icon" role="presentation">
							</span>
						</a>
					</div>
				<?php endif; ?>
			<?php endif; ?>

		</div>
	</div>

<?php get_footer();
