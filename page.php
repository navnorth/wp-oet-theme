<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); 
global $post;
?>

	<div class="row site-content">
    	
        <div class="col-md-9 c ol-sm-12 col-xs-12 padding_left pblctn_lft_sid_img_cntnr">
        	<h2 class="pblctn_hed"><?php echo $post->post_title;?></h2>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; ?>
         </div>   
       
        <div class="col-md-3 col-sm-12 col-xs-12 pblctn_right_sid_mtr">
            <!--- Right Side 1st Sidebar---->
            <?php 
				$page_id = get_the_ID();
				echo oer_dynamic_sidebar('default-template', $page_id);
			?>
        </div>
	
    </div><!-- site-content -->    

<?php get_footer(); ?>