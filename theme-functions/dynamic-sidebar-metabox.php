<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="oet_dynamic_sidebar_wrapper">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php _e("Section", OET_THEME_SLUG); ?></h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="oet_sidebar_section_title"><?php _e("Title:", OET_THEME_SLUG); ?></label>
                <input type="text" class="form-control" name="oet_sidebar_section_title[]" placeholder = "Section Title">
            </div>
            <div class="form-group">
                <label for="oet_sidebar_section_icon"><?php _e("Icon:", OET_THEME_SLUG); ?></label>
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
                <label for="oet_sidebar_section_html"><?php _e("HTML Text:", OET_THEME_SLUG); ?></label>
                <?php wp_editor( '',
                    'oer-sidebar-section-1',
                    $settings = array(
                        'textarea_name' => 'oet_sidebar_section_html[]',
                        'media_buttons' => true,
                        'textarea_rows' => 6,
                        'drag_drop_upload' => true,
                        'teeny' => true,
                    )
                );
                ?>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-default oet-add-sidebar-section"><i class="fa fa-plus"></i><?php _e("Add Sidebar Section", OET_THEME_SLUG); ?></button>
            </div>
        </div>
    </div>
</div>