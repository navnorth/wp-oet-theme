<?php
//add_action("admin_init", "add_image_metabox");
add_action("add_meta_boxes", "add_image_metabox");
function add_image_metabox()
{
	global $post;
	$template = null;
	if (!empty($post))
		$template = get_post_meta($post->ID, '_wp_page_template', true);
	
	if ($template!=="page-templates/blog-template.php") {
		add_meta_box( "publication_metabox", "Publication Metabox", "publication_metabox_func", "page" );
		add_meta_box( "story_metabox", "Story Metabox", "story_metabox_func", "page" );
	} else {
		add_meta_box( "blog_metabox", "Select Publications", "blog_metabox_func", "page");
	}
	add_meta_box( "Assign Widgets to Pages", "Assign Widgets to Pages", "asgnwidget_metabox_func", "page", "side", "high" );
}
function asgnwidget_metabox_func()
{
	global $post;
	?>
	<a target="_blank" href="<?php echo site_url(); ?>/wp-admin/themes.php?page=theme-options&action=widget_assign&page_id=<?php echo $post->ID;?>">
			<strong><?php echo $post->post_title;?></strong>
	</a>
<?php
}
function publication_metabox_func()
{
	global $post;
	$publication_date = get_post_meta($post->ID, "publication_date", true);
	$short_title = get_post_meta($post->ID, "short_title", true);

	$button_one_text = get_post_meta($post->ID, "button_one_text", true);
	$button_one_link = get_post_meta($post->ID, "button_one_link", true);
	$button_one_color = get_post_meta($post->ID, "button_one_color", true);

	$button_two_text = get_post_meta($post->ID, "button_two_text", true);
	$button_two_link = get_post_meta($post->ID, "button_two_link", true);
	$button_two_color = get_post_meta($post->ID, "button_two_color", true);

	$social_status = get_post_meta($post->ID, "social_status", true);
	?>
    <div class="meta_main_wrp">
    	<label>Publication Date</label>
		<div class="meta_fld_wrp">
			<input type="text" name="publication_date" value="<?php echo $publication_date; ?>">
		</div>
    </div>
    <div class="meta_main_wrp">
    	<label>Short Title</label>
		<div class="meta_fld_wrp">
			<input type="text" name="short_title" value="<?php echo $short_title; ?>">
		</div>
    </div>
    <div class="meta_main_wrp">
    	<label>Button One</label>
		<div class="meta_fld_wrp">
			<input type="text" name="button_one_text" value="<?php echo $button_one_text; ?>" placeholder="Button Text">
            <input type="text" name="button_one_link" value="<?php echo $button_one_link; ?>" placeholder="Button Link">
            <input type="text" name="button_one_color" value="<?php echo $button_one_color; ?>" placeholder="Button Colour Code">{without "#"}
		</div>
    </div>
    <div class="meta_main_wrp">
    	<label>Button Two</label>
		<div class="meta_fld_wrp">
			<input type="text" name="button_two_text" value="<?php echo $button_two_text; ?>" placeholder="Button Text">
            <input type="text" name="button_two_link" value="<?php echo $button_two_link; ?>" placeholder="Button Link">
            <input type="text" name="button_two_color" value="<?php echo $button_two_color; ?>" placeholder="Button Colour Code">{without "#"}
		</div>
    </div>

    <div class="meta_main_wrp">
    	<label>Social Media</label>
		<div class="meta_fld_wrp">
			<input type="radio" name="social_status" value="true" <?php if($social_status == 'true'){ echo "checked";}?>>True
            <input type="radio" name="social_status" value="false" <?php if($social_status == 'false'){ echo "checked";}?>>False
        </div>
    </div>
	<?php
}

