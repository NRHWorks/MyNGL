<?php
  $uid = arg(1);
  $u = entity_metadata_wrapper('user', user_load($uid));
  $p = entity_metadata_wrapper('profile2', profile2_load_by_user($uid, 'profile'));
?>
<div class="profile"<?php print $attributes; ?>>
  <div id="content-left">
    <?php
      $pic = $p->field_picture->value();
      print theme_image_style(array('style_name' => 'user_profile_circle_image', 'path' => $pic['uri'], 'attributes' => array('class' => 'profile-pic'), 'height' => null, 'width' => null));
    ?>
    <br clear="both" />
    <div id="profile-info">
      <span class="label">NAME:</span> 
      <strong>
      <?php print $u->field_first_name->value().' '.$u->field_last_name->value(); ?><br />
      </strong>

      <span class="label">LOCATION:</span>
      <?php print $p->field_city->value(); ?><br />
      
      <em><?php print $p->field_about->value(); ?></em><br />
    </div>
    <div id="spacer">&nbsp;</div>
  </div>
  <div id="content-right">
    <div id="rewards-dashboard">
      <span class="title">MYNGL REWARDS POINTS</span><br /><br /><br />
      <span class="intro">You Currently Have:</span><br /><br /><br />
      <div id="points-circle"><?php print $points; ?></div> 
      <span class="points">Points</span>
    </div>
  </div>
  <div id="footer-links">
    <a href="/user/<?php print $uid; ?>" class="link-small">Back to Dashboard</a>
  </div>
</div>
