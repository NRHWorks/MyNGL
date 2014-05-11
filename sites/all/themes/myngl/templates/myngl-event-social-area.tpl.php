<?php
  $primary_color = $brand->field_brand_primary_color['und'][0]['rgb'];
  $secondary_color = $brand->field_brand_secondary_color['und'][0]['rgb'];
?>

<div id="myngl-event-social-area">
  <div id=="myngl-event-social-area-logo" style="float:left;">
    <img src="<?php print file_create_url($brand->field_event_logo['und'][0]['uri']); ?>" align="left" />

    <div id="myngl-event-social-area--message" style="float:left; display:none; font-weight:bold; padding:10px; height:65px;background-color:<?php print $secondary_color; ?>;color:<?php print $primary_color; ?>;">
    </div>
  </div>

  <div id="myngl-event-chat-button" style="background-color:<?php print $primary_color; ?>;height:60px;width:60px;border-radius:30px;float:right;">  
    <a href="#" style="color:<?php print $secondary_color; ?>; font-weight:bold;">Chat</a>
  </div>

  <div id="myngl-event-chat-button-invitees" style="clear:both; padding-top:300px;">
    <div id="invitees-thumbs">
      <?php foreach ($invitees as $k => $i) : ?>
      <div id="invitee-thumb-<?php print $k; ?>" style="float:left;">
        <?php print $i['pic']; ?><br />
        <?php print $i['name']; ?>
      </div>
      <?php endforeach; ?> 
    </div>

    <div id="invitee-filters" style="border: 1px solid black; clear:both;">
      99 People Total / 100 In This Room
      <form>  
        <input type="radio" name-"filter" value="fb-friends" /> FB Friends
        <input type="radio" name-"filter" value="in-room" /> People in this Room
        <input type="radio" name-"filter" value="all" /> Show All
        <input type="radio" name-"filter" value="filter-options" /> Filter Options
      </form>
      <form>
        <input type="text" />
        <input type="submit" value="Search" />
      </form>
    </div>
  </div>
    
  </div>

</div>
  

