(function ($) {
  $(document).ready( function() {
    setInterval(function() { social_area.message(); }, 30000); 
    setInterval(function() { social_area.question(); }, 3000); 
    setInterval(function() { social_area.pov_message(); }, 1000); 
    
    $('#overlay-background').bind('click', function() {
      $('#myngl-event-chat-button-invitees').delay(200).fadeIn(500);
    });


    $("input[name='filter']").change(function(){
      if ($("input[@name='filter']:checked").val() == 'fb-friends'){
        social_area.show_fb_friends();
      } else if ($("input[@name='filter']:checked").val() == 'in-room') {
        social_area.show_in_room();
      } else if ($("input[@name='filter']:checked").val() == 'all') {
        social_area.show_all_invitees();
      } 
    });


  });
})(jQuery);

var social_area = (function ($) {
  return {
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
    },
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
    open_pov: function() {
      $('#myngl-event-chat-button-invitees').fadeOut(200, function() {
        myngl.overlay('myngl-event-pov', 450, 350);  
      });
      return false;
    },
    open_ucg: function() {
      $('#myngl-event-chat-button-invitees').fadeOut(200, function() {
        myngl.overlay('myngl-event-ugc', 500, 900);  
      });
      return false;
    },
    ugc_show : function(id) {
      $("#myngl-event-ugc-thumbs").hide();
      $("#myngl-event-ugc-content-" + id).fadeIn(500);
      return false;
    },
    ugc_hide : function() {
      $('.myngl-event-ugc-content').hide();
      $("#myngl-event-ugc-thumbs").fadeIn(500);
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
            if ($("#myngl-event-message").html() != data.message) {
              $("#myngl-event-message").animate({"height": "0"}, 200, function() { 
                $(this).html('<span>' + data.message + '</span>').animate({"height": "90px"}, 1000); 
              });
            } 
          }
        }
      });
    },
    question: function() {
      var myngl_id = Drupal.settings.myngl_id;

      $.ajax({
        type: "GET",
        url: "/myngl-event/" + myngl_id + "/ajax/question",
        success: function(data) {
            if ($("#myngl-event-pov-question").html() != data.question) {
              $("#myngl-event-pov-question").html(data.question); 
            } 
          }
      });
    },
    submit_message: function() {
      var myngl_id = Drupal.settings.myngl_id;
      
      $.ajax({
        type: "POST",
        url: "/myngl-event/" + myngl_id + "/ajax/post-pov-message",
        data: {'pov_message' : $('#message-input').val()}
      });
      
      $('#message-input').val('Enter Message');
      $('#message-input').addClass('form-light');    

      return false;  
    },
    pov_message: function() {
      var myngl_id = Drupal.settings.myngl_id;

      $.ajax({
        type: "GET",
        url: "/myngl-event/" + myngl_id + "/ajax/pov_message",
        success: function(data) {
            if ($("#myngl-event-pov-question").html() != data.question) {
              $("#myngl-event-pov-question").html(data.question); 
            } 
          }
      });
    },
    pov_message: function() {
      if ($("#myngl-event-pov").is(':visible')) {
        var myngl_id = Drupal.settings.myngl_id;

        $.ajax({
          type: "GET",
          url: "/myngl-event/" + myngl_id + "/ajax/pov_message",
          success: function(data) {
            $("#myngl-event-pov-wall").html('');
            data.forEach(function(entry) {
              console.log(entry);
              $("#myngl-event-pov-wall").append(entry + '<br /><br />');
            });
          }
        });
      }
    }
  }
}(jQuery));
