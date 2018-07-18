<?php
include_once wp_normalize_path( get_stylesheet_directory() . '/classes/oet_medium.php' );
/**
 * Disruptive Content
 * Shortcode Example : [disruptive_content title='' main_text='' button_text='' button_color='' button_url='']
 */
add_shortcode("disruptive_content", "disruptive_content_fun" );
function disruptive_content_fun($attr, $content = null)
{
	extract($attr);

	if (strpos($button_color,"#")===false)
		$button_color = "#".$button_color;
	
	$return = '';
    $return .= '<div class="row bg_img_of_icns" id="lnk_btn_cntnr_center">';
        $return .= '<div class="col-md-8 col-sm-8 col-xs-8" >';
            $return .= '<h3>'. $title .'</h3>';
            $return .= '<p>';
				//$main_text = apply_filters('the_content', $main_text);
            	$return .= $main_text;
            $return .= '</p>';
        $return .= '</div>';
        $return .= '<div class="col-md-4 col-sm-4 col-xs-4 text-right">';
			$return .= '<div class="link_dwnlds"><div><a href="'. $button_url .'" class="btn_dwnld" style="background-color:'. $button_color.'" onclick="ga(\'send\', \'event\', \'download\', \''.$button_url.'\');" target="_blank">'. $button_text .'</a></div></div>';
        $return .= '</div>';
    $return .= '</div>';

	return $return;
}

/**
 * Accordion Group & Accordion
 * Shortcode Example : [oet_accordion_group][oet_accordion title="" accordion_series="one" expanded=""] your content goes here [/oet_accordion][/oet_accordion_group]
 */
add_shortcode('oet_accordion_group', 'oet_accordion_group_func');
function oet_accordion_group_func($atts, $content = null)
{
	$accordion_id = "accordion";
	
	if (!empty($atts)) {
		extract($atts);
		if ($id)
			$accordion_id = $id;
	}
	
	$return = '';
	$return .= '<div class="panel-group" id="'.$accordion_id.'" role="tablist" aria-multiselectable="true">';
			$content = str_replace( "<p>","", $content );
			$content = str_replace( "</p>","", $content );
			$return .= do_shortcode($content);
	$return .= '</div>';
	return $return;
}

add_shortcode('oet_accordion', 'oet_accordion_func');
function oet_accordion_func($atts, $content = null)
{
$group_id = "accordion";

  extract($atts);
  $return = '';

  if(isset($accordion_series) && !empty($accordion_series))
  {
		$return .= '<div class="panel panel-default">';

		$return .= '<div class="panel-heading" role="tab" id="heading'. $group_id. $accordion_series .'">';
		  $return .= '<h5 class="panel-title">';

			  if(isset($expanded) && !empty($expanded) && strtolower($expanded) == "true")
			  {
				  $class = "";
				  $uptcls = "in";
			  }
			  else
			  {
				  $class = "collapsed";
				  $uptcls = '';
			  }

			  $return .= '<a class="'.$class.'" role="button" data-toggle="collapse" data-parent="#'.$group_id.'" href="#collapse'. $group_id. $accordion_series .'" data-target="#collapse'. $group_id. $accordion_series .'" aria-expanded="false" aria-controls="collapse'. $group_id. $accordion_series .'">';
			  $return .= $title;
			$return .= '</a>';
		 $return .= ' </h5>';
		$return .= '</div>';

		$return .= '<div id="collapse'. $group_id. $accordion_series .'" class="panel-collapse collapse '.$uptcls.'" role="tabpanel" aria-labelledby="heading'. $accordion_series .'">';
		  $return .= '<div class="panel-body">';
			//$content = apply_filters('the_content', $content);
			$return .= $content;
		  $return .= '</div>';
		$return .= '</div>';

		$return .= '</div>';

		return $return;
  }
}

/**
 * Pull Quote
 * Shortcode Example : [pull_quote speaker="" additional_info=""]your content goes here[/pull_quote]
 */
