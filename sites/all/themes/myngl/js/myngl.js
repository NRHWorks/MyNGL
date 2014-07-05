(function ($) {
  $(document).ready( function() {

    if ($(".field-name-field-profile-gender input#edit-profile-profile-field-profile-gender-und").prop('checked')==true) {
      $("#gender-switch-inner").css('left','50px');
    }
    else {
      $("#gender-switch-inner").css('left','10px');
    }

    if ($(".field-name-field-relationship input#edit-profile-profile-field-relationship-und").prop('checked')==true) {
      $("#status-switch-inner").css('left','50px');
    }
    else {
      $("#status-switch-inner").css('left','10px');
    }



    $("#gender-switch").click(function(){
      myngl.profile_switch_clicked('gender');
    });
    $("#status-switch").click(function(){
      myngl.profile_switch_clicked('status');
    });


    $(':text').each( function () {
      if ($(this).val() == '') {
        if ($(this).siblings('label').html()) {
          $(this).val($(this).siblings('label').html().replace(/<span.*/,'')).addClass('form-light');
        }
      }
      $(this).focus( function () {
        if ($(this).val() == $(this).siblings('label').html().replace(/<span.*/,'')) {
          $(this).val('').removeClass('form-light');
        }
      });
      $(this).blur( function () {
        if ($(this).val() == '') {
          $(this).val($(this).siblings('label').html().replace(/<span.*/,'')).addClass('form-light');
        }
      });
    });

    $('form').submit( function () {
      $(':text').each( function () {
        if ($(this).siblings('label').html()) {
          if ($(this).val() == $(this).siblings('label').html().replace(/<span.*/,'')) {
            $(this).val('');
          }
        }
      });
    });

    $(':password').each( function () {
      $(this).attr('placeholder', $(this).siblings('label').html().replace(/<span.*/,''));
    });

    $('#overlay-background').bind('click', function() {
      $('#overlay-background').hide();
      $('.overlay').hide();
    });

  });
})(jQuery);

var myngl = (function($) {
  return {
    profile_switch_clicked: function(label){
      if (label=='gender') {
        if ($(".field-name-field-profile-gender input#edit-profile-profile-field-profile-gender-und").prop('checked')==true) {
          $("#gender-switch-inner").animate({left: "10px"}, 200);
          $(".field-name-field-profile-gender input#edit-profile-profile-field-profile-gender-und").prop('checked',false);
        }
        else {
          $("#gender-switch-inner").animate({left: "50px"}, 200);
          $(".field-name-field-profile-gender input#edit-profile-profile-field-profile-gender-und").prop('checked',true);
        }
      }
      else {   // status
        if ($(".field-name-field-relationship input#edit-profile-profile-field-relationship-und").prop('checked')==true) {
          $("#status-switch-inner").animate({left: "10px"}, 200);
          $(".field-name-field-relationship input#edit-profile-profile-field-relationship-und").prop('checked',false);
        }
        else {
          $("#status-switch-inner").animate({left: "50px"}, 200);
          $(".field-name-field-relationship input#edit-profile-profile-field-relationship-und").prop('checked',true);
        }
      }

    },

    overlay: function(content, height, width) {
      $('#overlay-background').fadeIn(500);
      $('#' + content).css('height',height).css('width',width).fadeIn(100);
      return false;
    },

    overlay_close: function(show) {
      $('#overlay-background').fadeOut(500);
      $('.overlay').fadeOut(100);
      if(show == true) {
        $('#myngl-event-chat-button-invitees').delay(200).fadeIn(500);
      }
      return false;

    },
    help_overlay_close: function(){
      $('#overlay-background').fadeOut(500);
      $('#help-overlay').fadeOut(100);

    },

    update_participant_status: function(myngl_id, user_id, status){
      $.ajax({
        type: "GET",
        url: "/myngl-event/" + myngl_id + "/" + user_id + "/" + status,
        success: function(data) {}
      });


    }
    /*
    event_detail_overlay: function(myngl_id, user_id){
      $.ajax({
        type: "GET",
        url: "/myngl/"+ myngl_id + "/event-detail/"  + user_id ,
        success: function(data) {myngl.event_detail_overlay_success(data);}
      });
    },
    event_detail_overlay_success: function(data){
      //console.log(data);
      $('.event-detail-overlay').html(data[1].data).fadeIn(100);
      $('#overlay-background').fadeIn(500);


      return false;
    },
    close_event_detail: function(){
      $('#overlay-background').fadeOut(500);
       $('.event-detail-overlay').fadeOut(100);


    }*/

  }

}(jQuery));

var myngl_upcoming = (function($) {
  return {
    details: function(k) {
      $('.upcoming-myngls-pane').fadeOut(10);
      $('#upcoming-myngls-pane-details-' + k).fadeIn(100);
      return false;
    },
    upload_images: function(k) {
      $('.upcoming-myngls-pane').fadeOut(10);
      $('#upcoming-myngls-pane-upload-images-' + k).fadeIn(100);
      return false;
    },
    upload_videos: function(k) {
      $('.upcoming-myngls-pane').fadeOut(10);
      $('#upcoming-myngls-pane-upload-videos-' + k).fadeIn(100);
      return false;
    },
    upload_docs: function(k) {
      $('.upcoming-myngls-pane').fadeOut(10);
      $('#upcoming-myngls-pane-upload-docs-' + k).fadeIn(100);
      return false;
    },
    upload: function(k) {
      $('.upcoming-myngls-pane').fadeOut(10);
      $('#upcoming-myngls-pane-upload-images-' + k).fadeIn(100);
      return false;
    },
    upload_finished: function(k) {
      $('.upcoming-myngls-pane').fadeOut(10);
      $('#upcoming-myngls-pane-details-' + k).fadeIn(100);
      return false;
    },
    cancel_upload: function() {
      $('.upcoming-myngls-pane').fadeOut(10);
      return false;
    },
    change_date: function(k) {
      $('.upcoming-myngls-pane').fadeOut(10);
      $('#upcoming-myngls-pane-change-date-' + k).fadeIn(100);
      return false;
    },
    cancel_rsvp: function(k) {
      return false;
    },
    close_pane: function() {
      $('.upcoming-myngls-pane').fadeOut(100);
      return false;
    },
    change_date_submit: function(k, myngl_id, user_id, date_id) {
      alert('foo');
    }
  }

}(jQuery));
