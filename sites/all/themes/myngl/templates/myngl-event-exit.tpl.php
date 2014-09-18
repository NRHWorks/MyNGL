

<?php print $myngl->field_exit_google_survey['und'][0]['value']?>

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

<script type="text/javascript">
(function ($) {
  $(document).ready( function(){
    // This condition has to change to a Drupal.settings.variable
    if (Drupal.settings.time_up) {
    //if ($.cookie('myngl_event_ends_'+Drupal.settings.myngl_id)==1) {
      $(".branded ul li#lounge").removeClass('inactive');
      $(".branded ul li#theater").removeClass('inactive');
      $(".branded ul li#play-room").removeClass('inactive');
      $(".branded ul li#gifting-suite").removeClass('inactive');

      $(".branded ul li#lounge a").attr("onclick", "return false;").css("cursor", "default");
      $(".branded ul li#theater a").attr("onclick", "return false;").css("cursor", "default");
      $(".branded ul li#play-room a").attr("onclick", "return false;").css("cursor", "default");
      $(".branded ul li#gifting-suite a").attr("onclick", "return false;").css("cursor", "default");
    }
  });
}(jQuery));
</script>