add_shortcode('pull_quote', 'pull_quotethemefn');
function pull_quotethemefn($atts, $content = null)
{
	$speaker = $atts['speaker'];
	$additional_info = $atts['additional_info'];

	$return = '';
	$return .= '<div class="col-md-1 col-sm-1 col-xs-1">';
		$return .= '<img src="'. get_stylesheet_directory_uri() .'/images/dbl_cod_img.png" alt="Quote"/>';
	$return .= '</div>';

	$return .= '<div class="col-md-11 col-sm-11 col-xs-11">';
	if(isset($content) && !empty($content))
	{
		$return .= '<blockquote class="blog_mtr"><span></span>';
			//$content = apply_filters('the_content', $content);
			$return .= $content;
		$return .= '</blockquote>';
	}
	if(isset($speaker) && !empty($speaker))
	{
		$return .= '<blockquote class="blog_athr">';
			$return .= $speaker;
		$return .= '</blockquote>';
	}
	if(isset($additional_info) && !empty($additional_info))
	{
		$return .= ' <p class="blog_date">';
			$return .= $additional_info;
		$return .= '</p>';
	}
	$return .= '</div>';
	return $return;
}

/**
 * Featured Item
 * Shortcode Example : [featured_item heading='' url="" image='' title='' date='' button='' button_text='' sharing='']your content goes here[/featured_item]
 */
add_shortcode("featured_item","featured_item_func");
function featured_item_func($attr, $content = null)
{
	extract($attr);
	$return = '';
	$return .= '<div class="col-md-12 col-sm-12 col-xs-12 rght_sid_mtr">';
	if(isset($heading) && !empty($heading))
	{
    	$return .= '<h4>'. $heading .'</h4>';
	}
	if(isset($image) && !empty($image))
	{
		if(isset($url) && !empty($url))
		{
			$return .= '<a href="'. $url.'"><img class="featured_item_image" src="'. $image .'" alt="Featured Image" /></a>';
		}
		else
		{
    		$return .= '<img class="featured_item_image" src="'. $image .'" alt="Featured Image"/>';
		}
	}
	if(isset($title) && !empty($title))
	{
    	if(isset($url) && !empty($url))
		{
			$return .= '<p class="hdng_mtr"><a href="'. $url.'">'. $title .'</a></p>';
		}
		else
		{
    		$return .= '<p class="hdng_mtr">'. $title .'</p>';
		}
	}
	if(isset($date) && !empty($date))
	{
    	$return .= '<p class="date"><b>'. $date .'</b></p>';
	}
	if(isset($content) && !empty($content))
	{
		//$description = apply_filters('the_content', $description);
    	$return .= '<p class="rght_mtr">'. $content .'</p>';
	}
	if(isset($url) && !empty($url) && strtolower($button) == 'show')
	{
		$return .= '<div class="home_dwnld_btn"><a class="btn_dwnld" style="background-color:#e57200" href="'.$url.'">';

		if(isset($button_text) && !empty($button_text))
		{
			$return .= $button_text.'</a></div>';
		}
		else
		{
			$return .= 'Download</a></div>';
		}
	}
	if(isset($sharing) && strtolower($sharing) == 'show')
	{
		$return .= '<div class="col-md-7 col-sm-7 col-xs-7 rght_sid_socl_icn">';
			$return .= do_shortcode("[ssba]");
		$return .= '</div>';
	}
    $return .= '</div>';

	return $return;
}

/**
 * Featured Video
 * Shortcode Example : [featured_video heading="" src="" description="" height=""]
 */
