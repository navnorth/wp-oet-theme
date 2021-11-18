<?php
/**
 * Plugin Name:       OET Video Block
 * Description:       Example block written with ESNext standard and JSX support – build step required.
 * Requires at least: 5.6
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       oet-video-block
 *
 * @package           oet-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/writing-your-first-block-type/
 */
function oet_video_block_init() {
	//register_block_type( __DIR__ );
    $dir = dirname( __FILE__ );

    $script_asset_path = "$dir/build/index.asset.php";
    if ( ! file_exists( $script_asset_path ) ) {
        throw new Error(
            'You need to run `npm start` or `npm run build` for the "create-block/oer_subjects_index" block first.'
        );
    }
    
    $index_js     = 'build/index.js';
    $script_asset = require( $script_asset_path );
    wp_register_script(
        'oet-video-block-editor-script',
        plugins_url( $index_js, __FILE__ ),
        $script_asset['dependencies'],
        $script_asset['version']
    );
    wp_localize_script( 'oet-video-block-editor-script', 'oet_video_block', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_set_script_translations( 'oet-video-block-editor-script', 'oet-video-block' );

    $editor_css = 'build/index.css';
    wp_register_style(
        'oet-video-block-editor-style',
        plugins_url( $editor_css, __FILE__ ),
        array(),
        filemtime( "$dir/$editor_css" )
    );

    $style_css = 'build/style-index.css';
    wp_register_style(
        'oet-video-block-style',
        plugins_url( $style_css, __FILE__ ),
        array(),
        filemtime( "$dir/$style_css" )
    );

    register_block_type( 'oet-block/oet-video-block', array(
        'editor_script'     => 'oet-video-block-editor-script',
        'editor_style'      => 'oet-video-block-editor-style',
        'style'             => 'oet-video-block-style',
        'render_callback'   => 'oet_vide_block_display'
    ) );
}
add_action( 'init', 'oet_video_block_init' );

function oet_vide_block_display( $attributes , $ajax = false ) {
    $html = "";
    $shortcodeText = "";
    if (!empty($attributes)) {
        extract($attributes);

        $shortcodeText = "[featured_video";
        if (isset($attributes['heading']) && $attributes['heading']!=="")
            $shortcodeText .= sprintf(" heading='%s'",$attributes['heading']);
        if (isset($attributes['description']) && $attributes['description']!=="")
            $shortcodeText .= sprintf(" description='%s'",$attributes['description']);
        if (isset($attributes['height']) && $attributes['height']!=="")
            $shortcodeText .= sprintf(" height='%s'",$attributes['height']);
        if (isset($attributes['url']) && $attributes['url']!==""){
            $videoId = "";
            $shortcodeText .= sprintf(" videoId='%s'",$videoId);
        }
        $shortcodeText .= "]";

        if (isset($shortcodeText)){
            $html .= do_shortcode($shortcodeText);
        }
    }
    
    return $html;
}