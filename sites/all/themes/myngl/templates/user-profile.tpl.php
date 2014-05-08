<?php
  $uid = arg(1);
  $u = entity_metadata_wrapper('user', user_load($uid));
  $profile = profile2_load_by_user($uid, 'profile');
  if (isset($profile->pid)) {
    $p = entity_metadata_wrapper('profile2', $profile);
  }
?>
<div class="profile"<?php print $attributes; ?>>
  <div id="content-left">
    <?php
      if (isset($p)) { 
        $pic = $p->field_picture->value();
        print theme_image_style(array('style_name' => 'user_profile_circle_image', 'path' => $pic['uri'], 'attributes' => array('class' => 'profile-pic'), 'height' => null, 'width' => null));
      } else {
        print theme_image_style(array('style_name' => 'user_profile_circle_image', 'path' => 'public://default-user-profile.png', 'attributes' => array('class' => 'profile-pic'), 'height' => null, 'width' => null));
      }
    ?>
    <div id="profile-points">
      <div id="profile-points-total"><p class="points">545</p></div>
      current Myngl point total<br />
      <a href="/user/<?php print $uid; ?>/rewards" class="link-small">see rewards</a>
    </div>
    <br clear="both" />
    <div id="profile-info">
      <span class="label">NAME:</span> 
      <strong>
      <?php print $u->field_first_name->value().' '.$u->field_last_name->value(); ?><br />
      </strong>

      <?php if (isset($p)) : ?>
        <span class="label">LOCATION:</span>
        <?php print $p->field_city->value(); ?><br />
        
        <em><?php print $p->field_about->value(); ?></em><br />
        
        <span class="label">MY INTERESTS:</span>  
        <span class="interests">
        <?php 
            $interests = array();
            foreach ($p->field_interests->value() as $i)  {
              $interests[] = $i->name;
            }

            print join(', ', $interests);
        ?>
        </span>
      <?php endif; ?>
    </div>
    <div id="profile-menu">
      <div class="border-bottom">
        <a href="/user/<?php print $user->uid; ?>/edit/profile?destination=user/<?php print $user->uid; ?>" class="link-small-light">EDIT PROFILE</a> |
        <a href="/user/<?php print $user->uid; ?>/edit?destination=user/<?php print $user->uid; ?>" class="link-small-light">EDIT ACCOUNT SETTINGS</a> |
        <a href="/user/logout" class="link-small-light">LOGOUT</a>
      </div>
      <div class="border-bottom">
        <a href="#" class="myngl-profile-buttons" onclick="return myngl.overlay('upcoming-myngls', 600, 750);">
            MY UPCOMING MYNGLS&nbsp;
            <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-1x"></i>
              <i class="fa fa-angle-right fa-stack-1x fa-inverse"></i>
            </span>
        </a>
      </div>
      <div class="border-bottom">
        <a href="/user/<?php print $uid; ?>/activities" class="myngl-profile-buttons">
          MY ACTIVITY WALL&nbsp;
          <span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-1x"></i>
            <i class="fa fa-angle-right fa-stack-1x fa-inverse"></i>
          </span>
        </a>
      </div>
    </div>
  </div>
  <div id="content-right">
    <center>
    <?php print myngl_myngl_upcoming($user->uid); ?>
    </center>
  </div>
</div>
<?php print myngl_myngl_upcoming_overlay($user->uid); ?>

<?php /* UNCOMMENT THIS TO SHOW UPCOMING MYNGLS WHEN PAGE LOADS - USEFUL FOR DEBUGGING ?>
<script type="text/javascript"> jQuery(document).ready(function() { myngl.overlay('upcoming-myngls', 600, 750); }); </script>
<?php*/ ?>
