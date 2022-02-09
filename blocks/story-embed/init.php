<?php
/**
 * Plugin Name:       Oet Story Embed
 * Description:       Example block written with ESNext standard and JSX support – build step required.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       oet-story-embed
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function oet_story_embed_block_init(){
    $dir = dirname(__FILE__);
    $version_58 = is_version_58();

    $script_asset_path = "$dir/build/index.asset.php";
    if ( ! file_exists( $script_asset_path ) ) {
        throw new Error(
            'You need to run `npm start` or `npm run build` for the "oet-block/oet-pull-quotes-block" block first.'
        );
    }
    $index_js     = 'build/index.js';
    $script_asset = require( $script_asset_path );
    wp_register_script(
        'oet-story-embed-block-editor',
        plugins_url( $index_js, __FILE__ ),
        $script_asset['dependencies'],
        $script_asset['version']
    );
    wp_localize_script( 'oet-story-embed-block-editor', 'oet_story_embed', array( 'home_url' => home_url(), 'ajax_url' => admin_url( 'admin-ajax.php' ), 'version_58' => $version_58, 'theme_url' => get_stylesheet_directory_uri() ) );


    $editor_css = 'build/index.css';
    wp_register_style(
        'oet-story-embed-block-editor-style',
        plugins_url( $editor_css, __FILE__ ),
        array(),
        filemtime( "$dir/$editor_css" )
    );

    $style_css = 'build/style-index.css';
    wp_register_style(
        'oet-story-embed-block-style',
        plugins_url( $style_css, __FILE__ ),
        array(),
        filemtime( "$dir/$style_css" )
    );

    register_block_type( 'oet-block/oet-story-embed-block', array(
        'editor_script' => 'oet-story-embed-block-editor',
        'editor_style'  => 'oet-story-embed-block-editor-style',
        'style'         => 'oet-story-embed-block-style',
        'render_callback' => 'oet_story_embed_block_display'
    ) );
}

// Register Block via block.json
function oet_story_embed_block_json_init() {
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
        'oet-story-embed-block-editor',
        plugins_url( $index_js, __FILE__ ),
        $script_asset['dependencies'],
        $script_asset['version']
    );
    wp_localize_script( 'oet-story-embed-block-editor', 'oet_story_embed', array( 'home_url' => home_url(), 'ajax_url' => admin_url( 'admin-ajax.php' ), 'version_58' => $version_58, 'theme_url' => get_stylesheet_directory_uri() ) );

    $editor_css = 'build/index.css';
    wp_register_style(
        'oet-story-embed-block-editor-style',
        plugins_url( $editor_css, __FILE__ ),
        array(),
        filemtime( "$dir/$editor_css" )
    );


    register_block_type( 
        __DIR__ ,
        array(
            'editor_script' => 'oet-story-embed-block-editor',
            'editor_style'  => 'oet-story-embed-block-editor-style',
            'render_callback' => 'oet_story_embed_block_display',
        )
    );
}

// Checks WP version
if (!function_exists('is_version_58')) {
    function is_version_58(){
        if ( version_compare( $GLOBALS['wp_version'], '5.8-alpha-1', '<' ) ) {
            return false;
        } else {
            return true;
        }
    }
}

// Checks WP version to register block via block json if version is 5.8 or later
if ( is_version_58() ) {
    add_action( 'init', 'oet_story_embed_block_json_init' );
} else {
    add_action( 'init', 'oet_story_embed_block_init' );
}

// Render Callback of Story Embed Block
function oet_story_embed_block_display($attributes, $ajax = false){
    $html = "";
    $shortcodeText = "";
    if (!empty($attributes)) {
        extract($attributes);
        
        if (!$ajax)
            $html = '<div class="oet-pull-quotes-block">';

        $shortcodeText = "[pull_quote";
        if (isset($speaker))
            $shortcodeText .= " speaker='".$speaker."'";
        if (isset($additionalInfo))
            $shortcodeText .= " additional_info='".$additionalInfo."'";
        $shortcodeText .= "]";
        if (isset($content))
            $shortcodeText .= $content;
        $shortcodeText .= "[/pull_quote]";
        
        if (isset($shortcodeText)){
            $html .= do_shortcode($shortcodeText);
        }

        if (!$ajax)
            $html .= '</div>';
    }
    
    return $html;
}


// Display Pull Quotes Block Preview via Ajax
function oet_ajax_display_story_embed_block(){
    $shortcode = oet_story_embed_block_display($_POST['attributes'], true);
    echo wpautop(stripslashes($shortcode));
    die();
}
add_action( 'wp_ajax_display_story_embed', 'oet_ajax_display_story_embed_block' );
add_action( 'wp_ajax_nopriv_display_story_embed', 'oet_ajax_display_story_embed_block' );