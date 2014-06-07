<?php
  global $user;
  $primary_color = $brand->field_brand_primary_color['und'][0]['rgb'];
  $secondary_color = $brand->field_brand_secondary_color['und'][0]['rgb'];
  $background_color = $brand->field_brand_background_color['und'][0]['rgb'];
  $tertiary_color = $brand->field_brand_tertiary_color['und'][0]['rgb'];
?>



<style type="text/css">

	#myngl-activity-room{

	background-color:<?php print $brand->field_brand_background_color['und'][0]['rgb'];?>;
  border:solid 20px <?php print $brand->field_brand_tertiary_color['und'][0]['rgb'];?>;
  border-top: solid 35px <?php print $brand->field_brand_tertiary_color['und'][0]['rgb'];?>;
  height:500px;
  width:800px ;
  position:absolute;
  margin-left:auto;
	margin-right:auto;
  top:170px;
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
</style>



<div id="myngl-activity-room">


  <div id="myngl-activity-room-inside" style="overflow:hidden">
    <div id="myngl-activity-room-slider">
      <div id="myngl-activity-room-thumbs" >
        <?php /*foreach ($ucg as $k => $u) :
          <div class="event-ugc-thumb item" ><a href="#" onclick="return social_area.ugc_show(<?php print $k; ?>)"><?php print $u['thumb']; ?></a></div>
        <?php endforeach; ?> */ ?>


				<?php				$counter = 0; ?>
				<?php while($counter != 30): ?>
				<div class="activity-room-thumb" style="float:left;border:1px solid #ff0000; margin:10px; width:198px; height:140px;">Game Place Holder</div>
				<? $counter ++; ?>
				<? endwhile; ?>
			</div>
    </div>


	</div>

  <div onclick="activity_room.left()" class="halfCircleRight "><i class="fa fa-angle-left"></i></div>
  <div onclick="activity_room.right()" class="halfCircleLeft "><i class="fa fa-angle-right"></i></div>
</div>







</div><!-- /#myngl-activity-room -->


