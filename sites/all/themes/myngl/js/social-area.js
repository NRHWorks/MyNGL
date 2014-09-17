var ugcScrollPosition = 0;
var currently_shown_ugc = -1;
var users_tagline_and_prequestion_answers; //need to keep this info for other filters
var selected_other_filter;
var ugc_width=0;
var dock_shape = 0; //0 = single row at the bottom, 1 = full screen, -1 = completely hide
var dock_position = 0;
var redirect_setinterval_id;
var num_of_ugc;
var youtube_players = [];
var filter_answers = [];


(function ($) {
  $(document).ready( function() {
    if (Drupal.settings.developer_mode==1) {
      $('audio').trigger('pause');
        $('.fa-pause').removeClass('fa-pause').addClass('fa-play');
        background_music_playing = false;

    }

    $.getScript('https://www.youtube.com/iframe_api', function(){social_area.create_youtube_player()});


    num_of_ugc = $(".myngl-event-ugc-content").length;
    if ($.cookie('myngl_done_theater_'+Drupal.settings.myngl_id) != 1){

      $(".branded ul li#theater").removeClass('inactive');
      $(".branded ul li#play-room").removeClass('inactive');
      $(".branded ul li#gifting-suite").removeClass('inactive');

      $(".branded ul li#theater a").attr("onclick", "return false;").css("cursor", "default");
      $(".branded ul li#play-room a").attr("onclick", "return false;").css("cursor", "default");
      $(".branded ul li#gifting-suite a").attr("onclick", "return false;").css("cursor", "default");

    }


    $("#myngl-event-ugc-button").css("height", Drupal.settings.ugc_height + "%" );
    $("#myngl-event-ugc-button").css("width", Drupal.settings.ugc_width + "%");
    $("#myngl-event-ugc-button").css("left", Drupal.settings.ugc_left + "%" );
    $("#myngl-event-ugc-button").css("top", Drupal.settings.ugc_top + "%");

    $("#myngl-event-pov-button").css("height", Drupal.settings.pov_height + "%" );
    $("#myngl-event-pov-button").css("width", Drupal.settings.pov_width + "%");
    $("#myngl-event-pov-button").css("left", Drupal.settings.pov_left + "%" );
    $("#myngl-event-pov-button").css("top", Drupal.settings.pov_top + "%");

    if (Drupal.settings.show_pov_and_ugc_borders=="1") {
      $("#myngl-event-pov-button").css("border", "2px solid #ff0000" );
      $("#myngl-event-ugc-button").css("border", "2px solid #0000ff" );
    }


    $('body').css('background', "url("+Drupal.settings.lounge_background + ") center center no-repeat").css('background-size','cover');
    $.cookie('lounge_entrance_time', null); //comment this line out when it's done
    if ($.cookie('lounge_entrance_time') == null) {
      $.cookie('lounge_entrance_time', $.now());
    }


    myngl.update_participant_status(Drupal.settings.myngl_id, Drupal.settings.user_id,"Lounge");
    myngl.add_rewards_points(Drupal.settings.myngl_id, Drupal.settings.user_id, 'visiting_social');


    $("#invitee-thumb-" + Drupal.settings.user_id).addClass('this-user');
    social_area.update_tagline_and_pre_question_answers();
    setInterval(function(){myngl.update_participant_status(Drupal.settings.myngl_id, Drupal.settings.user_id,"Lounge");},20000);
    setInterval(function(){social_area.update_tagline_and_pre_question_answers();},10000);

    $('li#lounge').removeClass("inactive").addClass("active");
    setInterval(function() { social_area.message(); }, 3000);
    setInterval(function() { social_area.update_users_in_lounge(); }, 5000);
    redirect_setinterval_id = setInterval(function(){social_area.check_redirect_to_theater();},5000);

    $('#overlay-background').bind('click', function() {
      social_area.other_filter_close();
      $('#myngl-event-menu').css('display','block');
       myngl.overlay_close(true);
      return false;
    });
    /*
    $("input#group").change(function(){
      //console.log($("input#group").prop('checked'));
      var my_class = 'group-' +Drupal.settings.group_name;

      if ($("input#group").prop('checked')) {
        $(".invitee-thumb").each(function(){
          //console.log(my_class);

          if($(this).hasClass(my_class)){
            $(this).removeClass('group-hide');

          }
          else {
            $(this).addClass('group-hide');

          }
        });

        $('form#social-area-chat-list .checkbox').each(function(){
          if ($(this).hasClass(my_class)) {
            $(this).removeClass('group-hide');
          }
          else {
            $(this).addClass('group-hide').removeClass("selected");
          }

        });

      }
      else{
        $(".invitee-thumb").removeClass('group-hide');
        $("form#social-area-chat-list .checkbox").removeClass('group-hide');

      }
    });
    */

    $("input[name='filter']").change(function(){
      if ($("input[name='filter']:checked").val() == 'fb-friends'){
        //social_area.show_fb_friends();
      }
      else if ($("input[name='filter']:checked").val() == 'other') {
        social_area.show_other_filter();
      }
      else if ($("input[name='filter']:checked").val() == 'all') {
        $('.invitee-thumb').removeClass('filter-hide');
        $('form#social-area-chat-list .checkbox').removeClass('filter-hide');
      }
      else if ($("input[name='filter']:checked").val()=='group') {
        var my_class = 'group-' +Drupal.settings.group_name;
        $('.invitee-thumb').each(function(){
          if ($(this).hasClass(my_class)) {
            $(this).removeClass('filter-hide');
          }
          else {
            $(this).addClass('filter-hide');
          }

        });

        $('form#social-area-chat-list .checkbox').each(function(){
          if ($(this).hasClass(my_class)) {
            $(this).removeClass('filter-hide');
          }
          else {
            $(this).addClass('filter-hide');
          }

        });


      }
      else if ($("input[name='filter']:checked").val() == 'reps') {

        $('.invitee-thumb').each(function(){
          if ($(this).hasClass('brand-rep')) {
            $(this).removeClass('filter-hide');
          }
          else {
            $(this).addClass('filter-hide');
          }

        });

        $('form#social-area-chat-list .checkbox').each(function(){
          if ($(this).hasClass('brand-rep')) {
            $(this).removeClass('filter-hide');
          }
          else {
            $(this).addClass('filter-hide');
          }

        });

      }
      social_area.update_dock_size();
      $("#invitees-thumbs").animate({left: 0}, 400);
    });

    function get_next_row(a, b, c){
      if (a==b && a==c) {
        return 0;
      }
      else if (a==b) {
        return (a>c)?2:0;
      }
      else if (a==c) {
        return (a>b)?1:0;
      }
      else if (b==c) {
        return (a>b)?1:0;
      }
      else{
        var k = Math.min(a,b,c);
        if (k==a) {
          return 0;
        }
        else{
          return (k==b)?1:2;
        }
      }
    }

    // move each item to 3 rows
    var len_row = [0,0,0];

    for (var i = 0; i < num_of_ugc; i ++){
      var next_row = get_next_row(len_row[0], len_row[1], len_row[2]);
      //console.log($("#event-ugc-thumb-"+ i +" img").width());
      len_row[next_row] += $("#event-ugc-thumb-"+ i +" img").width()+ 10;
      $("#event-ugc-thumb-"+i).appendTo("#myngl-event-ugc-thumbs-row-"+next_row);

    }

    $("#myngl-event-ugc-thumbs-row-0").css("width", len_row[0]+"px");
    $("#myngl-event-ugc-thumbs-row-1").css("width", len_row[1]+"px");
    $("#myngl-event-ugc-thumbs-row-2").css("width", len_row[2]+"px");

    $("#myngl-event-ugc-thumbs").css('width', Math.max(len_row[0],len_row[1], len_row[2]) + 'px');

    if (Math.max(len_row[0],len_row[1], len_row[2]) <= 830) {
      $('.halfCircleRight').hide();
      $('.halfCircleLeft').hide();
    }

  });
})(jQuery);



