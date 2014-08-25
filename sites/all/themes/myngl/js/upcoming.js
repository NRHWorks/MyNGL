var next_scheduled_myngl_id;
var current_server_time;
var next_scheduled_event_update_in_progress = false;

(function ($) {
  $(document).ready( function() {
    next_scheduled_myngl_id = Drupal.settings.next_scheduled_myngl_id;
    current_server_time = Drupal.settings.current_server_time;
    setInterval(function() {
          current_server_time ++ ;
          upcoming.count_down();
        }, 1000);

    // remove this line when the site goes online. uncomment line 46 and 47.
    $("#content-right center #link").removeClass("hide");
  });

  $( document ).ajaxComplete(function(event, xhr, settings) {
    if (!next_scheduled_event_update_in_progress) {
      console.log("executed.");
      next_scheduled_event_update_in_progress = true;
      upcoming.update_next_scheduled_event();
      next_scheduled_event_update_in_progress = false;
    }
  });
})(jQuery);


var upcoming = (function ($) {
  return {
    update_overlay_short_date: function(){
      $(".upcoming-myngl").each(function(){
        var long_date = $(this).find('span.change-date span.date').text();
        $(this).find('span.long-date').text(long_date);
        $(this).find('span.short-date').text(long_date.substring(0, 10) );
      });
    },

    count_down: function(){
      var next_event_time = parseInt($("#upcoming-myngl-"+ next_scheduled_myngl_id+" #event-date-timestamp").text());
      var time_till_event = next_event_time - current_server_time;

      if (time_till_event<0) {

        // This two lines must be uncommented when the site goes online.
        //$("#content-right center #link").removeClass("hide");
        //$("#content-right center #count-down").css("display","none");
        return false;
      }

      var days = Math.floor(time_till_event / 86400);
      var hours = Math.floor((time_till_event % 86400) / 3600);
      var minutes = Math.floor((time_till_event % 3600)/ 60);
      var seconds = Math.floor(time_till_event % 60);

      var time_text = "";
      if (days!=0) {
        time_text = time_text + days+" days ";
      }
      if (hours!=0 || days!=0) {
        time_text = time_text + hours + " hr. ";
      }
      if (minutes!= 0 || hours!=0 || days!=0) {
        time_text = time_text + minutes + " min. ";
      }
      time_text = time_text + seconds + " sec.";
      $("#count-down #time").text(time_text);
      return false;
    },

    update_next_scheduled_event: function(){
      upcoming.update_overlay_short_date();

      $.ajax({
        type: "GET",
        url: "/myngl/next-scheduled-myngl-id/" + Drupal.settings.uid,
        async: false,
        success: function(data) {
          next_scheduled_myngl_id =data.nid;
          upcoming.swap_next_event(data);
        }
      });
    },
    swap_next_event:function (myngl_nid){
      $.ajax({
          type: "GET",
          url: "/myngl/upcoming-ajax/" + Drupal.settings.uid,
          async: false,
          success: function(data) {
            $('#content-right center').html(data);
          }
      });
    }
  }
})(jQuery);



