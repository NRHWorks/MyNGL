<?php
  global $user;
  $primary_color = $brand->field_brand_primary_color['und'][0]['rgb'];
  $secondary_color = $brand->field_brand_secondary_color['und'][0]['rgb'];
  $background_color = $brand->field_brand_background_color['und'][0]['rgb'];
  $tertiary_color = "#e2dbd2";
?>

<div id="myngl-event-social-area">
  <div class="branded-secondary point-badge">
    <p>45</p>
  </div>
  <div class="btn-branded" id="myngl-event-chat-button">  
    <a href="#" onclick="jQuery('#invitee-chat-icons').toggle(); return false;"><i class="fa fa-comment-o fa-2x"></i></a>
    <div id="invitee-chat-icons" style="display:none; float:right;">
        <?php foreach ($invitees as $k => $i) : ?>
        <div id="invitee-chat-thumb-<?php print $i['uid']; ?>" style="<?php if ($user->uid == $i['uid']) { print ' display:none; '; } ?>float:left; text-align: center; width: 130px; height:150px; " class="invitee <?php if ($i['fb']) { print ' fb ';} ?> | <?php if ($i['room']) { print ' in_room ';} ?>">
          <a href="#" onclick="return chat.show_solo_chat_top(<?php print $i['uid']; ?>)"><?php print $i['pic']; ?></a><br />
        </div>
        <?php endforeach; ?> 
    </div>
  </div>
  
  <div id="myngl-event-ugc-button" style="clear:both;">
    <a href="#" onclick="return social_area.open_ucg();"><span>UGC</span></a>
  </div>

  <div id="myngl-event-pov-button">
    <a href="#" onclick="return pov.open();"><span>POV</span></a>
  </div>

  <div id="myngl-event-chat-button-invitees" style="clear:both; margin-top: 300px;">
    <div style="position: relative;">
      <div id="invitees-thumbs" style="height: 140px; overflow: hidden;">
        <a id="close-invitee" style="float:right; display:none;" href="#" onclick="return social_area.close_invitees();">Close View</a>
        <?php foreach ($invitees as $k => $i) : ?>
        <div id="invitee-thumb-<?php print $i['uid']; ?>" style="<?php if ($user->uid == $i['uid']) { print ' display:none; '; } ?>float:left; text-align: center; width: 130px; height:150px; " class="invitee <?php if ($i['fb']) { print ' fb ';} ?> | <?php if ($i['room']) { print ' in_room ';} ?>">
          <a href="#" onclick="return chat.show_invitee_info(<?php print $i['uid']; ?>)"><?php print $i['pic']; ?></a><br />
          <span id="invitee-name-<?php print $i['uid']; ?>"><?php print $i['name']; ?></span><br />
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


<div id="myngl-event-ugc" class="overlay branded" style="display:none;height:500px; width:900px; ?>;position:absolute; margin:auto;z-index:200;top:0;bottom:0;left:0;right:0">
  <a href="#" onclick="myngl.overlay_close(true);" class="overlay-close">X</a>  
  <div id="myngl-event-ugc-box"class="branded-tertiary">

    <div id="myngl-event-ugc-thumbs" class="isotope js-isotope" >
      <?php foreach ($ucg as $k => $u) : ?>
        <div class="event-ugc-thumb item" ><a href="#" onclick="return social_area.ugc_show(<?php print $k; ?>)"><?php print $u['thumb']; ?></a></div>
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
  <div onclick="social_area.ugcScroll(-150)" class="halfCircleRight branded"><i class="fa fa-angle-left"></i></div>
  <div onclick="social_area.ugcScroll(150)" class="halfCircleLeft branded"><i class="fa fa-angle-right"></i></div>
</div>

<div id="myngl-event-pov" class="overlay branded">
  <a href="#" onclick="myngl.overlay_close(true);" class="overlay-close">X</a>
  <div id="myngl-event-pov-question" class="branded-tertiary"></div>
  <hr>
  <div id="myngl-event-pov-wall" class="branded-tertiary" style="border-right: 5px solid <?php echo $tertiary_color; ?>;"></div>
  <div id="myngl-event-pov-messages" >
    <form class="branded" action="#" onsubmit="return pov.post(<?php print $user->uid; ?>);">
      <label>TYPE MESSAGE HERE.</label>
      <input type="text" class="branded-tertiary" id="pov-message" name="pov-message" size="40" />
      <input type="submit" value="Send" />
    </form>
  </div>
</div> 

<div id="myngl-event-chat" class="overlay branded" style="width:500px; height:450px;">
  <a href="#" onclick="myngl.overlay_close(true);" class="overlay-close">X</a>
  <div id="myngl-event-chat-messages" style="height:430px; overflow:scroll; border:1px solid #3c4350 "></div>
  <div id="myngl-event-chat-form" style="height:40px;">
    <form action="#" onsubmit="return chat.send_message();" style="margin-top:10px;">
      <label>Enter Message</label>
      <input type="hidden" id="chat-uid" name="chat-uid" value="<?php global $user; print $user->uid; ?>" />
      <input type="text" id="chat-message-input" name="message-input" size="40" style="width:200px !important;" />
      <input type="submit" value="Send" />
    </form>
  </div>
</div> 

<div class="social-bg" style="background-image: url(<?php print base_path() . 'sites/default/files/styles/godivaroom.jpg' ?>);"> </div>
        
<?php foreach ($invitees as $k => $i) : ?>
  <?php if ($user->uid != $i['uid']) : ?> 
    <div id="myngl-event-solo-chat-<?php print $i['uid']; ?>" class="myngl-event-solo-chat myngl-chat branded" style="width:325px; height:325px; clear:both; display:none; position:absolute; ">
      <div class="myngl-event-solo-chat-intro" style="height: 25px;">
        <a href="#" onclick="jQuery(this).parent().parent().hide();" class="overlay-close">X</a>
        Chat with <?php print $i['name']; ?>:
      </div>
      <div class="myngl-event-solo-chat-messages"style="height:210px; overflow:scroll; border:1px solid #3c4350;"></div>
      <div class="myngl-event-solo-chat-form" style="height:40px;">
        <form action="#" onsubmit="return chat.send_solo_message(<?php global $user; print $i['uid']; ?>);" style="margin-top:10px;">
          <label>Enter Message</label>
          <input type="hidden" class="chat-from-uid" name="chat-uid" value="<?php global $user; print $user->uid; ?>" />
          <input type="hidden" class="chat-to-uid" name="chat-uid" value="<?php global $user; print $i['uid']; ?>" />
          <input type="text" class="solo-chat-message-input" name="message-input" size="40" style="width:200px !important;" />
          <input type="submit" value="Send" />
        </form>
      </div>
    </div> 
    <div id="myngl-event-invitee-info-<?php print $i['uid']; ?>" style="background-color: #FFF; border: 1px solid black; height:200px; width:200px; position:absolute; display:none;" >
      <?php print $i['name'].': Need to add tagline and info here'; ?>
      <a href="#" onclick="return chat.show_solo_chat_bottom(<?php print $i['uid']; ?>)">Start Chat</a>
    </div>
  <?php endif;  ?>
<?php endforeach; ?> 



