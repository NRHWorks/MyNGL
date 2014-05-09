<div id="myngl-questions-logos">
  <img src="/<?php print path_to_theme(); ?>/images/logo_small.png" />
  <?php print theme_image_style(array('style_name' => 'brand_logo_small', 'path' => $brand->field_brand_logo['und'][0]['uri'], 'height' => null, 'width' => null)); ?>
</div>

<div id="myngl-questions-title">
  Welcome to <?php print $myngl->title; ?>
</div>

<div id="myngl-questions-form">
  Before we go to the event, please answer these questions to help with your experience:<br /><br />
  <?php print $form; ?>
</div>

<div id="myngl-questions-below-form">
  <a href="/myngl/<?php print $myngl->nid; ?>/event">Skip</a>
</div>
