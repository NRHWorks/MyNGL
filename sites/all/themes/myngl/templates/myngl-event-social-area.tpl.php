<?php
  global $user;
  $primary_color = $brand->field_brand_primary_color['und'][0]['rgb'];
  $secondary_color = $brand->field_brand_secondary_color['und'][0]['rgb'];
  $background_color = $brand->field_brand_background_color['und'][0]['rgb'];
  $tertiary_color = "#e2dbd2";
?>

<div id="myngl-event-social-area">
  <div class="branded-secondary point-badge">
    <p><?php print $total_points; ?></p>
  </div>
  <div class="btn-branded" id="myngl-event-chat-button">


    <a href="#" onclick="jQuery('#invitee-chat-selector').toggle(); return false;"><i class="fa fa-comment-o fa-2x"></i></a>
    <div id="invitee-chat-icons" style="display:none; float:right;">
        <?php $uids = array(); ?>
        <?php foreach ($invitees as $k => $i) : ?>
          <?php if ($user->uid != $i['uid']): ?>
            <div id="invitee-chat-thumb-<?php print $i['uid']; ?>" style='display:none' class="myngl-chat-circles invitee <?php if ($i['fb']) { print ' fb ';} ?> | <?php if ($i['room']) { print ' in_room ';} ?>">
            <a href="#" onclick="return chat.solo_show(<?php print $i['uid']; ?>)"><?php print $i['pic']; ?></a><br />
            </div>
          <?php endif; ?>
        <?php $uids[] = $i['uid'];//maintain a list of invitee id for javascript ?>
        <?php endforeach; ?>
        <?php drupal_add_js(array('uids' => $uids), 'setting'); ?>
    </div>
    <div id="minimized-chats">    </div>
  </div>

  <div id="invitee-chat-selector" style="float:right;z-index:30000;">
    <div id="invitee-chat-selector-search">SEARCH USERNAME</div>
    <!--  Nathan's code
    <?php foreach ($invitees as $k => $i) : if ($i['uid'] != $user->uid) : ?>
      <a href="#" onclick="return chat.solo_show(<?php print $i['uid']; ?>)">
        <?php print $i['pic']; ?>
        <?php print $i['name']; ?>
      </a>
    <?php endif; endforeach; ?>
    end nathan's code-->
    <form id="social-area-chat-list" style="margin-top:-10px;padding-left:20px;">

      <?php foreach ($invitees as $k => $i) : if ($i['uid'] != $user->uid) : ?>
        <div class="checkbox" id="uid-<?php print $i['uid']?>"
          onclick="chat.invitee_click(<?php print $i['uid']?>)"
          style="height:40px;margin-right:20px;padding:3px; display:none;"
          value="<?php print $i['uid']?>"
          >

          <?php print $i['pic']; ?>
          <?php print $i['name']; ?>
        </div><br/>

      <?php endif; endforeach; ?>
      <input type="submit" value="Chat" style=""/>
    </form>
    <br /><br />
  </div>

  <div id="myngl-event-ugc-button"  onclick="return social_area.open_ucg(); container();">
  </div>

  <div id="myngl-event-pov-button" onclick="return pov.open();">
  </div>

  <div id="myngl-event-chat-button-invitees" style="clear:both; margin-top: 300px;">
    <div style="position: relative;">
      <div id="invitees-thumbs" style="height: 140px; overflow: hidden;">
        <a id="close-invitee" style="float:right; display:none;" href="#" onclick="return social_area.close_invitees();">Close View</a>
        <?php foreach ($invitees as $k => $i) : ?>
          <?php if ($user->uid != $i['uid']): ?>
            <div id="invitee-thumb-<?php print $i['uid']; ?>" style="display:none;float:left; text-align: center; width: 130px; height:150px; " class="invitee <?php if ($i['fb']) { print ' fb ';} ?> | <?php if ($i['room']) { print ' in_room ';} ?>">
            <a href="#" onclick="return chat.show_invitee_info(<?php print $i['uid']; ?>)"><?php print $i['pic']; ?></a><br />
            <span id="invitee-name-<?php print $i['uid']; ?>"><?php print $i['name']; ?></span><br />
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <div class="thumb-background"></div>
    </div>
    <div id="invitee-filters" style="clear:both; background-color: #d8c696;">
      99 PEOPLE TOTAL / 100 IN THIS ROOM
      <form>
        <input type="radio" name="filter" value="all" /> Show All
        <input type="radio" name="filter" value="fb-friends" /> FB Friends
        <input type="radio" name="filter" value="reps" /> Brand Reps
        <input type="radio" name="filter" value="other" /> Other Filters
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
  <div id="myngl-event-ugc-box" class="branded-tertiary">
    <div id="myngl-event-ugc-box-inside">
    <div id="myngl-event-ugc-box-slider">
      <div id="myngl-event-ugc-thumbs">
        <?php foreach ($ucg as $k => $u) : ?>
          <div class="event-ugc-thumb item" ><a href="#" onclick="return social_area.ugc_show(<?php print $k; ?>)"><?php print $u['thumb']; ?></a></div>
        <?php endforeach; ?>
      </div>
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
  <div onclick="social_area.ugc_left()" class="halfCircleRight branded"><i class="fa fa-angle-left"></i></div>
  <div onclick="social_area.ugc_right()" class="halfCircleLeft branded"><i class="fa fa-angle-right"></i></div>
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

