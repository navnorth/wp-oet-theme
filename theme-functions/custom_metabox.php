<?php
add_action("admin_init", "add_image_metabox");
function add_image_metabox()
{
	add_meta_box( "publication_metabox", "Publication Metabox", "publication_metabox_func", "page" );
}
function publication_metabox_func()
{
	global $post;
	$publication_date = get_post_meta($post->ID, "publication_date", true);
	
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
    	<label>Button One</label>
		<div class="meta_fld_wrp">
			<input type="text" name="button_one_text" value="<?php echo $button_one_text; ?>" placeholder="Button Text">
            <input type="text" name="button_one_link" value="<?php echo $button_one_link; ?>" placeholder="Button Link">
            <input type="text" name="button_one_color" value="<?php echo $button_one_color; ?>" placeholder="Button Colour Code">{wihout "#"}
		</div>
    </div>
    <div class="meta_main_wrp">
    	<label>Button Two</label>
		<div class="meta_fld_wrp">
			<input type="text" name="button_two_text" value="<?php echo $button_two_text; ?>" placeholder="Button Text">
            <input type="text" name="button_two_link" value="<?php echo $button_two_link; ?>" placeholder="Button Link">
            <input type="text" name="button_two_color" value="<?php echo $button_two_color; ?>" placeholder="Button Colour Code">{wihout "#"}
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
add_action('save_post', 'save_featured_metabox'); 
function save_featured_metabox()
{ 
	global $post;
	update_post_meta($post->ID, "publication_date", $_POST["publication_date"] );
	
	update_post_meta($post->ID, "button_one_text", $_POST["button_one_text"] );
	update_post_meta($post->ID, "button_one_link", $_POST["button_one_link"] );
	update_post_meta($post->ID, "button_one_color", $_POST["button_one_color"] );
	
	update_post_meta($post->ID, "button_two_text", $_POST["button_two_text"] );
	update_post_meta($post->ID, "button_two_link", $_POST["button_two_link"] );
	update_post_meta($post->ID, "button_two_color", $_POST["button_two_color"] );
	
	update_post_meta($post->ID, "social_status", $_POST["social_status"] );
}
?>