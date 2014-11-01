<?php
/**
 * Template Name: Main Page Template
 */
?>
<?php get_header();?>
<!------------- Banner --------------->
<div class="row border_blue">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <h1><b>Sign the Future Ready Pledge!</b></h1>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
            Pellentesque habitant morbi tristique senectus et netus et 
            malesuada fames ac turpis egestas. Vestibulum tortor quam, 
            Feugiat vitae, ultricies eget tempor sit amet, ante.
        </p>
    </div>
    <div class="col-md-6 col-sm-12 col-xs12 bnr_img"> <img src="<?php echo get_stylesheet_directory_uri();?>/images/bnr_img.png"/></div>

</div>
        
<!------------- Body --------------->
<div class="row">
	<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'content', 'page' );
		endwhile;
	?>
</div>
<?php get_footer();?>