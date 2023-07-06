<?php

$page_content_404 = get_field('page_content_404', 'option');

get_header(); ?>

<div class="page-404-container">
	<div class="page-404-content">
		<div class="page-404-text">
			<h1 class="title-page-404">404<br><?php esc_html_e('Page not found.', 'greyowl'); ?></h1>
			<div class="page-404-main-content">
				<?php echo $page_content_404; ?>
			</div>
			<p class="bottom-text"><?php esc_html_e('Come back to the Homepage.', 'greyowl'); ?></p>
			<a href="<?php echo get_site_url(); ?>" class="back-to-homepage-link">
				<span class="link-text"><?php esc_html_e('Back to Homepage', 'greyowl'); ?></span>
			</a>
		</div>
		<div class="loader-animation">
			<div class="loader">
				<div class="loader__arm"></div>
			</div>
			<div class="loader">
				<div class="loader__arm"></div>
			</div>
			<div class="loader">
				<div class="loader__arm"></div>
			</div>
			<div class="loader">
				<div class="loader__arm"></div>
			</div>
			<div class="loader">
				<div class="loader__arm"></div>
			</div>
			<div class="loader">
				<div class="loader__arm"></div>
			</div>
			<div class="loader">
				<div class="loader__arm"></div>
			</div>
			<div class="loader">
				<div class="loader__arm"></div>
			</div>
			<div class="loader">
				<div class="loader__arm"></div>
			</div>
			<div class="loader">
				<div class="loader__arm"></div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
