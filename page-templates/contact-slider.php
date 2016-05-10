<?php
/**
 * Template Name: Contact Slider
 */
get_header();
global $post;
?>
<div id="content" class="row site-content" tabindex="-1">
    <div class="col-md-12 c ol-sm-12 col-xs-12 padding-left padding-right">
        <h2 class="pblctn_hed"><?php echo $post->post_title;?></h2>
        
            <?php while ( have_posts() ) : the_post(); ?>
            
                <?php get_template_part( 'content', 'page' ); ?>
                
            <?php endwhile;?>
            
    </div>
</div>
<!-- Sliding div starts here -->
<div id="contact-slider" style="right:-342px;">
    <div id="contact-slider-sidebar" onclick="open_panel()"><img src="<?php echo get_stylesheet_directory_uri();?>/images/contact.png"></div>
    <div id="contact-slider-content">
        <span class="contact-slider-close" onclick="open_panel();"></span>
    </div>
</div>
<!-- Sliding div ends here -->
<?php get_footer(); ?>
