var additional_videos_offset = 0;

(function ($) {
  $(document).ready( function(){
    if ($(".additional-video").length <=3) {
      $("#myngl-theater-see-more .fa").css('display','none');
    }

    $.cookie('theater_entrance_time', null); //comment this line out when it's done
    if ($.cookie('theater_entrance_time') == null) {
      $.cookie('theater_entrance_time', $.now());
    }
    if ($('.field-collection-item-field-theater-downloads').length<=4 ) {

      $('.halfCircleRight').hide();
      $('.halfCircleLeft').hide();
    }
    var k =$('.additional-video').length * 204;
    $("#additional-videos").css('width', k);
    console.log(k);
    myngl.update_participant_status(Drupal.settings.myngl_id, Drupal.settings.user_id,"Theater");
    setInterval(function(){myngl.update_participant_status(Drupal.settings.myngl_id, Drupal.settings.user_id,"Theater");},20000);
    myngl.add_rewards_points(Drupal.settings.myngl_id, Drupal.settings.user_id, 'visiting_theate');
    $('li#theater').removeClass("inactive").addClass("active");
    setInterval(function() { theater.message(); }, 3000);

    $("iframe.media-ustream-player").width(852).height(479).attr('id','iframe-movie');
    var viewer = UstreamEmbed('iframe-movie');
    var slides = false;
    viewer.addListener('live', function() { slides = true;  });
    viewer.addListener('offline', function(){
	if (slides == true) {
      		$('#myngl-event-menu').css('display','block');
      		$('#myngl-theater-see-more').css('display','block');
      		$("#question-form-wrapper").hide();
	}
    });
    
    $("#player").hide();
    $("#myngl-theater-see-more .additional-video a").click(function(event) {
        event.preventDefault();       
        $("#player").show();
        $("#theater-body .field-name-field-theater").hide();
                
        var aID = $(this).attr('href');
        aID = aID.replace("/watch?v=", "/embed/");
        $("#player").attr('src', aID + "?enablejsapi=1");        
    });
    
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
    additional_video_left: function(){
      var num_of_additional_videos = $('.additional-video').length;
      if (additional_videos_offset != 0) {
        additional_videos_offset --;
        $("#additional-videos").animate({left: - additional_videos_offset * 204 },200);
      }

      return false;

    },
    additional_video_right: function(){
      var num_of_additional_videos = $('.additional-video').length;
      if (additional_videos_offset < num_of_additional_videos -3) {
        additional_videos_offset ++;
        $("#additional-videos").animate({left: - additional_videos_offset * 204 },200);
      }
      return false;

    },
    message: function() {
      var myngl_id = Drupal.settings.myngl_id;
      var time_passed = $.now() - $.cookie('theater_entrance_time');
      //console.log (time_passed);
      $.ajax({
        type: "GET",
        url: "/myngl-event/" + myngl_id + "/ajax/message/" + time_passed + "/1",
        success: function(data) {
          if (data.message == '') {
            $("#myngl-event-message").css('border', '0').animate({"height": "0"}, 200);

          } else {
            if ($("#message-text").html() != data.message) {
              $("#myngl-event-message").css('border', '1px solid #000000').animate({"height": "0"}, 200, function() {
                $(this).html('<div id="message-text">' + data.message + '</div>').animate({"height": "90px"}, 1000);
              });
            }
          }
        }
      });


      /*$.ajax({
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
      });*/
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
          url: "/myngl-event/theater/question/" + myngl_id,
          data: {'question' : $('#question-input').val()}
        });

        $('#question-input').val('');
        $('#question-input').addClass('form-light');
      }

      return false;
    },

  }
}(jQuery));
