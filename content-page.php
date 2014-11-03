<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<?php 
	$content = get_the_content();
	$content = apply_filters('the_content', $content);
	$content = str_replace( "<br>","", $content );
	echo do_shortcode($content);
?>
		