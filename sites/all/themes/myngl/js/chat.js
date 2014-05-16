(function ($) {
  $(document).ready( function() {
    setInterval(function() { chat.get_message(); }, 2000); 
  });
})(jQuery);

var chat = (function ($) {
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
    send_solo_message : function() {
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
      show_solo_chat_bottom : function(uid) {
        $("#myngl-event-invitee-info-" + uid).fadeOut(100);
        $("#myngl-event-solo-chat-" + uid).fadeIn(100);
        
        $("#myngl-event-solo-chat-" + uid).draggable();

        var o = $("#invitee-thumb-" + uid).offset();

        $("#myngl-event-solo-chat-" + uid).css('top', (o.top - 300) + 'px');
        $("#myngl-event-solo-chat-" + uid).css('left', o.left + 'px');

        return false;
     },
      show_invitee_info : function(uid) {
        $("#myngl-event-invitee-info-" + uid).fadeIn(100);

        var o = $("#invitee-thumb-" + uid).offset();

        $("#myngl-event-invitee-info-" + uid).css('top', (o.top - 200) + 'px');
        $("#myngl-event-invitee-info-" + uid).css('left', o.left + 'px');

        return false;
     },
     show_solo_chat_top : function(uid) {
      if (!$("#myngl-event-solo-chat-" + uid).is(':visible')) {
          $("#myngl-event-solo-chat-" + uid).fadeIn(100);
          
          $("#myngl-event-solo-chat-" + uid).draggable();

          var left = 25;
          $(".myngl-event-solo-chat").each( function() {
            var o = $(this).offset();

            if ($(this).is(':visible') && ($(this).attr('id') != "myngl-event-solo-chat-" + uid)) {
              left = o.left + 350;
            }
          });

          $("#myngl-event-solo-chat-" + uid).css('top', 300 + 'px');
          $("#myngl-event-solo-chat-" + uid).css('left', left + 'px');
        }
        return false;
     }

    }
  
}(jQuery));

