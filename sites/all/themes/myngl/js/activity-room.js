var scrollPosition = 0;
(function ($) {
  $(document).ready( function() {
		$('li#activity-room').removeClass("inactive").addClass("active");

		setInterval(function() { activity_room.message(); }, 3000);

		var activity_room_width = 0;
    $('.activity-room-thumb').each( function() {
      //activity_room_width += $(this).children('a').children('img').width();
			activity_room_width += $(this).width();
      activity_room_width += 20;
			console.log(activity_room_width);
    });

    activity_room_width = Math.floor(activity_room_width / 3) + 200; /* 200 is the width of one game */
console.log(activity_room_width);
    $("#myngl-activity-room-thumbs").css('width', activity_room_width + 'px');


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
    }
  }
}(jQuery));
