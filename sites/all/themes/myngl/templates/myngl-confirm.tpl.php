<?php
  global $user;
  $event_date = myngl_timing_long_date($node->field_myngl_dates['und'][$date_index]['value']);
?>

<div id="rsvp-confirm-wrapper">
  <div id="rsvp-confirm-title">WELCOME TO "<?php print $node->title; ?>"</div>
  <div id="rsvp-confirm-date"><?php print $event_date; ?></div>
  <div>
    <span class="additional-dates" style="font-size:14px; color:#957f57">Change date?
      <a href="#" onclick="return myngl.overlay('switch-date', <?php print 220 + 40* count($node->field_myngl_dates['und']);?>, 400);" style="font-size:16px; color:#555;">Click here</a>
    </span>
  </div>
  <div id="rsvp-confirm-description"><?php print $node->field_myngl_description['und'][0]['safe_value']; ?></div>
  <?php if ($user->uid == 0) : ?>
    <div id="rsvp-confirm-button"><a href="/user/register"><img src="/<?php print path_to_theme(); ?>/images/rsvp-button.png" /></a></div>
    <div id="rsvp-confirm-login">Already a member? <a href="/user">Click Here</a></div>
  <?php else : ?>
    <div id="rsvp-confirm-button"><a href="/myngl/<?php print arg(1); ?>/rsvp/complete"><img src="/<?php print path_to_theme(); ?>/images/rsvp-button.png" /></a></div>
  <?php endif; ?>
</div>

<div id="switch-date" class="overlay">
  <a href="#" onclick="return myngl.overlay_close();" class="overlay-close">X</a>
  <h2>OTHER DATES</h2>
  <p><strong><?php print $node->title; ?></strong> will also be presented on the following dates. Please select the date that works best for you:</p>
  <form id="change-date-form" style="margin-top:30px;"
    onsubmit="  myngl.overlay_close();
                console.log (jQuery.cookie('Drupal.visitor.date_index'));

                jQuery.cookie('Drupal.visitor.date_index', null, { path: '/' });
                 console.log (jQuery.cookie('Drupal.visitor.date_index'));
                jQuery.cookie('Drupal.visitor.date_index', jQuery('input:radio:checked').attr('value'), { path: '/' });
                 console.log (jQuery.cookie('Drupal.visitor.date_index'));

                jQuery('#rsvp-confirm-date').html(jQuery('input:radio:checked').siblings('div').html());
                return false;">
    <?php
      //jQuery.cookie('Drupal.visitor.rsvp_date', jQuery('input:radio:checked').val(), { path: '/' });
      // this line above were at line 35 before
      $i = 0;
      foreach ($node->field_myngl_dates['und'] as $delta =>$d) :
        if(myngl_timing_strtotime($d['value'])> time()):

          print "<div>";
          print "<input type='radio'
                        name='change-date-radio'
                        value='".$delta."'
                        count='$i'
                        style='margin-left:60px;margin-right:10px;'>";
          //print "<input type='radio' name='change-date-radio' value='".$d['value']."' count='$i' style='margin-left:60px;margin-right:10px;'>";
          print '<div style="font-size: 18px; display: inline;">' . myngl_timing_long_date($d['value']) . '</div><br /><br />';
          print "</div>";
          $i++;
        endif;
      endforeach;
    ?>
    <input type="submit" value="SUBMIT" style="font-size:24px; margin-left: 240px;"/>
  </form>
</div>
