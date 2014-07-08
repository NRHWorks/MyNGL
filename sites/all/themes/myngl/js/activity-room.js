var scrollPosition = 0;
(function ($) {
  $(document).ready( function() {
		myngl.add_rewards_points(Drupal.settings.myngl_id, Drupal.settings.user_id, 'visiting_activi');
    $('li#play-room').removeClass("inactive").addClass("active");
    //setInterval(function() { activity_room.message(); }, 3000);
		activity_room.message();

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
			/*
      $.ajax({
        type: "GET",
        url: "/myngl-event/" + myngl_id + "/ajax/message",
        success: function(data) {
          if (data.message == '') {
            $("#myngl-event-message").animate({"height": "0"}, 200);
          } else {
            if ($("#message-span").html() != data.message) {
              $("#myngl-event-message").animate({"height": "0"}, 200, function() {
                $(this).html('<span id="message-span">' + data.message + '</span>').animate({"height": "90px"}, 1000);
              });
            }
          }
        }
      });
      */
			$("#myngl-event-message").html($("#activity-room-message").html()).animate({"height": "90px"}, 1000).css('padding-left','10px').css('padding-right','10px');

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
