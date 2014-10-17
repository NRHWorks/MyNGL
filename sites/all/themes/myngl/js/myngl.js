(function ($) {
  $(document).ready( function() {
    myngl.event_ends();

    $("#terms-overlay-link").click(function() {
      myngl.overlay('terms-overlay', 500, 750);
    });
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
      myngl.help_overlay_close();
    });

  });
})(jQuery);

var myngl = (function($) {
  return {
    cancel_invitation: function($myngl_id){
      $("#confirm-cancel-" + $myngl_id).fadeIn(300);
    },
    cancel_cancel: function($myngl_id){
      $("#confirm-cancel-" + $myngl_id).fadeOut(300);
    },
    add_rewards_points: function(myngl_id,user_id,field_name){
      $.ajax({
        type: "GET",
        url: "/myngl-event/" + myngl_id + "/rewards-add/" +  user_id + "/" +field_name,
        success: function(data) {
          $('.branded-secondary.point-badge p').text(data);
        }
      });
    },
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
    },

    overlay: function(content, height, width) {
      $('#overlay-background').fadeIn(500);
      $('#' + content).css('height',height).css('width',width).fadeIn(100);
      return false;
    },

    overlay_close: function(show) {
      $('#overlay-background').fadeOut(500);
      $('.overlay').fadeOut(100);
      $('.confirm-cancel').hide();
      if(show == true) {
        $('#myngl-event-chat-button-invitees').delay(200).fadeIn(500);
      }
      return false;

    },
    help_overlay_close: function(){
      $('#overlay-background').fadeOut(500);
      $('#help-overlay').fadeOut(100);
    },
    terms_overlay_close: function(){
      $('#overlay-background').fadeOut(500);
      $('#terms-overlay').fadeOut(100);
    },

    update_participant_status: function(myngl_id, user_id, status){
      $.ajax({
        type: "GET",
        url: "/myngl-event/update-status/" + myngl_id + "/" + user_id + "/" + status,
        success: function(data) {},
        complete: function(jqxhr, statuss){
            setTimeout(function(){myngl.update_participant_status(myngl_id, user_id, status)},20000);
          },
      });
    },
    event_ends: function (){
      if (Drupal.settings.myngl_id == undefined || window.location.href.indexOf("exit") > -1) {
        return false;
      }
      $.ajax({
        type: "GET",
        url: "/myngl-event/" + Drupal.settings.myngl_id + "/event-ends",
        success: function(data) {
         // console.log(data);
          if (data==1) {
            window.location="/myngl-event/" + Drupal.settings.myngl_id +"/exit";
            //consolel.log(data);
          }
        },
        complete: function(jqxhr, status){
            setTimeout(function(){myngl.event_ends()},10000);
        },
      });
      return false;
    },
    share_click: function (media, page) {
      $.ajax({
        type: "GET",
        url: "/myngl/social-sharing-record/"+ Drupal.settings.user_id +'/' +Drupal.settings.myngl_id + "/" +media+"/" + page,
        success: function(data) {
        }
      });
      return false;

    }

  }

}(jQuery));

var myngl_upcoming = (function($) {
  return {
    details: function(k) {
      $('.upcoming-myngls-pane').fadeOut(10);
      $('#upcoming-myngls-pane-details-' + k).fadeIn(100);
      return false;
    },
    details_auto: function(k) {
      $('.upcoming-myngls-pane').fadeOut(10);
      $('.upcoming-myngls-pane-details-' + k).fadeIn(100);
      return false;
    },
    upload_images: function(k) {
      $('.upcoming-myngls-pane').fadeOut(10);
      $('#upcoming-myngls-pane-upload-images-' + k).fadeIn(100);
      return false;
    },
    upload_images_auto: function(k) {
      $('.upcoming-myngls-pane').fadeOut(10);
      $('.upcoming-myngls-pane-upload-images-' + k).fadeIn(100);
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
    upload_finished: function(k, myngl_id, uid) {
      $('.upcoming-myngls-pane').fadeOut(10);
      $('#upcoming-myngls-pane-details-' + k).fadeIn(100);
      $.ajax({
        type: "GET",
        url: "/myngl-event/" + myngl_id + "/rewards-add/" + uid + "/" + "upload_ugc",
        success: function(data) {}
      });



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
