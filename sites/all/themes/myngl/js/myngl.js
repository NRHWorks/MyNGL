(function ($) {
  $(document).ready( function() {
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
        if ($(this).val() == $(this).siblings('label').html().replace(/<span.*/,'')) {
          $(this).val('');
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
