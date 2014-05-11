(function ($) {
  $(document).ready( function() {
    setInterval(function() { social_area.message(); }, 2000); 
  });
})(jQuery);

var social_area = (function ($) {
  return {
    message: function() {
      var myngl_id = Drupal.settings.myngl_id;

      $.ajax({
        type: "GET",
        url: "/myngl-event/" + myngl_id + "/ajax/message",
        success: function(data) {
          if (data.message == '') {
            $("#myngl-event-social-area--message").fadeOut(200);
          } else {
            if ($("#myngl-event-social-area--message").html() != data.message) {
              $("#myngl-event-social-area--message").fadeOut(200, function() { $(this).html(data.message).fadeIn(1000) });
            } 
          }
        }
      });

    }
  }
}(jQuery));
