var ugcScrollPosition = 0;
var currently_shown_ugc = -1;
var users_tagline_and_prequestion_answers; //need to keep this info for other filters
var selected_other_filter;
(function ($) {
  $(document).ready( function() {
    myngl.update_participant_status(Drupal.settings.myngl_id, Drupal.settings.user_id,"Lounge");
    $("#invitee-thumb-" + Drupal.settings.user_id).addClass('this-user');
    social_area.update_tagline_and_pre_question_answers();
    setInterval(function(){myngl.update_participant_status(Drupal.settings.myngl_id, Drupal.settings.user_id,"Lounge");},20000);
    setInterval(function(){social_area.update_tagline_and_pre_question_answers();},10000);

    $('li#lounge').removeClass("inactive").addClass("active");
    setInterval(function() { social_area.message(); }, 3000);
    setInterval(function() { social_area.update_users_in_lounge(); }, 5000);

    $('#overlay-background').bind('click', function() {
      social_area.other_filter_close();
      return false;
    });


    $("input[name='filter']").change(function(){
      if ($("input[name='filter']:checked").val() == 'fb-friends'){
        social_area.show_fb_friends();
      } else if ($("input[name='filter']:checked").val() == 'other') {
        //social_area.show_other_filter();
      } else if ($("input[name='filter']:checked").val() == 'all') {
        $('.invitee-thumb').removeClass('filter-hide');
      } else if ($("input[name='filter']:checked").val() == 'reps') {

        $('.invitee-thumb').each(function(){
          if ($(this).hasClass('brand-rep')) {
            $(this).removeClass('filter-hide');
          }
          else {
            $(this).addClass('filter-hide');
          }

        });

      }
    });

    var ugc_width = 0;
    $('.event-ugc-thumb').each( function() {
      ugc_width += $(this).children('a').children('img').width();
      ugc_width += 20;
    });

    ugc_width = Math.floor(ugc_width / 3);

    $("#myngl-event-ugc-thumbs").css('width', ugc_width + 'px');


/*
    $( window ).resize(function() {
      if (($( window ).width() / $( window ).height()) > 1) {
        console.log('tall');
      } else {
        console.log('wide');
      }
    });
*/

/*
    var $container = $('#myngl-event-ugc-thumbs').imagesLoaded( function() {
      $container.isotope({
        itemSelector : '.item',
        containerStyle: { 'overflow-x' :'scroll', 'overflow-y' : 'hidden', position: 'relative'},
        resizesContainer: false,
        layoutMode: 'masonryHorizontal',
        masonryHorizontal: {
          rowHeight: 150
        }
      });
    });
*/
  });
})(jQuery);

