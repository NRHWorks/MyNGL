
(function ($) {
  $(document).ready( function() {
    setInterval(function() { pov.fetch(); }, 2000); 
    setInterval(function() { pov.question(); }, 2000); 
  });
})(jQuery);

var pov = (function ($) {
  return {
    open : function() {
      $('#myngl-event-chat-button-invitees').fadeOut(200, function() {
        myngl.overlay('myngl-event-pov', 500, 400);  
      });
      return false;
    },
    fetch : function() {
      if ($("#myngl-event-pov").is(':visible')) {
        var myngl_id = Drupal.settings.myngl_id;

        $.ajax({
          type: "GET",
          url: "/myngl-pov/fetch/" + myngl_id + "/0",
          success: function(data) {

            $("#myngl-event-pov-wall").html('');
            data.forEach(function(entry) {
              $("#myngl-event-pov-wall").append('  <div id="pov-message - ' + entry.mpovid + '" class="pov-message"> <img src="' + $("#invitee-thumb-" + entry.user_id  + " img").attr('src') + '" class="chat myngl-event-profile-pic"  /> <strong>' + $("#invitee-name-" + entry.user_id).html()  + ':</strong>  ' +  entry.message + '</div>');
            });
          }
        });
      }

    }, 
    post : function(uid) {
      var myngl_id = Drupal.settings.myngl_id;
      
      $.ajax({
        type: "POST",
        url: "/myngl-pov/post/" + myngl_id + "/" + uid,
        data: {'message' : $('#pov-message').val()}
      });
  
      $('#pov-message').val('TYPE MESSAGE HERE.')

      return false;  
    },
    question : function() {
      var myngl_id = Drupal.settings.myngl_id;

      if ($('#myngl-event-pov').is(':visible')) {
        $.ajax({
          type: "GET",
          url: "/myngl-pov/question/" + myngl_id,
          success: function(data) {
              if ($("#myngl-event-pov-question").html() != data.question) {
                $("#myngl-event-pov-question").html(data.question); 
              } 
            }
        });
      } 

    /* 
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
*/
      }
    }
  
}(jQuery));

