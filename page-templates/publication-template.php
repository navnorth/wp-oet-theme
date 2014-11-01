<?php
/**
 * Template Name: Publication Template
 */
?>
<?php get_header();?>
 <div class="row">
 	
	<?php
		global $post;
		$page_id = get_the_ID();
		
		$publication_date = get_post_meta($post->ID, "publication_date", true);
		
		$button_one_text = get_post_meta($post->ID, "button_one_text", true);
		$button_one_link = get_post_meta($post->ID, "button_one_link", true);
		$button_one_color = get_post_meta($post->ID, "button_one_color", true);
		
		$button_two_text = get_post_meta($post->ID, "button_two_text", true);
		$button_two_link = get_post_meta($post->ID, "button_two_link", true);
		$button_two_color = get_post_meta($post->ID, "button_two_color", true);
		
		$social_status = get_post_meta($post->ID, "social_status", true);
		
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	?>
    
	<!--- Left Side Container---->
    <div class="col-md-9 padding_left">
    	<h2 class="pblctn_hed"><?php echo $post->post_title;?></h2>
        
        <div class="col-md-3 padding_left">
        	<span class="meta_date"><?php echo $publication_date; ?></span>
             <?php 
				if(isset($image) && !empty($image))
				{
            		echo '<img src="'. $image[0] .'"/>';
				}
				
				if(isset($button_one_text) && !empty($button_one_text) && isset($button_one_link) && !empty($button_one_link) && isset($button_one_color) && !empty($button_one_color))
				{
					?><button onClick="window.location.href='<?php echo $button_one_link; ?>'" class="btn_dwnld" style="background-color:#<?php echo $button_one_color; ?>"><?php echo $button_one_text; ?></button><?php
				}
				
				if(isset($button_two_text) && !empty($button_two_text) && isset($button_two_link) && !empty($button_two_link) && isset($button_two_color) && !empty($button_two_color))
				{
					?><button onClick="window.open('<?php echo $button_two_link; ?>','_blank')" class="btn_dwnld" style="background-color:#<?php echo $button_two_color; ?>"><?php echo $button_two_text; ?></button><?php
				}
				
				if(isset($social_status) && !empty($social_status) && $social_status == 'true')
				{
					echo '<p class="pblctn_scl_icn_hedng"> Share this Report </p>
							<p class="pblctn_scl_icns">
								<a href=""><span class="socl_icns fa-stack"><i class="fa fa-print fa-stack-2x"></i></span></a>
								<a href=""><span class="socl_icns fa-stack"><i class="fa fa-facebook fa-stack-2x"></i></span></a>
								<a href=""><span class="socl_icns fa-stack"><i class="fa fa-google-plus fa-stack-2x"></i></span></a>
								<a href=""><span class="socl_icns fa-stack"><i class="fa fa-twitter fa-stack-2x"></i></span></a>
								<a href=""><span class="socl_icns fa-stack"><i class="fa fa-envelope fa-stack-2x"></i></span></a>
							</p>';
				}
            ?>
    	</div>
        
        <?php
			while ( have_posts() ) : the_post();
				get_template_part( 'content', 'page' );
			endwhile;
		?>  
	</div>
    
    <!--- Right Side Container---->
    <div class="col-md-3 pblctn_right_sid_mtr">
        <!--- Right Side 1st Sidebar---->
        <?php echo oer_dynamic_sidebar('publication-template', $page_id);?>
    </div>
</div>
<?php get_footer();?>