var social_area = (function ($) {
  return {
    update_tagline_and_pre_question_answers: function(){
      $.ajax({
        type: "GET",
        url: "/myngl-event/" + Drupal.settings.myngl_id + "/invitee-info-update",
        success: function(data) {
          users_tagline_and_prequestion_answers = jQuery.parseJSON(data);
          social_area.update_tagline_and_pre_question_answers_success();
        }
      });
    },
    update_tagline_and_pre_question_answers_success: function(){
      // Update the tagline
      for (var i = 0; i < users_tagline_and_prequestion_answers.length; i ++){
        $("#myngl-event-invitee-info-"+ users_tagline_and_prequestion_answers[i].user_id + " span#tagline-holder").text(users_tagline_and_prequestion_answers[i].tagline);
        //console.log((users_tagline_and_prequestion_answers[i].pre_question_answers));

      }

      // Update other filters

      if($('form#filters input#other').is(':checked')) {
        social_area.other_filter();
      }
      return false;
    },
    show_other_filter: function(){
      $('#overlay-background').fadeIn(500);
      $('#other-filter-overlay').fadeIn(100);
    },
    other_filter_close: function(){
      $('#overlay-background').fadeOut(500);
      $('#other-filter-overlay').fadeOut(100);
    },
    other_filter: function(){

      //Get the selected answers.
      var filter_answers = [];
      var num_of_questions = $(("form#other-filter .question")).length;
      for(var i = 0; i < num_of_questions; i ++){
        filter_answers.push($("form#other-filter #question-" + i+" input:checked").val());
      }

      // Now Go through the stored user answers
      for (var i = 0; i < users_tagline_and_prequestion_answers.length; i ++){
        var show = true; //initially set show = true. if a test fails, then hide it.
        for (var j = 0; j < num_of_questions; j ++){
          var key = 'question-' + j;
          if (!(filter_answers[j]=='all')&&!(filter_answers[j]==users_tagline_and_prequestion_answers[i].pre_question_answers[key])){
            show = false;
          }
        }
        if (show) {
          $("#invitee-thumb-"+ users_tagline_and_prequestion_answers[i].user_id).removeClass("filter-hide")
        }
        else {
          $("#invitee-thumb-"+ users_tagline_and_prequestion_answers[i].user_id).addClass("filter-hide");
        }

      }
      return false;
    },

    ugc_left : function (value) {
      console.log("left clicked, currently_shown ugc is " + currently_shown_ugc);

      if (currently_shown_ugc !=-1) {
        $("#myngl-event-ugc-content-" + currently_shown_ugc).hide();
        currently_shown_ugc = (currently_shown_ugc ==0)? $('event-ugc-thumb').length -1: currently_shown_ugc -1;
        social_area.ugc_show(currently_shown_ugc);

        return false;
      }

      ugcScrollPosition += $('#myngl-event-ugc-box-inside').width();
      if (ugcScrollPosition > 0) {
        ugcScrollPosition = 0;
      }
      $('#myngl-event-ugc-box-slider').animate({'margin-left': ugcScrollPosition});
      return false;
    },
    ugc_right : function (value) {
      if (currently_shown_ugc !=-1) {
        $("#myngl-event-ugc-content-" + currently_shown_ugc).hide();
        currently_shown_ugc = (currently_shown_ugc ==$('event-ugc-thumb').length -1)?0: currently_shown_ugc +1;
        social_area.ugc_show(currently_shown_ugc);
        return false;
      }
      ugcScrollPosition -= $('#myngl-event-ugc-box-inside').width();
      if (ugcScrollPosition < (($("#myngl-event-ugc-thumbs").width() - $('#myngl-event-ugc-box-inside').width()) * -1)) {
        ugcScrollPosition = ($("#myngl-event-ugc-thumbs").width() - $('#myngl-event-ugc-box-inside').width()) * -1;
      }
      $('#myngl-event-ugc-box-slider').animate({'margin-left': ugcScrollPosition});
      return false;
    },
    ugc_close : function(){
      myngl.overlay_close(true);
      social_area.ugc_hide();
      return false;

    },
    ugc_hide : function() {
      $('.myngl-event-ugc-content').hide();
      $("#myngl-event-ugc-thumbs").fadeIn(500);
      currently_shown_ugc = -1;
      return false;
    },
    /*
    show_fb_friends : function() {
      $('#close-invitee').hide();
      $('#invitees-thumbs').css('height', '150px').css('margin-top','0px');
      $('.invitee').hide();
      $('.fb').show();
      return false;
    },
    show_in_room : function() {
      $('#close-invitee').hide();
      $('#invitees-thumbs').css('height', '150px').css('margin-top','0px');
      $('.invitee').hide();
      $('.in_room').show();
      return false;
    },
    show_all_invitees : function() {
      $('#close-invitee').show();
      $('#invitees-thumbs').css('height', '450px').css('margin-top','-300px');
      $('.invitee').show();
      return false;
    },*/
    close_invitees : function() {
      $('#close-invitee').hide();
      $('.invitee').show();
      $('#invitees-thumbs').css('height', '150px').css('margin-top','0px');
      $("input:radio").attr('checked', false);
      return false;
    },
    show_search : function() {
      console.log('show search');
      return false;
    },
    open_ucg: function() {
      $('#myngl-event-chat-button-invitees').fadeOut(200, function() {
        myngl.overlay('myngl-event-ugc', 520, 900);
      });
      /*
      setTimeout(function() {
        $('#myngl-event-ugc-thumbs').isotope({
          itemSelector : '.item',
          containerStyle: { 'overflow-x' :'scroll', 'overflow-y' : 'hidden', position: 'relative'},
          resizesContainer: false,
          layoutMode: 'masonryHorizontal',
          masonryHorizontal: {
            rowHeight: 150
          }
        });
        console.log("CHANGE");
      }, 250);
      */
      return false;
    },
    ugc_show : function(id) {
      $("#myngl-event-ugc-thumbs").hide();
      $("#myngl-event-ugc-content-" + id).fadeIn(500);
      currently_shown_ugc = id;

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
    },
    update_users_in_lounge: function(){
      $.ajax({
        type: "GET",
        url: "/myngl-event/"+ Drupal.settings.myngl_id + "/update-users-in-lounge",
        success: function(users) {
          social_area.update_users_in_lounge_success(users);
        }
      });
    },
    update_users_in_lounge_success : function (users){
      //The first element of the array is the total count. rest of the elements are the user_ids in lounge.
      $("#invitee-filters span#people-total").text(users[0]);
      $("#invitee-filters span#people-in-lounge").text(users.length -1);
      for (var i = 0; i < Drupal.settings.uids.length; i ++){
        uid = Drupal.settings.uids[i];
        if (users.indexOf(uid)!= -1) {
          $("#invitee-thumb-"+ uid).addClass("in-lounge");
          if (!$("#invitee-thumb-"+ uid).hasClass("filter-hidden")) {
            $("#invitee-thumb-"+ uid).css('display','block');
          }
          $("form#social-area-chat-list #uid-" + uid).addClass("in-lounge");
          if (!$("form#social-area-chat-list #uid-" + uid).hasClass("filter-hidden")) {
            $("form#social-area-chat-list #uid-" + uid).css('display','block');
          }
        }
        else {
          $("#invitee-thumb-"+ uid).removeClass("in-lounge").css('display','none');
          $("form#social-area-chat-list #uid-" + uid).removeClass("in-lounge").removeClass('selected').css('display','none');
        }
      }
    }
  }
}(jQuery));
