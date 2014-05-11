(function($) {
  Drupal.behaviors.icheck = {
    attach: function(context, settings) {
      for (var id in settings.icheck) {
        var skin = settings.icheck[id]['skin'];
        var color = settings.icheck[id]['color'];
        var classSuffix = (skin == color) ? '_' + skin : '_' + skin + '-' + color;

        // Because of AJAX, Drupal.settings are merged, so we need to get one
        // of the values.
        if (skin instanceof Array) {
          skin = skin.pop();
        }
        if (color instanceof Array) {
          color = color.pop();
        }

        // iCheck disabled click event on inputs. We need to trigger it manually.
        $('#' + id, context).on('ifChecked ifUnchecked', function(event) {
          if (event.type == 'ifChecked') {
//            console.log('icheck checked');
          }
          else if (event.type == 'ifUnchecked') {
//            console.log('icheck un-checked');
          }
          $(this).trigger('click');
          $(this).trigger('change');
        });

        if (skin == 'line') {
          // Remove old label.
          var label = $("label[for='" + id + "']");
          var label_text = label.text();
          label.remove();

          // line skin need specific label.
          $('#' + id, context).iCheck({
            checkboxClass: 'icheckbox' + classSuffix,
            radioClass: 'iradio' + classSuffix,
            insert: '<div class="icheck_line-icon"></div>' + label_text
          });
        }
        else {
          $('#' + id, context).iCheck({
            checkboxClass: 'icheckbox' + classSuffix,
            radioClass: 'iradio' + classSuffix,
          });
        }
      }
    }
  };
})(jQuery);
