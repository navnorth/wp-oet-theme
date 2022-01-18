<?php
function oet_featured_card_block_init(){
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
        'oet-featured-card-block-editor',
        plugins_url( $index_js, __FILE__ ),
        $script_asset['dependencies'],
        $script_asset['version']
    );
    wp_localize_script( 'oet-featured-card-block-editor', 'oet_featured_card', array( 'home_url' => home_url(), 'ajax_url' => admin_url( 'admin-ajax.php' ), 'version_58' => $version_58 ) );


    $editor_css = 'build/index.css';
    wp_register_style(
        'oet-featured-card-block-editor-style',
        plugins_url( $editor_css, __FILE__ ),
        array(),
        filemtime( "$dir/$editor_css" )
    );

    $style_css = 'build/style-index.css';
    wp_register_style(
        'oet-featured-card-block-style',
        plugins_url( $style_css, __FILE__ ),
        array(),
        filemtime( "$dir/$style_css" )
    );

    register_block_type( 'oet-block/oet-featured-card-block', array(
        'editor_script' => 'oet-featured-card-block-editor',
        'editor_style'  => 'oet-featured-card-block-editor-style',
        'style'         => 'oet-featured-card-block-style',
        'render_callback' => 'oet_featured_card_block_display'
    ) );
}

// Register Block via block.json
function oet_featured_card_block_json_init() {
    register_block_type( __DIR__ );
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
    add_action( 'init', 'oet_featured_card_block_init' );
} else {
    add_action( 'init', 'oet_featured_card_block_json_init' );
}

// Display Featured Card Block
/**
 * OET Featured Card
 * Shortcode Example : [oet_featured_card title=\'\' button_text=\'Read More\' background_image=\'\' url=\'\']your content goes here[/oet_featured_card]
 **/
function oet_featured_card_block_display($attributes, $ajax = false){
    $html = "";
    $shortcodeText = "";
    
    if (is_array($attributes)){
        extract($attributes);

        if (!$ajax)
            $html .= '<div class="oet-featured-card-block">';

        
        $shortcodeText = "[oet_featured_card";
        if (isset($title))
            $shortcodeText .= " title='".$title."'";
        if (isset($buttonText))
            $shortcodeText .= " button_text='".$buttonText."'";
        if (isset($backgroundImage) && !empty($backgroundImage))
            $shortcodeText .= " background_image='".$backgroundImage."'";
        if (isset($url))
            $shortcodeText .= " url='".$url."'";
        $shortcodeText .= "]";

        if (isset($content))
            $shortcodeText .= $content;

        $shortcodeText .= "[/oet_featured_card]";
        
        if (isset($shortcodeText)){
            $html .= do_shortcode($shortcodeText);
        }


        if (!$ajax)
            $html .= '</div>';
    }
    return $html;
}

// Display Featured Card Block Preview via Ajax
function oet_ajax_display_featured_card_block(){
    $shortcode = oet_publication_intro_block_display($_POST['attributes'], true);
    echo $shortcode;
    die();
}
add_action( 'wp_ajax_display_featured_card', 'oet_ajax_display_featured_card_block' );
add_action( 'wp_ajax_nopriv_display_featured_card', 'oet_ajax_display_featured_card_block' );