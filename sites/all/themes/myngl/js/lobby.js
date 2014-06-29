var apiready=0;
var intervalid;
var player;

function onYouTubeIframeAPIReady() {
  apiready= 1;
}

(function ($) {
  $(document).ready( function() {
    intervalid = setInterval(function() { youtube.loadvideo(); }, 500);
    if (jQuery.cookie('done_lobby_video') !='1') {


      $(".branded ul li#lounge").removeClass('inactive');
      $(".branded ul li#theater").removeClass('inactive');
      $(".branded ul li#play-room").removeClass('inactive');
      $(".branded ul li#gifting-suite").removeClass('inactive');

      $(".branded ul li#lounge a").attr("onclick", "return false;").css("cursor", "default");
      $(".branded ul li#theater a").attr("onclick", "return false;").css("cursor", "default");
      $(".branded ul li#play-room a").attr("onclick", "return false;").css("cursor", "default");
      $(".branded ul li#gifting-suite a").attr("onclick", "return false;").css("cursor", "default");
      $("iframe#youtube-field-player").attr('src',$("iframe#youtube-field-player").attr('src') + '&enablejsapi=1');
    }
  });
}(jQuery));

var youtube = (function ($) {
  return {
    loadvideo: function(){
      if (apiready==1) {
        player = new YT.Player('youtube-field-player', {
          events: {
          'onStateChange':youtube.onPlayerStateChange
          }
        });
        clearInterval(intervalid);
      }

    },

    onPlayerStateChange: function(evt) {

      if (evt.data == YT.PlayerState.ENDED ) {
        console.log("done");
        jQuery.cookie('done_lobby_video', '1');

        $(".branded ul li#lounge").addClass('inactive');
        $(".branded ul li#theater").addClass('inactive');
        $(".branded ul li#play-room").addClass('inactive');
        $(".branded ul li#gifting-suite").addClass('inactive');

        $(".branded ul li#lounge a").removeAttr("onclick").css("cursor", "auto");
        $(".branded ul li#theater a").removeAttr("onclick").css("cursor", "auto");
        $(".branded ul li#play-room a").removeAttr("onclick").css("cursor", "auto");
        $(".branded ul li#gifting-suite a").removeAttr("onclick").css("cursor", "auto");
      }
    },
  }
}(jQuery));
