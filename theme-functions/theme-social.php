<?php
function twentytwelve_menu()
{
	add_theme_page('Social Media Options', 'Social Media Options', 'edit_theme_options', 'socialmedia-options', 'socialmedia_settings');
}
add_action('admin_menu', 'twentytwelve_menu');
function socialmedia_settings()
{
	if(isset($_POST["save_social"]))
	{
		extract($_POST);
		update_option("twitter_url", $twitter_url);
		update_option("facebook_url", $facebook_url);
		update_option("yotube_url", $yotube_url);
		update_option("google_url", $google_url);
		update_option("linkedin_url", $linkedin_url);
		update_option("linktonwltr", $linktonwltr);
	}
	
	$twitter_url = get_option("twitter_url");
	$facebook_url = get_option("facebook_url");
	$yotube_url = get_option("yotube_url");
	$google_url = get_option("google_url");	
	$linktonwltr = get_option("linktonwltr");	
	
	
	$return = '';
	$return .=  '<div class="wrap">
					<h2>Social Media Setting</h2>';
					
	$return .= '<form method="post">';
		$return .= '<div class="oer_sclmda_wrpr">
					  <div class="oer_sclmda_sub_wrapper">
							<div class="oer_sclmda_txt"><strong>Twitter</strong></div>
							<div class="oer_sclmda_fld"><input type="text" name="twitter_url" value="'. $twitter_url.'" /></div>
					  </div>
					  <div class="oer_sclmda_sub_wrapper">
							<div class="oer_sclmda_txt"><strong>Facebook</strong></div>
							<div class="oer_sclmda_fld"><input type="text" name="facebook_url" value="'. $facebook_url.'" /></div>
					  </div>
					  <div class="oer_sclmda_sub_wrapper">
							<div class="oer_sclmda_txt"><strong>Youtube</strong></div>
							<div class="oer_sclmda_fld"><input type="text" name="yotube_url" value="'. $yotube_url.'" /></div>
					  </div>
					  <div class="oer_sclmda_sub_wrapper">
							<div class="oer_sclmda_txt"><strong>Google Plus</strong></div>
							<div class="oer_sclmda_fld"><input type="text" name="google_url" value="'. $google_url.'" /></div>
					  </div>
					  <div class="oer_sclmda_sub_wrapper">
							<div class="oer_sclmda_txt"><strong>Link To Newsletter</strong></div>
							<div class="oer_sclmda_fld"><input type="text" name="linktonwltr" value="'. $linktonwltr.'" /></div>
					  </div>
					  <div class="oer_sclmda_sub_wrapper">
							<div class="oer_sclmda_txt"></div>
							<div class="oer_sclmda_fld"><input type="submit" name="save_social" value="Save Settings" /></div>
					  </div>
					  
					</div>';
	$return .= '</form>';
	
	echo $return;
}
?>