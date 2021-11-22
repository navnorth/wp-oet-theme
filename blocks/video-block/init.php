<?php
/**
 * Plugin Name:       Featured Video Block
 * Description:       Displays featured video block on a page.
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
    $dir_url = get_stylesheet_directory_uri().'/blocks/featured-video/';

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
        $dir_url.$index_js,
        $script_asset['dependencies'],
        $script_asset['version']
    );
    wp_localize_script( 'oet-video-block-editor-script', 'oet_video_block', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_set_script_translations( 'oet-video-block-editor-script', 'oet-video-block' );

    $editor_css = 'build/index.css';
    wp_register_style(
        'oet-video-block-editor-style',
        $dir_url.$editor_css,
        array(),
        filemtime( "$dir/$editor_css" )
    );

    $style_css = 'build/style-index.css';
    wp_register_style(
        'oet-video-block-style',
        $dir_url.$style_css,
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

        if (!$ajax)
            $html .= '<div class="oet-video-block">';
        $shortcodeText = "[featured_video";
        if (isset($attributes['heading']))
            $shortcodeText .= sprintf(" heading='%s'",$attributes['heading']);
        if (isset($attributes['description']))
            $shortcodeText .= sprintf(" description='%s'",$attributes['description']);
        if (isset($attributes['height']))
            $shortcodeText .= sprintf(" height='%s'",$attributes['height']);
        if (isset($attributes['videoId']))
            $shortcodeText .= sprintf(" videoid='%s'",$attributes['videoId']);
        $shortcodeText .= "]";
        $shortcodeText = htmlspecialchars($shortcodeText);
        if (isset($shortcodeText)){
            $html .= do_shortcode($shortcodeText);
        }
        if (!$ajax)
            $html .= '</div>';
    }
    
    return $html;
}

// Display Medium Embed ajax
function oet_ajax_display_video_block(){
    $shortcode = oet_vide_block_display($_POST, true);
    echo $shortcode;
    die();
}
add_action( 'wp_ajax_display_video_block', 'oet_ajax_display_video_block' );
add_action( 'wp_ajax_nopriv_display_video_block', 'oet_ajax_display_video_block' );

function oet_get_YT_videoId() {
    if ($_POST){
        $url = $_POST['url'];
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        $youtube_id = $match[1];
        $youtube_id = $match[1];
        echo json_encode(array("video_id" => $youtube_id));
    }
    die();
}
add_action( 'wp_ajax_get_video_id', 'oet_get_YT_videoId' );
add_action( 'wp_ajax_nopriv_get_video_id', 'oet_get_YT_videoId' );