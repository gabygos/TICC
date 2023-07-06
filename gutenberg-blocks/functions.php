<?php



/**
 * Function for `enqueue_block_editor_assets` action-hook.
 *
 * @return void
 */
function theme_enqueue_block_editor_assets_action(){

	wp_register_script( 'gutenberg-blocks', THEME . '/gutenberg-blocks/gutenberg-blocks.js', array( 'wp-blocks', 'wp-i18n', 'wp-editor' ), '1.0.1', false );
    wp_enqueue_script( 'gutenberg-blocks' );
}
add_action( 'enqueue_block_editor_assets', 'theme_enqueue_block_editor_assets_action' );
