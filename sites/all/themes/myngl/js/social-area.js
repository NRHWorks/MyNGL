var ugcScrollPosition = 0;
(function ($) {
  $(document).ready( function() {
    setInterval(function() { social_area.message(); }, 3000); 
    
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
    ugc_left : function (value) {
      ugcScrollPosition += $('#myngl-event-ugc-box-inside').width();

      if (ugcScrollPosition > 0) {
        ugcScrollPosition = 0;
      }

      $('#myngl-event-ugc-box-slider').animate({'margin-left': ugcScrollPosition});

      return false;
    },
    ugc_right : function (value) {
      ugcScrollPosition -= $('#myngl-event-ugc-box-inside').width();

      if (ugcScrollPosition < (($("#myngl-event-ugc-thumbs").width() - $('#myngl-event-ugc-box-inside').width()) * -1)) {
        ugcScrollPosition = ($("#myngl-event-ugc-thumbs").width() - $('#myngl-event-ugc-box-inside').width()) * -1;
      }
      
      $('#myngl-event-ugc-box-slider').animate({'margin-left': ugcScrollPosition});

      return false;
    },
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
    open_ucg: function() {
      $('#myngl-event-chat-button-invitees').fadeOut(200, function() {
        myngl.overlay('myngl-event-ugc', 500, 900);  
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