<div id="myngl-event-chat" class="myngl-chat overlay branded" style="width:500px; height:450px;">
  <a href="#" onclick="myngl.overlay_close(true);" class="overlay-close">X</a>
  <div id="myngl-event-chat-messages" class="myngl-chat-messages" style="height:430px; overflow:scroll; border:1px solid #3c4350 "></div>
  <div id="myngl-event-chat-form" class="myngl-chat-form" style="height:40px;">
    <form action="#" onsubmit="return chat.send_message();" style="margin-top:10px;">
      <label>Enter Message</label>
      <input type="hidden" id="chat-uid" name="chat-uid" value="<?php global $user; print $user->uid; ?>" />
      <input type="text" id="chat-message-input" name="message-input" size="40" />
      <input type="submit" value="Send" />
    </form>
  </div>
</div>

<div class="social-bg" style="background-image: url(<?php print base_path() . 'sites/default/files/styles/godivaroom.jpg' ?>);"> </div>

<?php foreach ($invitees as $k => $i) : ?>
  <?php if ($user->uid != $i['uid']) : ?>
    <div id="myngl-event-solo-chat-<?php print $i['uid']; ?>" class="myngl-event-solo-chat myngl-chat branded" style="left:0px;width:325px; height:340px; clear:both; display:none; position:absolute; ">
      <div class="myngl-event-solo-chat-intro branded">

        <a href="#" onclick="chat.solo_hide(<?php print $i['uid']; ?>)" class="overlay-close" style="margin-left:10px">X</a>
        <a href="#" onclick="chat.solo_minimize(<?php print $i['uid']; ?>);" class="overlay-close">_</a>
        Chat with <?php print $i['name']; ?>:
      </div>
      <div id="myngl-event-solo-chat-messages-<?php print $i['uid']; ?>" class="myngl-event-solo-chat-messages myngl-chat-messages branded-tertiary"style="height:210px; overflow:scroll; border:1px solid #3c4350;"></div>
      <div class="myngl-event-solo-chat-form myngl-chat-form">
        <form action="#" onsubmit="return chat.solo_post(<?php print $i['uid']; ?>);" style="margin-top:10px;">
          <label>Enter Message</label>
          <input type="hidden" class="chat-to-uid" name="chat-to-uid" value="<?php print $i['uid']; ?>" />
          <input type="text" id="solo-chat-message-input-<?php print $i['uid']; ?>" class="solo-chat-message-input branded-tertiary" name="message-input" size="40" />
          <input type="submit" value="Send" />
        </form>
      </div>
    </div>
    <div  id="myngl-event-invitee-info-<?php print $i['uid']; ?>"
          style="background-color: <?php print $primary_color; ?>; color:<?php print $secondary_color; ?>; padding:10px; width:200px; height:200px; position:absolute; display:none;" >
      <span style="font-size:18px; font-weight:bold;"><?php print $i['name']; ?></span><br /><br />
      <span style="font-size:16px; font-weight:bold; ">Tagline: <?php print $i['tagline'] ; ?></span><br /><br /><br />
      <a href="#" onclick="return chat.solo_show(<?php print $i['uid']; ?>)" style="float:right;color:<?php print $secondary_color; ?>; font-weight:bold;">Start Chat</a>
    </div>
  <?php endif;  ?>
<?php endforeach; ?>
