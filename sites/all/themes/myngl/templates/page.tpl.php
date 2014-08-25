  <div id="page-wrapper"><div id="page">

    <div id="header"><div class="section clearfix">

      <?php print render($page['header']); ?>

    </div></div> <!-- /.section, /#header -->

    <?php print $messages; ?>

    <div id="main-wrapper"><div id="main" class="clearfix">

      <div id="content" class="column"><div class="section">
        <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
        <a id="main-content"></a>
        <?php print render($title_prefix); ?>
        <div id="title-wrapper">
          <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
        </div>
        <?php print render($title_suffix); ?>

        <?php if ((false) && ($_GET['nav'] == 1)) : //TODO: remove this before going live ?>
        <?php //if (true) : //TODO: remove this before going live ?>
          <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
          <?php print render($page['help']); ?>
          <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
        <?php endif; ?>

        <?php print render($page['content']); ?>
        <?php print $feed_icons; ?>
      </div></div> <!-- /.section, /#content -->

      <?php if ($page['sidebar_first']): ?>
        <div id="sidebar-first" class="column sidebar"><div class="section">
          <?php print render($page['sidebar_first']); ?>
        </div></div> <!-- /.section, /#sidebar-first -->
      <?php endif; ?>

      <?php if ($page['sidebar_second']): ?>
        <div id="sidebar-second" class="column sidebar"><div class="section">
          <?php print render($page['sidebar_second']); ?>
        </div></div> <!-- /.section, /#sidebar-second -->
      <?php endif; ?>

    </div></div> <!-- /#main, /#main-wrapper -->

    <div id="footer"><div class="section">
      <?php print render($page['footer']); ?>
    </div></div> <!-- /.section, /#footer -->

  </div></div> <!-- /#page, /#page-wrapper -->

<?php if (arg(0) == 'user' && arg(1) == 'register') : ?>

  <div id="terms-overlay" class="overlay">
    <h1>Terms and Conditions</h1>
      <div style="width:760px; height:400px; overflow: scroll">
      <?php
        $block = module_invoke('block','block_view','2');
        print render($block['content']);
      ?>
      </div>


    <a href="#" style="float:right; margin-top:25px" onclick="myngl.terms_overlay_close();">Close</a>
  </div>

<?php endif; ?>