function story_metabox_func()
{
    global $post;
    $box_one_header = get_post_meta($post->ID, "box_one_header", true);
    $box_one_text = get_post_meta($post->ID, "box_one_text", true);

    $box_two_header = get_post_meta($post->ID, "box_two_header", true);
    $box_two_text = get_post_meta($post->ID, "box_two_text", true);

    ?>
    <div class="meta_main_wrp">
        <label>Box One Header</label>
        <div class="meta_fld_wrp">
            <input type="text" name="box_one_header" value="<?php echo $box_one_header; ?>">
        </div>
    </div>
    <div class="meta_main_wrp">
        <label>Box One Text</label>
        <div class="meta_fld_wrp">
            <textarea name="box_one_text"><?php echo $box_one_text; ?></textarea>
        </div>
    </div>

    <div class="meta_main_wrp">
        <label>Box Two Header</label>
        <div class="meta_fld_wrp">
            <input type="text" name="box_two_header" value="<?php echo $box_two_header; ?>">
        </div>
    </div>
    <div class="meta_main_wrp">
        <label>Box Two Text</label>
        <div class="meta_fld_wrp">
            <textarea name="box_two_text"><?php echo $box_two_text; ?></textarea>
        </div>
    </div>
    <?php
}

function blog_metabox_func() {
	global $post;
	
	$mpubdisplay = get_post_meta($post->ID, "mpubdisplay", true);
	?>
	<div class="meta_main_wrp">
		<input type="radio" name="mpubdisplay" value="all" <?php checked( $mpubdisplay, "all", true ); ?>> All Medium Stories <br/>
	</div>
	<div class="meta_main_wrp">
		<input type="radio" name="mpubdisplay" value="selective" <?php checked( $mpubdisplay, "selective", true ); ?>> Select Publication(s) <br/>
	</div>
	<div class="meta_main_wrapper">
	<?php
	
	$publications = getMediumPublications();

	if ($publications){
		$i=1;
		foreach($publications as $publication){
		    $pub_value = get_post_meta($post->ID, "mpublication".$i, true);
		    ?>
		    <div class="meta_main_wrp">
			    <input type="checkbox" name="mpublication<?php echo $i; ?>" value="1" <?php checked( $pub_value, "1", true ); ?>  /> <label for="publication<?php echo $i; ?>" class="pub_label"><?php echo $publication->name; ?> <a href="<?php echo $publication->url; ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri() . "/images/view-site-icon.png"; ?>" alt="View Publication" width="16" /></a></label>
		    </div>
		    <?php
		    $i++;
		}
	}
	?>
	</div>
	<?php
}

add_action('save_post', 'save_featured_metabox');
function save_featured_metabox()
{
	global $post;
	update_post_meta($post->ID, "publication_date", $_POST["publication_date"] );
	update_post_meta($post->ID, "short_title", $_POST["short_title"] );

	update_post_meta($post->ID, "button_one_text", $_POST["button_one_text"] );
	update_post_meta($post->ID, "button_one_link", $_POST["button_one_link"] );
	update_post_meta($post->ID, "button_one_color", $_POST["button_one_color"] );

	update_post_meta($post->ID, "button_two_text", $_POST["button_two_text"] );
	update_post_meta($post->ID, "button_two_link", $_POST["button_two_link"] );
	update_post_meta($post->ID, "button_two_color", $_POST["button_two_color"] );

	update_post_meta($post->ID, "social_status", $_POST["social_status"] );

	update_post_meta($post->ID, "box_one_header", $_POST["box_one_header"] );
	update_post_meta($post->ID, "box_one_text", $_POST["box_one_text"] );
	update_post_meta($post->ID, "box_two_header", $_POST["box_two_header"] );
	update_post_meta($post->ID, "box_two_text", $_POST["box_two_text"] );
	
	if  (get_post_meta($post->ID, '_wp_page_template', true)=="page-templates/blog-template.php"){
		update_post_meta($post->ID, "mpubdisplay", $_POST['mpubdisplay']);
		$publications = getMediumPublications();
		$count = count($publications);
		for($i=1;$i<=$count;$i++){
			update_post_meta($post->ID, "mpublication".$i, $_POST["mpublication".$i] );
		}
	}
}
?>
