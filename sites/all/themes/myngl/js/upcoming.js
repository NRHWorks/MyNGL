var next_scheduled_myngl_id;
var current_server_time;
var next_scheduled_event_update_in_progress = false;

var scroller_index = 0;
var num_of_myngls;

(function ($) {
  $(document).ready( function() {
    num_of_myngls = $('div.upcoming-myngl').length;
    next_scheduled_myngl_id = Drupal.settings.next_scheduled_myngl_id;
    current_server_time = Drupal.settings.current_server_time;
    //upcoming.update_overlay_short_date();
    setInterval(function() {
          current_server_time ++ ;
          upcoming.count_down();
        }, 1000);

    upcoming.reorder_icons();
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
        console.log("updating short date");
        var id = $(this).attr("id").substring(15);;



        var long_date = $('#upcoming-myngl-details-'+id).find('span.change-date span.date').text();
        $('#upcoming-myngl-details-'+id).find('span.long-date').text(long_date);
        $(this).find('span.short-date').text(long_date.substring(0, 10) );

        var calendar_date = $('#upcoming-myngl-details-'+id).find("#addthis-date-hidden .start").text();
        var calendar_end_date = $('#upcoming-myngl-details-'+id).find("#addthis-date-hidden .end").text();
        //var day_light_saving = ($(this).find('span.date.long-date').text().slice(-3)=="EDT")?true:false;

        $('#upcoming-myngl-details-'+id).find('.addthisevent-drop ._start').html(calendar_date);
        $('#upcoming-myngl-details-'+id).find('.addthisevent-drop ._end').html(calendar_end_date);
        $('#upcoming-myngl-details-'+id).find('span.addthisevent_dropdown').remove();


      });
      addthisevent.refresh();
      upcoming.reorder_icons();
    },
    reorder_icons:function(){
      var dates = new Array();

      $('.upcoming-myngl-detail-panels').each(function(){
         var date = $(this).find("#event-date-timestamp").text();
         var nid = $(this).attr('id').substring(23);
         dates.push({time: parseInt(date), nid: nid});

       });

      dates.sort(function(a,b){return a.time - b.time});

      var thumbs= new Array();

      for (var i = 0; i < dates.length; i ++){
       thumbs[i] = $('#upcoming-myngl-'+dates[i].nid);
       thumbs[i].remove();

      }
      for (var i = 0; i < thumbs.length; i ++){
        $("#myngl-icons-inner").append(thumbs[i]);
      }
    },

    count_down: function(){

      //UTC to EST / EDT

      //console.log("next_event_time text = " + "#upcoming-myngl-"+ next_scheduled_myngl_id+" #event-date-timestamp");
      var next_event_time = parseInt($("#upcoming-myngl-details-"+ next_scheduled_myngl_id+" #event-date-timestamp").text());

      var time_till_event = next_event_time - current_server_time;

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

var upcoming_scroll =(function ($) {
  return {
    left:function(){



      if (scroller_index==0) {
        return false;
      }
      scroller_index--;

      $( "#myngl-icons-inner" ).animate({left: 0 - scroller_index*249}, 400);




    },
    right:function(){

      if (scroller_index == num_of_myngls-3) {
        return false;
      }
      scroller_index++;


      $( "#myngl-icons-inner" ).animate({left: 0 - scroller_index*249}, 400);

     //$("#invitees-thumbs").animate({left: 0 - dock_position}, 400);



    }
  }
})(jQuery);
