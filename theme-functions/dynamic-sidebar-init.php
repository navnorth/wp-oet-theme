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
                            <label for="oet_sidebar_section_type">Content Type:</label>
                            <select name="oet_sidebar_section[type][]" class="form-control oet-sidebar-section-type">
                                <option value="html">Free-form HTML</option>
                                <option value="link">Page Link</option>
                                <option value="image">Image</option>
                                <option value="related">Related Content</option>
                                <option value="youtube">YouTube Video</option>
                                <option value="story">Story</option>
                                <option value="medium">Medium Post</option>
                            </select>
                        </div>
                    </div>
                </div>';      
    
    echo $content;
    exit();
}


/**
 * Add Content Section By Type
 */
add_action('wp_ajax_oet_sidebar_content_type_callback', 'oet_sidebar_content_type_callback');
add_action('wp_ajax_nopriv_oet_sidebar_content_type_callback', 'oet_sidebar_content_type_callback');

function oet_sidebar_content_type_callback() {
    $totalSections = isset($_REQUEST['row_id']) ? $_REQUEST['row_id'] : '25';
    $type = isset($_REQUEST['type']) ? $_REQUEST['type']: "";
    $content = get_fields_from_content_type($type, $totalSections);
    echo $content;
    exit();
}

/** Get Fields From Selected Content Type **/
function get_fields_from_content_type($type, $rowid, $value=""){
    $fields_section = '';
    switch ($type){
        case "html":
            // Free Form HTML
            $html = $value[0];
            $fields_section = '<div class="form-group">
                        <label for="oet_sidebar_section_html">HTML Content:</label>';
                        ob_start(); // Start Output buffer
                        wp_editor( $html,
                            'oer-sidebar-section-'.($rowid),
                            $settings = array(
                                'textarea_name' => 'oet_sidebar_section[content][html][]',
                                'media_buttons' => true,
                                'textarea_rows' => 6,
                                'drag_drop_upload' => true,
                                'teeny' => true,
                                'tinymce' => true,
                                'quicktags' => true
                            )
                        );
            $fields_section .= ob_get_clean();
            $fields_section .=  '</div>';
            break;
        case "link":
        case "image":
        case "youtube":
        case "story":
        case "medium":
            $contents = "";
            if (!empty($value)){
                $contents = $value;
                $count = count($contents['title']);
                for($index=0;$index<$count;$index++){
                    $val = "";
                    $title = $contents['title'][$index];
                    $description = $contents['description'][$index];
                    if ($type=="link" || $type=="image" || $type=="youtube" || $type=="medium")
                        $val = $contents['url'][$index];
                    elseif ($type=="story")
                        $val = $contents['story'][$index];
                    $rowid = $index + 1;
                    $fields_section .= '<div class="panel panel-default oet-sidebar-section-type-wrapper" id="oet_sidebar_section_type_'.$rowid.'">
                        <div class="panel-heading">
                            <h3 class="panel-title">'.ucwords($type).' '.$rowid.'</h3>
                            <span class="oet-sortable-handle">
                                <i class="fa fa-arrow-down sidebar-section-reorder-down" aria-hidden="true"></i>
                                <i class="fa fa-arrow-up sidebar-section-reorder-up" aria-hidden="true"></i>
                            </span>
                            <span class="btn btn-danger btn-sm oet-remove-sidebar-section-content" title="Delete"><i class="fa fa-trash-o"></i> </span>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="oet_sidebar_section_content_title">Title:</label>
                                <input type="text" class="form-control" name="oet_sidebar_section[content]['.$type.'][title][]" placeholder = "Content Title" value="'.$title.'">
                            </div>
                            <div class="form-group">
                                <label for="oet_sidebar_section_content_html">Short Description:</label>';
                                ob_start(); // Start Output buffer
                                wp_editor( $description,
                                    'oer-sidebar-section-type-'.$rowid,
                                    $settings = array(
                                        'textarea_name' => 'oet_sidebar_section[content]['.$type.'][description][]',
                                        'media_buttons' => true,
                                        'textarea_rows' => 6,
                                        'drag_drop_upload' => true,
                                        'teeny' => true,
                                        'tinymce' => true,
                                        'quicktags' => true
                                    )
                                );
                                $fields_section .= ob_get_clean();
                    $fields_section .= '</div>
                            <div class="form-group">';
                    $fields_section .= generatecontentfieldtype($type, $val);
                    $fields_section .= '</div>
                        </div>
                    </div>';
                }
                if ($count>0){
                    $fields_section .= '<div class="form-group button-row-content">
                        <button type="button" class="btn btn-default oet-add-sidebar-section-content"><i class="fa fa-plus"></i> Add More '.ucwords($type).'</button>
                    </div>';
                }
            } else {
                $fields_section = '<div class="panel panel-default oet-sidebar-section-type-wrapper" id="oet_sidebar_section_type_'.$rowid.'">
                    <div class="panel-heading">
                        <h3 class="panel-title">'.ucwords($type).' '.$rowid.'</h3>
                        <span class="oet-sortable-handle">
                            <i class="fa fa-arrow-down sidebar-section-reorder-down" aria-hidden="true"></i>
                            <i class="fa fa-arrow-up sidebar-section-reorder-up" aria-hidden="true"></i>
                        </span>
                        <span class="btn btn-danger btn-sm oet-remove-sidebar-section-content" title="Delete"><i class="fa fa-trash-o"></i> </span>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="oet_sidebar_section_content_title">Title:</label>
                            <input type="text" class="form-control" name="oet_sidebar_section[content]['.$type.'][title][]" placeholder = "Content Title">
                        </div>
                        <div class="form-group">
                            <label for="oet_sidebar_section_content_html">Short Description:</label>';
                            ob_start(); // Start Output buffer
                            wp_editor( '',
                                'oer-sidebar-section-type-'.$rowid,
                                $settings = array(
                                    'textarea_name' => 'oet_sidebar_section[content]['.$type.'][description][]',
                                    'media_buttons' => true,
                                    'textarea_rows' => 6,
                                    'drag_drop_upload' => true,
                                    'teeny' => true,
                                    'tinymce' => true,
                                    'quicktags' => true
                                )
                            );
                            $fields_section .= ob_get_clean();
                $fields_section .= '</div>
                        <div class="form-group">';
                $fields_section .= generatecontentfieldtype($type);
                $fields_section .= '</div>
                    </div>
                </div>';
                if ($rowid==1) {
                $fields_section .= '<div class="form-group button-row-content">
                        <button type="button" class="btn btn-default oet-add-sidebar-section-content"><i class="fa fa-plus"></i> Add More '.ucwords($type).'</button>
                    </div>';
                }
            }
            break;
        case "related":
            break;
    }
    return $fields_section;
}

