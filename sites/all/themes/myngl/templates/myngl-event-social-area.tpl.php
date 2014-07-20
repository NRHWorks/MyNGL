<?php
/*
  if (!isset($_COOKIE['done_lobby_video']) || $_COOKIE['done_lobby_video']!= 1){
    global $base_url;
    $redirect = 'Location: '. $base_url . '/myngl-event/' . $myngl->nid ."/lobby";
    header($redirect);
    exit;
  }*/
?>
<?php $num_of_test_icons = 50; ?>
<?php drupal_add_js(array('num_of_test_icons' => $num_of_test_icons), 'setting'); ?>
<?php
  global $user;
  $primary_color = $brand->field_brand_primary_color['und'][0]['rgb'];
  $secondary_color = $brand->field_brand_secondary_color['und'][0]['rgb'];
  $background_color = $brand->field_brand_background_color['und'][0]['rgb'];
  $tertiary_color = "#e2dbd2";
?>

<style>
  #close-and-minimize-all{
    position:absolute;
    right:40px;
    top:85px;
    background-color: <?php print $primary_color; ?>;
    color: <?php print $secondary_color; ?>;
    font-size:16px;
    padding:4px 8px 4px 8px;
  }

  #close-and-minimize-all span{
    cursor: pointer;
  }

  #other-filter-overlay{
    z-index:1000;
    width:600px;
    height:400px;
    position:absolute;
    left:0;
    right:0;
    top:100px;
    margin-left:auto;
    margin-right:auto;
    background-color:<?php print $primary_color;?>;
    color:<?php print $secondary_color; ?>;
    display:none;
  }

  #other-filter-overlay #other-filter-close{
    position:absolute;
    right:10px;
    top:10px;
    font-size:18px;
  }

  form#other-filter{
    padding:20px;
    margin-top:20px;
  }

  form#other-filter .question{
    margin-bottom:30px;
    overflow:auto;
  }

  form#other-filter .question-label{
    font-size:16px;
    font-weight:bold;
    margin-bottom:10px;
  }

  form#other-filter .input-wrapper{
  float:left; width:270px;
  }
  form#other-filter input{
    margin-right:5px;

  }
  #other-filter-overlay #other-filter-submit{
    position:absolute;
    right:20px;
    bottom:20px;
    background-color:<?php print $secondary_color;?>;
    color:<?php print $primary_color;?>;
    height:30px;
    width:80px;
    font-size:18px;
    text-align:center;
    padding-top:5px;
    border-radius:5px;

  }
  .this-user{
    display:none !important;
  }
</style>
<div id="other-filter-overlay">
  <div id="other-filter-close" onclick="social_area.other_filter_close();">X</div>
  <div id="other-filter-submit" onclick="social_area.other_filter_close(); social_area.other_filter()">Submit</div>
  <form id="other-filter">
    <?php foreach($pre_questions as $i =>$question): ?>
      <div class='question' id="question-<?php print $i;?>">
        <div class='question-label'><?php print $question['question']; ?></div>
        <?php foreach($question['answers'] as $ii => $answer):?>

          <div class='input-wrapper'><input  type="radio" name="other-filter-question-<?php print $i;?>" value="<?php print $answer['value'];?>" /><?php print $answer['value'];?></div>
        <?php endforeach; ?>
        <div class='input-wrapper' ><input  type="radio" name="other-filter-question-<?php print $i;?>" value="all" checked='checked'/>all</div>

      </div><!-- /.question -->
    <?php endforeach; ?>
  </form>
</div>


<div id="close-and-minimize-all"><span onclick='chat.minimize_all()' style="margin-right:5px;">_</span> <span onclick='chat.close_all()'>X</div>

<style type="text/css">
  #dock-arrows{
    position:absolute;
    z-index:300;
    right:10px;
    bottom:45px;
    width:20px;
  }
  .fa-social-dock-arrow{
    font-size:20px;
    /*background-color:<?php print $primary_color;?>;*/
    color:<?php print $secondary_color; ?>;
  }
  .fa-social-dock-arrow.disabled{
    color:#888888;
  }
