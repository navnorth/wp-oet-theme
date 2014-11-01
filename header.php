<?php
/**
 * The Header template for our theme
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="container-fluid">
	<div class="container">
    
		<!------------- Logo Search & Social Icns --------------->
        <div class="row hdr">
        	<div class="col-md-7 col-sm-8 col-xs-12">
            	<a href="<?php echo site_url();?> ">
                	<img src="<?php echo get_stylesheet_directory_uri();?>/images/logo.png"/>
                </a>
            </div>
            
            <div class="col-md-3 col-sm-4 col-xs-12 col-md-offset-2">
            
            	<div class="col-md-12 col-sm-12 col-xs-5">
                	<div class="form-group has-feedback gray_bg">
                    	
                        <form id="searchform" class="searchform" action="<?php echo site_url();?>" method="get" role="search">
                        	<input type="text" class="form-control" id="inputSuccess2" placeholder="Search" name="s" />
                      		<a href="javascript:" onClick="jQuery(this).closest('form').submit()">
                                <span class="form-control-feedback ">
                              		<img src="<?php echo get_stylesheet_directory_uri();?>/images/search_icn.png">
                                </span>
                            </a>
                        </form>
                       
                    </div>
                </div>
                
                <div class="col-md-11 col-sm-12 col-xs-5 col-xs-offset-2 col-md-offset-1 soclize">
                	<a href="https://twitter.com/officeofedtech" target="_blank">
                    	<span class="socl_icns fa-stack"><i class="fa fa-twitter fa-stack-2x"></i></span>
                    </a>
                    <a href="https://www.facebook.com/officeofedtech" target="_blank">
                    	<span class="socl_icns fa-stack"><i class="fa fa-facebook fa-stack-2x"></i></span>
                    </a>
                    <a href="https://www.youtube.com/user/OfficeOfEdTech" target="_blank">
                    	<span class="socl_icns fa-stack"><i class="fa fa-youtube-play fa-stack-2x"></i></span>
                    </a>
                    <a href="https://plus.google.com/112638174472724154129/" target="_blank">
                    	<span class="socl_icns fa-stack"><i class="fa fa-google-plus fa-stack-2x"></i></span>
                    </a>
                    <a href="" target="_blank">
                    	<span class="socl_icns fa-stack"><i class="fa fa-envelope fa-stack-2x"></i></span>
                    </a>
                </div>
                
            </div>
        </div>
        
        <!------------- Top Strap & Navigation --------------->
        <div class="row top_strp"></div>
        <div class="row navi_bg">
        	<!--<button class="menu-toggle"><?php //_e( 'Menu', 'twentytwelve' ); ?></button>
			<a class="assistive-text" href="#content" title="<?php //esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>">
				<?php //_e( 'Skip to content', 'twentytwelve' ); ?>
			</a>-->
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
        </div>