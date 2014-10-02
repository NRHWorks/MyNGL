var scrollPosition = 0;
(function ($) {
  $(document).ready( function() {
    $.cookie('playroom_entrance_time', null); //comment this line out when it's done
    if ($.cookie('playroom_entrance_time') == null) {
      $.cookie('playroom_entrance_time', $.now());
    }

    myngl.add_rewards_points(Drupal.settings.myngl_id, Drupal.settings.user_id, 'visiting_activi');
    $('li#play-room').removeClass("inactive").addClass("active");
    setInterval(function() { activity_room.message(); }, 3000);

    var activity_room_width = 0;
    $('.activity-room-thumb').each( function() {
      activity_room_width += $(this).width();
      activity_room_width += 10;
    });

    activity_room_width= Math.max((Math.floor( activity_room_width / (160 * 3)) + 1)*160, 800) ;
    $("#myngl-activity-room-thumbs").css('width', activity_room_width + 'px');
    myngl.update_participant_status(Drupal.settings.myngl_id, Drupal.settings.user_id,"PlayRoom");
    setInterval(function(){myngl.update_participant_status(Drupal.settings.myngl_id, Drupal.settings.user_id,"PlayRoom");},20000);
  })
}(jQuery));


var activity_room = (function ($) {
  return {
    left : function (value) {
      scrollPosition += $('#myngl-activity-room-inside').width();
      if (scrollPosition > 0) {
        scrollPosition = 0;
      }
      $('#myngl-activity-room-slider').animate({'margin-left': scrollPosition});
      return false;
    },

    right : function (value){
      scrollPosition -= $('#myngl-activity-room-inside').width();
      if (scrollPosition < (($("#myngl-activity-room-thumbs").width() - $('#myngl-activity-room-inside').width()) * -1)) {
        scrollPosition = ($("#myngl-activity-room-thumbs").width() - $('#myngl-activity-room-inside').width()) * -1;
      }
      $('#myngl-activity-room-slider').animate({'margin-left': scrollPosition});
      return false;
    },

    message: function() {
      var myngl_id = Drupal.settings.myngl_id;
      var time_passed = $.now() - $.cookie('playroom_entrance_time');
      $.ajax({
        type: "GET",
        url: "/myngl-event/" + myngl_id + "/ajax/message/" + time_passed + "/2",
        success: function(data) {
          if (data.message == '') {
            $("#myngl-event-message").animate({"height": "0"}, 200).hide();
          }
          else {
            if ($("#message-text").html() != data.message) {
              $("#myngl-event-message").animate({"height": "0"}, 200, function() {
                $(this).show().html('<div id="message-text">' + data.message + '</div>').animate({"height": "90px"}, 1000);
              });
            }
          }
        }
      });
    }
  }
}(jQuery));

var activity_overlay = (function($){
  return {
    show : function (source, width, height){
      myngl.add_rewards_points(Drupal.settings.myngl_id, Drupal.settings.user_id, 'playroom_activi');
      $('#overlay-background').fadeIn(500);
      $("iframe#activity-overlay").each( function(){
        $(this).attr("src", source);
        $(this).css('width', width);
        $(this).css('height', height);
      });
      $("#activity-iframe-wrapper").css('height',height).css('width',width).fadeIn(500);
    },
    close : function(){
      $("iframe#activity-overlay").each( function(){
        $(this).attr("src", "");
      });
      $('#overlay-background').fadeOut(500);
      $('#activity-iframe-wrapper').fadeOut(100);
    },
  }
}(jQuery));
