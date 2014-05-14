<?php
  $primary_color = $brand->field_brand_primary_color['und'][0]['rgb'];
  $secondary_color = $brand->field_brand_secondary_color['und'][0]['rgb'];
  $background_color = $brand->field_brand_background_color['und'][0]['rgb'];
?>

<div id="myngl-event-social-area">
  <div class="branded-secondary point-badge">
    <p>45</p>
  </div>
  <div class="btn-branded" id="myngl-event-chat-button" border="1px solid red;">  
    <a href="#" onclick="return social_area.open_chat();"><i class="fa fa-comment-o fa-2x"></i></a>
  </div>
  
  <div id="myngl-event-ugc-button" style="clear:both;">
    <a href="#" onclick="return social_area.open_ucg();"><span>UGC</span></a>
  </div>

  <div id="myngl-event-pov-button">
    <a href="#" onclick="return social_area.open_pov();"><span>POV</span></a>
  </div>

  <div id="myngl-event-chat-button-invitees" style="clear:both; padding-top:300px;">
    <div style="position: relative;">
      <div id="invitees-thumbs" style="height: 140px; overflow: hidden;">
        <a id="close-invitee" style="float:right; display:none;" href="#" onclick="return social_area.close_invitees();">Close View</a>
        <?php foreach ($invitees as $k => $i) : ?>
        <div id="invitee-thumb-<?php print $k; ?>" style="float:left; text-align: center; width: 130px; height:150px; " class="invitee <?php if ($i['fb']) { print ' fb ';} ?> | <?php if ($i['room']) { print ' in_room ';} ?>">
          <?php print $i['pic']; ?><br />
          <?php print $i['name']; ?> <br />(<?php if ($i['fb']) { print ' FB ';} ?> | <?php if ($i['room']) { print ' In Room ';} ?>)
        </div>
        <?php endforeach; ?> 
      </div>
      <div class="thumb-background"></div>
    </div>
    <div id="invitee-filters" style="clear:both; background-color: #d8c696;">
      99 PEOPLE TOTAL / 100 IN THIS ROOM
      <form>  
        <input type="radio" name="filter" value="fb-friends" /> FB Friends
        <input type="radio" name="filter" value="in-room" /> People in this Room
        <input type="radio" name="filter" value="all" /> Show All
        <!-- <input type="radio" name="filter" value="filter-options" /> Filter Options -->
      </form>
      <form>
        <input type="text" />
        <!--<input type="submit" value="Search" />-->
      </form>
    </div>
  </div>
  </div>
</div>


<div id="myngl-event-ugc" class="overlay" style="display:none;height:500px; width:900px;background-color:<?php print $background_color; ?>;position:absolute; margin:auto;z-index:200;top:0;bottom:0;left:0;right:0">
  <a href="#" onclick="return myngl.overlay_close();" class="overlay-close">X</a>  
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
  <a href="#" onclick="return myngl.overlay_close();" class="overlay-close">X</a>
  <div id="myngl-event-pov-question" style="height:100px;"></div>
  <div id="myngl-event-pov-wall" style="height:275px; overflow:scroll;"></div>
  <div id="myngl-event-pov-messages" style="height:75px;">
    <form action="#" onsubmit="return social_area.submit_message();">
      <label>Enter Message</label>
      <input type="text" id="message-input" name="message-input" size="40" style="width:200px !important;" />
      <input type="submit" value="Send" />
    </form>
  </div>
</div> 

  <div id="myngl-event-chat" class="overlay" style="width:350px; height:450px;">
  <a href="#" onclick="return myngl.overlay_close();" class="overlay-close">X</a>
  <div id="myngl-event-chat-messages" style="height:275px; overflow:scroll;"></div>
  <div id="myngl-event-chat-form" style="height:75px;">
    <form action="#" onsubmit="return social_area.submit_chat();">
      <label>Enter Message</label>
      <input type="text" id="message-input" name="message-input" size="40" style="width:200px !important;" />
      <input type="submit" value="Send" />
    </form>
  </div>
</div> 

<div class="social-bg" style="background-image: url(<?php print base_path() . 'sites/default/files/styles/godivaroom.jpg' ?>);"> </div>