add_shortcode("featured_video","feature_video_func");
function feature_video_func($attr, $content = null)
{
	global $post;
	extract($attr);

	$return = '';
	if(!isset($id) || empty($id))
		$id = "ytplayer";

	if(isset($videoid) && !empty($videoid))
		$src = "//www.youtube.com/embed/".$videoid."?enablejsapi=1";

	$tracking_script = "<script type='text/javascript'>\n";

	$tracking_script .= " 	// This code loads the IFrame Player API code asynchronously \n".
				"var tag = document.createElement('script'); \n".
				"tag.src = \"//www.youtube.com/iframe_api\"; \n ".
				"var firstScriptTag = document.getElementsByTagName('script')[0]; \n".
				"firstScriptTag.parentNode.insertBefore(tag, firstScriptTag); \n".
				"	// This code is called by the YouTube API to create the player object \n".
				"function onYouTubeIframeAPIReady(event) { \n".
				"	player = new YT.Player('".$id."', { \n".
				"	videoId: '', \n".
				"	playerVars: { \n".
				"		'autoplay': 0, \n".
				"		'controls': 1, \n".
				"		'rel' : 0 \n".
				"	}, \n".
				"	events: { \n".
				"		'onReady': onPlayerReady, \n".
				"		'onStateChange': onPlayerStateChange \n".
				"		} \n".
				"	}); \n".
				"}\n".
				"	var pauseFlag = false; \n".
				"function onPlayerReady(event) { \n".
				"	// do nothing, no tracking needed \n".
				"} \n".
				"function onPlayerStateChange(event) { \n".
				"	var url = event.target.getVideoUrl(); \n".
				"	var match = url.match(/[?&]v=([^&]+)/); \n".
				"	if( match != null) \n".
				"	{ \n ".
				"		var videoId = match[1]; \n".
				"	} \n".
				"	videoId = String(videoId); \n".
				"	// track when user clicks to Play \n".
				"	if (event.data == YT.PlayerState.PLAYING) { \n".
				"		console.log('playing'); \n".
				"		ga('send','event','Featured Video: ".$post->post_title."','Play', videoId);\n".
				"		pauseFlag = true; \n".
				"	}\n".
				"	// track when user clicks to Pause \n".
				"	if (event.data == YT.PlayerState.PAUSED && pauseFlag) { \n".
				"		ga('send','event','Featured Video: ".$post->post_title."', 'Pause', videoId); \n".
				"		pauseFlag = false; \n ".
				"	} \n".
				"	// track when video ends \n".
				"	if (event.data == YT.PlayerState.ENDED) { \n".
				"		ga('send', 'event','Featured Video: ".$post->post_title."', 'Finished', videoId); \n".
				"	}\n".
				"} \n";

	$tracking_script .= "</script>";

	$return .= '<div class="col-md-12 col-sm-12 col-xs-12 rght_sid_mtr">';
	if(isset($heading) && !empty($heading))
	{
		$return .= '<h4>'. $heading .'</h4>';
	}

	$return .= '<div class="col-md-12 col-sm-12 col-xs-12 vdo_bg">';

			if(isset($src) && !empty($src))
			{
				if(empty($height))
				{
					$height = 300;
				}

             	$return .= '<iframe id="'.$id.'" width="540" height="'. $height.'" src="'. $src .'" allowfullscreen></iframe>';
			}

			if(isset($description) && !empty($description))
			{
				//$description = apply_filters('the_content', $description);
				$return .= '<p>'. $description .'</p>';
			}
	$return .= $tracking_script;
    $return .= '</div>';
	$return .= '</div>';
	return $return;
}

/**
 * Home Right Column
 * Shortcode Example : [home_right_column] your content goes here [/home_right_column]
 */
add_shortcode('home_right_column', 'home_right_column_func');
function home_right_column_func($atts, $content = null)
{
	if (is_array($atts)) extract($atts);

	$return = '';
	$return .= '<div class="col-md-6 col-sm-12 col-xs-12 rght_sid_mtr">';
			$return .= do_shortcode($content);
	$return .= '</div>';
	return $return;
}

/**
 * Home Left Column
 * Shortcode Example : [home_left_column divider="yes/no"] your content goes here [/home_left_column]
 */
add_shortcode('home_left_column', 'home_left_column_func');
function home_left_column_func($atts, $content = null)
{
	if (is_array($atts)) extract($atts);

	$return = '';
	$return .= '<div class="col-md-6 col-sm-12 col-xs-12 lft_sid_mtr">';
			$return .= do_shortcode($content);
	if( (isset($divider) && ($divider == 'yes')) || !(isset($divider)) )
	{
		$return .= '<div class="sprtn_brdr"></div>';
	}
	$return .= '</div>';
	return $return;
}

/**
 * Featured Area
 * Shortcode Example : [oet_featured_area heading="" image="" title=""]your content goes here[/oet_featured_area]
 */
