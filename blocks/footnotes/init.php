<?php
function oet_footnotes_block_init(){
    $dir = dirname(__FILE__);
    $dir_url = get_stylesheet_directory_uri().'/blocks/footnotes/';
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
        'oet-footnotes-block-editor',
        //$dir_url . $index_js,
        plugins_url( $index_js, __FILE__),
        $script_asset['dependencies'],
        $script_asset['version']
    );
    wp_localize_script( 'oet-footnotes-block-editor', 'oet_footnotes', array( 'home_url' => home_url(), 'ajax_url' => admin_url( 'admin-ajax.php' ), 'version_58' => false ) );


    $editor_css = 'build/index.css';
    wp_register_style(
        'oet-footnotes-block-editor-style',
        plugins_url( $editor_css, __FILE__),
        //$dir_url . $editor_css,
        array(),
        filemtime( "$dir/$editor_css" )
    );

    $style_css = 'build/style-index.css';
    wp_register_style(
        'oet-footnotes-block-style',
        //$dir_url . $style_css,
        plugins_url( $style_css, __FILE__ ),
        array(),
        filemtime( "$dir/$style_css" )
    );

    register_block_type( 'oet-block/oet-footnotes-block', array(
        'editor_script' => 'oet-footnotes-block-editor',
        'editor_style'  => 'oet-footnotes-block-editor-style',
        'style'         => 'oet-footnotes-block-style',
    ) );
}

// Register Block via block.json
function oet_footnotes_block_json_init() {
    $dir = dirname(__FILE__);
    $dir_url = get_stylesheet_directory_uri().'/blocks/footnotes/';
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
        'oet-footnotes-block-editor',
        $dir_url . $index_js,
        $script_asset['dependencies'],
        $script_asset['version']
    );
    wp_localize_script( 'oet-footnotes-block-editor', 'oet_footnotes', array( 'home_url' => home_url(), 'ajax_url' => admin_url( 'admin-ajax.php' ), 'version_58' => $version_58 ) );

    $editor_css = 'build/index.css';
    wp_register_style(
        'oet-footnotes-block-editor',
        $dir_url . $editor_css,
        array(),
        filemtime( "$dir/$editor_css" )
    );

    $style_css = 'build/style-index.css';
    wp_register_style(
        'oet-footnotes-block-style',
        $dir_url . $style_css,
        array(),
        filemtime( "$dir/$style_css" )
    );

    register_block_type( 
        __DIR__ ,
        array(
            'editor_script' => 'oet-footnotes-block-editor',
            'editor_style'  => 'oet-footnotes-block-editor',
            'style'         => 'oet-footnotest-block-style',
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
    add_action( 'init', 'oet_footnotes_block_init' );
} else {
    add_action( 'init', 'oet_footnotes_block_json_init' );
}
?>