/** Generate Field Types **/
function generatecontentfieldtype($type, $value=""){
    $content = "";
    switch ($type){
        case "link":
            $content .= '<div class="form-group">
                            <label for="oet_sidebar_section_content_link_url">Url:</label>
                            <input type="text" class="form-control" name="oet_sidebar_section[content]['.$type.'][url][]" placeholder = "Enter Url" value="'.$value.'">
                        </div>';
            break;
        case "image":
            $img = "";
            $buttonText = "Select Image";
            if (!empty($value)){
                $img = '<img src="' . $value . '" class="oet-section-image-thumbnail" width="200"><span class="btn btn-danger btn-sm oet-remove-section-image" title="Remove Image"><i class="fa fa-minus-circle"></i></span>';
                $buttonText = "Change Image";
            }
            $content .= '<div class="form-group">
                            <label for="oet_sidebar_section_image_url">Image:</label>
                            <div class="oet_section_image_thumbnail_holder">'.$img.'</div>
                            <button name="oet_sidebar_section_image_button" class="oet_sidebar_section_image_button" class="ui-button" alt="'.$buttonText.'">'.$buttonText.'</button>
                            <input type="hidden" name="oet_sidebar_section[content]['.$type.'][url][]" class="oet_sidebar_section_image_url" value="'.$value.'" />
                        </div>';
            break;
        case "youtube":
            $content .= '<div class="form-group">
                            <label for="oet_sidebar_section_content_link_url">Youtube URL:</label>
                            <input type="text" class="form-control" name="oet_sidebar_section[content]['.$type.'][url][]" placeholder = "Enter Youtube Url" value="'.$value.'">
                        </div>';
            break;
        case "story":
            $content .= '<div class="form-group">
                            <label for="oet_sidebar_section_content_story">Story:</label>
                            <select name="oet_sidebar_section[content]['.$type.'][story][]" class="form-control oet-sidebar-section-story">';
            $stories = oet_get_stories();
            foreach($stories as $story){
                $content .= '<option value="'.$story->ID.'" '.selected($value,$story->ID, false).'>'.$story->post_title.'</option>';
            }
            $content .= '   </select>
                        </div>';
            break;
        case "medium":
            $content .= '<div class="form-group">
                            <label for="oet_sidebar_section_content_link_url">Medium Post URL:</label>
                            <input type="text" class="form-control" name="oet_sidebar_section[content]['.$type.'][url][]" placeholder = "Enter Medium Url" value="'.$value.'">
                        </div>';
            break;
    }
    return $content;
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

/**
 * Display Dynamic Sidebar
 **/
function oet_display_dynamic_sidebar($page_id){
    $sidebar_content = "";
    // Get Page Meta by Id
    $sidebar_sections = get_post_meta( $page_id, 'oet_sidebar_section' );
    if (!empty($sidebar_sections)) {
        // Display dynamic sidebar sections
        $sidebar_section = $sidebar_sections[0];
        $sidebar_count = count($sidebar_section['title']);
        for($index=0;$index<$sidebar_count;$index++){
            $title = $sidebar_section['title'][$index];
            $icon = $sidebar_section['icon'][$index];
            $type = (isset($sidebar_section['type'][$index])?$sidebar_section['type'][$index]:"");
            $content_type = (isset($sidebar_section['content'][$type])?$sidebar_section['content'][$type]:"");
            $sidebar_content .= '<div class="col-md-12 col-sm-6 col-xs-6">';
            $sidebar_content .= '   <div class="pblctn_box">';
            $sidebar_content .= '       <span class="socl_icns fa-stack"><i class="fa '.$icon.'"></i></span>';
            $sidebar_content .= '   </div>';
            $sidebar_content .= '   <p class="rght_sid_wdgt_hedng">'. $title .'</p>';
            if ($type=="related")
                $sidebar_content .=     display_sidebar_content_type($type, $index, $sidebar_section);
            else
                $sidebar_content .=     display_sidebar_content_type($type, $index, $content_type);
            $sidebar_content .= '</div>';
        }
    } else {
        // Default featured content sidebar
        $sidebar_content = oet_display_default_sidebar($page_id);
    }
    return $sidebar_content;
}

/**
 * Display Default Sidebar if no dynamic sidebar specified
 *
 * Returns 4 related contents based on tags/categories
 **/
function oet_display_default_sidebar($page_id, $related_count=4, $display_header=true){
    $html = "";
    // Get tags/categories of page
    $terms = wp_get_post_terms($page_id, array('category','post_tag'), array('fields'=> 'all'));
    if (empty($terms)) $terms = array();
    $term_list = wp_list_pluck($terms, 'slug');
    
    $related_args = array(
        'post_type'         => array('page', 'post'),
        'posts_per_page'    => $related_count,
        'post_status'       => 'publish',
        'post__not_in'      => array($page_id),
        'orderby'           => 'rand',
        'tax_query'         => array(
            'relation'      => 'OR',
            array(
                'taxonomy'  => 'category',
                'field'     => 'slug',
                'terms'     => $term_list
            ),
            array(
                'taxonomy'  => 'post_tag',
                'field'     => 'slug',
                'terms'     => $term_list
            )
        )
    );
    
    $related_posts = new WP_Query($related_args);
    $heading_title = "Related Content";
    
    if (!empty($title))
        $heading_title = $title;
        
    if ($related_posts->have_posts()){
        if ($display_header){
            $html .= '<div class="col-md-12 col-sm-6 col-xs-6">';
            $html .= '   <div class="pblctn_box">';
            $html .= '       <span class="socl_icns fa-stack"><i class="fa '.$icon.'"></i></span>';
            $html .= '   </div>';
            $html .= '   <h4 class="rght_sid_wdgt_hedng">'.$heading_title.'</h4>';
        }
        $index = 0;
        while($related_posts->have_posts()): $related_posts->the_post();
            $excerpt = '';
            if ($index==0)
                $html .= '<p class="hdng_mtr brdr_mrgn_none"><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
            else
                $html .= '<p class="hdng_mtr"><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
                
            $related_id = get_the_ID();
            
            if (function_exists('display_story_excerpt')){
                $excerpt = display_story_excerpt($related_id, 100);
            }
            
            if (strlen($excerpt)<=0) {
                $excerpt = get_excerpt_by_id($related_id, 15);
            }
            
            $html .= '<p>'.$excerpt.'</p>';
            $index++;
        endwhile;
        $html .= '</div>';
    }
    wp_reset_postdata();
    
    return $html;
}

/** Display Content Types on front-end **/
function display_sidebar_content_type($type, $sectionid, $sidebar_content){
    global $post;
    
    $content = "";
    switch ($type){
        case "html":
            $html = $sidebar_content[0];
            $content = $html;
            break;
        case "link":
            $count = count($sidebar_content['title']);
            for($index=0;$index<$count;$index++){
                $title = (isset($sidebar_content['title'][$index])?$sidebar_content['title'][$index]:"");
                $description = (isset($sidebar_content['description'][$index])?$sidebar_content['description'][$index]:"");
                $link_url =  (isset($sidebar_content['url'][$index])?$sidebar_content['url'][$index]:"");
                if ($index==0)
                    $content .= '<p class="hdng_mtr brdr_mrgn_none"><a href="'.$link_url.'">'.$title.'</a></p>';
                else
                    $content .= '<p class="hdng_mtr"><a href="'.$link_url.'">'.$title.'</a></p>';
                $content .= '<p>'.$description.'</p>';
            }
            break;
        case "image":
            $count = count($sidebar_content['title']);
            for($index=0;$index<$count;$index++){
                $title = (isset($sidebar_content['title'][$index])?$sidebar_content['title'][$index]:"");
                $description = (isset($sidebar_content['description'][$index])?$sidebar_content['description'][$index]:"");
                $image_url =  (isset($sidebar_content['url'][$index])?$sidebar_content['url'][$index]:"");
                $class = "hdng_mtr brdr_mrgn_none";
                $hclass = "sdbr_img_cntnt";
                if ($index==0)
                    $hclass .= " brdr_mrgn_none";
                $content .= '<div class="'.$hclass.'">';
                $content .= '<div class="hdng_img_mtr"><a href="'.$image_url.'" target="_blank"><img src="'.$image_url.'"></a></div>';
                $content .= '<p class="'.$class.'">'.$title.'</p>';
                $content .= '<p>'.$description.'</p>';
                $content .= '</div>';
            }
            break;
        case "related":
            $content = oet_display_default_sidebar($post->ID,4,false);
            break;
    }
    return $content;
}

/** Get Stories **/
function oet_get_stories(){
    $args = array(
        'post_type'         => array('stories'),
        'posts_per_page'    => -1,
        'post_status'       => 'publish',
    );
    
    $stories = new WP_Query($args);
    
    return $stories->posts;
}
?>