<?php
  global $user;
  $primary_color = $brand->field_brand_primary_color['und'][0]['rgb'];
  $secondary_color = $brand->field_brand_secondary_color['und'][0]['rgb'];
  $background_color = $brand->field_brand_background_color['und'][0]['rgb'];
  $tertiary_color = $brand->field_brand_tertiary_color['und'][0]['rgb'];

?>

<style>
  #link{
    position:absolute;
    top:380px;
    width:340px;
  }
  #link.hide{
    display:none;
  }
  #link a{
    color:<?php print $secondary_color; ?>;
    font-size:16px;
    font-family:'georgia';
  }
  #link #arrow{
    width:22px;
    height:22px;
    background-color:<?php print $secondary_color; ?>;
    border-radius: 22px;

    float:right;
  }
  #link #arrow a{
    color:#ffffff;
  }
  #count-down{
    position:absolute;
    width:340px;
    top:327px;
  }
  #count-down #time{
    color:#ffffff;
    background-color:<?php print $secondary_color; ?>;
    float:right;
    font-family:'lato';
    font-size:12px;

    padding:2px 4px 2px 4px;
  }
</style>

<div style="position:relative; color:<?php print $secondary_color; ?>; font-size:16px;font-family:'georgia';">
  <div style="position:absolute; width:340px; height:1px; background-color:#999999; left:2px;top:310px;"></div>
  <div style="position:absolute; width:340px; height:1px; background-color:#999999; left:2px;top:363px;"></div>
  <div style="position:absolute; width:340px; height:1px; background-color:#999999; left:2px;top:417px;"></div>

  <div style = "margin-left:30px">
    <div style="margin-bottom:40px;">Next Myngl on
      <?php //print $myngl->field_myngl_dates['und'][0]['value']; ?>
      <?php print myngl_timing_panel_date($rsvp_date); ?>
    </div>
    <?php print theme_image_style(array('style_name' => 'brand_logo', 'path' => $brand->field_brand_logo['und'][0]['uri'], 'height' => null, 'width' => null)).'<br><br>'; ?>
  </div>
  <div id="count-down">
    Myngl Event will start in
    <div id="time"></div>

  </div>

  <div id="link" class="hide">

  <?php
    $link_text = 'Go to the '. strtoupper($brand->title).' Myngl now!';
    print l($link_text, 'myngl/' . $myngl->nid . '/pre-questions');
  ?>
  <div id='arrow'><?php print l(">",'myngl/' . $myngl->nid . '/pre-questions' )?></div>
</div>

