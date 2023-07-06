<?php

$research_query = theme_get_research( 7 );

$research_list = get_field('research_list');

$research_page = get_field('research_page_data', 'option');
$label_counter_num = ( isset( $args['label_counter_num'] ) ) ? $args['label_counter_num'] : label_counter($label_counter);

if( $research_list ): // $research_query->have_posts() ?>

    <section class="research-section">
        <?php theme_the_page_part_label( $label_counter_num, esc_html__('Research', 'greyowl'), 'research-section', true ); ?>


        <div class="research-conatainer">
            <?php
            $last_artikle = count( $research_list );
            foreach ( $research_list as $key => $obj ):
                $key_article = $key + 1;
                $added_class = '';
                if( $last_artikle == $key_article ){
                    if( $key_article % 3 == 1 ){
                        $added_class = 'last-midle-article';
                    }  else {
                        $added_class = 'last-article';
                    }
                }
                get_template_part('inc/research-article', null, array( 'class' => $added_class, 'obj' => $obj ) );
            endforeach; ?>
            <?php /*
            while ( $research_query->have_posts() ): $research_query->the_post(); ?>

                <?php get_template_part('inc/research-article'); ?>

            <?php endwhile;
            */ ?>
        </div>

        <?php if( isset( $research_page->ID ) ): ?>
            <div class="research-button-row">
                <a href="<?php echo get_permalink( $research_page->ID ) ?>" class="research-button button-white">
                    <?php esc_html_e('All Research', 'greyowl'); ?>
                </a>
                <?php /*
                <button type="button" class="research-button trigger-all-research-button">
                    <?php esc_html_e('All Research', 'greyowl'); ?>
                </button>
                */ ?>
            </div>
        <?php endif; ?>

    </section>

<?php endif; wp_reset_postdata(); ?>
