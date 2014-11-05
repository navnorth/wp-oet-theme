<?php
/**
 * Disruptive Content
 * Shortcode Example : [disruptive_content title='' main_text='' button_text='' button_color='' button_url='']
 */
add_shortcode("disruptive_content", "disruptive_content_fun" );
function disruptive_content_fun($attr, $content = null)
{
	extract($attr);
	
	$return = '';
    $return .= '<div class="row bg_img_of_icns">';
        $return .= '<div class="col-md-8 col-sm-8 col-xs-8" >';
            $return .= '<h3>'. $title .'</h3>';
            $return .= '<p>';
				//$main_text = apply_filters('the_content', $main_text);
            	$return .= $main_text;
            $return .= '</p>';
        $return .= '</div>';
        $return .= '<div class="col-md-4 col-sm-4 col-xs-4 text-right">';
			$return .= '<div class="link_dwnlds"><div><a href="'. $button_url .'" class="btn_dwnld" style="background-color:'. $button_color.'">'. $button_text .'</a></div></div>';
        $return .= '</div>';
    $return .= '</div>';
	
	return $return;
}

/**
 * Accordion Group & Accordion
 * Shortcode Example : [oet_accordion_group][oet_accordion title="" accordion_series="one"] your content goes here [/oet_accordion][/oet_accordion_group]
 */
add_shortcode('oet_accordion_group', 'oet_accordion_group_func');
function oet_accordion_group_func($atts, $content = null)
{
	//extract($atts);
	$return = '';
	$return .= '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
			$content = str_replace( "<p>","", $content );
			$content = str_replace( "</p>","", $content );
			$return .= do_shortcode($content);
	$return .= '</div>';
	return $return;
}

