(function ($) {
	$(document).ready( function() {

		$('li#theater').removeClass("inactive").addClass("active");
		setInterval(function() { theater.message(); }, 3000);

		$("iframe.media-ustream-player").width(694).height(390);
		//$('body.page-myngl-event').css('background', "#ffffff");

	});
}(jQuery));

var theater = (function ($) {
  return {

    message: function() {
      var myngl_id = Drupal.settings.myngl_id;

      $.ajax({
        type: "GET",
        url: "/myngl-event/" + myngl_id + "/ajax/theater-message",
        success: function(data) {
          if (data.message == '') {
            $("#theater-top-message").animate({"height": "0"}, 200);
          } else {
            if ($("#message-span").html() != data.message) {
              $("#theater-top-message").animate({"height": "0"}, 200, function() {
                $(this).html('<span id="message-span">' + data.message + '</span>').animate({"height": "90px"}, 1000);
              });
            }
          }
        }
      });
    }
  }
}(jQuery));


var question = (function ($) {
  var latest_mcsid = 0;

  return {
    question_submit : function() {
			var myngl_id = Drupal.settings.myngl_id;
			var from_uid = Drupal.settings.user_id;


		  if ($('#question-input').val() != '') {
        $.ajax({
          type: "POST",
          url: "/myngl-event/theater/question/" + myngl_id + "/" + from_uid,
          data: {'question' : $('#question-input').val()}
				});

        $('#question-input').val('');
				$('#question-input').addClass('form-light');
      }

      return false;
    },

  }
}(jQuery));
