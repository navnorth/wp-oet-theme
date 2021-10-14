<?php 
/**
 * ENQUEUE CSS & JS
 **/
add_action( 'wp_enqueue_scripts', 'oet_acf_slider_enqueue',2 );
function oet_acf_slider_enqueue() {
  global $post;
  if(!is_404()):
    if(get_field('oet_acf_slides', $post->ID)):
      wp_enqueue_style( 'oet-acf-slider-style', get_stylesheet_directory_uri() . '/modules/oet-acf-slider/css/style.css', array(), null );
      wp_enqueue_script( 'oet-acf-slider-script', get_stylesheet_directory_uri() . '/modules/oet-acf-slider/js/script.js' , array('jquery') , null, true);
  	endif;
  endif;
}

/**
 * OESE ACF SLIDER SHORTCODE
 * Shortcode Example : [oet_acf_slider]
 **/
 
 
 
 add_shortcode("oet_acf_slider", "oet_acf_slider_func" );
 function oet_acf_slider_func($_id){
    ob_start();
 		if(get_field('oet_acf_slides', $_id)):
   		 $_slides  = get_field('oet_acf_slides', $_id);
       $_slide_count = count($_slides);
       $_slider_autoplay = 1;
       $_slider_autoplay_interval = (get_field('oet_acf_seconds_between_changing_slides', $_id) * 1000);
       $_slider_animation = get_field('oet_acf_slides_animation_transition', $_id);
       
 			$_cnt = 0; $_html = '';
      ?>
      
      <div id="oet-acf-slider">
        <div class="oet-acf-slider-content-wrapper" style="display:none;">
          <div class="oet-acf-slider-wrapper">
            <div aria-live="polite" aria-atomic="true" class="oet-acf-slider-accessibility-liveregion visuallyhidden"></div>
            <ul class="slider-list">
      
            <?php
 			      foreach ($_slides as $key => $_slide):
               if(!empty($_slide['oet_acf_slide_image'])):
         					$_image_url = wp_get_attachment_image_src( $_slide['oet_acf_slide_image'], 'full' )[0];
                  if(!empty($_slide['oet_acf_slide_image'])){
                     $_image_alt = $_slide['oet_acf_slide_image_alt_text'];
                  }else{
                    if(trim($_slide['oet_acf_slide_image']['alt']," ") != ""){
                      $_image_alt = $_slide['oet_acf_slide_image_alt_text'];
                    }else{
                      $_image_alt = 'slide image '.($_cnt + 1);
                    }
                  }        
                   
         					$_image_header = trim($_slide['oet_acf_slide_header']," ");
                  $_image_description = trim($_slide['oet_acf_slide_description']," ");
         					$_image_link = trim($_slide['oet_acf_slide_button_url']," ");
                  $_image_link_target = 'target="_blank"';
         					$_vis = ($_cnt > 0)? 'style="visibility:hidden;"': '';
                  ?>
                    <li class="oet_acf_slide" data-index="<?php echo $_cnt ?>"><?php
                       $bgStyle = ' style="background-image:url('.$_image_url.');background-repeat:no-repeat;background-position:center center;background-size:cover;"'; ?>
                       <div class="oet_acf_slide_content" <?php echo $bgStyle ?>>
                         
                         <img src="<?php echo $_image_url ?>" alt="" style="display:none;">
                         <div class="oet_acf_slide_caption_wrapper">
                           <div class="oet_acf_slide_caption_block"> <?php
                               echo ($_image_header != '')?'<h2 class="oet_acf_slide_title">'.$_image_header.'</h2>': ''; ?>
                               <p class="oet_acf_slide_desc"><?php echo $_image_description ?></p>
                               <p class="oet-slide-button-row"> <?php
                                   if(!empty($_slide['oet_acf_slide_button_url'])): ?>
                                     <a href="<?php echo $_image_link ?>" class="oet-slide-button" tabindex="0" aria-label="<?php echo $_image_header ?> Read More Push Button">Read More&nbsp;&nbsp;→</a>
                                   <?php
                                   endif ?>
                               </p>
                           </div>
                         </div>
                           
                       </div>
                    </li>
                  <?php
         					$_cnt++;
               endif;
 			      endforeach;
      
            ?>
            </ul>
          </div>
          
          <?php if($_slide_count > 1){ ?> 
            <div class="oet-acf-nav-wrapper">
              <ul class="bullet-list"></ul>
            </div>
          <?php }else{
           $_slider_autoplay = 0;
          } ?>
      
        </div>
        <div class="oet-acf-slider-preloader-wrapper">
          <div class="oetslider-ring"><div></div><div></div><div></div><div></div></div>
        </div>
      </div>
              
      <script>
        jQuery(document).ready(function() {
        	jQuery("#oet-acf-slider").slider(true,'<?php echo $_slider_animation ?>',<?php echo $_slider_autoplay ?>,<?php echo $_slider_autoplay_interval ?>);
        });
      </script>
      <?php

 		endif;
     
 	  return ob_get_clean();
 }
 
 
 