add_shortcode('oet_featured_area', 'oet_featured_area_descrptn');
function oet_featured_area_descrptn($attr, $content = null)
{
	extract($attr);
	$return = '';
	$return .= '<div class="col-md-12 col-sm-12 col-xs-12 lft_sid_mtr">';
			$return .= '<div class="col-md-12 lft_sid_mtr">';

			if(isset($heading) && !empty($heading))
			{
				$return .= '<h4>'. $heading .'</h4>';
			}
			if(isset($image) && !empty($image))
			{
				$return .= '<img class="featured_area_image" src="'. $image .'"  alt="Featured Image" />';
			}
			if(isset($title) && !empty($title))
			{
				$return .= '<p class="hdng_mtr">'. $title .'</p>';
			}
			if(isset($content) && !empty($content))
			{
				//$description = apply_filters('the_content', $content);
				$return .= '<p>'. $content .'</p>';
			}

			$return .= '</div>';
	$return .= '</div>';
	return $return;
}

/**
 * Share Icon
 * Shortcode Example : [share_the_toolkit]
 */
add_shortcode("share_the_toolkit","share_the_toolkit_func");
function share_the_toolkit_func($atts, $content = null)
{
	$return = '';
	$return .= '<div class="pblctn_right_sid_mtr">';
	$return .= '<p class="pblctn_scl_icn_hedng"> Share the Toolkit </p>';
        $return .= '<p class="pblctn_scl_icns">';
            $return .= '<a href="'. facebook_url.'"><span class="socl_icns fa-stack"><i class="fa fa-facebook fa-stack-2x"></i></span></a>';
            $return .= '<a href="'. google_url.'"><span class="socl_icns fa-stack"><i class="fa fa-google-plus fa-stack-2x"></i></span></a>';
            $return .= '<a href="'. twitter_url.'"><span class="socl_icns fa-stack"><i class="fa fa-twitter fa-stack-2x"></i></span></a>';
            $return .= '<a href="'. linktonwltr.'"><span class="socl_icns fa-stack"><i class="fa fa-envelope fa-stack-2x"></i></span></a>';
       $return .= ' </p>';
	$return .= '</div>';
	return $return;
}
/**
 * Recommended Resource
 * Shortcode Example : [recommended_resources media_type1='' src1='' text1='' link1='' media_type2='' src2='' text2='' link2='' media_type3='' src3='' text3=''  link3='']
 */
