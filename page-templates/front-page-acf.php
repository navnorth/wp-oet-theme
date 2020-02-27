<?php
/**
 * Template Name: ACF Home Page Template
 */
?>
<?php get_header();?>
       
<div id="content" class="row" tabindex="-1">
	<?php
		while ( have_posts() ) : the_post();
			//get_template_part( 'content', 'page' );
      /* SLIDER START */
    
      oet_display_slideshow(get_the_ID());
      
      //include(get_stylesheet_directory().'/slider/oet_slider_init.php');
      //echo do_shortcode('[slideshow_deploy id=’5528′]');
      
      
      /* SLIDER END */
      if( have_rows('oet_acf_homepage_row') ):        
        while ( have_rows('oet_acf_homepage_row') ) : the_row();
            
            $columnlayouts = array();
            if( get_row_layout() == '1_column_layout' ):
                $columnlayouts[0] = get_sub_field('oet_acf_homepage_column_1');
                foreach ($columnlayouts as $columnlayout) {  //Column FC
                  ?><div class="col-xs-12 oet_1column_layout"><?php
                  if(!empty($columnlayout)): 
                    foreach ($columnlayout as $subfieldlayout) { //Subfields FC w/in Column FC
                      if(!empty($subfieldlayout)): 
                        foreach ($subfieldlayout as $subfieldkey => $subfieldvalue) {  //subfields within Subfield FC
                          if($subfieldkey !== 'acf_fc_layout'):
                            echo $subfieldvalue.'<br>';
                          endif;
                        }
                      endif;
                    }
                  endif;
                  ?></div><?php
                }
            elseif( get_row_layout() == '2_column_layout' ): 
                $columnlayouts[0] = get_sub_field('oet_acf_homepage_column_1');
                $columnlayouts[1] = get_sub_field('oet_acf_homepage_column_2');
                ?><div class="col-xs-12 oet_acf_homepage_2column_layout ovlp"><?php
                foreach ($columnlayouts as $columnlayout) {  //Column FC
                  ?><div class="col-xs-12 col-md-6 col-lg-6 oet_2column_layout"><?php
                  if(!empty($columnlayout)): 
                    foreach ($columnlayout as $subfieldlayout) { //Subfields FC w/in Column FC
                      if(!empty($subfieldlayout)): 
                        foreach ($subfieldlayout as $subfieldkey => $subfieldvalue) {  //subfields within Subfield FC
                          if($subfieldkey !== 'acf_fc_layout'):
                            echo $subfieldvalue.'<br>';
                          endif;
                        }
                      endif;
                    }
                  endif;
                  ?></div><?php
                }?></div><?php
            elseif( get_row_layout() == '3_column_layout' ): 
                
                $columnlayouts[0] = get_sub_field('oet_acf_homepage_column_1');
                $columnlayouts[1] = get_sub_field('oet_acf_homepage_column_2');
                $columnlayouts[2] = get_sub_field('oet_acf_homepage_column_3');
                ?>
                
                <div class="col-xs-12 oet_3column_wrapper">
                    <div class="row ovlp"><?php
                    foreach ($columnlayouts as $columnlayout) {  //Column FC
                      ?><div class="col-xs-12 col-md-4 col-lg-4 oet_trendingnow_layout"><?php
                        if(!empty($columnlayout)): 
                          foreach ($columnlayout as $subfieldlayout) { //Subfields FC w/in Column FC
                            if(!empty($subfieldlayout)): 
                              foreach ($subfieldlayout as $subfieldkey => $subfieldvalue) {  //subfields within Subfield FC
                                if($subfieldkey !== 'acf_fc_layout'):
                                  ?><div class="oet-trending-image pad"><?php
                                  echo $subfieldvalue.'<br>';
                                  ?></div><?php
                                endif;
                              }
                            endif;
                          }
                        endif;
                      ?></div>
                    <?php } ?>
                  </div>
                </div><?php
                
            elseif( get_row_layout() == 'oet_act_homepage_trendingnow' ):
                $sechead = get_sub_field('oet_acf_homepage_trendingnow_section_header');        
                $columnlayouts[0] = get_sub_field('oet_acf_homepage_column_1');
                $columnlayouts[1] = get_sub_field('oet_acf_homepage_column_2');
                $columnlayouts[2] = get_sub_field('oet_acf_homepage_column_3');
                
                ?>
                <div class="col-xs-12 oet_3column_wrapper">
                    <?php if($sechead !== '' && !empty($sechead)){ ?>
                      <div class="row"><h2 class="oet-trending-section-title"><?php echo $sechead; ?></h2></div>
                    <?php } ?>
                    <div class="row ovlp"><?php
                    foreach ($columnlayouts as $columnlayout) {  //Column FC
                      ?><div class="col-xs-12 col-md-4 col-lg-4 oet_trendingnow_layout"><?php
                        if(!empty($columnlayout)): 
                        foreach ($columnlayout as $subfieldlayout) { //Subfields FC w/in Column FC
                          if(!empty($subfieldlayout)): 
                          //print_r($subfieldlayout);
                            $_img = (isset($subfieldlayout['oet_acf_homepage_trendingnow_image']['id']))? $subfieldlayout['oet_acf_homepage_trendingnow_image']['id']: $subfieldlayout['oet_acf_homepage_trendingnow_image'];
                            $_img = wp_get_attachment_url( $_img);
                            $_ico = $subfieldlayout['oet_acf_homepage_trendingnow_titleicon'];
                            $_title_icon = ($subfieldlayout['oet_acf_homepage_trendingnow_titleicon'] != 'none')? '<i class="fa '.$_ico.'"></i>&nbsp;': '';
                            $_title = $subfieldlayout['oet_acf_homepage_trendingnow_title'];
                            $_tmp = $subfieldlayout['oet_acf_homepage_trendingnow_description'];
                            $_desc = (strlen($_tmp)>210)? substr($_tmp,0,180).' ...': $_tmp;
                            $_url = $subfieldlayout['oet_acf_homepage_trendingnow_link'];
                            ?>
                              <div class="oet-trending-image pad"><img src="<?php echo $_img; ?>" alt="trending-now-image" /></div>
                              <h3 class="oet-trending-title pad"><?php echo $_title_icon; echo $_title; ?></h3>
                              <div class="oet-trending-description pad"><?php echo $_desc; ?></div>
                              <div class="oet-trending-button pad"><a href="<?php echo $_url; ?>">Read More&nbsp;&nbsp;→</a></div>
                            <?php
                          endif;
                        }
                        endif;
                      ?></div>
                    <?php } ?>
                  </div>
                </div><?php
            elseif( get_row_layout() == 'oet_act_homepage_titlelinks' ): 
                
                $tl_bg = get_sub_field('oet_acf_homepage_tilelinks_background'); 
                $tl_hds = get_sub_field('oet_acf_homepage_tilelinks_sectionheader_layout');        
                $tl_lys[0] = get_sub_field('oet_act_homepage_tilelinks_quad1');
                $tl_lys[1] = get_sub_field('oet_act_homepage_tilelinks_quad2');
                $tl_lys[2] = get_sub_field('oet_act_homepage_tilelinks_quad3');
                $tl_lys[3] = get_sub_field('oet_act_homepage_tilelinks_quad4');
                
                $tl_bgimg_default = get_stylesheet_directory_uri().'/images/tile_links_default_background.png?default';
                if(!empty($tl_bg)){
                  $tl_bgimg = (isset($tl_bg['oet_acf_homepage_titlelinks_background']['id']))? $tl_bg['oet_acf_homepage_titlelinks_background']['id']: $tl_bg;
                  $tl_bgimg = wp_get_attachment_url( $tl_bgimg);
                }else{
                  $tl_bgimg = $tl_bgimg_default;
                }
  
                ?>
                
                
                <div class="col-xs-12 oet_tilelinks_wrapper">
                  <!--<div class="oet_tilelinks_background_overlay"></div>-->
                  <div class="oet-tilelinks-content-wrapper">
                  <?php if($tl_hds !== '' && !empty($tl_hds)){ 
                    foreach ($tl_hds as $tl_hd) {
                      if(!empty($tl_hd)):
                        $tl_hdr_text = $tl_hd['oet_acf_homepage_tilelinks_sectionheader_text'];
                        $tl_hdr_fontsize = $tl_hd['oet_acf_homepage_titelinks_sectionheader_fontsize'];
                        $tl_hdr_fontcolor= $tl_hd['oet_acf_homepage_tilelinks_sectionheader_fontcolor'];
                        $tl_hdr_fontweight = $tl_hd['oet_acf_homepage_tilelinks_sectionheader_fontweight'];
                        
                        if(!empty($tl_hdr_text)){
                        ?>  
                        <div class="row"><h2 class="oet-tilelinks-section-title"><?php echo $tl_hdr_text; ?></h2></div>
                        <?php 
                        }
                    endif;
                    ?>
                    <style>
                    .oet-tilelinks-section-title{
                      font-size: <?php echo $tl_hdr_fontsize ?>px;
                      color: <?php echo $tl_hdr_fontcolor ?>;
                      font-family:'WorkSans-<?php echo $tl_hdr_fontweight ?>' !important;
                    }
                    </style>
                    <?php
                    }
                  } 
                    
                    
                  if($tl_lys !== '' && !empty($tl_lys)):
                    ?><div class="row oet-tilelinks-button-section"><?php
                    foreach ($tl_lys as $tl_ly):
                      
                      $_titlelinks_layouts = get_sub_field('oet_act_homepage_tilelinks_quad1');  
                      $lt_btn_text = $tl_ly[0]['oet_act_homepage_tilelinks_buttontext'];
                      $lt_btn_color = $tl_ly[0]['oet_act_homepage_tilelinks_buttoncolor'];
                      $lt_btn_fontcolor = $tl_ly[0]['oet_act_homepage_tilelinks_buttonfontcolor'];
                      $lt_btn_fontsize = $tl_ly[0]['oet_act_homepage_tilelinks_buttonfontsize'];
                      $lt_btn_url = $tl_ly[0]['oet_act_homepage_tilelinks_url'];
                      ?>
                          <div class="col-xs-12 col-md-6 oet-tilelinks-button-block">
                            <table border="0"><tr><td style="background-color:<?php echo $lt_btn_color ?> !important;" onclick="jQuery(this).children('a')[0].click();">
                              <a href="<?php echo ($lt_btn_url!='')? $lt_btn_url: '#'; ?>" style="color:<?php echo $lt_btn_fontcolor ?>; font-size:<?php echo $lt_btn_fontsize ?>px"><?php echo $lt_btn_text ?></a>
                            </td></tr></table>
                          </div>  
                    <?php 
                    endforeach;
                    ?></div><?php
                  endif; ?>
                    
                    
                    
                    
                  </div>  
  
                <style>
                  .oet_tilelinks_wrapper::before {
                    background-image: linear-gradient(rgba(44, 67, 116, 0.85), rgba(44, 67, 116, 0.85)), url(<?php echo $tl_bgimg ?>);
                  }
                </style>  
                </div>
                <?php
          
            elseif( get_row_layout() == 'oet_act_homepage_spacer' ):
                ?><div class="row oet-tilelinks-spacer"></div><?php    
            endif;  
            
            
        // End loop.
        endwhile;
      endif;    
		endwhile;
	?>
</div>
<?php get_footer();?>