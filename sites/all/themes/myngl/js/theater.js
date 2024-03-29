var additional_videos_offset = 0;
var newest_video = null;
var viewer = null;
var main_youtube_player = null;


(function ($) {
  $(document).ready( function(){

    if ($("iframe.media-youtube-player").length !=0) {
      var src = $("iframe.media-youtube-player").attr('src');
      $("iframe.media-youtube-player").attr("src", src + '&enablejsapi=1');
      $.getScript('http://www.youtube.com/iframe_api', function(){
        theater.create_youtube_player()});
    }


    if ($.cookie("myngl_done_theater_"+Drupal.settings.myngl_id)==1) {
      $('#myngl-theater-see-more').css('display','block');
      $("#question-form-wrapper").hide();
      $('#myngl-event-menu').css('display','block');
    }

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

    myngl.update_participant_status(Drupal.settings.myngl_id, Drupal.settings.user_id,"Theater");
    myngl.add_rewards_points(Drupal.settings.myngl_id, Drupal.settings.user_id, 'visiting_theate');
    $('li#theater').removeClass("inactive").addClass("active");
     theater.message();

    $("iframe.media-ustream-player").width(852).height(479).attr('id','iframe-movie');
    $("iframe.media-youtube-player").width(852).height(479).attr('id','iframe-movie');

    viewer = UstreamEmbed('iframe-movie');
    var slides = false;
    viewer.addListener('live', function() {
      slides = true;
      });
    viewer.addListener('finished', function(){

        theater.show_menu_and_additional_items();
        //theater.show_latest_video();

    })
    viewer.addListener('offline', function(){
      //console.log('offilen');
      if (slides == true) {
        theater.show_menu_and_additional_items();
        theater.show_latest_video();

      }
    });
    viewer.getProperty('content', function (content) {

      var channel_id = content[1];
      $.ajax({
          type: "GET",
          url: "http://api.ustream.tv/json/channel/" + channel_id +"/getInfo" ,
          dataType: 'jsonp',
          success: function(data) {
            var user_id = data.user.id;
            $.ajax({
              type: "GET",
              url: "http://api.ustream.tv/json/user/" + user_id +"/listAllVideos" ,
              dataType: 'jsonp',
              success: function(data2) {

                  var video = data2[0];
                  for(var i in data2){
                    if (parseInt(data2[i].id)>parseInt(video.id)) {
                      video = data2[i];
                    }
                  }
                  newest_video = jQuery.extend(true, {}, video);

              }
            });
          }
      });
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

    create_youtube_player: function(){
      // Wait untill the api is loaded.
      if (typeof(YT) == 'undefined' || typeof(YT.Player) == 'undefined') {
        window.onYouTubeIframeAPIReady = function() {
          theater.create_youtube_player();
        };
        return false;
      }



      $("iframe").each(function(){
        if ($(this).attr("id")!= 'player') {
          var id = $(this).attr('id');
        console.log(id);
        main_youtube_player = new YT.Player(id, {
          events: {
          'onStateChange': theater.onPlayerStateChange
          }
        });
        }


      });


    },
    onPlayerStateChange: function(e){
      if (e.data ==0) {

        theater.show_menu_and_additional_items()
      }
      /*  e.data can be:
        -1 (unstarted)
         0 (ended)
         1 (playing)
         2 (paused)
         3 (buffering)
      */

    },



    show_latest_video: function(){
      //console.log(newest_video);
      viewer.callMethod('load', 'video', parseInt(newest_video.id));
      viewer.callMethod('stop');
    },
    show_menu_and_additional_items: function(){
    		$('#myngl-event-menu').css('display','block');
    		$('#myngl-theater-see-more').css('display','block');
    		$("#question-form-wrapper").hide();
        var date = new Date();
        date.setTime(date.getTime() + (240 * 60 * 1000)); // Cookie expires in 4 hours. should be enough
        $.cookie("myngl_done_theater_"+Drupal.settings.myngl_id, 1, { expires: date });
    },
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
            $("#myngl-event-message").animate({"height": "0"}, 200).hide();
          }
          else {
            if ($("#message-text").html() != data.message) {
              $("#myngl-event-message").animate({"height": "0"}, 200, function() {
                $(this).show().html('<div id="message-text">' + data.message + '</div>').animate({"height": "90px"}, 1000);
              });
            }
          }
        },
        complete: function(jqxhr, status){
          setTimeout(function(){theater.message()},5000);
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
          url: "/myngl-event/theater/question/" + myngl_id + "/"+from_uid,
          data: {'question' : $('#question-input').val()}
        });

        $('#question-input').val('');
        $('#question-input').addClass('form-light');
      }

      return false;
    },

  }
}(jQuery));
