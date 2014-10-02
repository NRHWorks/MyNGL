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
<?php
  global $user;
  $primary_color = $brand->field_brand_primary_color['und'][0]['rgb'];
  $secondary_color = $brand->field_brand_secondary_color['und'][0]['rgb'];
  $background_color = $brand->field_brand_background_color['und'][0]['rgb'];
  $tertiary_color = $brand->field_brand_tertiary_color['und'][0]['rgb'];
?>


<style type="text/css">
  <?php
    $background_image =$brand->field_activity_room_background['und'][0]['filename'];
  ?>

  body.page-myngl-event-activity-room {
    background-image: url(<?php print base_path() . 'sites/default/files/'.$background_image ?>);
    background-size: cover !important;
  }

  #myngl-activity-room{
  background-color:<?php print $brand->field_brand_background_color['und'][0]['rgb'];?>;
  border:solid 20px <?php print $brand->field_brand_tertiary_color['und'][0]['rgb'];?>;
  border-top: solid 35px <?php print $brand->field_brand_tertiary_color['und'][0]['rgb'];?>;
  height:500px;
  width:800px ;
  position:absolute;
  margin-left:auto;
  margin-right:auto;
  top:155px;
  left:0;
  right:0;
  padding-left:50px;
  padding-right:50px;


  }

 .halfCircleRight{
     border-radius: 0 70px 70px 0;
     -moz-border-radius: 0 70px 70px 0;
     -webkit-border-radius:  0 70px 70px 0;
     bottom: 285px;
     left: -5px;
   }


  .halfCircleRight, .halfCircleLeft {
    height:70px;
    width:35px;
    cursor: pointer;
    position: absolute;
    top:200px;

    background-color:<?php print $brand->field_brand_tertiary_color['und'][0]['rgb'];?>;
    -moz-user-select: none;
    -ms-user-select: none;
    -webkit-user-select: none;
    -o-user-select: none

   }
.halfCircleLeft{
     border-radius: 70px 0 0 70px;
     -moz-border-radius: 70px 0 0 70px;
     -webkit-border-radius: 70px 0 0 70px;
     bottom: 350px;
     left: 865px;
  }
i.fa {  /* arrows in the half circles */
  color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
}

.activity-room-bg{
  z-index:-999;
  width:1024px;
  position:absolute;
  margin-left:auto;
  margin-right:auto;
  height:768px;
  left:0;
  right:0;
  top:0px;

}

.activity-room-thumb{
  float:left;
  margin-left:2.5%;
  margin-right:0;
  margin-top:80px;
  width:45%;
  text-align: center;

}
.activity-room-thumb ul{
display:none;
}

.activity-room-thumb .field-thumb-place-holder{
  width:150px;
  height:120px;
  background-color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;

}

.activity-room-thumb .field-name-field-title{
  font-weight:bold;
}

#activity-iframe-wrapper{
  z-index:200;
  border:1px solid #00ff00;
  position:absolute;
  left:0;
  right:0;
  top:160px;
  margin-left:auto;
  margin-right:auto;
  display:none;
  border:solid 20px <?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
  border-top: solid 35px <?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;

}
#activity-iframe-close{
  position:absolute;
  right:0px;
  top:-20px;

}
#activity-overlay{
  left:0;
  right:0;
  margin-left:auto;
  margin-right:auto;
  border:0px;
}

</style>
  <div id="myngl-activity-room">


    <div id="myngl-activity-room-inside" style="overflow:hidden">
      <div style="position:absolute; width:800px;">
      <?php
        $welcome_title =field_view_field('node', $myngl, 'field_activity_room_welcome_titl','full' );
        print render($welcome_title);
      ?>
      </div>
      <div id="myngl-activity-room-slider">
        <div id="myngl-activity-room-thumbs" >
          <?php
            $activities = field_view_field('node', $myngl, 'field_activity_room_activity','full' );
            $element_counter = 0;
          ?>
          <? while(isset($activities[$element_counter])): ?>
            <div class="activity-room-thumb">
              <?php print render ($activities[$element_counter]); ?>
            </div>
            <?php $element_counter ++; ?>
          <? endwhile; ?>



        </div> <!-- /#myngl-activity-room-thumbs -->
      </div><!-- /#myngl-activity-room-slider -->
    </div><!-- /#myngl-activity-room-inside -->
<!--    <div onclick="activity_room.left()" class="halfCircleRight "><i class="fa fa-angle-left"></i></div>
    <div onclick="activity_room.right()" class="halfCircleLeft "><i class="fa fa-angle-right"></i></div>
-->

  </div><!-- /#myngl-activity-room -->

<div id="activity-iframe-wrapper" >

    <div id="activity-iframe-close" onclick="activity_overlay.close()">X</div>
    <iframe id='activity-overlay' ></iframe>

</div>
<div id="activity-room-message" style = "display:none">
  <?php
    $message = field_view_field('node', $myngl, 'field_activity_room_message','full' );
    print render($message);
  ?>
</div>
