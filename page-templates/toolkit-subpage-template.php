<?php
/**
 * Template Name: Toolkit Sub Page Template
 */
?>
<?php 
	get_header();
	$page_id = get_the_ID();
?>
 
<div class="row">
	<!--- Left Side Container---->
    <div class="col-md-9 col-sm-12 col-xs-12 padding_left tlkt_stp_cntnr_lft_sid">
    	<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'content', 'page' );
			endwhile;
		?>
	</div>
    
    <!--- Right Side Container---->
    <div class="col-md-3 col-sm-12 col-xs-12 pblctn_right_sid_mtr">
        <!--- Right Side 1st Sidebar---->
		<?php echo oer_dynamic_sidebar('toolkit-subpage-template', $page_id);?>	
    </div>
</div>
<?php get_footer();?>