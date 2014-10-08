(function ($) {
  $(document).ready( function(){
    setInterval(function(){
      $.ajax({
          type: "GET",
          url: "/node/"+ Drupal.settings.myngl_id+"/theater-message-ajax-fetch" ,
          success: function(data) {

            for(var i in data){
              var date = data[i].date;
              if ($("#question-"+date).length ==0) {
                $("#question-list").prepend('<div class="question" id="question-' + date + '">'+ data[i].question+"<hr/></div>");
              }
            }
          }
      });
    }, 3000);
  });
}(jQuery));
