<?php
/**
 * Twenty Twelve Child functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 */

define( 'OET_THEME_SLUG' , 'wp_oet_theme' );
define( 'OET_THEME_PATH' ,  get_stylesheet_directory() );
     
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
 
 /**
 * Shortcode Button.
 */
 require_once( get_stylesheet_directory() . '/tinymce_button/shortcode_button.php' );
 
/**
 * Dynamic Sidebar .
 */
require_once( get_stylesheet_directory() . '/theme-functions/dynamic-sidebar-init.php' );
/**
* Theme Shortcode.
*/
 require_once( get_stylesheet_directory() . '/tinymce_button/shortcode-ajax.php' );

include_once wp_normalize_path( get_stylesheet_directory() . '/vendor/autoload.php' );

use JonathanTorres\MediumSdk\Medium;

 //Add search thumbnail
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'search-thumbnail', 230, 9999 ); //230 pixels wide (and unlimited height)
}

function theme_back_enqueue_script()
{
    wp_enqueue_script( 'theme-back-script', get_stylesheet_directory_uri() . '/js/back-script.js' );
	wp_enqueue_style( 'theme-back-style',get_stylesheet_directory_uri() . '/css/back-style.css' );
	wp_enqueue_style( 'tinymce_button_backend',get_stylesheet_directory_uri() . '/tinymce_button/shortcode_button.css' );
  wp_localize_script( 'theme-back-script', 'oet_ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
  wp_enqueue_style( 'theme-bootstrap-style',get_stylesheet_directory_uri() . '/css/bootstrap.min.css' );
  wp_enqueue_script('bootstrap-script', get_stylesheet_directory_uri() . '/js/bootstrap.js' );
  wp_enqueue_style( 'shortcode-style-backend',get_stylesheet_directory_uri() . '/tinymce_button/shortcode-style.css' );
  wp_enqueue_script('shortcode_script', get_stylesheet_directory_uri() . '/tinymce_button/shortcode_script.js' );
  wp_enqueue_style( 'theme-font-style',get_stylesheet_directory_uri() . '/css/font-awesome.min.css' );
}
add_action( 'admin_enqueue_scripts', 'theme_back_enqueue_script' );

function theme_front_enqueue_script()
{
    global $csenabled, $cspage;

    $csenabled = get_option("enablecontactslider");
    $cspage = get_option("contactsliderpage");

	wp_enqueue_style( 'theme-front-style',get_stylesheet_directory_uri() . '/css/front-style.css' );

	wp_enqueue_style( 'theme-main-style',get_stylesheet_directory_uri() . '/css/mainstyle.css' );
	wp_enqueue_style( 'theme-bootstrap-style',get_stylesheet_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'theme-font-style',get_stylesheet_directory_uri() . '/css/font-awesome.min.css' );

	//Add specific Stylesheet for the contact slider template
	if ( $csenabled ) {
	    wp_enqueue_style( 'contact-slider-style',get_stylesheet_directory_uri() . '/css/slider.css' );
	}

	wp_enqueue_script('jquery');
	wp_enqueue_script('theme-front-script', get_stylesheet_directory_uri() . '/js/front-script.js' );
	wp_enqueue_script( 'ellipsis-script', get_stylesheet_directory_uri() . '/js/jquery.dotdotdot.min.js' );
	wp_enqueue_script('bootstrap-script', get_stylesheet_directory_uri() . '/js/bootstrap.js' );
	wp_enqueue_script( 'theme-back-script', get_stylesheet_directory_uri() . '/js/modernizr-custom.js' );

	//Add specific javascript for the contact slider template
	if ( $csenabled ) {
	    wp_enqueue_script('contact-slider-script', get_stylesheet_directory_uri() . '/js/slider.js' );
	}
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
        $src = esc_url( remove_query_arg( 'ver', $src ) );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

// Fed Govt analytics script
function federated_analytics_tracking_code(){
    echo '<script type="text/javascript" id="_fed_an_ua_tag" src="https://dap.digitalgov.gov/Universal-Federated-Analytics-Min.js?agency=ED"></script>';
}
add_action('wp_head', 'federated_analytics_tracking_code');

// Google Analytics script
function google_analytics_with_userid(){
    $ga_id = get_option("google_analytics_id");
    if (!empty($ga_id))
    {
	    echo "<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');";

        if(isset($_COOKIE['GAT_token']) && !empty($_COOKIE['GAT_token']))
    	{
    	    $token = htmlspecialchars($_COOKIE['GAT_token']);
    	    echo "ga('create', '" . $ga_id . "', { 'userId': '" . $token . "' });";
    	    echo "ga('set', 'dimension1', '" . $token . "');";

    	} else {
    	    echo "ga('create', '" . $ga_id . "', 'auto');";
    	}

	    echo "ga('send', 'pageview'); </script>";
    }
}
add_action('wp_head', 'google_analytics_with_userid');

function load_contact_slider() {
    global $csenabled, $cspage, $wp;
    if ( $csenabled ) {
	wp_enqueue_script('front-bottom-script', get_stylesheet_directory_uri() . '/js/front-bottom-script.js' );
?>
    <!-- Sliding div starts here -->
    <!--<div id="contact-slider" style="right:-342px;">-->
    <div id="contact-slider">
	<button id="contact-slider-sidebar" aria-expanded="false" onclick="open_panel()" data-redirect="<?php echo home_url("contact"); ?>" aria-label="Contact Us Collapsed"><img src="<?php echo get_stylesheet_directory_uri();?>/images/contact-slide-button.png" alt="Contact Us"></button>
	<div id="contact-slider-content">
	    <button class="contact-slider-close" onclick="close_panel();" tabindex="0" aria-label="Close"></button>
	    <?php
	    $cpost = get_post($cspage);
	    echo do_shortcode($cpost->post_content);
	    ?>
	</div>
    </div>
    <!-- Sliding div ends here -->
<?php
    load_recaptcha_callback_script();
    }
}
add_action( 'wp_footer' , 'load_contact_slider' );

function load_recaptcha_callback_script(){
    ?>
    <script type="text/javascript">
    var recaptchaWidgets = [];
    var recaptchaCallback = function() {
	var forms = document.getElementsByTagName( 'form' );
	var pattern = /(^|\s)g-recaptcha(\s|$)/;

	for ( var i = 0; i < forms.length; i++ ) {
		var divs = forms[ i ].getElementsByTagName( 'div' );

		for ( var j = 0; j < divs.length; j++ ) {
			var sitekey = divs[ j ].getAttribute( 'data-sitekey' );

			if ( divs[ j ].className && divs[ j ].className.match( pattern ) && sitekey ) {
				var params = {
					'sitekey': sitekey,
					'type': divs[ j ].getAttribute( 'data-type' ),
					'size': divs[ j ].getAttribute( 'data-size' ),
					'theme': divs[ j ].getAttribute( 'data-theme' ),
					'badge': divs[ j ].getAttribute( 'data-badge' ),
					'tabindex': divs[ j ].getAttribute( 'data-tabindex' )
				};

				var callback = divs[ j ].getAttribute( 'data-callback' );

				if ( callback && 'function' == typeof window[ callback ] ) {
					params[ 'callback' ] = window[ callback ];
				}

				var expired_callback = divs[ j ].getAttribute( 'data-expired-callback' );

				if ( expired_callback && 'function' == typeof window[ expired_callback ] ) {
					params[ 'expired-callback' ] = window[ expired_callback ];
				}

				var widget_id = grecaptcha.render( divs[ j ], params );
				recaptchaWidgets.push( widget_id );
				break;
			}
		}
	}
	jQuery('#cCaptcha div iframe').attr('title','Google reCaptcha');
	jQuery('#cCaptcha div iframe').attr('name','google_reCaptcha');
    };

    document.addEventListener( 'wpcf7submit', function( event ) {
	switch ( event.detail.status ) {
		case 'spam':
		case 'mail_sent':
		case 'mail_failed':
			for ( var i = 0; i < recaptchaWidgets.length; i++ ) {
				grecaptcha.reset( recaptchaWidgets[ i ] );
			}
	}
    }, false );
    </script>
    <?php
}

function get_excerpt_by_id($post_id, $word_count=55){
    $the_post = get_post($post_id); //Gets post ID
    $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
    $the_excerpt = do_shortcode($the_excerpt);

    $the_excerpt = apply_filters('the_content', $the_excerpt);
    $the_excerpt = str_replace(']]>', ']]>', $the_excerpt);

    $excerpt_length = apply_filters('excerpt_length', $word_count); //Sets excerpt length by word count

    $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');

    $the_excerpt = wp_trim_words( $the_excerpt, $excerpt_length, $excerpt_more );

    return $the_excerpt;
}


function compareType($array1, $array2) {
    if ( $array1['typeId'] == $array2['typeId'] )
        return 0;
    if ( $array1['typeId'] < $array2['typeId'] )
        return -1;
    return 1;
}

// Add DOM event Listener to Contact Form
function oet_cf7_footer() {
?>
<script type="text/javascript">
    document.addEventListener( 'wpcf7submit', function( event ) {
	setTimeout(function(){
	    jQuery('.wpcf7-response-output.wpcf7-validation-errors').attr('tabindex', '0');
	    jQuery('.wpcf7-response-output.wpcf7-validation-errors').focus();
	    //jQuery(window).scrollTop(jQuery('.wpcf7-response-output.wpcf7-validation-errors').offset().top-120);
	}, 500);
}, false );
</script>
<?php
}
add_action( 'wp_footer', 'oet_cf7_footer' );

/**
 * RSS Feed to JSON
 **/
function convert_rss_to_json($rss_feed_url){
    $api_key = "hhaqrctfimba6odysjkotqix7tgjmdii5wl1ohld";
    $count = 50;
    $url = "https://api.rss2json.com/v1/api.json?rss_url=".urlencode($rss_feed_url)."&api_key=".$api_key."&count=".$count;
    //$response = json_decode(file_get_contents($url),true);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response,true);
}

function get_medium_posts_json($json_url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $json_url);
    $response = curl_exec($ch);
    $response = str_replace("])}while(1);</x>","",$response);
    curl_close($ch);
    return json_decode($response,true);
}

/**
 * Strip Tags and Content
 **/
function strip_tags_content($text, $start_tag, $end_tag) {
    $text = preg_replace('#'.$start_tag.'(.*?)'.$end_tag.'#', '', $text, 1);
    return $text;
}

/**
 * Get Medium Publications
 **/
function getMediumPublications(){
    $publications = array();

    $client_id = get_option("mediumclientid");
    $client_secret = get_option("mediumclientsecret");
    $self_access_token = get_option("mediumaccesstoken");

    // Self Access Token Authentication
    $medium = new Medium($self_access_token);
    $user = $medium->getAuthenticatedUser();
    $publications = $medium->publications($user->data->id)->data;

    return $publications;
}

function verify_token($self_access_token){
    try {
	$medium = new OET_Medium($self_access_token);
	return $medium->get_authenticated_user();
    } catch(MediumAuthException $e){
	return false;
    }
}

function add_tag_to_pages(){
    register_taxonomy_for_object_type('post_tag', 'page');
}
add_action( "init" , "add_tag_to_pages" );

function oet_search_where($where){
    global $wpdb;
    if (is_search())
	$where .= "OR (t.name LIKE '%".get_search_query()."%' AND {$wpdb->posts}.post_status = 'publish')";
    return $where;
}
add_filter( "posts_where" , "oet_search_where" );

function oet_search_join($join){
    global $wpdb;
    if (is_search())
	$join .= "LEFT JOIN {$wpdb->term_relationships} tr ON ({$wpdb->posts}.ID = tr.object_id) LEFT JOIN {$wpdb->term_taxonomy} tt ON (tt.taxonomy = 'post_tag' AND tt.term_taxonomy_id=tr.term_taxonomy_id) LEFT JOIN {$wpdb->terms} t ON (tt.term_id = t.term_id)";
    return $join;
}
add_filter( "posts_join" , "oet_search_join" );

function oet_search_groupby($groupby){
    global $wpdb;

    // we need to group on post ID
    $groupby_id = "{$wpdb->posts}.ID";
    if(!is_search() || strpos($groupby, $groupby_id) !== false) return $groupby;

    // groupby was empty, use ours
    if(!strlen(trim($groupby))) return $groupby_id;

    // wasn't empty, append ours
    return $groupby.", ".$groupby_id;
}
add_filter('posts_groupby', 'oet_search_groupby');

function oet_test_searchwp_basic_auth_creds() {
	$credentials = array(
		'username' => 'guest', // the HTTP BASIC AUTH username
		'password' => 'wordpress'  // the HTTP BASIC AUTH password
	);

	return $credentials;
}
add_filter( 'searchwp_basic_auth_creds', 'oet_test_searchwp_basic_auth_creds' );

add_action('wp_ajax_debug_medium_connection', 'oet_debug_medium_connection');
function oet_debug_medium_connection(){
    $curl = true;
    //Checking if curl is enabled
    if (in_array("curl", get_loaded_extensions())){
	   $response = "<h4 class='green'>CURL is enabled on this server.</h4>";
    } else {
	   $response = "<h4 class='red'>CURL is not enabled on this server. Please install.</h4>";
	   $curl = false;
    }

    $self_access_token = get_option("mediumaccesstoken");

    // Self Access Token Authentication
    if ($curl){
        $oet_medium = new OET_Medium($self_access_token);
        $response .= $oet_medium->debug_medium_connection();
    }
    echo $response;

    die();
}

function display_medium_post_error($url){
    $background = "background:#757575";
    return $embed = '
    <div class="col-md-4 col-sm-6 col-xs-12">
	<div class="medium" style="'.$background.'">
	    <div class="medium-background">
		<div class="medium-wrapper">
		    <p>Medium integration temporarily unavailable - <a href="'.$url.'" target="_blank">Read the Article</a></p>
		</div>
	    </div>
	</div>
    </div>
    ';
}

/**
 * Register Sidebar metabox.
 */
function oet_register_meta_boxes() {
    add_meta_box( 'oet-sidebar-metabox-id', __( 'Sidebar', OET_THEME_SLUG ), 'oet_display_dynamic_sidebar_callback', 'page' );
}
add_action( 'add_meta_boxes', 'oet_register_meta_boxes' );
 
 /**
  * Sidebar Metabox callback
  */
 function oet_display_dynamic_sidebar_callback(){
    include_once( OET_THEME_PATH . "/theme-functions/dynamic-sidebar-metabox.php" );    
 }

 function add_modals_to_footer(){
    $screen = get_current_screen();
    if ( 'post' == $screen->base && 'page' == $screen->id ){
        include_once(OET_THEME_PATH.'/inner-templates/popups/delete-section-confirm-popup.php');
    }
}
add_action( 'admin_footer', 'add_modals_to_footer', 10 );