<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php

function oet_dynamic_sidebar_enqueue_scripts()
{
    global $post;
    if (is_object($post) && $post->post_type == "page") {
        wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js' );
        wp_enqueue_style( 'bootstrap-css',get_stylesheet_directory_uri() . '/css/bootstrap.min.css' );
        wp_enqueue_style( 'fontawesome-css',get_stylesheet_directory_uri() . '/css/font-awesome.min.css' );
        wp_enqueue_style( 'sidebar-css',get_stylesheet_directory_uri() . '/css/dynamic-sidebar.css' );
        wp_enqueue_script( 'sidebar-js', get_stylesheet_directory_uri() . '/js/dynamic-sidebar.js', array('jquery') );
        wp_localize_script( 'sidebar-js', 'oet_ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    }
}
add_action( 'admin_enqueue_scripts', 'oet_dynamic_sidebar_enqueue_scripts' );

/**
 * Add Sidebar Section
 */
add_action('wp_ajax_oet_add_sidebar_section_callback', 'oet_add_sidebar_section_callback');
add_action('wp_ajax_nopriv_oet_add_sidebar_section_callback', 'oet_add_sidebar_section_callback');

function oet_add_sidebar_section_callback() {
    $totalSections = isset($_REQUEST['row_id']) ? $_REQUEST['row_id'] : '25';
    
    $content = '<div class="panel panel-default oet-sidebar-section-wrapper" id="oet_sidebar_section_'.$totalSections.'">
                    <div class="panel-heading">
                        <h3 class="panel-title">Section '.$totalSections.'</h3>
                        <span class="oet-sortable-handle">
                            <i class="fa fa-arrow-down sidebar-section-reorder-down" aria-hidden="true"></i>
                            <i class="fa fa-arrow-up sidebar-section-reorder-up" aria-hidden="true"></i>
                        </span>
                        <span class="btn btn-danger btn-sm oet-remove-sidebar-section" title="Delete"><i class="fa fa-trash-o"></i> </span>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="oet_sidebar_section_title">Title:</label>
                            <input type="text" class="form-control" name="oet_sidebar_section[title][]" placeholder = "Section Title">
                        </div>
                        <div class="form-group">
                            <label for="oet_sidebar_section_icon">Icon:</label>
                            <select name="oet_sidebar_section[icon][]" class="form-control">
                                <option value="fa-star">Star</option>
                                <option value="fa-compress">Compress</option>
                                <option value="fa-cogs">Cogs</option>
                                <option value="fa-cog">Cog</option>
                                <option value="fa-globe">Globe</option>
                                <option value="fa-power-off">Power Off</option>
                                <option value="fa-file-o">File</option>
                                <option value="fa-wifi">WiFi</option>
                                <option value="fa-check">Check</option>
                                <option value="fa-comment-o">Comment</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="oet_sidebar_section_html"><?php _e("HTML Text:", OET_THEME_SLUG); ?></label>';
                            ob_start(); // Start Output buffer
                            wp_editor( '',
                                'oer-sidebar-section-'.$totalSections,
                                $settings = array(
                                    'textarea_name' => 'oet_sidebar_section[html][]',
                                    'media_buttons' => true,
                                    'textarea_rows' => 6,
                                    'drag_drop_upload' => true,
                                    'teeny' => true,
                                    'tinymce' => true,
                                    'quicktags' => true
                                )
                            );
                            $content .= ob_get_clean();
                $content .= '</div>
                    </div>
                </div>';      
    
    echo $content;
    exit();
}

/**
 * Save sidebar sections fields
 */
add_action('save_post', 'oet_save_page_custom_fields');
function oet_save_page_custom_fields() {
    global $post;
    
    //Check first if $post is not empty
    if ($post) {
        if ($post->post_type == 'page') {
            //Save Sidebar Section
            if (isset($_POST['oet_sidebar_section'])) {
                update_post_meta($post->ID, 'oet_sidebar_section', $_POST['oet_sidebar_section']);
            }
        }
    }
}
?>