/*
add_shortcode("oet_acf_slider", "oet_acf_slider_func" );
function oet_acf_slider_func($_id){
		if(get_field('oet_acf_slides', $_id)):
  			$_slides  = get_field('oet_acf_slides', $_id);
        $_slide_count = count($_slides);
        //$_slider_autoplay = (get_field('oet_acf_slides', $_id))? 1: 0;
        $_slider_autoplay = 1;
        $_slider_autoplay_interval = (get_field('oet_acf_seconds_between_changing_slides', $_id) * 1000);
        //$_slider_animation = get_field('oese_slider_animation', $_id);
        $_slider_animation = 'fade';
  			$_cnt = 0; $_html = '';
  			foreach ($_slides as $key => $_slide):
          if(!empty($_slide['oet_acf_slide_image'])):
  					$_image_url = wp_get_attachment_image_src( $_slide['oet_acf_slide_image'], 'full' )[0];
            if(!empty($_slide['oet_acf_slide_image'])){
              $_image_alt = $_slide['oet_acf_slide_image_alt_text'];
            }else{
              if(trim($_slide['oet_acf_slide_image']['alt']," ") != ""){
                  $_image_alt = $_slide['oet_acf_slide_image_alt_text'];
              }else{
                  $_image_alt = 'slide image '.($_cnt + 1);
              }
            }        
            
  					$_image_header = trim($_slide['oet_acf_slide_header']," ");
            $_image_description = trim($_slide['oet_acf_slide_description']," ");
  					$_image_link = trim($_slide['oet_acf_slide_button_url']," ");
            $_image_link_target = 'target="_blank"';

  					$_vis = ($_cnt > 0)? 'style="visibility:hidden;"': '';
                $_html .= '<li class="oet_acf_slide" data-index="'.$_cnt.'">';
                    $bgStyle = '  style="background-image:url('.$_image_url.');background-repeat:no-repeat;background-position:center center;background-size:cover;"';
                    $_html .= '<div class="oet_acf_slide_content" '.$bgStyle.'>';
                        $_caption_html = '<div class="oet_acf_slide_caption_wrapper">';
                          $_caption_html .= '<div class="oet_acf_slide_caption_block">';
                            $_caption_html .= ($_image_header != '')?'<h2 class="oet_acf_slide_title">'.$_image_header.'</h2>': '';
                            $_caption_html .= '<p class="oet_acf_slide_desc">'.$_image_description.'</p>';
                            $_caption_html .= '<p class="oet-slide-button-row">';
                                if(!empty($_slide['oet_acf_slide_button_url'])):
                                  $_caption_html .='<a href="'.$_image_link.'" class="oet-slide-button" tabindex="0" aria-label="'.$_image_header.' Read More Push Button">Read More&nbsp;&nbsp;→</a>';
                                endif;
                            $_caption_html .= '</p>';
                          $_caption_html .= '</div>';
                        $_caption_html .= '</div>';
                        $_html .= '<img src="'.$_image_url.'" style="width:100%;display:none;" alt="">';
                        $_html .= $_caption_html;
                        
                    $_html .= '</div>';
                $_html .= '</li>';
    
  					$_cnt++;
          endif;
  			endforeach;
        
        $_ret = '';
        $_ret .= '<div id="oet-acf-slider">';
          $_ret .= '<div class="oet-acf-slider-content-wrapper" style="display:none;">';
            $_ret .= '<div class="oet-acf-slider-wrapper">';
              $_ret .= '<div aria-live="polite" aria-atomic="true" class="oet-acf-slider-accessibility-liveregion visuallyhidden"></div>';
      				$_ret .= '<ul class="slider-list">'.$_html.'</ul>';
            $_ret .= '</div>';
            
            if($_slide_count > 1){
              //$_ret .= '<button class="oet-slider-sidenavs left slider-button arrow previous" role = "button" aria-label="previous slide" data-index="0">&#10094;</button>';
              //$_ret .= '<button class="oet-slider-sidenavs right slider-button arrow next" role = "button" aria-label="next slide" data-index="0">&#10095;</button>';      
              $_ret .= '<div class="oet-acf-nav-wrapper">';
              $_ret .= '<ul class="bullet-list"></ul>';
              $_ret .= '</div>';
            }else{
              $_slider_autoplay = 0;
            }
          $_ret .= '</div>';
          $_ret .= '<div class="oet-acf-slider-preloader-wrapper">';
            $_ret .= '<div class="oetslider-ring"><div></div><div></div><div></div><div></div></div>';
          $_ret .= '</div>';
        $_ret .= '</div>';
        
        $_ret .= '<script>';
          $_ret .= 'jQuery(document).ready(function() {';
          	$_ret .= 'jQuery("#oet-acf-slider").slider(true,"'.$_slider_animation.'",'.$_slider_autoplay.','.$_slider_autoplay_interval.');';
          $_ret .= '});';
        $_ret .= '</script>';
      
		endif;
    
	  return $_ret;
}
*/
?>