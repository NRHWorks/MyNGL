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
    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque, massa in viverra ornare, lorem lectus scelerisque elit, sed pharetra velit diam eget diam. Duis in sagittis mauris. Aenean euismod vestibulum neque. Phasellus pretium vitae ligula vel sagittis. Quisque libero eros, laoreet id vestibulum non, pretium quis urna. Aenean elit magna, ultricies faucibus lobortis vitae, rhoncus quis nibh. In in massa vitae leo feugiat tincidunt. Sed ornare nisl nec ante blandit, id vehicula neque rutrum. Pellentesque euismod, magna nec condimentum dapibus, eros turpis semper urna, ac tincidunt lectus justo vitae urna. Donec cursus dapibus convallis. Nunc imperdiet pretium malesuada.  </p>
    <p> Cras dignissim porta lorem vitae posuere. Mauris vitae tristique risus. Curabitur arcu lacus, iaculis ac malesuada et, eleifend eget purus. Morbi in gravida nisi. Vestibulum turpis sapien, fringilla ac pretium ut, porta nec justo. Nullam dignissim nisl vel vulputate iaculis. In pretium arcu et magna tempor, eu laoreet ipsum fermentum. Fusce semper lacinia eros, quis laoreet massa ultrices sit amet. In ex elit, volutpat porta diam sed, facilisis lobortis augue. Ut porttitor mauris enim, vel vestibulum nunc aliquet sit amet. Sed in sapien vel augue aliquam porttitor. Fusce sit amet venenatis velit. Mauris finibus ex malesuada metus maximus, non ultricies turpis imperdiet.  </p>
    <p> Vivamus in quam dui. Etiam facilisis hendrerit commodo. Mauris semper, tortor ac blandit iaculis, ipsum risus efficitur purus, eu cursus elit massa commodo purus. Vestibulum elit felis, porta vel dolor vitae, euismod placerat urna. Nunc arcu nulla, tristique eget purus mollis, gravida sagittis neque. Aenean vel justo quis lacus laoreet maximus ac et eros. Ut a scelerisque purus. Integer non pretium est, sit amet varius urna. Aenean vitae diam semper, tincidunt augue sed, pretium augue. Sed a pellentesque elit. Donec sed urna varius, fringilla tortor et, dapibus elit. Integer et dui sapien. Nulla nec diam quis elit bibendum placerat convallis eget tellus. Nulla euismod nulla sed nisl lacinia luctus. Curabitur imperdiet justo id dolor placerat pulvinar. Cras feugiat ipsum id ex ullamcorper malesuada.  </p>
    <a href="#" style="float:right; margin-top:25px" onclick="myngl.terms_overlay_close();">Close</a>
  </div>

<?php endif; ?>
