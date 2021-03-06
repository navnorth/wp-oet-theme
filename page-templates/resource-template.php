<?php
/**
 * Template Name: Resource Template
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header();
global $post;
?>

	<div id="content" class="row site-content" tabindex="-1">
		
        	<div class="col-md-12 c ol-sm-12 col-xs-12 padding_left padding_right">
		<?php
		if( have_rows( 'oet_acf_slides') ){
			oet_display_slideshow(get_the_ID());
		} else {
		?>
            	<h1 class="pblctn_hed"><?php echo $post->post_title;?></h1>
		<?php } ?>
            	
				<?php while ( have_posts() ) : the_post(); ?>
				
                	<?php get_template_part( 'content', 'page' ); ?>
                
				<?php endwhile;?>

		</div>
		<?php
		//checks if parent page uses publication template then load TOC
		$parent_id = $post->post_parent;
		$template = get_post_meta($parent_id, '_wp_page_template', true);
                if ($template == "page-templates/publication-template.php") {
			echo "<div class='col-md-12 c ol-sm-12 col-xs-12 padding_left padding_right default-toc'>";
			get_template_part( 'inner-templates/content', 'table' );
			echo "</div>";
		}
		?>
	</div>

<?php get_footer(); ?>