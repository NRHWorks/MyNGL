var apiready=0;
var intervalid;
var player;

(function ($) {
  $(document).ready( function() {
    myngl.update_participant_status(Drupal.settings.myngl_id, Drupal.settings.user_id,"Lobby");
    myngl.add_rewards_points(Drupal.settings.myngl_id, Drupal.settings.user_id, 'visiting_lobby');
    update_status_interval = setInterval(function(){myngl.update_participant_status(Drupal.settings.myngl_id, Drupal.settings.user_id,"Lobby");},20000);

    if (jQuery.cookie('done_lobby_video_'+Drupal.settings.myngl_id) !='1') {
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

    $('video').bind('ended',  function(){
        jQuery.cookie('done_lobby_video_'+Drupal.settings.myngl_id, '1');
        setTimeout(function() { 
          var lobby = window.location.href;
          var social_area = window.location.href.replace("lobby", "social-area");
          window.location.href = social_area;
        }  ,2000);
    });
  });
})(jQuery);