add_shortcode("recommended_resources","recommended_resources_func");
function recommended_resources_func($attr, $content = null)
{
	extract($attr);
	$return = '';
	$regex = "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/";
	if(isset($heading) && !empty($heading))
	{
		$return .= '<p class="pblctn_scl_icn_hedng">'. $heading.'</p>';
	}

	if(isset($text1) && !empty($text1) && isset($src1) && !empty($src1) && isset($text2) && !empty($text2) && isset($src2) && !empty($src2) && isset($text3) && !empty($text3) && isset($src3) && !empty($src3))
	{
        $return .= '<div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right tlkt_stp_vdo_cntnr">';
		if(isset($media_type1) && !empty($media_type1) && strtolower($media_type1) == 'video')
		{
			if(isset($text1) && !empty($text1) && isset($src1) && !empty($src1))
			{
				preg_match($regex, $src1, $matches);
				$src = "//www.youtube.com/embed/".$matches[1];
				$return .= '<div class="col-md-4 col-sm-4 col-xs-4 pblctn_vdo_bg">';
					$return .= '<iframe width="274" height="160" src="'. $src .'" allowfullscreen></iframe>';
					$return .= '<p>'. $text1 .'</p>';
				$return .= '</div>';
			}
		}
		else
		{
			if(isset($text1) && !empty($text1) && isset($src1) && !empty($src1))
			{
				$return .= '<div class="col-md-4 col-sm-4 col-xs-4 pblctn_vdo_bg">';
					$return .= '<a href="'.$link1.'" target="_blank"><img width="274" height="160" src="'. $src1 .'" alt="Resource" /></a>';
					$return .= '<p>'. $text1 .'</p>';
				$return .= '</div>';
			}
		}

		if(isset($media_type2) && !empty($media_type2) && strtolower($media_type2) == 'video')
		{
			if(isset($text2) && !empty($text2) && isset($src2) && !empty($src2))
			{
				preg_match($regex, $src2, $matches);
				$src = "//www.youtube.com/embed/".$matches[1];
				$return .= '<div class="col-md-4 col-sm-4 col-xs-4 pblctn_vdo_bg">';
					$return .= '<iframe width="274" height="160" src="'. $src .'" allowfullscreen></iframe>';
					$return .= '<p>'. $text2 .'</p>';
				$return .= '</div>';
			}
		}
		else
		{
			if(isset($text2) && !empty($text2) && isset($src2) && !empty($src2))
			{
				$return .= '<div class="col-md-4 col-sm-4 col-xs-4 pblctn_vdo_bg">';
					$return .= '<a href="'.$link2.'" target="_blank"><img width="274" height="160" src="'. $src2 .'" alt="Resource"/></a>';
					$return .= '<p>'. $text2 .'</p>';
				$return .= '</div>';
			}
		}

		if(isset($media_type3) && !empty($media_type3) && strtolower($media_type3) == 'video')
		{
			if(isset($text3) && !empty($text3) && isset($src3) && !empty($src3))
			{
				preg_match($regex, $src3, $matches);
				$src = "//www.youtube.com/embed/".$matches[1];
				$return .= '<div class="col-md-4 col-sm-4 col-xs-4 pblctn_vdo_bg">';
					$return .= '<iframe width="274" height="160" src="'. $src .'" allowfullscreen></iframe>';
					$return .= '<p>'. $text3 .'</p>';
				$return .= '</div>';
			}
		}
		else
		{
			if(isset($text3) && !empty($text3) && isset($src3) && !empty($src3))
			{
				$return .= '<div class="col-md-4 col-sm-4 col-xs-4 pblctn_vdo_bg">';
					$return .= '<a href="'.$link3.'" target="_blank"><img width="274" height="160" src="'. $src3 .'" alt="Resource"/></a>';
					$return .= '<p>'. $text3 .'</p>';
				$return .= '</div>';
			}

		}
		$return .= '</div>';
	}
	else
	{
		$return .= '<div class="col-md-12 col-sm-12 col-xs-12 padding_left padding_right tlkt_stp_vdo_cntnr">';

		if(isset($media_type1) && !empty($media_type1) && strtolower($media_type1) == 'video')
		{
			if(isset($text1) && !empty($text1) && isset($src1) && !empty($src1))
			{
				preg_match($regex, $src1, $matches);
				$src = "//www.youtube.com/embed/".$matches[1];
				$return .= '<div class="col-md-6 col-sm-12 col-xs-12 pblctn_vdo_bg_fr_two">';
					$return .= '<iframe width="274" height="160" src="'. $src .'" allowfullscreen></iframe>';
					$return .= '<p>'. $text1 .'</p>';
				$return .= '</div>';
			}
		}
		else
		{
			if(isset($text1) && !empty($text1) && isset($src1) && !empty($src1))
			{
				$return .= '<div class="col-md-6 col-sm-12 col-xs-12 pblctn_vdo_bg_fr_two">';
					$return .= '<a href="'.$link1.'" target="_blank"><img width="274" height="160" src="'. $src1 .'"  alt="Resource"/></a>';
					$return .= '<p>'. $text1 .'</p>';
				$return .= '</div>';
			}
		}

		if(isset($media_type2) && !empty($media_type2) && strtolower($media_type2) == 'video')
		{
			if(isset($text2) && !empty($text2) && isset($src2) && !empty($src2))
			{
				preg_match($regex, $src2, $matches);
				$src = "//www.youtube.com/embed/".$matches[1];
				$return .= '<div class="col-md-6 col-sm-12 col-xs-12 pblctn_vdo_bg_fr_two">';
					$return .= '<iframe width="274" height="160" src="'. $src .'" allowfullscreen></iframe>';
					$return .= '<p>'. $text2 .'</p>';
				$return .= '</div>';
			}
		}
		else
		{
			if(isset($text2) && !empty($text2) && isset($src2) && !empty($src2))
			{
				$return .= '<div class="col-md-6 col-sm-12 col-xs-12 pblctn_vdo_bg_fr_two">';
					$return .= '<a href="'.$link2.'" target="_blank"><img width="274" height="160" src="'. $src2 .'" alt="Resource"/></a>';
					$return .= '<p>'. $text2 .'</p>';
				$return .= '</div>';
			}
		}

		if(isset($media_type3) && !empty($media_type3) && strtolower($media_type3) == 'video')
		{
			if(isset($text3) && !empty($text3) && isset($src3) && !empty($src3))
			{
				preg_match($regex, $src3, $matches);
				$src = "//www.youtube.com/embed/".$matches[1];
				$return .= '<div class="col-md-6 col-sm-12 col-xs-12 pblctn_vdo_bg_fr_two">';
					$return .= '<iframe width="274" height="160" src="'. $src .'" allowfullscreen></iframe>';
					$return .= '<p>'. $text3 .'</p>';
				$return .= '</div>';
			}
		}
		else
		{
			if(isset($text3) && !empty($text3) && isset($src3) && !empty($src3))
			{
				$return .= '<div class="col-md-6 col-sm-12 col-xs-12 pblctn_vdo_bg_fr_two">';
					$return .= '<a href="'.$link3.'" target="_blank"><img width="274" height="160" src="'. $src3 .'" alt="Resource"/></a>';
					$return .= '<p>'. $text3 .'</p>';
				$return .= '</div>';
			}

		}
        $return .= '</div>';
	}

	return $return;
}

