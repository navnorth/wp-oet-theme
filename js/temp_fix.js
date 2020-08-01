    // This code loads the IFrame Player API code asynchronously 
/*
var tag = document.createElement('script'); 
tag.src = "http://localhost:8888/oet-test/wp-content/themes/wp-oet-theme/js/iframe_api.js"; 
var ytplayer = new Array(10); 
var yplayer;
var firstScriptTag = document.getElementsByTagName('script')[0]; 
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag); 
window.YTConfig = { host: 'https://www.youtube.com' } 
    // This code is called by the YouTube API to create the player object 
function onYouTubeIframeAPIReady(event) { 
    setTimeout(function(){  
        console.log('YT loading'); 
    }, 5000);  
    loadYTPlayers(); 
}
    var pauseFlag = false; 
    var gaSent = false; 
function onTempPlayerError(event) { 
    if (event.data) { 
        if (gaSent === false) { 
            ga('send',  'event', 'Featured Video: STEM', 'Failed', ''  ); 
            gaSent = true; 
        } 
    } 
} 
jQuery('.vdo_bg').each(function(index){
    let pId = index+1;
    let vidLink = jQuery(this).find('a.oet-video-link');
    
    vidLink.attr('data-Id',pId);
    vidLink.attr('data-target','#oet-video-overlayytvideo'+pId.toString());
    jQuery(this).find('.modal').attr('id','oet-video-overlayytvideo'+pId.toString());
    
});
function loadYTPlayers() {
    vids = ['GBT4f146h9U','Aki99TM5MMI','7ssz7ZiHoTo','OLyIZaUw0m8','0BDYGOEsSoA','yvl_xTXGcs8','V3XlKqEDtR4','QX18iiFWtP8','MJOGK--sNdY','4RvgEIJsRek'];
    jQuery.each(vids, function(key,value){
        let id = key+1;
        loadYTPlayer(value,id.toString());
    });
}
function loadYTPlayer(videoId, Id) { 
    var playerId = 'ytvideo' + Id;
    ytplayer[Id] = new YT.Player(playerId, { 
    videoId: videoId, 
    playerVars: { 
        'autoplay': 0, 
        'controls': 1, 
        'enablejsapi': 1, 
        'rel' : 0, 
        'origin' : 'https://oet-test.navigationnorth.com', 
        'host' : '//www.youtube.com' 
    }, 
    events: { 
        'onError': onTempPlayerError, 
        'onReady': onTempPlayerReady, 
        'onStateChange': onTempPlayerStateChange 
        } 
    }); 
} 
function onTempPlayerReady(event) { 
    // do nothing, no tracking needed 
} 
function onTempPlayerStateChange(event) { 
    console.log(event.target);
    var url = event.target.getVideoUrl(); 
    var match = url.match(/[?&]v=([^&]+)/); 
    if( match != null) 
    { 
        var videoId = match[1]; 
    } 
    videoId = String(videoId); 
    // track when user clicks to Play 
    if (event.data == YT.PlayerState.PLAYING) { 
        console.log('playing'); 
        ga('send','event','Featured Video: STEM','Play', videoId);
        pauseFlag = true; 
    }
    // track when user clicks to Pause 
    if (event.data == YT.PlayerState.PAUSED && pauseFlag) { 
        ga('send','event','Featured Video: STEM', 'Pause', videoId); 
        pauseFlag = false; 
    } 
    // track when video ends 
    if (event.data == YT.PlayerState.ENDED) { 
        ga('send', 'event','Featured Video: STEM', 'Finished', videoId); 
    }
} 
function oet_toggletempmodal(bol, Id){
    if (typeof(player) !== 'undefined')
        player.stopVideo();
  if(bol){ //show and play
    if (typeof(ytplayer[Id]) !== 'undefined'){ 
        ytplayer[Id].playVideo();
        jQuery('#oet-video-overlayytvideo'+Id).modal('show');
    } 
  }else{ //pause and hide
    if (typeof(ytplayer[Id]) !== 'undefined'){ 
        ytplayer[Id].pauseVideo();
        if ( typeof(ytplayer[Id]) !== 'undefined' )
            ytplayer[Id].pauseVideo()
        jQuery('#oet-video-overlayytvideo'+Id).modal('hide');
    } 
  }
}
jQuery(document).on('click','a.oet-video-link', function(e){
    e.preventDefault ? e.preventDefault() : e.returnValue = false;
    let Id = jQuery(this).attr('data-Id');
    setTimeout(function(){  
        yplayer = ytplayer[Id];
        if (typeof ytplayer[Id] !=="undefined")
            ytplayer[Id].playVideo();
    }, 2000);
});
jQuery(document).on('click','div[id^="oet-video-overlay"]', function(e){
      e.preventDefault ? e.preventDefault() : e.returnValue = false;
      setTimeout(function(){  
        oet_toggletempmodal(0, jQuery(this).attr('data-id'));
        },1000);
    })
setTimeout(function(){  
    console.log('YT loading'); 
    loadYTPlayers(); 
    if (typeof(player)!=='undefined')
        player.stopVideo();
}, 10000);  
*/