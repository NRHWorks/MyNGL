<?php
  if ($myngl->field_show_pov_and_ugc_borders['und'][0]['value']!=1){
    if (!isset($_COOKIE['done_lobby_video_'.$myngl->nid]) || $_COOKIE['done_lobby_video_'.$myngl->nid]!= 1){
      global $base_url;
      $redirect = 'Location: '. $base_url . '/myngl-event/' . $myngl->nid ."/lobby";
      header($redirect);
      exit;
    }
  }
?>
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<?php $num_of_test_icons = 0; ?>
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
    display:none;
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
    padding:30px;
    margin-top:10px;
  }
  .field-name-field-lounge-other-filter-title{
    margin:30px 30px 0 30px;
    font-size:30px;

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

</style>
<div id="other-filter-overlay">
  <div id="other-filter-close" onclick="social_area.other_filter_close();">X</div>
  <div id="other-filter-submit" onclick="social_area.other_filter_close(); social_area.other_filter()">Submit</div>
  <?php
    $filter_title = field_view_field('node', $myngl, 'field_lounge_other_filter_title','full' );
    print render ($filter_title); ?>

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
    right:35px;
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

    <div id="invitee-chat-selector-search">
      <form >
        <label>Search User Name</label>
        <input class="form-light" type="text" onkeyup="social_area.search();"/>
      </form>
    </div>
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
        <div class="checkbox
                    <?php if ($i['brand_rep']==1) { print ' brand-rep ';} ?>
                    <?php if(isset($i['group_name'])){print ' group-'.$i['group_name'];} ?>
                    "
          id="uid-<?php print $i['uid']?>"
          onclick="chat.invitee_click(<?php print $i['uid']?>)"
          style="height:40px; padding: 7px 0px 7px 20px;"
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
      <div class="fa-social-dock-arrow fa fa-chevron-circle-right" id="dock-scroll-right" onclick="social_area.dock_scroll_right();" style="position: absolute;right:5px;bottom:-40px;font-size:30px;z-index:200;"></div>
      <div class="fa-social-dock-arrow fa fa-chevron-circle-left" id="dock-scroll-left" onclick="social_area.dock_scroll_left();" style="position: absolute; left:5px;bottom:-40px;font-size:30px;z-index:200;"></div>
      <div id="invitees-thumbs"  >
        <?php foreach ($invitees as $k => $i) : ?>
          <?php //if ($user->uid != $i['uid']): ?>
            <div  id="invitee-thumb-<?php print $i['uid']; ?>"
                  style="float:left; text-align: center; width: 90px; height:120px; "
                  class="invitee
                         invitee-thumb
                         <?php if ($i['fb']) { print ' fb ';} ?>
                         <?php if ($i['brand_rep']==1) { print ' brand-rep ';} ?>
                         <?php if(isset($i['group_name'])){print ' group-'.$i['group_name'];} ?>
                         ">
            <a href="#" onmouseleave='chat.mouse_leave_thumb(<?php print $i['uid']; ?>)' onmouseover="return chat.show_invitee_info(<?php print $i['uid']; ?>)"><?php print $i['pic']; ?></a><br />
            <span id="invitee-name-<?php print $i['uid']; ?>"><?php print $i['name']; ?></span><br />
            </div>
          <?php //endif; ?>
        <?php endforeach; ?>

        <!-- Beginning of the test code -->
        <?php for ($i = 0; $i < $num_of_test_icons; $i ++): ?>
          <div class="invitee-thumb-test-place-holder"
             style=" float:left; width: 90px; height:120px; margin-left: 10px;
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

    <div id="invitee-filters-wrapper">
      <div id="invitee-filters" style="clear:both; background-color: #d8c696;">
        <span id="people-total">0</span> PEOPLE TOTAL / <span id="people-in-lounge">0</span> IN THIS ROOM
        <form id='filters'>

          <input id='all' type="radio" name="filter" value="all" checked/> Show All
          <input id='fb-friends' type="radio" name="filter" value="fb-friends" /> FB Friends
          <input id='reps' type="radio" name="filter" value="reps" /> Brand Reps
          <?php if ($myngl->field_enable_invitee_group['und'][0]['value']==1): ?>
            <input id='group' type="radio" name='filter' value='group'/> My Group
          <?php endif; ?>
          <input id='other' type="radio" name="filter" value="other" onclick="social_area.show_other_filter();"/> Other Filters
          <!-- <input type="radio" name="filter" value="filter-options" /> Filter Options -->
        </form>
<!--
        <form id="invitee-search">
          <input type="text" />
        </form>
-->
      </div>
    </div>
  </div>
  </div>
</div>


<div id="myngl-event-ugc" class="overlay branded" style="display:none;height:520px; width:900px; position:absolute; margin:auto;z-index:200;top:0;bottom:0;left:0;right:0">
  <a href="#" onclick="social_area.ugc_close();" class="overlay-close">X</a>
  <div id="myngl-event-ugc-box" class="branded-tertiary">
    <div id="title" style='font-size:24px;position:absolute;top:5px;'>Guest Creativity</div>
    <div id="myngl-event-ugc-box-inside">
    <div id="myngl-event-ugc-box-slider" style="margin-left:0;">
      <div id="myngl-event-ugc-thumbs">
        <div id="myngl-event-ugc-thumbs-row-0" style="height:150px;"></div>
        <div id="myngl-event-ugc-thumbs-row-1" style="height:150px;"></div>
        <div id="myngl-event-ugc-thumbs-row-2" style="height:150px;"></div>
        <?php foreach ($ucg as $k => $u) : ?>
          <div class="event-ugc-thumb item" id="event-ugc-thumb-<?php print $k; ?>"><a href="#" onclick="return social_area.ugc_show(<?php print $k; ?>)"><?php print $u['thumb']; ?></a></div>
        <?php endforeach; ?>
      </div>
    </div>

    <?php foreach ($ucg as $k => $u) : ?>
      <div id="myngl-event-ugc-content-<?php print $k; ?>" class="myngl-event-ugc-content" style="display:none;">
        <div style='text-align:right; width:800px;'>
          <a href="mailto:?body=<?php print (isset($u['path']))?urlencode($u['path']):""; ?>&subject=<?php print $myngl->title; ?>">
            <img src="/sites/all/themes/myngl/images/ucg-email.png" />
          </a>

          <script>function fbs_click_<?php print $k; ?>() {u='<?php print (isset($u['path']))?$u['path']:""; ?>';t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>
          <a href="http://www.facebook.com/share.php" onclick="return fbs_click_<?php print $k; ?>()" target="_blank" title="Myngl">
            <img src="/sites/all/themes/myngl/images/ucg-facebook.png" />
          </a>

          <script>function twt_click_<?php print $k; ?>() { window.open('https://twitter.com/share?url=<?php print (isset($u['path']))?urlencode($u['path']):""; ?>&text=<?php print urlencode('At theMyngl – Cool new Online Experiential Event! Exclusive content, Chat, FREE gifts! theMyngl.com #'. $brand->title .'Myngl'); ?>','sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>
          <a href="https://twitter.com/share?url=<?php print(isset($u['path']))?urlencode($u['path']):""; ?>&text=<?php print urlencode('At theMyngl – Cool new Online Experiential Event! Exclusive content, Chat, FREE gifts! theMyngl.com #'. $brand->title .'Myngl'); ?>" onclick="return twt_click_<?php print $k; ?>()" target="_blank">
            <img src="/sites/all/themes/myngl/images/ucg-twitter.png" />
          </a>
        </div>
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
  <div id="title" style="font-size:20px;position:absolute;">Shout Out!</div>
  <div id="myngl-event-pov-question" class="branded-tertiary" style="background-color:#ffffff;"></div>
  <hr>
  <div id="myngl-event-pov-wall" class="branded-tertiary" style="border-right: 5px solid <?php echo $tertiary_color; ?>;background-color:#ffffff;"></div>
  <div id="myngl-event-pov-messages" >
    <form class="branded" action="#" onsubmit="return pov.post(<?php print $user->uid; ?>);">
      <label>TYPE MESSAGE HERE.</label>
      <input type="text" class="branded-tertiary" id="pov-message" name="pov-message" size="40" style='background-color:#ffffff;' />
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

<?php foreach ($invitees as $k => $i) : ?>
  <?php if ($user->uid != $i['uid']) : ?>
    <div id="myngl-event-solo-chat-<?php print $i['uid']; ?>" class="myngl-event-solo-chat myngl-chat branded" style="left:0px;width:325px; height:340px; clear:both; display:none; position:absolute; ">
      <div class="myngl-event-solo-chat-intro branded">

        <a href="#" onclick="chat.solo_hide(<?php print $i['uid']; ?>)" class="overlay-close" style="margin-left:10px">X</a>
        <a href="#" onclick="chat.solo_minimize(<?php print $i['uid']; ?>);" class="overlay-close">_</a>
        <div style = "color:#ffffff;">Chat with <?php print $i['name']; ?>:</div>
      </div>
      <div id="myngl-event-solo-chat-messages-<?php print $i['uid']; ?>" class="myngl-event-solo-chat-messages myngl-chat-messages branded-tertiary" style="height:210px; overflow:scroll; border:1px solid #3c4350; background-color:#ffffff;"></div>
      <div class="myngl-event-solo-chat-form myngl-chat-form">
        <form action="#" onsubmit="return chat.solo_post(<?php print $i['uid']; ?>);" style="margin-top:10px;">
          <label>Enter Message</label>
          <input type="hidden" class="chat-to-uid" name="chat-to-uid" value="<?php print $i['uid']; ?>" />
          <input type="text" id="solo-chat-message-input-<?php print $i['uid']; ?>" class="solo-chat-message-input branded-tertiary" name="message-input" size="40" style="background-color:#ffffff;" />
          <input type="submit" value="Send"/>
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

      <span style="font-size:16px;font-family:'roboto';color:#ffffff;"><?php print $i['name']; ?></span>
      <div style="width:100%; height:1px; margin:3px 0 8px 0; background-color:#ffffff;"> </div>
      <!--<span style="font-size:14px; font-family:'lato'; color:#ffffff;"><?php print $i['about_me'] ; ?></span><br /><br />-->
      <?php //if (isset($i['city']) && ($i['city'] != 'null')) : ?>
        <span id='city' style="font-size:14px; font-family:'lato'; color:#ffffff;">Hometown: <?php print $i['city'];?></span><br /><br />
      <?php //endif; ?>
      <?php //if (isset($i['tagline']) && ($i['tagline'] != 'null')) : ?>
        <span style="font-size:14px; font-family:'lato'; color:#ffffff;">Reason to Myngl: <span id="tagline-holder"><?php print $i['tagline'] ; ?></span></span><br /><br />
      <?php //endif; ?>
      <a href="#" onclick="chat.reset_id_of_showing_invitee_info(); return chat.solo_show(<?php print $i['uid']; ?>)"
                  style="font-size:14px;position:absolute;right:10px;bottom:10px;text-decoration:underline;color:#ffffff; ">
        CHAT
        <img style="position:relative;top:10px;" src='<?php print base_path();?>sites/all/themes/myngl/images/chatboxes.png' height='30px' width='30px'/>
      </a>




    </div>
  <?php endif;  ?>
<?php endforeach; ?>
