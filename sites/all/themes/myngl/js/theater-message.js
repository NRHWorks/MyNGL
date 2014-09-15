(function ($) {
  $(document).ready( function(){

    setInterval(function(){
      console.log ("node/"+ Drupal.settings.myngl_id+"/theater-message-ajax-fetch");
      $.ajax({
          type: "GET",
          url: "/node/"+ Drupal.settings.myngl_id+"/theater-message-ajax-fetch" ,
          success: function(data) {

            for(var i in data){
              var delta = data[i].delta;
              if ($("#question-"+delta).length ==0) {
                $("#question-list").prepend('<div class="question" id="question-' + delta + '">'+ data[i].question+"<hr/></div>");
              }
            }
            //console.log(data);
          }
      });





    }, 3000);

  });
}(jQuery));
