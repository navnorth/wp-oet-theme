jQuery( document ).ready(function() {
    jQuery('#page_template').on('change', function() {
	  //alert(this.value);
	});
	
	jQuery(".fa-bars").click(function(){
		jQuery(".menu-primary-menu-container").css("display", "block");
		jQuery(".responsiv-menu_ul").css("display", "block");
   		jQuery(".responsiv-menu").slideToggle("slow");
 	});
	jQuery(".fa-print").click(function(){
		window.print();
	});

	/** Keyboard Navigation using Keydown event **/
	jQuery('.menu-item > a').on('keydown',function(e){
	    if (e.which==40) { /* Down Arrow Key */
		/* Check if current menu item has a child menu */
		if (jQuery(this).parent().has('.sub-menu').length > 0) {
		    subMenu = jQuery(this).parent().find('.sub-menu');
		    subMenu.show();
		    subMenu.focus();
		} else {
		    jQuery(this).parent().next().find('a').focus();
		}
	       return false;
	    }
	    if (e.which==38) { /* Up Arrow Key */
		/* Check if sub menu is visible, then hide*/
		 if (jQuery(this).parent().has('.sub-menu').is(':visible')) {
		    jQuery(this).parent().find('.sub-menu').hide();
		    jQuery(this).parent().find('.sub-menu').removeAttr('style');
		}
		return false;
	    }
	});
	jQuery('.menu-item > a').on('mouseenter' , function(){
	     if (jQuery(this).parent().has('.sub-menu')) {
		jQuery('.sub-menu').removeAttr('style');
	     }
	});
	jQuery('.menu-item > a').on('focus' , function(){
	     if (jQuery(this).parent().has('.sub-menu').length>0) {
		jQuery('.sub-menu').removeAttr('style');
	     }
	});
	
	jQuery('.main-menu ul li a').on('focus', function(){
	    if (jQuery(this).parent().has('.sub-menu').length>0) {
		jQuery(this).parent().find('.sub-menu').toggle();
	    } else {
		jQuery(this).parent().prev().find('.sub-menu').toggle();
	    }
	});
	
	if (jQuery(window).width()<=600) {
	    jQuery('.form-group.gray_bg').before('<a href="javascript:void(0)" class="mobile-search-btn"><span class="fa-stack"><i class="fa fa-search" aria-hidden="true"></i></span></a>');
	    jQuery('.mobile-search-btn').on('click', function(){
			if (jQuery('.form-group.gray_bg').is(":visible")) {
			    jQuery('.form-group.gray_bg').hide();
			    jQuery('.top_strp').css({"margin-top":"0"});
			    jQuery('.navi_icn').css({"margin-top":"-48px"})
			    jQuery('#content').css({"margin-top":"0"});
			} else {
			    jQuery('.form-group.gray_bg').show();
			    jQuery('.top_strp').css({"margin-top":"50px"});
			    jQuery('.navi_icn').css({"margin-top":"-93px"})
			    jQuery('#content').css({"margin-top":"45px"});
			}
	    });
	}
	
	//Wrap youtube video with video container
	jQuery("iframe[src*='youtube.com']").wrap("<div class='video-container'></div>");
	
	jQuery('.slideshow_description').addClass("dot-ellipsis dot-resize-update dot-load-update");
	
	//Update top level menu styles dynamically
	jQuery('.main-menu ul li a').each(function(){
	    if(jQuery(this).attr('href')=='#') {
		jQuery(this).css( { 'cursor':'default' });
	    }
	});
	
    // Replace SVGs with PNG on unsupported browsers
	if (!Modernizr.svg) {
		jQuery('img.svg-replace[src*="svg"]').attr('src', function() {
			return jQuery(this).attr('src').replace('.svg', '.png');
		});
		//jQuery('*[class=".slideshow_container_style-light .slideshow_pagination ul li"]').css('background', 'url(../images/slider_pager.png) 0 0 no-repeat !important;');
		console.log('Replaced SVG images with PNG');
	}
  
});

/*
jQuery(window).load(function(){
    var heght = jQuery("#lnk_btn_cntnr_center").children("div.col-md-8").height();
    jQuery(".link_dwnlds").height(heght);

    var a_hght = jQuery(".link_dwnlds").children("div").children("a").height();
    a_hght = parseInt(a_hght) + parseInt(30);
    var a_margin = parseInt(heght) - parseInt(a_hght);
    a_margin = a_margin/2;
    jQuery(".link_dwnlds").children("div").children("a").css("margin-top", a_margin+"px");
});
*/
function openWindow(url, title, width, height) {
  var left = (screen.width - width) / 2;
  var top = (screen.height - height) / 4;
  var popupWindow = window.open(url,
			      title,
			      'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + width + ', height=' + height + ', top=' + top + ', left=' + left);
}

jQuery.getScript('//www.youtube.com/player_api');

var arrPlayer = [];
sideytplayer = {
    init: function(container, videoId, instance) {
        if (typeof(YT) == 'undefined' || typeof(YT.Player) == 'undefined') {
            window.onYouTubePlayerAPIReady = function() {
                setTimeout(function(){ 
                    console.log('wow1');               
                    var numItems = jQuery('.oet_youtube_side_container').length;
                    jQuery('.oet_youtube_side_container').each(function() {
                        var ctrn = jQuery(this).attr('id');
                        var yid = jQuery(this).attr('yid');
                        var inst = jQuery(this).attr('inst');
                        console.log(ctrn+'--'+yid+'--'+inst);
                        sideytplayer.loadPlayer(ctrn, yid, inst);
                    });
                }, 1000);
            };
            console.log('wow2');
            //jQuery.getScript('//www.youtube.com/player_api');
        } else {
            console.log('wow3');
            sideytplayer.loadPlayer(container, videoId, instance);
        }
    },
    loadPlayer: function(container, videoId, instance) {
        arrPlayer[instance] = new YT.Player(container, {
            playerVars: {
                modestbranding: 1,
                rel: 0,
                showinfo: 0,
                autoplay: 0
            },
            height: 480,
            width: 854,
            videoId: videoId,
            events: {
                  //'onStateChange': onPlayerStateChange
            }
        });
    },
    play:function(inst){
      arrPlayer[inst].playVideo();
    },
    pause:function(inst){
      arrPlayer[inst].pauseVideo();
    }
};

window.setInterval(function(){
    jQuery('.oet-youtube-modal-wrapper .modal').focus();
}, 1000);


if (jQuery('.oet_youtube_side_container').length)
	sideytplayer.init();