var next_scheduled_myngl_id;
var current_server_time;
var next_scheduled_event_update_in_progress = false;

(function ($) {
  $(document).ready( function() {
    next_scheduled_myngl_id = Drupal.settings.next_scheduled_myngl_id;
    current_server_time = Drupal.settings.current_server_time;
    upcoming.update_overlay_short_date();
    setInterval(function() {
          current_server_time ++ ;
          upcoming.count_down();
        }, 1000);

    // remove this line when the site goes online. uncomment line 46 and 47.
    $("#content-right center #link").removeClass("hide");
  });

  $( document ).ajaxComplete(function(event, xhr, settings) {
    if (!next_scheduled_event_update_in_progress) {
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

        // This part update the "add to calendar" links"
        // long date format: 08.27.2014 @ 07:00 pm EST
        // format: 27-08-2014 19:00:00
        var timestamp = parseInt( $(this).find("#event-date-timestamp").text());
        console.log(timestamp);
        var date = new Date (timestamp * 1000);
        var end_date = new Date( (timestamp + 3600)*1000);


        var year = date.getFullYear();
        var end_year = end_date.getFullYear();

        var month = date.getMonth()+1;
        if (month<10) {
          month = "0"+month;
        }
        var end_month = end_date.getMonth()+1;
        if (end_month <10) {
          end_month = "0"+end_month;
        }

        var day = date.getDate();
        if (day<10) {
          day = "0"+day;
        }
        var end_day = end_date.getDate();
        if (end_day<10) {
          end_day = "0"+end_day;
        }

        var hour = date.getHours();
        if (hour<10) {
          hour = "0"+ hour;
        }
        var end_hour = end_date.getHours();
        if (end_hour<10) {
          end_hour = "0"+ end_hour;
        }

        var min = date.getMinutes();
        if (min<10) {
          min = "0"+ min;
        }


        var calendar_date = day+"-"+month+"-"+year+" "+hour+":"+min+":00";
        var calendar_end_date = end_day+"-"+end_month+"-"+year+" "+end_hour+":"+min+":00";

        $(this).find('.addthisevent-drop ._start').html(calendar_date);
        $(this).find('.addthisevent-drop ._end').html(calendar_end_date);

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