</style>
<div id="dock-arrows">
  <div id="dock-up" class="fa-social-dock-arrow fa fa-chevron-circle-up"  onclick="social_area.dock_expand()"></div>
  <div id="dock-down" class="fa-social-dock-arrow fa fa-chevron-circle-down"  onclick="social_area.dock_fold()"></div>
</div>

<div id="myngl-event-social-area">
  <div class="branded-secondary point-badge">
    <p><?php print $total_points; ?></p>
  </div>
  <div class="btn-branded" id="myngl-event-chat-button">
    <a href="#" onclick="jQuery('#invitee-chat-selector').toggle(); return false;"><i class="fa fa-comment-o fa-2x"></i></a>
    <div id="invitee-chat-icons" style="display:none; float:right;">
        <?php $uids = array(); ?>
        <?php $brand_rep_ids = array(); ?>
        <?php foreach ($invitees as $k => $i) : ?>
          <?php if ($user->uid != $i['uid']): ?>
            <div id="invitee-chat-thumb-<?php print $i['uid']; ?>" style='display:none' class="myngl-chat-circles invitee <?php if ($i['fb']) { print ' fb ';} ?> | <?php if ($i['room']) { print ' in_room ';} ?>">
            <a href="#" onclick="return chat.solo_show(<?php print $i['uid']; ?>)"><?php print $i['pic']; ?></a><br />
            </div>
          <?php endif; ?>
          <?php $uids[] = $i['uid'];//maintain a list of invitee id for javascript ?>
          <?php if ($i['brand_rep']==1) $brand_rep_ids[] = $i['uid']; //for javascript filter?>
        <?php endforeach; ?>
        <?php drupal_add_js(array('uids' => $uids), 'setting'); ?>
        <?php drupal_add_js(array('brand_rep_ids'=> $brand_rep_ids),'setting'); ?>
    </div>
    <div id="minimized-chats">    </div>
    <div id="expand-all" style="float:right; margin-top:5px;padding-right:2px;cursor:pointer;" onclick="chat.expand_all()"><img src="/sites/all/themes/myngl/images/expand_all.png" /></div>


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
    <form id="social-area-chat-list" style="margin-top:-10px;">

      <?php foreach ($invitees as $k => $i) : if ($i['uid'] != $user->uid) : ?>
        <div class="checkbox" id="uid-<?php print $i['uid']?>"
          onclick="chat.invitee_click(<?php print $i['uid']?>)"
          style="height:40px; padding: 7px 0px 7px 20px; display:none;"
          value="<?php print $i['uid']?>"
          >

          <?php print $i['pic']; ?>
          <?php print $i['name']; ?>
        </div>

      <?php endif; endforeach; ?>
      <input type="submit" value="Chat" style="margin-left:20px;"/>
    </form>
    <br /><br />
  </div>

  <div id="myngl-event-ugc-button"  onclick="return social_area.open_ucg(); container();">
  </div>

  <div id="myngl-event-pov-button" onclick="return pov.open();">
  </div>

  <div id="myngl-event-chat-button-invitees" style="clear:both; /*margin-top: 300px;*/">

    <div id="invitee-thumbs-wrapper" >
      <div class="fa-social-dock-arrow fa fa-chevron-circle-right" id="dock-scroll-right" onclick="social_area.dock_scroll_right();" style="position: absolute;right:5px;bottom:5px;font-size:30px;z-index:200;"></div>
      <div class="fa-social-dock-arrow fa fa-chevron-circle-left" id="dock-scroll-left" onclick="social_area.dock_scroll_left();" style="position: absolute; left:5px;bottom:5px;font-size:30px;z-index:200;"></div>
      <div id="invitees-thumbs"  >
        <?php foreach ($invitees as $k => $i) : ?>
          <?php //if ($user->uid != $i['uid']): ?>
            <div id="invitee-thumb-<?php print $i['uid']; ?>" style="float:left; text-align: center; width: 90px; height:120px; " class="invitee invitee-thumb <?php if ($i['fb']) { print ' fb ';} ?> <?php if ($i['brand_rep']==1) { print ' brand-rep ';} ?>">
            <a href="#" onmouseleave='chat.mouse_leave_thumb(<?php print $i['uid']; ?>)' onmouseover="return chat.show_invitee_info(<?php print $i['uid']; ?>)"><?php print $i['pic']; ?></a><br />
            <span id="invitee-name-<?php print $i['uid']; ?>"><?php print $i['name']; ?></span><br />
            </div>
          <?php //endif; ?>
        <?php endforeach; ?>


        <!-- Beginning of the test code -->
        <?php for ($i = 0; $i < $num_of_test_icons; $i ++): ?>
          <div class="invitee-thumb-test-place-holder"
             style=" float:left; width: 90px; height:120px;
             background-color:
             #<?php print str_pad ( dechex (rand(0, 255)) , 2 ,"0", STR_PAD_LEFT ) .
                          str_pad ( dechex (rand(0, 255)) , 2 ,"0", STR_PAD_LEFT ) .
                          str_pad ( dechex (rand(0, 255)) , 2 ,"0", STR_PAD_LEFT );?>">

          </div>
        <?php endfor; ?>
        <!-- end of the test code -->

      </div><!-- /#invitees-thumbs -->
      <div class="thumb-background"></div>
    </div> <!-- /#invitee-thumb-wrapper-->

    <div id="invitee-filters" style="clear:both; background-color: #d8c696;">
      <span id="people-total">0</span> PEOPLE TOTAL / <span id="people-in-lounge">0</span> IN THIS ROOM
      <form id='filters'>
        <input id='all' type="radio" name="filter" value="all"  /> Show All
        <input id='fb-friends' type="radio" name="filter" value="fb-friends" checked/> FB Friends
        <input id='reps' type="radio" name="filter" value="reps" /> Brand Reps
        <input id='other' type="radio" name="filter" value="other" onclick="social_area.show_other_filter();"/> Other Filters
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


