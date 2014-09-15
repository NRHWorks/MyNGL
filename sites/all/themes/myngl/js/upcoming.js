var next_scheduled_myngl_id;
var current_server_time;
var next_scheduled_event_update_in_progress = false;
var today_is_daylight_saving_time;

(function ($) {
  $(document).ready( function() {

    Date.prototype.stdTimezoneOffset = function() {
      var jan = new Date(this.getFullYear(), 0, 1);
      var jul = new Date(this.getFullYear(), 6, 1);
      return Math.max(jan.getTimezoneOffset(), jul.getTimezoneOffset());
    }

    Date.prototype.dst = function() {
      return this.getTimezoneOffset() < this.stdTimezoneOffset();
    }

    var today = new Date();
    if (today.dst()) {
      console.log("Daylight savings time!");
      today_is_daylight_saving_time = true;
    }
    else {
      console.log("not daylight saving time");
      today_is_daylight_saving_time = false;
    }

    next_scheduled_myngl_id = Drupal.settings.next_scheduled_myngl_id;
    current_server_time = Drupal.settings.current_server_time;
    upcoming.update_overlay_short_date();
    setInterval(function() {
          current_server_time ++ ;
          upcoming.count_down();
        }, 1000);

    // remove this line when the site goes online. uncomment line 46 and 47.
    //$("#content-right center #link").removeClass("hide");
  });

  $( document ).ajaxComplete(function(event, xhr, settings) {
    $('input.form-file').val('');
    $('input.form-text').val('');
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


        var date = new Date (timestamp * 1000);

        var end_date = new Date( (timestamp + 3600)*1000);


        var year = date.getUTCFullYear();
        var end_year = end_date.getUTCFullYear();

        var month = date.getUTCMonth()+1;
        if (month<10) {
          month = "0"+month;
        }
        var end_month = end_date.getUTCMonth()+1;
        if (end_month <10) {
          end_month = "0"+end_month;
        }

        var day = date.getUTCDate();
        if (day<10) {
          day = "0"+day;
        }
        var end_day = end_date.getUTCDate();
        if (end_day<10) {
          end_day = "0"+end_day;
        }

        var hour = date.getUTCHours();

        if (hour<10) {
          hour = "0"+ hour;
        }
        var end_hour = end_date.getUTCHours();
        if (end_hour<10) {
          end_hour = "0"+ end_hour;
        }

        var min = date.getMinutes();
        if (min<10) {
          min = "0"+ min;
        }


        var calendar_date = day+"-"+month+"-"+year+" "+hour+":"+min+":00";
        var calendar_end_date = end_day+"-"+end_month+"-"+year+" "+end_hour+":"+min+":00";

        var day_light_saving = ($(this).find('span.date.long-date').text().slice(-3)=="EDT")?true:false;

        $(this).find('.addthisevent-drop ._start').html(calendar_date);
        $(this).find('.addthisevent-drop ._end').html(calendar_end_date);
        $(this).find('.addthisevent-drop ._zonecode').html(15/* (day_light_saving)?'11':'15'*/);
        $(this).find('span.addthisevent_dropdown').remove();
        addthisevent.refresh();




      });
    },

    count_down: function(){

      Date.prototype.stdTimezoneOffset = function() {
      var jan = new Date(this.getFullYear(), 0, 1);
      var jul = new Date(this.getFullYear(), 6, 1);
      return Math.max(jan.getTimezoneOffset(), jul.getTimezoneOffset());
      }

    Date.prototype.dst = function() {
      return this.getTimezoneOffset() < this.stdTimezoneOffset();
    }
    var today_is_daylight_saving_time;
    var today = new Date();
    if (today.dst()) {
      //console.log("Daylight savings time!");
      today_is_daylight_saving_time = true;
    }
    else {
      //console.log("not daylight saving time");
      today_is_daylight_saving_time = false;
    }

      //UTC to EST / EDT
      var adjusted_current_server_time = current_server_time - ((today_is_daylight_saving_time)?14400:18000);

      var next_event_time = parseInt($("#upcoming-myngl-"+ next_scheduled_myngl_id+" #event-date-timestamp").text());
      var time_till_event = next_event_time - adjusted_current_server_time;
      if ($.cookie("myngl_event_ends_"+next_scheduled_myngl_id) != null ) {
        //code

        $.removeCookie("myngl_event_ends_"+next_scheduled_myngl_id);

      }
      //console.log("current_server_time = " + current_server_time);
      //console.log('next_event_time = '+ next_event_time);

      if (time_till_event<0) {

        // This two lines must be uncommented when the site goes online.
        // To show both links, uncomment line 15 and comment out the following
        // two lines.
        $("#content-right center #link").removeClass("hide");
        $("#content-right center #count-down").css("display","none");

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



