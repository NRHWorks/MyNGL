<?php
  $uid = arg(1);
  $u = entity_metadata_wrapper('user', user_load($uid));
  $p = entity_metadata_wrapper('profile2', profile2_load_by_user($uid, 'profile'));
?>
<div class="profile"<?php print $attributes; ?>>
  <div id="scrollable-content">
    <?php foreach ($activities as $a) : ?>
    <div class="activity">
      <div class="activity-date">
        <br />
        <span class="month"><?php print date('F',$a['date']); ?></span><br />
        <span class="day"><?php print date('j',$a['date']); ?></span><br />
      </div>
      <div class="activity-details">
        <?php if (isset($a['day'])) : ?><span class="activity-day"><?php print $a['day']; ?></span><br /><?php endif; ?>
        <span class="activity-description"><?php print $a['description']; ?></span>
      </div>
      <div class="activity-points">
        <span class="points"><?php print $a['points']; ?></span> 
        <span class="myngl-points">Myngl Points</span>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <div id="footer-links">
    <a href="/user/<?php print $uid; ?>" class="link-small">Back to Dashboard</a>
  </div>
</div>
