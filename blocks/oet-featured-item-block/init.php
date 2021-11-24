<?php
/**
 * Plugin Name:       OET Featured Item Block
 * Description:       Featured Item Block for OET
 * Requires at least: 5.7.2
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       oet-featured-item-block
 *
 * @package           oet-block
 */

 /*Load Plugin last (Remove when loaded from another plugin)*/
 function this_plugin_last() {
 	$wp_path_to_this_file = preg_replace('/(.*)plugins\/(.*)$/', WP_PLUGIN_DIR."/$2", __FILE__);
 	$this_plugin = plugin_basename(trim($wp_path_to_this_file));
 	$active_plugins = get_option('active_plugins');
 	$this_plugin_key = array_search($this_plugin, $active_plugins);
         array_splice($active_plugins, $this_plugin_key, 1);
         array_push($active_plugins, $this_plugin);
         update_option('active_plugins', $active_plugins);
 }
 add_action("activated_plugin", "this_plugin_last");

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/writing-your-first-block-type/
 */
 
if ( ! defined( 'ABSPATH' ) ) {
 	exit;
}

function oet_blocks_oet_featured_item_block_block_init() {
  $dir_url = get_stylesheet_directory_uri().'/blocks/oet-featured-item-block/';
	// Register block editor styles for backend.
	wp_register_style(	
		'oet_featured_item_block-block-editor-css', // Handle.
		$dir_url.'build/index.css',
		array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);
	
	// Register block styles for both frontend.
	wp_register_style(
		'oet_featured_item_block-style-css', // Handle.
		$dir_url.'build/style-index.css',
		is_admin() ? array( 'wp-editor' ) : null, // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);
	
	// Register block editor script for backend.
	wp_register_script(
		'oet_featured_item_block-block-js', // Handle.
		$dir_url.'build/index.js',
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);
	
	// Register backend script.
	wp_register_script(
		'oet_featured_item_block-backend-js', // Handle.
		$dir_url.'backend.js',
		array( 'jquery', 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);
	
	
	register_block_type(
		'oet-block/oet-featured-item-block', array(
			// Enqueue blocks.style.build.css on both frontend & backend.
			'style'         => 'oet_featured_item_block-style-css',
			// Enqueue blocks.build.js in the editor only.
			'editor_script' => 'oet_featured_item_block-block-js',
			// Enqueue blocks.editor.build.css in the editor only.
			'editor_style'  => 'oet_featured_item_block-block-editor-css',
			
			'script' => 'oet_featured_item_block-backend-js'
		)
	);
	
}

add_action( 'init', 'oet_blocks_oet_featured_item_block_block_init' );



add_action( 'init', 'oet_featured_item_color_palette_func' );
function oet_featured_item_color_palette_func() {	
		$existing = get_theme_support( 'editor-color-palette' );
		$new = array_merge( $existing[0], array(
		    array(
		        'name' => __( 'Orange', 'wp_oet_theme' ),
		        'slug' => 'oet-color-pallete-orage',
		        'color' => '#e57200',
		    ),
		    array(
		        'name' => __( 'Black', 'wp_oet_theme' ),
		        'slug' => 'oet-color-pallete-black',
		        'color' => '#000000',
		    ),
		));
		add_theme_support( 'editor-color-palette',  $new);
}



