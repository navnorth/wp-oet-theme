<?php
/**
 * Plugin Name:       OET Featured Content Block
 * Description:       Example block written with ESNext standard and JSX support – build step required.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       oet-featured-content-block
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
function wp_oer_subject_resources_block_init(){
    $dir = dirname(__FILE__);
    $version_58 = is_version_58();

    $script_asset_path = "$dir/build/index.asset.php";
    if ( ! file_exists( $script_asset_path ) ) {
        throw new Error(
            'You need to run `npm start` or `npm run build` for the "create-block/oer-object-resources-block" block first.'
        );
    }
    $index_js     = 'build/index.js';
    $script_asset = require( $script_asset_path );
    wp_register_script(
        'oet-featured-content-block-editor',
        plugins_url( $index_js, __FILE__ ),
        $script_asset['dependencies'],
        $script_asset['version']
    );
    wp_localize_script( 'oet-featured-content-block-editor', 'oet_featured_content', array( 'home_url' => home_url(), 'ajax_url' => admin_url( 'admin-ajax.php' ), 'version_58' => $version_58 ) );

    $front_asset_path = "$dir/build/front.asset.php";
    if ( ! file_exists( $front_asset_path ) ) {
        throw new Error(
            'You need to run `npm start` or `npm run build` for the "create-block/oer-object-resources-block" block first.'
        );
    }

    $frontend_js = 'build/front.js';
    $front_asset = require( $front_asset_path );
    wp_register_script(
        'oet-featured-content-block-frontend',
        plugins_url( $frontend_js, __FILE__ ),
        $front_asset['dependencies'],
        $front_asset['version']
    );

    $editor_css = 'build/index.css';
    wp_register_style(
        'oet-featured-content-block-editor',
        plugins_url( $editor_css, __FILE__ ),
        array(),
        filemtime( "$dir/$editor_css" )
    );

    $style_css = 'build/style-index.css';
    wp_register_style(
        'oet-featured-content-block-css',
        plugins_url( $style_css, __FILE__ ),
        array(),
        filemtime( "$dir/$style_css" )
    );

    register_block_type( 'oet-block/oet-featured-content-block', array(
        'editor_script' => 'oet-featured-content-block-editor',
        'editor_style'  => 'oet-featured-content-block-editor',
        'script'        => 'oet-featured-content-block-frontend',
        'style'         => 'oet-featured-content-block-css',
        'render_callback' => 'oet_featured_content_block_display'
    ) );
}

function oet_featured_content_block_json_init() {
	register_block_type( __DIR__ );
}

if ( version_compare( $GLOBALS['wp_version'], '5.8-alpha-1', '<' ) ) {
    add_action( 'init', 'wp_oer_subject_resources_block_init' );
} else {
    add_action( 'init', 'oet_featured_content_block_json_init' );
}

function oet_featured_content_block_display($attributes, $ajax = false){
    $html = "";
    $shortcodeText = "";
    if (!empty($attributes)) {
        extract($attributes);
    }
    return $html;
}