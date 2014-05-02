<?php global $user; ?>

<div id="rsvp-confirm-wrapper">
  <div id="rsvp-confirm-title">WELCOME TO <?php print $node->title; ?></div>
  <div id="rsvp-confirm-date"><?php print date('m.d.Y @ g:i a',strtotime($node->field_myngl_dates['und'][0]['value'])); ?> EST</div>
  <div>
    <span class="additional-dates" style="font-size:14px; color:#957f57">For additional dates 
      <a href="#" onclick="jQuery('#other-date-blockout').show();jQuery('#other-dates-form').show(); return false;" style="font-size:16px; color:#555;">Click Here</a>
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


<div id="other-date-blockout" class="overlay-background"></div>
<div id="other-dates-form" class="overlay">
  <h2>OTHER DATES</h2>
  <p>This Myngl will also run on the following dates.  Pick one that will work for you:</p>
  <form id="change-date-form" style="margin-top:30px;" 
    onsubmit="  jQuery('#other-date-blockout').hide();
                jQuery('#other-dates-form').hide(); 
                jQuery('#rsvp-confirm-date').html(jQuery('input:radio:checked').val()); 
                return false;">
    <?php 
      foreach ($node->field_myngl_dates['und'] as $d) : 
        print "<input type='radio' name='change-date-radio' value='".date('m.d.Y @ g:i a',strtotime($d['value']))." EST' style='margin-left:60px;margin-right:10px;'>";
        print '<span style="font-size: 18px">'.date('m.d.Y @ g:i a',strtotime($d['value'])) . 'EST</span><br /><br />';
      endforeach; 
    ?>
    <input type="submit" value="SUBMIT" style="font-size:24px; margin-left: 240px;"/>
  </form>
</div>
