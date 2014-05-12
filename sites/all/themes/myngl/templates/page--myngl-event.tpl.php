<div id="page-myngl-event-wrapper">
      <?php print $messages; ?>
      <div class="branded event-logo">
        <img src="<?php echo file_create_url($brand->field_event_logo['und'][0]['uri']); ?>">
      </div>

    <div id="main-wrapper"><div id="main" class="clearfix">

      <div id="content" class="column"><div class="section">
        <?php print render($page['content']); ?>
      </div></div> <!-- /.section, /#content -->

    </div></div> <!-- /#main, /#main-wrapper -->

<br /><br /><br />

  <footer>
    <div id="myngl-event-menu" class="branded">
      <ul>
        <li><a href="/myngl-event/<?php print $myngl->nid; ?>/social-area">Social Area</a></li>
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

