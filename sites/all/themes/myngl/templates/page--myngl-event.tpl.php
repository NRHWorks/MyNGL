<div id="page-myngl-event-wrapper">
    <?php print $messages; ?>

    <div id="main-wrapper"><div id="main" class="clearfix">

      <div id="content" class="column"><div class="section">
        <?php print render($page['content']); ?>
      </div></div> <!-- /.section, /#content -->

    </div></div> <!-- /#main, /#main-wrapper -->

<br /><br /><br />
Variables available in Page Template:<br />
<?php
  print "PRIMARY COLOR: ".$brand->field_brand_primary_color['und'][0]['rgb']."<br>";
  print "SECONDARY COLOR: ".$brand->field_brand_secondary_color['und'][0]['rgb']."<br>";
?>

  <footer>
    <div id="myngl-event-menu">
      <ul>
        <li><a href="#">Social Area</a></li>
        <li><a href="#">Theater</a></li>
        <li><a href="#">Activity Room</a></li>
        <li><a href="#">Gifting Suite</a></li>
        <li><a href="#">Exit</a></li>
        <li><a href="#">?</a></li>
        <li><a href="#"><i class="fa fa-pause"></i></a></li>
        <li><a href="#">The Myngl</a></li>
      <ul>
    </div>
  <footer>
</div>