<div id="myngl-event-ugc" class="overlay branded" style="display:none;height:520px; width:900px;";position:absolute; margin:auto;z-index:200;top:0;bottom:0;left:0;right:0">
  <a href="#" onclick="social_area.ugc_close();" class="overlay-close">X</a>
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
        <div style='text-align:right; width:800px;'><img src="/sites/all/themes/myngl/images/theater-downloads-social-icons1.png"></div>
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
          onmouseleave="chat.set_id_of_hovered_invitee_info(-1);chat.reset_id_of_showing_invitee_info();chat.close_invitee_info(<?php print $i['uid']; ?>)"
          onmouseover="chat.set_id_of_hovered_invitee_info(<?php print $i['uid']; ?>);"
          style="background-color: <?php print $primary_color; ?>; color:<?php print $secondary_color; ?>; padding:10px; width:250px; height:150px; position:absolute; display:none;" >

      <style>
        .arrow-down {
	width: 0;
	height: 0;
	border-left: 30px solid transparent;
	border-right: 30px solid transparent;
  position:absolute;
  top:170px;
  left:35px;
	border-top: 30px solid <?php print $primary_color;?>;

}
      </style>
      <div class="arrow-down"></div>

      <span style="font-size:18px;font-family:'georgia';"><?php print $i['name']; ?></span>
      <div style="width:10px; height:2px; margin:3px 0 8px 0; background-color:<?php print $secondary_color;?>"> </div>
      <span style="font-size:16px; font-weight:bold; "><?php print $i['about_me'] ; ?></span><br /><br />
      <span style="font-size:16px; font-weight:bold; ">Tagline: <span id="tagline-holder"><?php print $i['tagline'] ; ?></span></span><br /><br />
      <a href="#" onclick="chat.reset_id_of_showing_invitee_info(); return chat.solo_show(<?php print $i['uid']; ?>)" style="position:absolute;right:10px;bottom:20px;text-decoration:underline;color:<?php print $secondary_color; ?>; font-weight:bold;">Start Chat</a>




    </div>
  <?php endif;  ?>
<?php endforeach; ?>
