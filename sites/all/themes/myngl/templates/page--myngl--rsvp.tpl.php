

<div id="rsvp-logos">
  <div id="rsvp-myngl-logo">
    <img src="/<? print path_to_theme(); ?>/images/logo.png" /> 
  </div>
  <div id="rsvp-brand-logo">
    <?php print myngl_myngl_brand_logo(arg(1)); ?>
  </div>
</div>

<div id="page-wrapper"><div id="page">

    <?php print $messages; ?>

    <div id="main-wrapper"><div id="main" class="clearfix">

      <div id="content" class="column"><div class="section">
        <?php print render($page['content']); ?>
      </div></div> <!-- /.section, /#content -->

    </div></div> <!-- /#main, /#main-wrapper -->
    
  </div></div> <!-- /#page, /#page-wrapper -->
