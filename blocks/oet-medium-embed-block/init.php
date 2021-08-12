<?php
/**
 * Plugin Name:       OET Medium Embed Block
 * Description:       Medium Embed Block for OET
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       oet-medium-embed-block
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
function oet_medium_embed_block_init() {
    $dir = dirname( __FILE__ );
    $dir_url = get_stylesheet_directory_uri().'/blocks/oet-medium-embed-block/';

    $script_asset_path = "$dir/build/index.asset.php";
    if ( ! file_exists( $script_asset_path ) ) {
        throw new Error(
            'You need to run `npm start` or `npm run build` for the "create-block/oer_subjects_index" block first.'
        );
    }
    
    $index_js     = 'build/index.js';
    $script_asset = require( $script_asset_path );
    wp_register_script(
        'oet-block-medium-embed-block-editor-script',
        $dir_url . $index_js,
        $script_asset['dependencies'],
        $script_asset['version']
    );
    wp_set_script_translations( 'oet-block-medium_embed-block_editor-script', 'oet_medium_embed' );

    $editor_css = 'build/index.css';
    wp_register_style(
        'oet-block-medium-embed-block-editor-style',
        $dir_url . $editor_css,
        array(),
        filemtime( "$dir/$editor_css" )
    );

    $style_css = 'build/style-index.css';
    wp_register_style(
        'oet-block-medium-embed-style',
        $dir_url . $style_css,
        array(),
        filemtime( "$dir/$style_css" )
    );

	register_block_type( 'oet-block/oet-medium-embed-block', array(
        'editor_script'     => 'oet-block-medium-embed-block-editor-script',
        'editor_style'      => 'oet-block-medium-embed-block-editor-style',
        'style'             => 'oet-block-medium-embed-style',
        'render_callback'   => 'oet_display_medium_embed'
    ) );
}
add_action( 'init', 'oet_medium_embed_block_init' );

/*
* Add OET Block Category
*/
function oet_add_oet_block_category( $categories ) {
    $category_slugs = wp_list_pluck( $categories, 'slug' );
    return in_array( 'oet-block-category', $category_slugs, true ) ? $categories : array_merge(
        array(
            array(
                'slug' => 'oet-block-category',
                'title' => __( 'OET Blocks', 'oet-block-category' ),
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'oet_add_oet_block_category', 10, 2);

function oet_display_medium_embed($attributes, $ajax = false){
    print_r($attributes);
}