/**
 * Featured Content Box
 * Shortcode Example : [featured_content_box title='' top_icon='' align='']your content goes here[/featured_content_box]
 */
 add_shortcode("featured_content_box", "featured_content_box_func");

 function featured_content_box_func($attr, $content = null)
 {
	 extract($attr);
	 $return = '';
		$return .= '<div class="pblctn_right_sid_mtr">';
		$return .= '<div class="col-md-12 col-sm-6 col-xs-6">';
        $return .= '<div class="pblctn_box">';

		if(isset($top_icon) && !empty($top_icon))
		{
			$return .= '<span class="socl_icns fa-stack"><i class="fa fa-'.$top_icon.' "></i></span>';
		}
		else
		{
			$return .= '<span class="socl_icns fa-stack"><i class="fa fa-star "></i></span>';
		}

		$return .= '</div>';
            $return .= '<P class="rght_sid_wdgt_hedng">'. $title .'</P>';
            $return .= '<div class="cntnbx_cntnr" style="text-align:'. $align.'">'.$content.'</div>';
        $return .= '</div>';
		$return .= '</div>';

		return $return;
 }

 /**
 * Button
 * Shortcode Example : [btn button_color ='' text='' text_color='#ffffff']
 */
 add_shortcode("oet_button", "button_func");
 function button_func($attr, $content = null) {

	if (is_array($attr)) extract($attr);

	//Checks if content is provided otherwise display the text attribute as button text
	$buttonText = (isset($text) && !empty($text)) ? $text : "Button";
	if (!empty($content)) {
		$buttonText = $content;
	}

	$btnStyle = '';

	//Button Color
	if (isset($button_color) && !empty($button_color)) {
		if (strpos($button_color,"#")===false)
			$button_color = "#".$button_color;
		$btnStyle .= "background-color:".$button_color.";";
	}

	//Button Text color
	if (isset($text_color) && !empty($text_color)) {
		if (strpos($text_color,"#")===false)
			$text_color = "#".$text_color;
		$btnStyle .= "color:".$text_color.";";
	}

	//Button Font Face
	if (isset($font_face) && !empty($font_face)) {
		$btnStyle .= "font-family:".$font_face.";";
	}

	//Button Font Size
	if (isset($font_size) && !empty($font_size)) {
		$btnStyle .= "font-size:".$font_size."px;";
	}

	//Button Font Weight
	if (isset($font_weight) && !empty($font_weight)) {
		$btnStyle .= "font-weight:".$font_weight.";";
	}

	//Button Code
	$buttonStart = "<button class='btn custom-button' style='".$btnStyle."'>";
	$buttonEnd = "</button>";

	$return = $buttonStart.$buttonText.$buttonEnd;

	if (isset($url) && !empty($url)) {
		$urlStart = "<a href='".$url."'";
		if (isset($new_window) && ($new_window=="yes")) {
			$urlStart .= " onmousedown='ga(\"send\", \"event\",\"Outbound\",window.location.pathname,\"".$url."\",0);' target='_blank'";
		}
		$urlStart .= ">";
		$urlEnd = "</a>";
		$return = $urlStart.$return.$urlEnd;
	}

	return $return;
 }

 /**
 * Spacer
 * Shortcode Example : [spacer height='20']
 */
 add_shortcode("spacer", "spacer_func");
 function spacer_func($attribute) {

	if (is_array($attribute)) extract($attribute);

	if (isset($height) && !empty($height)) {
		$height = " height:".((strpos($height,"px")>0)?$height:$height."px");
	} else {
		$height = " height:12px;";
	}

	$return = '<div class="clearfix" style="clear:both;'. $height .'"></div>';

	return $return;

 }

 /**
 * Bootstrap Row
 * Shortcode Example : [row]
 */
 add_shortcode("row", "bootstrap_row_func");
 function bootstrap_row_func( $atts, $content = null ) {

    $atts = shortcode_atts( array(
      "xclass" => false,
      "data"   => false
	), $atts );

    $class  = 'row';
    $class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';

    $data_props = parse_data_attributes( $atts['data'] );

    return sprintf(
      '<div class="%s"%s>%s</div>',
      esc_attr( $class ),
      ( $data_props ) ? ' ' . $data_props : '',
      do_shortcode( $content )
    );
  }

