

<div id="exit-div" style="padding-top:100px; padding-bottom:100px;">
  <img src="/sites/all/themes/myngl/images/logo.png" /><br /><br />
  <span class="exit-thank-you">THANK YOU FOR JOINING US</span><br /><br />
  <?php //$exit_text = field_view_field('node', $myngl, 'field_exit_text','full' ); //Not sure why this line doesn't work.. ?>
  <div class='exit-text' style="margin:50px 50px 80px 50px;">
    <?php print $myngl->field_exit_text['und'][0]['safe_value']; ?>
  </div>
  <!--
  <div id="exit-points">
    <br />You Have<br />
    <div id="exit-points-circle">
      <span class="exit-points-points"><?php print $points; ?></span><br />
      Points
    </div>
  </div>

  -->
  <div id="exit-dashboard-link">
    <div class="exit-circle"><a href="/">&gt;</a></div>
    <span class="exit-back">BACK TO THE DASHBOARD</span> 
  </div>
</div>