add_shortcode('oet_accordion', 'oet_accordion_func');
function oet_accordion_func($atts, $content = null)
{
  extract($atts);
  $return = '';

  if(isset($accordion_series) && !empty($accordion_series))
  {		
		$return .= '<div class="panel panel-default">';
			
		$return .= '<div class="panel-heading" role="tab" id="heading'. $accordion_series .'">';
		  $return .= '<h4 class="panel-title">';
			$return .= '<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse'. $accordion_series .'" aria-expanded="false" aria-controls="collapse'. $accordion_series .'">';
			  $return .= $title;
			$return .= '</a>';
		 $return .= ' </h4>';
		$return .= '</div>';
			
		$return .= '<div id="collapse'. $accordion_series .'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'. $accordion_series .'">';
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
 * Shortcode Example : [pull_quote image="" speaker="" additional_info=""]your content goes here[/pull_quote]
 */
add_shortcode('pull_quote', 'pull_quotethemefn');
function pull_quotethemefn($atts, $content = null)
{
	$speaker = $atts['speaker'];
	$additional_info = $atts['additional_info'];
	
	$return = '';
	$return .= '<div class="col-md-1 col-sm-1 col-xs-1">';
		$return .= '<img src="'. get_stylesheet_directory_uri() .'/images/dbl_cod_img.png"/>';
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
		$return .= ' <h4 class="blog_date">';
			$return .= $additional_info;
		$return .= '</h4>';
	}
	$return .= '</div>';
	return $return;
}

/**
 * Featured Item
 * Shortcode Example : [featured_item heading='' url="" image='' title='' date='' description='' button='' sharing='']
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
    	$return .= '<a href="'. $url.'"><img src="'. $image .'"/></a>';
	}
	if(isset($title) && !empty($title))
	{
    	$return .= '<p class="hdng_mtr"><a href="'. $url.'">'. $title .'</a></p>';
	}
	if(isset($date) && !empty($date))
	{
    	$return .= '<p class="date"><b>'. $date .'</b></p>';
	}
	if(isset($description) && !empty($description))
	{
		//$description = apply_filters('the_content', $description);
    	$return .= '<p class="rght_mtr"><a href="'. $url.'">'. $description .'</a></p>';    
	}
	if(isset($url) && !empty($url) && strtolower($button) == 'show')
	{
		$return .= '<div class="home_dwnld_btn"><a class="btn_dwnld" style="background-color:#e57200" href="'.$url.'">Download</a></div>';
	}
	if(strtolower($sharing) == 'show')
	{
		$return .= '<div class="col-md-7 col-sm-7 col-xs-7 rght_sid_socl_icn">';
			$return .= '<a href="'. twitter_url.'"><span class="socl_icns fa-stack"><i class="fa fa-twitter fa-stack-2x"></i></span></a>';
			$return .= '<a href="'. facebook_url.'"><span class="socl_icns fa-stack"><i class="fa fa-facebook fa-stack-2x"></i></span></a>';
			$return .= '<a href="'. google_url.'"><span class="socl_icns fa-stack"><i class="fa fa-google-plus fa-stack-2x"></i></span></a>';
			$return .= '<a href="'. linkedin_url.'"><span class="socl_icns fa-stack"><i class="fa fa-linkedin fa-stack-2x"></i></span></a>';
		$return .= '</div>';
	}
    $return .= '</div>';
	
	return $return;
}

/**
 * Featured Video
 * Shortcode Example : [feature_video heading="" src="" description=""]
 */
add_shortcode("feature_video","feature_video_func");
function feature_video_func($attr, $content = null)
{
	extract($attr);
	
	$return = '';
	
	$return .= '<div class="col-md-12 col-sm-12 col-xs-12 padding_left">';
	$return .= '<div class="col-md-12 col-sm-12 col-xs-12 pblctn_vdo_bg">';
			if(isset($src) && !empty($src))
			{		
             	$return .= '<iframe width="600" height="300" src="'. $src .'" frameborder="0" allowfullscreen></iframe>';
			}
			
			if(isset($description) && !empty($description))
			{
				//$description = apply_filters('the_content', $description);
				$return .= '<p>'. $description .'</p>';
			}
    $return .= '</div>';
	$return .= '</div>';
	
	return $return;	
}

/**
 * Home Featured Video
 * Shortcode Example : [home_feature_video heading="" src="" description=""]
 */
add_shortcode("home_feature_video","home_feature_video_func");
function home_feature_video_func($attr, $content = null)
{
	extract($attr);
	
	$return = '';
	$return .= '<div class="col-md-12 col-sm-12 col-xs-12 rght_sid_mtr">';
	if(isset($heading) && !empty($heading))
	{
		$return .= '<h4>'. $heading .'</h4>';
	}
	
	$return .= '<div class="col-md-12 col-sm-12 col-xs-12 vdo_bg">';
	
			if(isset($src) && !empty($src))
			{		
             	$return .= '<iframe width="540" height="300" src="'. $src .'" frameborder="0" allowfullscreen></iframe>';
			}
			
			if(isset($description) && !empty($description))
			{
				//$description = apply_filters('the_content', $description);
				$return .= '<p>'. $description .'</p>';
			}
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
	//extract($atts);
	$return = '';
	$return .= '<div class="col-md-6 col-sm-12 col-xs-12 rght_sid_mtr">';
			$return .= do_shortcode($content);
	$return .= '</div>';
	return $return;
}

/**
 * Home Left Column
 * Shortcode Example : [home_left_column] your content goes here [/home_left_column]
 */
add_shortcode('home_left_column', 'home_left_column_func');
function home_left_column_func($atts, $content = null)
{
	//extract($atts);
	
	$return = '';
	$return .= '<div class="col-md-6 col-sm-12 col-xs-12 lft_sid_mtr">';
			$return .= do_shortcode($content);
	$return .= '<div class="sprtn_brdr"></div>';
	$return .= '</div>';
	return $return;
}

/**
 * Featured Area
 * Shortcode Example : [featured_area heading="" image="" title="" description=""]
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
				$return .= '<img src="'. $image .'"/>';
			}
			if(isset($title) && !empty($title))
			{
				$return .= '<p class="hdng_mtr">'. $title .'</p>';
			}
			if(isset($description) && !empty($description))
			{
				//$description = apply_filters('the_content', $content);
				$return .= '<p>'. $description .'</p>';
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
            $return .= '<a href="mailto:'. mailto.'"><span class="socl_icns fa-stack"><i class="fa fa-envelope fa-stack-2x"></i></span></a>';
       $return .= ' </p>';	
	$return .= '</div>';
	return $return;   
}
/**
 * Share Icon
 * Shortcode Example : [recommended_resources media_type1='' src1='' text1='' link1='' media_type2='' src2='' text2='' link2='' media_type3='' src3='' text3=''  link3='']
 */
add_shortcode("recommended_resources","recommended_resources_func");
function recommended_resources_func($attr, $content = null)
{
	extract($attr);
	$return = '';
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
				$return .= '<div class="col-md-4 col-sm-4 col-xs-4 pblctn_vdo_bg">';
					$return .= '<iframe width="274" height="160" src="'. $src1 .'" frameborder="0" allowfullscreen></iframe>';
					$return .= '<p>'. $text1 .'</p>';
				$return .= '</div>';
			}
		}
		else
		{
			if(isset($text1) && !empty($text1) && isset($src1) && !empty($src1))
			{
				$return .= '<div class="col-md-4 col-sm-4 col-xs-4 pblctn_vdo_bg">';
					$return .= '<a href="'.$link1.'"><img width="274" height="160" src="'. $src1 .'" ></a>';
					$return .= '<p>'. $text1 .'</p>';
				$return .= '</div>';
			}
		}
		
		if(isset($media_type2) && !empty($media_type2) && strtolower($media_type2) == 'video')
		{
			if(isset($text2) && !empty($text2) && isset($src2) && !empty($src2))
			{
				$return .= '<div class="col-md-4 col-sm-4 col-xs-4 pblctn_vdo_bg">';
					$return .= '<iframe width="274" height="160" src="'. $src2 .'" frameborder="0" allowfullscreen></iframe>';
					$return .= '<p>'. $text2 .'</p>';
				$return .= '</div>';
			}
		}
		else
		{
			if(isset($text2) && !empty($text2) && isset($src2) && !empty($src2))
			{
				$return .= '<div class="col-md-4 col-sm-4 col-xs-4 pblctn_vdo_bg">';
					$return .= '<a href="'.$link2.'"><img width="274" height="160" src="'. $src2 .'"></a>';
					$return .= '<p>'. $text2 .'</p>';
				$return .= '</div>';
			}
		}
		
		if(isset($media_type3) && !empty($media_type3) && strtolower($media_type3) == 'video')
		{
			if(isset($text3) && !empty($text3) && isset($src3) && !empty($src3))
			{
				$return .= '<div class="col-md-4 col-sm-4 col-xs-4 pblctn_vdo_bg">';
					$return .= '<iframe width="274" height="160" src="'. $src3 .'" frameborder="0" allowfullscreen></iframe>';
					$return .= '<p>'. $text3 .'</p>';
				$return .= '</div>';
			}
		}
		else
		{
			if(isset($text3) && !empty($text3) && isset($src3) && !empty($src3))
			{
				$return .= '<div class="col-md-4 col-sm-4 col-xs-4 pblctn_vdo_bg">';
					$return .= '<a href="'.$link3.'"><img width="274" height="160" src="'. $src3 .'"></a>';
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
				$return .= '<div class="col-md-6 col-sm-12 col-xs-12 pblctn_vdo_bg_fr_two">';
					$return .= '<iframe width="274" height="160" src="'. $src1 .'" frameborder="0" allowfullscreen></iframe>';
					$return .= '<p>'. $text1 .'</p>';
				$return .= '</div>';
			}
		}
		else
		{
			if(isset($text1) && !empty($text1) && isset($src1) && !empty($src1))
			{
				$return .= '<div class="col-md-6 col-sm-12 col-xs-12 pblctn_vdo_bg_fr_two">';
					$return .= '<a href="'.$link1.'"><img width="274" height="160" src="'. $src1 .'" ></a>';
					$return .= '<p>'. $text1 .'</p>';
				$return .= '</div>';
			}
		}
		
		if(isset($media_type2) && !empty($media_type2) && strtolower($media_type2) == 'video')
		{
			if(isset($text2) && !empty($text2) && isset($src2) && !empty($src2))
			{
				$return .= '<div class="col-md-6 col-sm-12 col-xs-12 pblctn_vdo_bg_fr_two">';
					$return .= '<iframe width="274" height="160" src="'. $src2 .'" frameborder="0" allowfullscreen></iframe>';
					$return .= '<p>'. $text2 .'</p>';
				$return .= '</div>';
			}
		}
		else
		{
			if(isset($text2) && !empty($text2) && isset($src2) && !empty($src2))
			{
				$return .= '<div class="col-md-6 col-sm-12 col-xs-12 pblctn_vdo_bg_fr_two">';
					$return .= '<a href="'.$link2.'"><img width="274" height="160" src="'. $src2 .'"></a>';
					$return .= '<p>'. $text2 .'</p>';
				$return .= '</div>';
			}
		}
		
		if(isset($media_type3) && !empty($media_type3) && strtolower($media_type3) == 'video')
		{
			if(isset($text3) && !empty($text3) && isset($src3) && !empty($src3))
			{
				$return .= '<div class="col-md-6 col-sm-12 col-xs-12 pblctn_vdo_bg_fr_two">';
					$return .= '<iframe width="274" height="160" src="'. $src3 .'" frameborder="0" allowfullscreen></iframe>';
					$return .= '<p>'. $text3 .'</p>';
				$return .= '</div>';
			}
		}
		else
		{
			if(isset($text3) && !empty($text3) && isset($src3) && !empty($src3))
			{
				$return .= '<div class="col-md-6 col-sm-12 col-xs-12 pblctn_vdo_bg_fr_two">';
					$return .= '<a href="'.$link3.'"><img width="274" height="160" src="'. $src3 .'"></a>';
					$return .= '<p>'. $text3 .'</p>';
				$return .= '</div>';
			}
	
		}    
        $return .= '</div>';
	}
	
	return $return;   
}
?>