/**
* Bootstrap Column
* Shortcode Example : [column lg='12']
*/
add_shortcode("column", "bootstrap_column_func");
function bootstrap_column_func( $atts, $content = null ) {

$atts = shortcode_atts( array(
      "lg"          => false,
      "md"          => false,
      "sm"          => false,
      "xs"          => false,
      "offset_lg"   => false,
      "offset_md"   => false,
      "offset_sm"   => false,
      "offset_xs"   => false,
      "pull_lg"     => false,
      "pull_md"     => false,
      "pull_sm"     => false,
      "pull_xs"     => false,
      "push_lg"     => false,
      "push_md"     => false,
      "push_sm"     => false,
      "push_xs"     => false,
      "xclass"      => false,
      "data"        => false
	), $atts );

    $class  = '';
    $class .= ( $atts['lg'] )			                                ? ' col-lg-' . $atts['lg'] : '';
    $class .= ( $atts['md'] )                                           ? ' col-md-' . $atts['md'] : '';
    $class .= ( $atts['sm'] )                                           ? ' col-sm-' . $atts['sm'] : '';
    $class .= ( $atts['xs'] )                                           ? ' col-xs-' . $atts['xs'] : '';
    $class .= ( $atts['offset_lg'] || $atts['offset_lg'] === "0" )      ? ' col-lg-offset-' . $atts['offset_lg'] : '';
    $class .= ( $atts['offset_md'] || $atts['offset_md'] === "0" )      ? ' col-md-offset-' . $atts['offset_md'] : '';
    $class .= ( $atts['offset_sm'] || $atts['offset_sm'] === "0" )      ? ' col-sm-offset-' . $atts['offset_sm'] : '';
    $class .= ( $atts['offset_xs'] || $atts['offset_xs'] === "0" )      ? ' col-xs-offset-' . $atts['offset_xs'] : '';
    $class .= ( $atts['pull_lg']   || $atts['pull_lg'] === "0" )        ? ' col-lg-pull-' . $atts['pull_lg'] : '';
    $class .= ( $atts['pull_md']   || $atts['pull_md'] === "0" )        ? ' col-md-pull-' . $atts['pull_md'] : '';
    $class .= ( $atts['pull_sm']   || $atts['pull_sm'] === "0" )        ? ' col-sm-pull-' . $atts['pull_sm'] : '';
    $class .= ( $atts['pull_xs']   || $atts['pull_xs'] === "0" )        ? ' col-xs-pull-' . $atts['pull_xs'] : '';
    $class .= ( $atts['push_lg']   || $atts['push_lg'] === "0" )        ? ' col-lg-push-' . $atts['push_lg'] : '';
    $class .= ( $atts['push_md']   || $atts['push_md'] === "0" )        ? ' col-md-push-' . $atts['push_md'] : '';
    $class .= ( $atts['push_sm']   || $atts['push_sm'] === "0" )        ? ' col-sm-push-' . $atts['push_sm'] : '';
    $class .= ( $atts['push_xs']   || $atts['push_xs'] === "0" )        ? ' col-xs-push-' . $atts['push_xs'] : '';
    $class .= ( $atts['xclass'] )                                       ? ' ' . $atts['xclass'] : '';

    $data_props = parse_data_attributes( $atts['data'] );

    return sprintf(
      '<div class="%s"%s>%s</div>',
      esc_attr( $class ),
      ( $data_props ) ? ' ' . $data_props : '',
      do_shortcode( $content )
    );
}

