<?php global $user; ?>

<div id="rsvp-confirm-wrapper">
  <div id="rsvp-confirm-title">WELCOME TO <?php print $node->title; ?></div>
  <div id="rsvp-confirm-date"><?php print date('m.d.Y @ g:i a',strtotime($node->field_myngl_dates['und'][0]['value'])); ?> EST</div>
  <div>
    <span class="additional-dates" style="font-size:14px; color:#957f57">Change date? 
      <a href="#" onclick="return myngl.overlay('switch-date', 300, 400);" style="font-size:16px; color:#555;">Click here</a>
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
                jQuery.cookie('Drupal.visitor.rsvp_date', jQuery('input:radio:checked').val()); 
                jQuery('#rsvp-confirm-date').html(jQuery('input:radio:checked').siblings('div').html()); 
                return false;">
    <?php 
      foreach ($node->field_myngl_dates['und'] as $d) : 
        print "<div>";
        print "<input type='radio' name='change-date-radio' value='".$d['value']." EST' style='margin-left:60px;margin-right:10px;'>";
        print '<div style="font-size: 18px; display: inline;">' . myngl_long_date($d['value']) . 'EST</div><br /><br />';
        print "</div>";
      endforeach; 
    ?>
    <input type="submit" value="SUBMIT" style="font-size:24px; margin-left: 240px;"/>
  </form>
</div>
