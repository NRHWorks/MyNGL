<div id="rsvp-confirm-wrapper">
  <div id="rsvp-confirm-title">WELCOME TO <?php print $node->title; ?></div>
  <div id="rsvp-confirm-date"><?php print date('m.d.Y @ g:i a',strtotime($node->field_myngl_dates['und'][0]['value'])); ?> EST</div>
  <div id="rsvp-confirm-description"><?php print $node->field_myngl_description['und'][0]['safe_value']; ?></div>
  <div id="rsvp-confirm-button"><a href="/user/register"><img src="/<?php print path_to_theme(); ?>/images/rsvp-button.png" /></a></div>
  <div id="rsvp-confirm-login">Already a member? <a href="/user">Click Here</a></div>
</div>