/*--------------------------------------------------------------------------------------
*
* Parse data-attributes for shortcodes
*
*-------------------------------------------------------------------------------------*/
function parse_data_attributes( $data ) {

	$data_props = '';

	if( $data ) {
	  $data = explode( '|', $data );

	  foreach( $data as $d ) {
	    $d = explode( ',', $d );
	    $data_props .= sprintf( 'data-%s="%s" ', esc_html( $d[0] ), esc_attr( trim( $d[1] ) ) );
	  }
	}
	else {
	  $data_props = false;
	}
	return $data_props;
}

/**
 * Callout Box
 * Shortcode Example : [oet_callout type='check' color='00529f' width='12' align='left']
 */
 add_shortcode("oet_callout", "oet_callout_func");
 function oet_callout_func($attribute, $content = null) {

	if (is_array($attribute)) extract($attribute);
	$class_attrs = array("pull-out-box");
	$style =  "";

	//Set Type
	$attr_type = "checkmark";
	if ($type)
		$attr_type = $type;

	$class_attrs[] = $attr_type;

	//Set Color
	if ($color){

		$color_class = $color;

		if (strpos($color,"#")>=0){
			$color_class = substr($color,1,strlen($color)-1);
		}

		$class_attrs[] = "color-".$color_class;

		$style = '<style>';
		//Set Line Color
		$style .= '.color-'.$color_class.'{
				border-color:'.$color.' !important;
			  }';
		//Set Icon Background Color
		$style .= '.color-'.$color_class.':before {
				background-color:'.$color.' !important;
			}';
		$style .= '</style>';
	}

	//Set Width
	$attr_width = 12;
	$class_attrs[] = "col-xs-".$attr_width;

	if ($width) {
		$attr_width = "col-md-".$width;
		$class_attrs[] = $attr_width;
		$class_attrs[] = "col-sm-".$width;
	}

	//Set Alignment
	if ($alignment)
		$class_attrs[] = "pull-".$alignment;

	$attrs = implode(" ", $class_attrs);

	$return = '<div class="'.$attrs.'">'.$content.'</div>'.$style;

	return $return;

 }

 /**
 * Publication Intro
 * Shortcode Example : [publication_intro title='This is the title']Text goes here[/publication_intro]
 */
 add_shortcode("publication_intro", "publication_intro_func");
 function publication_intro_func($attribute, $content = null) {

	if (is_array($attribute)) extract($attribute);
	
	$return = '<div class="intro">
			<div class="intro-goal">
				<div class="title">'.$title.'</div>
				'.$content.'
		        </div>
		</div>';

	return $return;
 }

 /**
  * Single Post Medium Embed
  * Shortcode Example : [oet_medium url=""]
  **/ 
add_shortcode("oet_medium", "oet_medium_func");
function oet_medium_func($attribute, $content = null){
	$return = "";
	if (is_array($attribute)) extract($attribute);
	
	if ($url) {
		$self_access_token = get_option("mediumaccesstoken");
		$oet_medium = new OET_Medium($self_access_token);
		
		if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
			$oet_medium->display_invalid_text();	
		}
		
		if ($align && $align!=="")
			$return =  $oet_medium->display_post($url, $align);
		else
			$return =  $oet_medium->display_post($url);
	}
	
	return $return;
}
?>