var social_area = (function ($) {
  return {

    create_youtube_player: function(){

      $("iframe").each(function(){

        var src = $(this).attr('src');
        var video_id = src.substring(src.lastIndexOf('/')+1 , src.lastIndexOf('?')  );
        var id = $(this).attr('id');
        $(this).attr('id',id + " youtube-" + video_id );
        $(this).attr('src',src+"&enablejsapi=1");
        var player = new YT.Player($(this).attr('id'), {
          events: {
          'onStateChange': social_area.onPlayerStateChange
          }
        });
        youtube_players.push(player);
      });


    },
    onPlayerStateChange: function(e){
      /*  e.data can be:
        -1 (unstarted)
         0 (ended)
         1 (playing)
         2 (paused)
         3 (buffering)
      */


      // first we need a flag to tell if the user turns off the audio by themselves
      if (e.data==1 && !user_turn_off_music) {   // AND ther user doesn't turn off the music by themselves
        $('audio').trigger('pause');
        $('.fa-pause').removeClass('fa-pause').addClass('fa-play');
        background_music_playing = false;
      }
      else if ((e.data==0|| e.data==2)&&!user_turn_off_music) { //and the user doesn't turn off the music by themselves
        background_music_playing = true;
          $('audio').trigger('play');
          $('.fa-play').removeClass('fa-play').addClass('fa-pause');
      }


    },
    check_redirect_to_theater: function(){

      if ($.cookie('myngl_done_theater_'+Drupal.settings.myngl_id) == 1 ||Drupal.settings.developer_mode==1){
        clearInterval(redirect_setinterval_id);
        return false;
      }

      $.ajax({
        type: "GET",
        url: "/myngl-event/" + Drupal.settings.myngl_id + "/lounge-redirect-to-theater",
        success: function(data) {
          //console.log(data);
          if (data.redirect==1) {
            // commenting out for testing
              window.location="/myngl-event/" + Drupal.settings.myngl_id +"/theater";

          }
        }
      });
      return false;
    },
    search: function(){
      $("#social-area-chat-list .checkbox.in-lounge").each(function(){
        social_area.search_helper($(this));
        });
    },
    search_helper:function (this_checkbox){
      var search_text = $("#invitee-chat-selector-search input:text").val().toLowerCase();
      var checkbox_text = this_checkbox.text().toLowerCase();
      //console.log(search_text + ", " + checkbox_text);
      if (checkbox_text.indexOf(search_text)>-1) {
        this_checkbox.css('display','block');
      }
      else{
        this_checkbox.css('display','none');
      }

    },
    dock_hide: function(){
      $("#invitee-thumbs-wrapper").css("display","none");
      $(".fa-social-dock-arrow.fa-chevron-circle-down").addClass("disabled");
      dock_shape = -1;
    },
    dock_bottom: function(){
      dock_shape = 0;
      $("#invitee-thumbs-wrapper").css("display","block");
      $("#invitee-thumbs-wrapper").css("height","100px");
      $("#myngl-event-chat-button-invitees #invitee-thumbs-wrapper #invitees-thumbs").css({
          width:"100%",
          overflow:"hidden",
          left:-dock_position + "px",
        });
      social_area.update_dock_size();
      $("#dock-scroll-right").show();
      $("#dock-scroll-left").show();
      $(".fa-social-dock-arrow.fa-chevron-circle-up").removeClass("disabled");
      $(".fa-social-dock-arrow.fa-chevron-circle-down").removeClass("disabled");
      $("#invitees-thumbs").css("background","transparent");
    },
    dock_full: function(){
      dock_shape =1;
      var new_height = $(window).height() - 250;
      $("#myngl-event-chat-button-invitees #invitee-thumbs-wrapper ").css("height",new_height + "px" );
      $("#myngl-event-chat-button-invitees #invitee-thumbs-wrapper #invitees-thumbs").css({
            width:"inherit",
            overflow:"scroll",
            height:"inherit",
            left:0,
      });
      $("#dock-scroll-right").hide();
      $("#dock-scroll-left").hide();
      $(".fa-social-dock-arrow.fa-chevron-circle-up").addClass("disabled");
      $("#invitees-thumbs").css("background-color","#E2DBD2");
    },
    dock_expand: function(){
      if (dock_shape ==-1) {
        social_area.dock_bottom();
      }
      else if (dock_shape==0) {
        social_area.dock_full();
      }
    },
    dock_fold: function(){
      if (dock_shape ==1) {
        social_area.dock_bottom();
      }
      else if (dock_shape==0) {
        social_area.dock_hide();
      }
    },
    update_dock_size : function(){
      var v1 = $("#invitees-thumbs .invitee-thumb.in-lounge").length;
      var v2 = $("#invitees-thumbs .invitee-thumb.in-lounge.filter-hide").length +
               $("#invitees-thumbs .invitee-thumb.in-lounge.group-hide").length -
               $("#invitees-thumbs .invitee-thumb.in-lounge.group-hide.filter-hide").length;
      var v3 =  Drupal.settings.num_of_test_icons;

      if (dock_shape==0) { //dock is a single row at the bottom
        $("#invitee-thumbs-wrapper #invitees-thumbs").css("width", (v1 - v2 + v3)*90 );
      }
      else { // dock is fully opened.
      }
    },

    dock_scroll_right: function(){
      if ($("#invitees-thumbs").width()- $(window).width() <0) {
        return false;
      }

      dock_position = Math.min (dock_position + $(window).width(), $("#invitees-thumbs").width()- $(window).width() );
      $("#invitees-thumbs").animate({left: 0 - dock_position}, 400);


      return false;
    },
    dock_scroll_left: function(){
      if ($("#invitees-thumbs").width()- $(window).width() <0) {
        return false;
      }
      dock_position = Math.max (dock_position - $(window).width(), 0 );

      $("#invitees-thumbs").animate({left: 0 - dock_position}, 400);

      return false;
    },
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
      //console.log(users_tagline_and_prequestion_answers);
      // Update the tagline
      for (var i = 0; i < users_tagline_and_prequestion_answers.length; i ++){
        if (users_tagline_and_prequestion_answers[i].tagline!=null) {
          $("#myngl-event-invitee-info-"+ users_tagline_and_prequestion_answers[i].user_id + " span#tagline-holder").text(users_tagline_and_prequestion_answers[i].tagline);
        }
        // The following line only work if myngl_event.module line 496 is un commented (search for "city")
        //$("#myngl-event-invitee-info-"+ users_tagline_and_prequestion_answers[i].user_id + " span#city").text(users_tagline_and_prequestion_answers[i].city);
        //console.log(users_tagline_and_prequestion_answers[i]);
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
      $(("form#other-filter .question")).each(function(){
        var id_string =$(this).attr('id');
        var id = id_string.substring(id_string.lastIndexOf('-')+1, id_string.length);
        //console.log(id);
        filter_answers[id] = $("form#other-filter #question-" + id+" input:checked").val();

      });


      for (var i = 0; i < users_tagline_and_prequestion_answers.length; i ++){
        var show = true; //initially set show = true. if a test fails, then hide it.
        for (var question_id in filter_answers){
          var key = 'question-' + question_id;
          if (!(filter_answers[question_id]=='all')&&!(filter_answers[question_id]==users_tagline_and_prequestion_answers[i].pre_question_answers[key])){
            show = false;
          }
        }
        if (show) {
          $("form#social-area-chat-list #uid-"+ users_tagline_and_prequestion_answers[i].user_id).removeClass("filter-hide");
          $("#invitee-thumb-"+ users_tagline_and_prequestion_answers[i].user_id).removeClass("filter-hide");
        }
        else {
          $("#invitee-thumb-"+ users_tagline_and_prequestion_answers[i].user_id).addClass("filter-hide");
          $("form#social-area-chat-list #uid-"+ users_tagline_and_prequestion_answers[i].user_id).addClass("filter-hide");
        }

      }

      return false;
    },

    turn_off_all_youtube_videos: function(){
      for(var i = 0; i < youtube_players.length; i++){
        youtube_players[i].pauseVideo();
      }
      if (!user_turn_off_music){
        background_music_playing = true;
        $('audio').trigger('play');
        $('.fa-play').removeClass('fa-play').addClass('fa-pause');

      }
    },
    ugc_left : function (value) {
      //console.log("left clicked, currently_shown ugc is " + currently_shown_ugc);
      social_area.turn_off_all_youtube_videos();


      if (currently_shown_ugc !=-1) {
        $("#myngl-event-ugc-content-" + currently_shown_ugc).hide();
        currently_shown_ugc = (currently_shown_ugc ==0)? num_of_ugc -1: currently_shown_ugc -1;
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
      //console.log("right clicked, currently_shown ugc is " + currently_shown_ugc);
      social_area.turn_off_all_youtube_videos();

      if (currently_shown_ugc !=-1) {
        $("#myngl-event-ugc-content-" + currently_shown_ugc).hide();
        currently_shown_ugc = (currently_shown_ugc ==num_of_ugc -1)?0: currently_shown_ugc +1;
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

      social_area.turn_off_all_youtube_videos();
      myngl.overlay_close(true);
      social_area.ugc_hide();
      if (ugc_width <=830) {

        $('.halfCircleRight').hide();
        $('.halfCircleLeft').hide();

      }
      return false;

    },
    ugc_hide : function() {

      social_area.turn_off_all_youtube_videos();
      $('.myngl-event-ugc-content').hide();
      $("#myngl-event-ugc-thumbs").fadeIn(500);
      currently_shown_ugc = -1;

      if (ugc_width <=830) {

        $('.halfCircleRight').hide();
        $('.halfCircleLeft').hide();

      }

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
      //console.log('show search');
      return false;
    },
    open_ucg: function() {
      $('#myngl-event-chat-button-invitees').fadeOut(200, function() {
        myngl.overlay('myngl-event-ugc', 520, 900);
      });
      myngl.add_rewards_points(Drupal.settings.myngl_id, Drupal.settings.user_id, 'opening_ugc_win');
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



      $('.halfCircleRight').show();
      $('.halfCircleLeft').show();



      return false;
    },

    message: function() {
      var myngl_id = Drupal.settings.myngl_id;
      var time_passed = $.now() - $.cookie('lounge_entrance_time');
      //console.log (time_passed);
      $.ajax({
        type: "GET",
        url: "/myngl-event/" + myngl_id + "/ajax/message/" + time_passed + "/0",
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
          $("#invitee-thumb-"+ uid).addClass("in-lounge").removeClass("not-in-lounge");
          $("form#social-area-chat-list #uid-" + uid).addClass("in-lounge").removeClass("not-in-lounge");

        }
        else {
          $("#invitee-thumb-"+ uid).removeClass("in-lounge"); //css('display','none');
          $("form#social-area-chat-list #uid-" + uid).removeClass("in-lounge").removeClass('selected').addClass("not-in-lounge");//.css('display','none');*/
        }
      }
      social_area.update_dock_size();
    }
  }
}(jQuery));
