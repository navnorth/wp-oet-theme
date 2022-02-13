<?php
/**
 * 
 * OET Recommended Resources Block 
 * 
 **/
function oet_recommended_resources_block_init(){
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
        'oet-recommended-resources-block-editor',
        plugins_url( $index_js, __FILE__ ),
        $script_asset['dependencies'],
        $script_asset['version']
    );
    wp_localize_script( 'oet-recommended-resources-block-editor', 'oet_recommended_resources', array( 'home_url' => home_url(), 'ajax_url' => admin_url( 'admin-ajax.php' ), 'version_58' => $version_58 ) );


    $editor_css = 'build/index.css';
    wp_register_style(
        'oet-recommended-resources-block-editor-style',
        plugins_url( $editor_css, __FILE__ ),
        array(),
        filemtime( "$dir/$editor_css" )
    );

    $style_css = 'build/style-index.css';
    wp_register_style(
        'oet-recommended-resources-block-style',
        plugins_url( $style_css, __FILE__ ),
        array(),
        filemtime( "$dir/$style_css" )
    );

    register_block_type( 'oet-block/oet-recommended-resources-block', array(
        'editor_script' => 'oet-recommended-resources-block-editor',
        'editor_style'  => 'oet-recommended-resources-block-editor-style',
        'style'         => 'oet-recommended-resources-block-style',
        'render_callback' => 'oet_recommended_resources_block_display'
    ) );
}

// Register Block via block.json
function oet_recommended_resources_block_json_init() {
    register_block_type( __DIR__ );
}

// Checks WP version to register block via block json if version is 5.8 or later
if ( is_version_58() ) {
    add_action( 'init', 'oet_recommended_resources_block_init' );
} else {
    add_action( 'init', 'oet_recommended_resources_block_json_init' );
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

// Display Recommended Resources Block
/**
 * Recommended Resources
 * Shortcode Example : [recommended_resources heading='' media_type1='' src1='' text1='' link1='' media_type2='' src2='' text2='' link2='' media_type3='' src3='' text3=''  link3='']
 */
function oet_recommended_resources_block_display($attributes, $ajax = false){
    $html = "";
    $shortcodeText = "";

    if (!empty($attributes)){
        extract($attributes);

        $shortcodeText = '[recommended_resources';

        if (isset($heading))
            $shortcodeText .= ' heading="'.$heading.'"';
        if (isset($mediaType1))
            $shortcodeText .= ' media_type1="'.$mediaType1.'"';

        $shortcodeText .= ']';

        if (isset($shortcodeText)){
            $html .= do_shortcode($shortcodeText);
        }
    }
    return $html;
}


// Display Recommended Resources Block Preview via Ajax
function oet_ajax_display_recommended_resources_block(){
    $shortcode = oet_recommended_resources_block_display($_POST['attributes'], true);
    echo $shortcode;
    die();
}
add_action( 'wp_ajax_display_recommended_resources', 'oet_ajax_display_recommended_resources_block' );
add_action( 'wp_ajax_nopriv_display_recommended_resources', 'oet_ajax_display_recommended_resources_block' );
