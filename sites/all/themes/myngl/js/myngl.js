
(function ($) {
  $(document).ready( function() {
    $(':text').each( function () {
      if ($(this).val() == '') {
        $(this).val($(this).siblings('label').html().replace(/<span.*/,'')).addClass('form-light');
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
  });
})(jQuery);

