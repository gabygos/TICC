<?php
/**
 * Default page template
 *
 * @package WordPress
 */

$question_and_answer = get_field('question_and_answer');
$short_banner_text   = get_field('short_banner_text');

get_header(); ?>

<div class="banner-page-content background-blue-and-bubble">
	<div class="banner-page-container">
		<h1 class="page-main-title page-banner-title">
			<?php the_title(); ?>
		</h1>
		<p class="short-banner-text">
			<?php echo nl2br( $short_banner_text ); ?>
		</p>
	</div>
</div>

<div class="page-main-content trigger-create-gallery">
	<?php theme_the_page_part_label( label_counter($label_counter), esc_html__('details', 'greyowl'), 'details-section' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php the_content(); ?>

	<?php endwhile; ?>
</div>

<?php if ( $question_and_answer ): ?>
	<section class="question-and-answer-section">
		<?php theme_the_page_part_label( label_counter($label_counter), esc_html__('Q&A', 'greyowl'), 'q-a-section' ); ?>

		<div class="question-and-answer-list">
			<?php
			$counter = 1;
			foreach ( $question_and_answer as $qa ):
				$number = ( $counter < 10 ) ? '0'.$counter : $counter;
				$qa_id = 'qa-'.$number ?>
				<article class="qa-item">
					<div class="question-row">
						<a href="#<?php echo $qa_id; ?>" class="trigger-open-close-answer">
							<h3 class="question" data-num="<?php echo $number; ?>">
								<?php echo $qa['question']; ?>
								<span class="symbols"></span>
							</h3>
						</a>
					</div>
					<div id="<?php echo $qa_id; ?>" class="answer-box">
						<div class="answer">
							<?php echo $qa['answer']; ?>
						</div>
					</div>
				</article>
				<?php $counter++;
			endforeach; ?>
		</div>

	</section>
<?php endif; ?>

<?php get_footer();
