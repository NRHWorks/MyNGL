<?php
  $primary_color = $brand->field_brand_primary_color['und'][0]['rgb'];
  $secondary_color = $brand->field_brand_secondary_color['und'][0]['rgb'];
  $background_color = $brand->field_brand_background_color['und'][0]['rgb'];
?>

<div id="myngl-event-social-area">
  <div id=="myngl-event-social-area-logo" style="float:left;">
    <div id="myngl-event-social-area--message" style="float:left; display:none; font-weight:bold; padding:10px; height:65px;background-color:<?php print $secondary_color; ?>;color:<?php print $primary_color; ?>;">
    </div>
  </div>

  <div id="myngl-event-chat-button" style="background-color:<?php print $primary_color; ?>;height:60px;width:60px;border-radius:30px;float:right;">  
    <a href="#" style="color:<?php print $secondary_color; ?>; font-weight:bold;">Chat</a>
  </div>
  
  <div id="myngl-event-ugc-button" style="clear:both;">
    <a href="#" onclick="return social_area.open_ucg();">UGC</a>
  </div>

  <div id="myngl-event-pov-button">
    <a href="#" onclick="return social_area.open_pov();">POV</a>
  </div>

  <div id="myngl-event-chat-button-invitees" style="clear:both; padding-top:300px;">
    <div id="invitees-thumbs" style="border: 1px solid black; height: 150px; overflow: hidden;">
      <a id="close-invitee" style="float:right; display:none;" href="#" onclick="return social_area.close_invitees();">Close View</a>
      <?php foreach ($invitees as $k => $i) : ?>
      <div id="invitee-thumb-<?php print $k; ?>" style="float:left; text-align: center; width: 180px; height:150px; " class="invitee <?php if ($i['fb']) { print ' fb ';} ?> | <?php if ($i['room']) { print ' in_room ';} ?>">
        <?php print $i['pic']; ?><br />
        <?php print $i['name']; ?> <br />(<?php if ($i['fb']) { print ' FB ';} ?> | <?php if ($i['room']) { print ' In Room ';} ?>)
      </div>
      <?php endforeach; ?> 
    </div>

    <div id="invitee-filters" style="border: 1px solid black; clear:both;">
      99 People Total / 100 In This Room
      <form>  
        <input type="radio" name="filter" value="fb-friends" /> FB Friends
        <input type="radio" name="filter" value="in-room" /> People in this Room
        <input type="radio" name="filter" value="all" /> Show All
        <!-- <input type="radio" name="filter" value="filter-options" /> Filter Options -->
      </form>
      <form>
        <input type="text" />
        <input type="submit" value="Search" />
      </form>
    </div>
  </div>
  </div>
</div>


<div id="myngl-event-ugc" class="overlay" style="display:none;height:500px; width:900px;background-color:<?php print $background_color; ?>;position:absolute; margin:auto;z-index:200;top:0;bottom:0;left:0;right:0">  
  <div id="myngl-event-ugc-box" style="height:500px;width:900px;">

    <div id="myngl-event-ugc-thumbs" style="height:500px;width:auto;overflow:hidden">
      <?php foreach ($ucg as $k => $u) : ?>
        <div style="float: left; margin: 5px;"><a href="#" onclick="return social_area.ugc_show(<?php print $k; ?>)"><?php print $u['thumb']; ?></a></div>
      <?php endforeach; ?>
    </div>

    
    <?php foreach ($ucg as $k => $u) : ?>
      <div id="myngl-event-ugc-content-<?php print $k; ?>" class="myngl-event-ugc-content" style="display:none;">
        <?php print $u['content']; ?><br />
        <a href="#" onclick="return social_area.ugc_hide();">Back to Gallery</a> <br />
        submitted by <strong><?php print $u['user']; ?></strong>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<div id="myngl-event-pov" class="overlay" style="width:350px; height:450px;">
  <div id="myngl-event-pov-question" style="height:100px;">
    Enter Questions Here
  </div>
  <div id="myngl-event-pov-wall" style="height:275px;">
    Wall of questions 
  </div>
  <div id="myngl-event-pov-messages" style="height:75px;">
    Type Message Here
  </div>
</div> 

