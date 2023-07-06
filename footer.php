<?php
/**
 * Site footer
 *
 * @package WordPress
 */

get_template_part('inc/newsletter-form'); ?>

		</div>
	</main>

	<footer id="footer" class="footer" role="contentinfo">
		<?php get_template_part('inc/footer-part'); ?>
	</footer><!-- /footer -->

	<?php get_template_part('inc/search-events'); ?>

	</div><!-- end of site-wrapper -->

	</div><!-- end of off-canvas-content -->

</div><!-- end of off-canvas-wrapper -->

<?php get_template_part('inc/lightbox-display-out'); ?>

	<?php wp_footer(); ?>
	<?php
	$map_api_key = trim( get_field('map_api_key', 'option') );
	if( $map_api_key && ( is_singular('events') || is_page_template('view/tpl-contact-us.php') ) ): ?>
		<script async src="https://maps.googleapis.com/maps/api/js?key=<?php echo $map_api_key; ?>&callback=initMap"></script>
	<?php endif; ?>
	</body>
</html>
