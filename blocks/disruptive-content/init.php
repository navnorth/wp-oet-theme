<?php
/**
 * Plugin Name:       OET Disruptive Content
 * Description:       Displays disruptive content block on a page.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       oet-disruptive-content
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
function oet_disruptive_content_block_init(){
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
        'oet-disruptive-content-block-editor',
        plugins_url( $index_js, __FILE__ ),
        $script_asset['dependencies'],
        $script_asset['version']
    );
    wp_localize_script( 'oet-disruptive-content-block-editor', 'oet_disruptive_content', array( 'home_url' => home_url(), 'ajax_url' => admin_url( 'admin-ajax.php' ), 'version_58' => $version_58 ) );


    $editor_css = 'build/index.css';
    wp_register_style(
        'oet-disruptive-content-block-editor',
        plugins_url( $editor_css, __FILE__ ),
        array(),
        filemtime( "$dir/$editor_css" )
    );

    $style_css = 'build/style-index.css';
    wp_register_style(
        'oet-disruptive-content-block-css',
        plugins_url( $style_css, __FILE__ ),
        array(),
        filemtime( "$dir/$style_css" )
    );

    register_block_type( 'oet-block/oet-disruptive-content-block', array(
        'editor_script' => 'oet-disruptive-content-block-editor',
        'editor_style'  => 'oet-disruptive-content-block-editor',
        'style'         => 'oet-disruptive-content-block-css',
        'render_callback' => 'oet_disruptive_content_block_display'
    ) );
}

function oet_disruptive_content_block_json_init() {
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

    register_block_type( 
        __DIR__ ,
        array(
            'editor_script' => 'oet-featured-content-block-editor',
            'render_callback' => 'oet_featured_content_block_display',
        )
    );
}


if (!function_exists('is_version_58')) {
    function is_version_58(){
        if ( version_compare( $GLOBALS['wp_version'], '5.8-alpha-1', '<' ) ) {
            return false;
        } else {
            return true;
        }
    }
}

if ( is_version_58() ) {
    add_action( 'init', 'oet_disruptive_content_block_init' );
} else {
    add_action( 'init', 'oet_disruptive_content_block_json_init' );
}


// Display Disruptive Content Block
/**
 * Disruptive Content
 * Shortcode Example : [disruptive_content title='' main_text='' button_text='' button_color='' button_url='']
 */
function oet_disruptive_content_block_display( $attributes, $ajax = false ){
    $html = "";
    $shortcodeText = "";
    if (!empty($attributes)) {
        extract($attributes);
        
        if (!$ajax)
            $html = '<div class="oet-disruptive-content-block">';

        $shortcodeText = "[disruptive_content";
        if (isset($title))
            $shortcodeText .= " title='".$title."'";
        if (isset($mainText))
            $shortcodeText .= " main_text='".$mainText."'";
        if (isset($buttonText))
            $shortcodeText .= " button_text='".$buttonText."'";
        if (isset($buttonColor))
            $shortcodeText .= " button_color='".$buttonColor."'";
        if (isset($buttonUrl))
            $shortcodeText .= " button_url='".$buttonUrl."'";
        $shortcodeText .= "]";
        
        if (isset($shortcodeText)){
            $html .= do_shortcode($shortcodeText);
        }

        if (!$ajax)
            $html .= '</div>';
    }
    
    return $html;
}
