<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php
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
                            <input type="text" class="form-control" name="oet_sidebar_section_title[]" placeholder = "Section Title">
                        </div>
                        <div class="form-group">
                            <label for="oet_sidebar_section_icon">Icon:</label>
                            <select name="oet_sidebar_section_icon[]" class="form-control">
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
                                    'textarea_name' => 'oet_sidebar_section_html[]',
                                    'media_buttons' => true,
                                    'textarea_rows' => 6,
                                    'drag_drop_upload' => true,
                                    'teeny' => true,
                                )
                            );
                            $content .= ob_get_clean();
                $content .= '</div>
                    </div>
                </div>';      
    
    echo $content;
    exit();
}
?>