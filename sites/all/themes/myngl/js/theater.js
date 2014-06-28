(function ($) {
  $(document).ready( function() {

    $('li#theater').removeClass("inactive").addClass("active");
    setInterval(function() { theater.message(); }, 3000);

    $("iframe.media-ustream-player").width(694).height(390).attr('id','iframe-movie');
    var viewer = UstreamEmbed('iframe-movie');
    viewer.addListener('finished', function(){
      $('#myngl-theater-see-more').css('display','block');
			$("#question-form-wrapper").hide();
    });

		$("#myngl-theater-see-more .additional-video a").attr('target','_blank');
    $('.downloads-slide:eq(0)').animate({'left':0}).addClass('active');

    var animating = false;

    $("#halfCircleLeft").bind('click', function() {

      if (animating == true) {
				return false;
			}
      if ($('.downloads-slide').length <=1){
        return false;
      }

      animating = true;

      var active = $('.downloads-slide.active');
      var next =  $('.downloads-slide:eq(' + (active.index() + 1) + ')').length ?
                  $('.downloads-slide:eq(' + (active.index() + 1) + ')')  :
                  $('.downloads-slide:eq(0)');

      next.css('left',active.width());
      active.animate({'left':'-' + active.width()});
      next.animate({'left':'0'}, {'complete':function() { animating = false}});

      active.removeClass('active');
      next.addClass('active');

      return false;
    });

    $("#halfCircleRight").bind('click', function() {

      if (animating == true)
        return false;
      if ($('.downloads-slide').length <=1){
        return false;
      }

      animating = true;

      var active = $('.downloads-slide.active');
      var last = $('.downloads-slide').last();
      var next =  (active.index() == 0) ?
                  $('.downloads-slide:eq(' + last.index() + ')') :
                  $('.downloads-slide:eq(' + (active.index() - 1) + ')');

      next.css('left',(-1 * active.width()));
      active.animate({'left':active.width()});
      next.animate({'left':'0'}, {'complete':function() { animating = false}});

      active.removeClass('active');
      next.addClass('active');

      return false;
    });

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
    },
    downloads_left : function (value) {
      console.log("downloads_left called");
      return false;
    },

    downloads_right : function (value) {
      console.log("downloads.right called");
      return false;
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
