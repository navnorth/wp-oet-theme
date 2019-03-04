<?php
function twentytwelve_menu()
{
	add_theme_page('Theme Settings', 'Theme Settings', 'edit_theme_options', 'socialmedia-options', 'socialmedia_settings');
}
add_action('admin_menu', 'twentytwelve_menu');
function socialmedia_settings()
{
	$notice = null;
	if(isset($_POST["save_social"]))
	{
		extract($_POST);
		if (isset($google_analytics_id))
			update_option("google_analytics_id", $google_analytics_id);
		if (isset($twitter_url))
			update_option("twitter_url", $twitter_url);
		if (isset($facebook_url))
			update_option("facebook_url", $facebook_url);
		if (isset($yotube_url))
			update_option("yotube_url", $yotube_url);
		if (isset($google_url))
			update_option("google_url", $google_url);
		if (isset($linktonwltr))
			update_option("linktonwltr", $linktonwltr);
		if (isset($mediumaccesstoken)){
			update_option("mediumaccesstoken", $mediumaccesstoken);
			$verified  = verify_token($mediumaccesstoken);
			if ($verified->errors){
				$notice = "Medium Self Access Token could not be verified, please try the Debug option for more information.";
			}
		}
		if (isset($enablecontactslider))
			update_option("enablecontactslider", $enablecontactslider);
		if (isset($contactsliderpage))
			update_option("contactsliderpage", $contactsliderpage);
	}
	
	$google_analytics_id = get_option("google_analytics_id");
	$twitter_url = get_option("twitter_url");
	$facebook_url = get_option("facebook_url");
	$yotube_url = get_option("yotube_url");
	$google_url = get_option("google_url");	
	$linktonwltr = get_option("linktonwltr");
	$mediumaccesstoken = get_option("mediumaccesstoken");
	$enablecontactslider = get_option("enablecontactslider");
	$contactsliderpage = get_option("contactsliderpage");
	
	//get all pages with contact slider template
	$contact_pages = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'page-templates/contact-slider.php'
	));
	
	$options = "";
	
	foreach($contact_pages as $page){
		$selected="";
		if ($contactsliderpage==$page->ID) {
			$selected = " selected";		
		}
		$options .= "<option value='".$page->ID."'".$selected.">".$page->post_title."</option>";
	}
	
	
	$return = '';
	$return .=  '<div class="wrap">
					<h2>Theme Settings</h2>';
	
	if ($notice){
		$return .= '<div class="notice notice-warning is-dismissible"><p>'.$notice.'</p></div>';
	}
	
	$return .= '<form method="post">';
		$return .= '<div class="oer_sclmda_wrpr">
			<div class="oer_sclmda_sub_wrapper">
				      <div class="oer_sclmda_txt"><strong>Google Analytics ID</strong></div>
				      <div class="oer_sclmda_fld"><input type="text" name="google_analytics_id" value="'. $google_analytics_id.'" /></div>
			</div>
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
				      <div class="oer_sclmda_txt"><strong>Medium Self Access Token:</strong></div>
				      <div class="oer_sclmda_fld"><input type="password" name="mediumaccesstoken" value="'. $mediumaccesstoken .'" /> <button id="debug_medium" class="medium-debug-btn button">Debug</button></div>
			</div>
			<div class="oer_sclmda_sub_wrapper">
				      <div class="oer_sclmda_txt"><strong>Enable Contact Slider?</strong></div>
				      <div class="oer_sclmda_fld"><input type="checkbox" id="enablecontactslider" name="enablecontactslider" value="'.(($enablecontactslider)?$enablecontactslider:true).'" '.(($enablecontactslider==1)?"checked='checked'":"").' /><select name="contactsliderpage" id="contactsliderpage" disabled="disabled">'.$options.'</select></div>
			</div>
			<div class="oer_sclmda_sub_wrapper">
				      <div class="oer_sclmda_txt"></div>
				      <div class="oer_sclmda_fld"><input type="submit" name="save_social" value="Save Settings" /></div>
			</div>
			<div id="oer_verbose_block"></div>
		      </div>';
	$return .= '</form>';
	
	echo $return;
}
?>