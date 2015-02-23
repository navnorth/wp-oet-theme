<?php
/**
 * Twenty Twelve Child functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 */

/**
 * Register sidebars.
 */
require_once( get_stylesheet_directory() . '/theme-functions/widget-areas.php' );

/**
 * Theme Settings.
 */
require_once( get_stylesheet_directory() . '/theme-functions/theme-options.php' );

/**
 * Theme Social Media Settings.
 */
require_once( get_stylesheet_directory() . '/theme-functions/theme-social.php' );

/**
 * Theme Shortcode.
 */
require_once( get_stylesheet_directory() . '/theme-functions/theme-shortcode.php' );

/**
 *
 * Theme Widget
 */
 require_once(get_stylesheet_directory() . '/theme-functions/custom_widget.php');

/**
 *
 * Theme Metabox
 */
 require_once(get_stylesheet_directory() . '/theme-functions/custom_metabox.php');

/**
 * Shortcode Button.
 */
 require_once( get_stylesheet_directory() . '/tinymce_button/shortcode_button.php' );

function theme_back_enqueue_script()
{
    wp_enqueue_script( 'theme-back-script', get_stylesheet_directory_uri() . '/js/back-script.js' );
	wp_enqueue_style( 'theme-back-style',get_stylesheet_directory_uri() . '/css/back-style.css' );
	wp_enqueue_style( 'tinymce_button_backend',get_stylesheet_directory_uri() . '/tinymce_button/shortcode_button.css' );
}
add_action( 'admin_enqueue_scripts', 'theme_back_enqueue_script' );

function theme_front_enqueue_script()
{
	wp_enqueue_style( 'theme-front-style',get_stylesheet_directory_uri() . '/css/front-style.css' );

	wp_enqueue_style( 'theme-main-style',get_stylesheet_directory_uri() . '/css/mainstyle.css' );
	wp_enqueue_style( 'theme-bootstrap-style',get_stylesheet_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'theme-font-style',get_stylesheet_directory_uri() . '/css/font-awesome.min.css' );

	wp_enqueue_script('jquery');
    wp_enqueue_script('theme-front-script', get_stylesheet_directory_uri() . '/js/front-script.js' );
	wp_enqueue_script('bootstrap-script', get_stylesheet_directory_uri() . '/js/bootstrap.js' );
}
add_action( 'wp_enqueue_scripts', 'theme_front_enqueue_script' );

function oer_dynamic_sidebar($index, $page_id)
{
	global $wp_registered_sidebars, $wp_registered_widgets;
	if(isset($page_id) && !empty($page_id))
	{
		$oer_assign_widget = unserialize( get_post_meta($page_id,"_oer_assign_widget",true) );

		if (!empty($index))
		{
			$sidebar = $wp_registered_sidebars[$index];
			foreach ( (array) $oer_assign_widget as $id )
			{
				if ( !isset($wp_registered_widgets[$id]) ) continue;

				$params = array_merge(
					array( array_merge( $sidebar, array('widget_id' => $id, 'widget_name' => $wp_registered_widgets[$id]['name']) ) ),
					(array) $wp_registered_widgets[$id]['params']);

				// Substitute HTML id and class attributes into before_widget
				$classname_ = '';
				foreach ( (array) $wp_registered_widgets[$id]['classname'] as $cn )
				{
					if ( is_string($cn) )
						$classname_ .= '_' . $cn;
					elseif ( is_object($cn) )
						$classname_ .= '_' . get_class($cn);
				}

				$classname_ = ltrim($classname_, '_');
				$params[0]['before_widget'] = sprintf($params[0]['before_widget'], $id, $classname_);

				$params = apply_filters( 'dynamic_sidebar_params', $params );

				$callback = $wp_registered_widgets[$id]['callback'];

				do_action( 'dynamic_sidebar', $wp_registered_widgets[ $id ] );

				if ( is_callable($callback) )
				{
					call_user_func_array($callback, $params);
					$did_one = true;
				}
			}
		}//index found
	}//pagid found
}

function the_content_filter($content) {

    $block = join("|",array("home_left_column", "home_right_column"));
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
	return $rep;
}
add_filter("the_content", "the_content_filter");

function wpse_wpautop_nobr( $content )
{
	return wpautop( $content, false );
}

function my_remove_version_info() {
     return '';
}
add_filter('the_generator', 'my_remove_version_info');

// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

// Fed Govt analytics script
function federated_analytics_tracking_code(){
    echo '<script language="javascript" id="_fed_an_ua_tag" src="http://www2.ed.gov/style/Universal-Federated-Analytics.1.0.js?ver=true&agency=ED"></script>';
}
add_action('wp_head', 'federated_analytics_tracking_code');
