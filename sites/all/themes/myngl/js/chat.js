(function ($) {
  $(document).ready( function() {
    setInterval(function() { chat.get_message(); }, 2000); 
    setInterval(function() { chat.solo_fetch(); }, 2000); 
  });
})(jQuery);

var chat = (function ($) {
  var latest_mcsid = 0;

  return {
    open_chat : function() {
      $('#myngl-event-chat-button-invitees').fadeOut(200, function() {
        myngl.overlay('myngl-event-chat', 500, 450);  
      });
      return false;
    },
    get_message : function() {
      if ($("#myngl-event-chat").is(':visible')) {
        var myngl_id = Drupal.settings.myngl_id;

        $.ajax({
          type: "GET",
          url: "/myngl-chat/get-message/" + myngl_id ,
          success: function(data) {
            console.log(data);

            $("#myngl-event-chat-messages").html('');
            data.forEach(function(entry) {
              $("#myngl-event-chat-messages").append('  <div id="chat-message - ' + entry.mcid + '" class="chat-message"> <img src="' + $("#invitee-thumb-" + entry.user_id  + " img").attr('src') + '" class="chat myngl-event-profile-pic"  /> <strong>' + $("#invitee-name-" + entry.user_id).html()  + ':</strong>  ' +  entry.message + '</div>');
            });
          }
        });
      }

    }, 
    send_message : function() {
      var myngl_id = Drupal.settings.myngl_id;
     
      if ($('#chat-message-input').val() != 'Enter Message') { 
          $.ajax({
            type: "POST",
            url: "/myngl-chat/send-message/" + myngl_id + "/" + $("#chat-uid").val(),
            data: {'message' : $('#chat-message-input').val()}
          });
        
          $('#chat-message-input').val('Enter Message');
          $('#chat-message-input').addClass('form-light');    

          return false;  
        }
      },
      solo_post : function(to_uid) {
        var myngl_id = Drupal.settings.myngl_id;
        var from_uid = Drupal.settings.user_id;
     
        if ($('#solo-chat-message-input-' + to_uid).val() != 'Enter Message') { 
          $.ajax({
            type: "POST",
            url: "/myngl-chat/solo-post/" + myngl_id + "/" + from_uid + "/" + to_uid,
            data: {'message' : $('#solo-chat-message-input-' + to_uid).val()}
          });
        
          $('#solo-chat-message-input-' + to_uid).val('Enter Message');
          $('#solo-chat-message-input-' + to_uid).addClass('form-light');    
        }
          
        return false;  
      },
      solo_fetch : function () {
        var myngl_id = Drupal.settings.myngl_id;
        var user_id = Drupal.settings.user_id;

        $.ajax({
          type: "GET",
          url: "/myngl-chat/solo-fetch/" + myngl_id + "/" + user_id + "/" + latest_mcsid,
          success: function (data) {
            data.forEach( function(entry) {
              if (entry.to_user_id != user_id) {
                chat.solo_show(entry.to_user_id);
              } else {
                chat.solo_show(entry.from_user_id);
              } 
              
              if (parseInt(entry.mcsid) > latest_mcsid) {
                latest_mcsid =  parseInt(entry.mcsid);
              }
            });

            data.forEach( function(entry) {
              if (entry.to_user_id != user_id) {
                $("#myngl-event-solo-chat-messages-" + entry.to_user_id).append('<div id="solo-message-' + entry.mcsid + '" class="solo-message"> <img src="' + $("#invitee-thumb-" + entry.from_user_id  + " img").attr('src') + '" class="solo-chat myngl-event-profile-pic"  /> <strong>' + $("#invitee-name-" + entry.from_user_id).html()  + ':</strong>  ' +  entry.message + '</div>');
                $("#myngl-event-solo-chat-messages-" + entry.to_user_id).animate({ scrollTop: $("#myngl-event-solo-chat-messages-" + entry.to_user_id)[0].scrollHeight}, 10);
              } else {
                $("#myngl-event-solo-chat-messages-" + entry.from_user_id).append('<div id="solo-message-' + entry.mcsid + '" class="solo-message"> <img src="' + $("#invitee-thumb-" + entry.from_user_id  + " img").attr('src') + '" class="solo-chat myngl-event-profile-pic"  /> <strong>' + $("#invitee-name-" + entry.from_user_id).html()  + ':</strong>  ' +  entry.message + '</div>');
                $("#myngl-event-solo-chat-messages-" + entry.from_user_id).animate({ scrollTop: $("#myngl-event-solo-chat-messages-" + entry.from_user_id)[0].scrollHeight}, 10);
              } 
            });
          }
        });
      },
      solo_show : function(uid) {
        if (!($("#myngl-event-solo-chat-" + uid).hasClass('visible'))) {
          left = 25;

          $(".myngl-event-solo-chat.visible").each( function() {
            var o = $(this).offset();

            if ((left > (o.left - 25)) && (left < (o.left + 25))) {
              left = o.left + 375;
            }
          });

          $("#myngl-event-solo-chat-" + uid).css('left', left + 'px');
          
          $("#myngl-event-invitee-info-" + uid).fadeOut(100);
          $("#myngl-event-solo-chat-" + uid).fadeIn(100);
          
          $("#myngl-event-solo-chat-" + uid).addClass('visible');
          
          $("#myngl-event-solo-chat-" + uid).draggable();

          $("#myngl-event-solo-chat-" + uid).css('top', '300px');

        }

        return false;
      },
      show_invitee_info : function(uid) {
        $("#myngl-event-invitee-info-" + uid).fadeIn(100);

        var o = $("#invitee-thumb-" + uid).offset();

        $("#myngl-event-invitee-info-" + uid).css('top', (o.top - 200) + 'px');
        $("#myngl-event-invitee-info-" + uid).css('left', o.left + 'px');

        return false;
     }

    }
}(jQuery));

