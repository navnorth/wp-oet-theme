<?php
/**
 * Template Name: Main Page Template
 */
?>
<?php get_header();?>
       
<!------------- Body --------------->
<div class="row">
	<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'content', 'page' );
		endwhile;
	?>
</div>
<?php get_footer();?>