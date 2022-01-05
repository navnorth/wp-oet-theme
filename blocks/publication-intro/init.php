<?php
/**
 * Plugin Name:       Oet Publication Intro
 * Description:       Example block written with ESNext standard and JSX support – build step required.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       oet-publication-intro
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/writing-your-first-block-type/
 */
function oet_publication_intro_block_init(){
    $dir = dirname(__FILE__);
    $version_58 = is_version_58();

    $script_asset_path = "$dir/build/index.asset.php";
    if ( ! file_exists( $script_asset_path ) ) {
        throw new Error(
            'You need to run `npm start` or `npm run build` for the "oet-block/oet-publication-intro-block" block first.'
        );
    }
    $index_js     = 'build/index.js';
    $script_asset = require( $script_asset_path );
    wp_register_script(
        'oet-publication-intro-block-editor',
        plugins_url( $index_js, __FILE__ ),
        $script_asset['dependencies'],
        $script_asset['version']
    );
    wp_localize_script( 'oet-publication-intro-block-editor', 'oet_publication_intro', array( 'home_url' => home_url(), 'ajax_url' => admin_url( 'admin-ajax.php' ), 'version_58' => $version_58 ) );


    $editor_css = 'build/index.css';
    wp_register_style(
        'oet-publication-intro-block-editor-style',
        plugins_url( $editor_css, __FILE__ ),
        array(),
        filemtime( "$dir/$editor_css" )
    );

    $style_css = 'build/style-index.css';
    wp_register_style(
        'oet-publication-intro-block-style',
        plugins_url( $style_css, __FILE__ ),
        array(),
        filemtime( "$dir/$style_css" )
    );

    register_block_type( 'oet-block/oet-publication-intro-block', array(
        'editor_script' => 'oet-publication-intro-block-editor',
        'editor_style'  => 'oet-publication-intro-block-editor-style',
        'style'         => 'oet-publication-intro-block-style',
        'render_callback' => 'oet_publication_intro_block_display'
    ) );
}

// Register Block via block.json
function oet_publication_intro_block_json_init() {
	register_block_type( __DIR__ );
}
add_action( 'init', 'create_block_oet_publication_intro_block_init' );

// Checks WP version to register block via block json if version is 5.8 or later
if ( is_version_58() ) {
    add_action( 'init', 'oet_featured_content_block_init' );
} else {
    add_action( 'init', 'oet_featured_content_block_json_init' );
}

// Checks WP version
function is_version_58(){
    if ( version_compare( $GLOBALS['wp_version'], '5.8-alpha-1', '<' ) ) {
        return false;
    } else {
        return true;
    }
}

// Render Callback that gets displayed
function oet_publication_intro_block_display($attrs, $ajax = false){
    print_r($attrs);
}
