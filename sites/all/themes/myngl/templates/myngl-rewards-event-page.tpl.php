<?php
  global $user;
  $primary_color = $brand->field_brand_primary_color['und'][0]['rgb'];
  $secondary_color = $brand->field_brand_secondary_color['und'][0]['rgb'];
  $background_color = $brand->field_brand_background_color['und'][0]['rgb'];
  $tertiary_color = "#e2dbd2";
  $background_image = file_create_url($myngl->field_gifting_series_background['und'][0]['uri']);


?>
<style type="text/css">

body.page-myngl-event-rewards {
  background: url('<?php print $background_image ?>') center center no-repeat ;
  background-size: cover !important;
}




#thank-you{
  margin-top:30px;
  position:absolute;
  margin-left:auto;
  margin-right:auto;
  width:100%;
  text-align:center;
  color:<?php print $primary_color; ?>;
  font-size:32px;
  font-family:'georgia';
  font-style:italic;


}

#reward-wrapper{
  width:800px;
  height:600px;

  position:relative;
  top:120px;
  margin-left:auto;
  margin-right:auto;

}

#reward-wrapper ul{
  display:none;
}

#left{
  width:400px;
  color:<?php print $secondary_color ?>;
  float:left;
}
#reward-wrapper .field-collection-item-field-reward{
  width:395px;
  height:195px;
  margin-right:5px;
  margin-bottom:5px;
  background-color:<?php print $primary_color; ?>;
}

#reward-wrapper .field-collection-item-field-reward .level-and-points-wrapper{
  padding-left:20px;
  padding-top:15px;
  height:25px;
  font-family:"georgia";

}



#reward-wrapper .field-collection-item-field-reward .level{
  font-size:18px;
  float:left;
}

#reward-wrapper .field-collection-item-field-reward .points{
  float:right;
  width:120px;
  position:relative;
  top:-10px;

}
#reward-wrapper .field-collection-item-field-reward .points strong{
  font-size:28px;
  font-weight:normal;


}

#reward-wrapper .field-collection-item-field-reward .short-line{
  height:1px;
  border-top: 2px solid <?php print $secondary_color; ?>;
  width:30px;
  margin-left:20px;
}
#reward-wrapper .field-collection-item-field-reward .image-and-texts-wrapper{
  padding-left:20px;
}



#reward-wrapper .field-collection-item-field-reward .image-and-texts-wrapper{
  margin-top:15px;
  width:auto;
  height:130px;
}

#reward-wrapper .field-collection-item-field-reward .field-thumb-place-holder{
  height:120px;
  width:120px;
  background-color: <?php print $secondary_color; ?>;
  float:left;
}

#reward-wrapper .field-collection-item-field-reward .field-thumb-place-holder,
#reward-wrapper .field-collection-item-field-reward .field-name-field-thumb{
  float:left;
}


#reward-wrapper .field-collection-item-field-reward .texts{
  margin-left:135px;
  position:relative;
  padding-right:20px;
}

#reward-wrapper .field-collection-item-field-reward .field-name-field-title{
  font-weight:bold;
  margin-bottom:10px;
  font-style:italic;
}

#reward-wrapper .field-collection-item-field-reward .redeem{
  position:absolute;
  top:100px;
  font-family:"san-serif";
  font-style:italic;
  font-size:18px;
  margin-left:80px;
}

#reward-wrapper .field-collection-item-field-reward .redeem-button{

  position:absolute;
  left:125px;
  top:-1px;
  font-size:20px;
  font-style:normal;
  font-weight: bold;
  color:<?php print $brand->field_brand_tertiary_color['und'][0]['rgb'];?>;
 padding-left:6px;
 padding-right:6px;
 background-color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
 -moz-border-radius: 30px 30px 30px 30px;
 -webkit-border-radius: 30px 30px 30px 30px;

}

#right{
  width:400px;
  float:right;
}

#reward-wrapper #external-site{
  position:relative;
  height:195px;
  width:400px;
  background-color:<?php print $primary_color; ?>;
  color:<?php print $secondary_color ?>;

}

#reward-wrapper #external-site .field-name-field-external-site-title{
  position:relative;
  padding-top:10px;
  padding-left:20px;
  font-family: "san-serif";
  font-size:24px;
}

#reward-wrapper #external-site .field-name-field-external-site-subtitle{
  padding-top:10px;
  padding-left:20px;
  font-size:18px;
}

#reward-wrapper #external-site .field-name-field-external-site-description{
  padding-left:20px;
  padding-right:20px;
  padding-top:5px;
}

#reward-wrapper #buy-now{
  position:absolute;
  top:156px;
  font-family:"san-serif";
  font-style:italic;
  font-size:18px;
  margin-left:270px;
}

#reward-wrapper #buy-now a{
  position:absolute;
  left:85px;
  top:-1px;
  font-size:20px;
  font-style:normal;
  font-weight: bold;
  color:<?php print $brand->field_brand_tertiary_color['und'][0]['rgb'];?>;
 padding-left:6px;
 padding-right:6px;
 background-color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
 -moz-border-radius: 30px 30px 30px 30px;
 -webkit-border-radius: 30px 30px 30px 30px;
}

</style>




<div id="thank-you">THANK YOU FOR COMING!
<div id="horizontal-line"
     style="

            border-bottom:2px solid <?php print $primary_color; ?>;
            width:120px;
            height:30px;
            margin-left:auto;
            margin-right:auto"></div>
</div>
<div id="reward-wrapper">
  <div id="left">
    <?php
      $rewards = field_view_field('node', $myngl, 'field_reward','full' );
      $element_counter = 0;
    ?>
    <?php while(isset($rewards[$element_counter])): ?>
      <?php print render ($rewards[$element_counter]); ?>
      <?php $element_counter ++ ; ?>
    <?php endwhile; ?>
  </div><!-- /#left-->
  <div id="right">
    <div id="external-site">
      <?php $ex_site_title = field_view_field('node', $myngl, 'field_external_site_title','full' ); ?>
      <?php print render($ex_site_title); ?>
      <?php $ex_site_subtitle = field_view_field('node', $myngl, 'field_external_site_subtitle','full' ); ?>
      <?php print render($ex_site_subtitle); ?>
      <?php $ex_site_desc = field_view_field('node', $myngl, 'field_external_site_description','full' ); ?>
      <?php print render($ex_site_desc); ?>

      <?php $ex_site_link = field_view_field('node', $myngl, 'field_external_site_link','full' ); ?>
      <div id="buy-now">
        BUY NOW <a href='<?php print strip_tags(render($ex_site_link)); ?>' target='_blank'>></a>
      </div>
    </div>
    <div id="bottom-right-image">
      <?php $bottom_right_image = field_view_field('node', $myngl, 'field_gifting_series_bottom_righ','full' ); ?>
      <?php print render($bottom_right_image); ?>
    </div>
  </div>


</div><!--/#reward-wrapper -->


<style type="text/css">


#gifting-series-overlay{
  display:none;
  width:800px;
  height:600px;
	position:absolute;
  z-index:200;
	left:0;
	right:0;
	top:160px;
	margin-left:auto;
	margin-right:auto;
	border:solid 20px <?php print $brand->field_brand_primary_color['und'][0]['rgb'];?>;
  border-top: solid 35px <?php print $brand->field_brand_primary_color['und'][0]['rgb'];?>;
  background-color: <?php print $brand->field_brand_background_color['und'][0]['rgb'];?>;
}



#gifting-series-overlay .overlay-reward{
  display:none;
}

#gifting-series-overlay .close{
	position:absolute;
	right:0px;
	top:-20px;
  color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
  height:100%;

}

#gifting-series-overlay #gift-redeem{
  color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
  font-family:'san-serif';
  font-size:28px;
  width:auto;

  padding-top:30px;
  padding-left:20px;
  padding-bottom:10px;
}


#gifting-series-overlay .short-line{
  border-top:2px solid #000000;
  width:60px;
  height:0px;
}

#gifting-series-overlay #short-line-1{
  margin-left:20px;
}
#gifting-series-overlay #short-line-2{
  margin-top:20px;
}
#gifting-series-overlay #short-line-3{
  float:right;
  clear:both;
}
#gifting-series-overlay #text-wrapper{
  padding-left:20px;
  padding-top:10px;
  width:530px;
  float:left;
  height:485px;
  color:#666666;
  position:relative;

}
#gifting-series-overlay .level-and-points-wrapper,
#gifting-series-overlay .field-thumb-place-holder,
#gifting-series-overlay .field-name-field-thumb,
#gifting-series-overlay .short-line-4,
#gifting-series-overlay .redeem{
  display:none;
}

#gifting-series-overlay .field-name-field-title{
  font-size:20px;
  font-weight:bold;
  font-style:italic;
}

#gifting-series-overlay #text-bottom{
  position:absolute;
  bottom:0px;
  right:0px;
}

#gifting-series-overlay #redeem {
  font-family:'san-serif';
  font-style:italic;
  color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
  float:right;
  padding-bottom:15px;
  width:140px;
  position:relative;
  font-size:16px;

}


#gifting-series-overlay #redeem #button{

  position:absolute;
  left:115px;
  top:-1px;
  font-size:20px;
  font-style:normal;
  font-weight: bold;
  color:<?php print $brand->field_brand_tertiary_color['und'][0]['rgb'];?>;
 padding-left:6px;
 padding-right:6px;
 background-color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
 -moz-border-radius: 30px 30px 30px 30px;
 -webkit-border-radius: 30px 30px 30px 30px;
}

#gifting-series-overlay #myngl-more-and-earn{
  float:right;
  clear:both;
  margin-top:15px;
  text-decoration:underline;
}


#gifting-series-overlay #you-have,
#gifting-series-overlay #you-need{
  float:right;
  position:relative;
  font-family:"san-serif";
  width:145px;
  padding:30px;
  height:170px;
  margin-right:25px;
  margin-bottom:10px;
  margin-top:10px;
  background-color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
  color:#ffffff;

}


#gifting-series-overlay #you-have .label,
#gifting-series-overlay #you-need .label{
  font-weight:bold;
  font-style:italic;

  font-size:24px;

}

#gifting-series-overlay #you-have .short-line,
#gifting-series-overlay #you-need .short-line{
  border-top:2px #ffffff solid;
  margin-top:10px;
  margin-bottom:10px;
}

#gifting-series-overlay #you-have .points,
#gifting-series-overlay #you-need .points{
  font-size:90px;
}

#gifting-series-overlay #you-have .unit,
#gifting-series-overlay #you-need .unit{
  position:absolute;
  bottom:30px;
  right:30px;
  font-size:20px;

}

#gifting-series-overlay #questions{
  display:none;
  position:absolute;
  top:0px;
}

#gifting-series-overlay #questions #title,
#gifting-series-overlay #congrats #title{
  color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
  font-family:'san-serif';
  font-size:28px;
  width:auto;

  padding-top:30px;
  padding-left:20px;
  padding-bottom:10px;

}

form#myngl-myngl-post-questions-form input#edit-submit:focus{
  outline:0;
}

#gifting-series-overlay #congrats{
  display:none;
  position:absolute;
  top:0px;
  width:100%;


}

#gifting-series-overlay #congrats #left{
  padding-left:20px;
  width:350px;
  margin-right:20px;

  float:left;
}

#gifting-series-overlay #congrats .short-line{
  margin-left:20px;
}

#gifting-series-overlay #congrats #social{
  width:780px;

  height:35px;
  padding-right:20px;
}

#gifting-series-overlay #congrats #gift-photo{
  width:380px;
  height:400px;
  border:1px solid #856944;
  float:right;
  margin-right:20px;

}
#gifting-series-overlay #email-wrapper{
  clear:both;
  float:right;

  ;
  width:400px;

}

#gifting-series-overlay #email-wrapper form{
  margin-top:10px;
}

#gifting-series-overlay #email-wrapper #email-input{
  width:270px;
}
</style>



<div id="gifting-series-overlay">
  <div class= 'close' onclick='rewards_overlay.close()'>X</div>
  <div id="gift-and-points-info">

  <div id="gift-redeem">Gift Redeem</div>
  <div class = "short-line" id="short-line-1"></div>
  <div id="text-wrapper">

    <?php
      $counter = 0;
      $reward_collections = $myngl->field_reward['und'];
      while (isset($reward_collections[$counter])){
        $collection = entity_load_single('field_collection_item',$reward_collections[$counter]['value'] );
        print "<div class ='overlay-reward' id='reward-id-". $reward_collections[$counter]['value']."'>";
        $renderable = entity_view('field_collection_item', array($collection), 'full' );
        print render ($renderable);
        print "</div>";
        $counter ++;
      }
    ?>
    <div class = "short-line" id="short-line-2"></div>
    <div id = "text-bottom">
      <div id="redeem" onclick="rewards_overlay.show_questions()">REDEEM GIFT <div id="button">></div></div>
      <div class = "short-line" id="short-line-3"></div>
      <div id="myngl-more-and-earn">
        <a href="<?php print base_path();?>myngl-event/<?php print $myngl->nid;?>/social-area">
          Don't have enough points? Myngl more and earn
        </a>
      </div>
    </div><!-- /#text-bottom -->
  </div><!-- /#text-wrapper -->

  <div id="you-need">
    <div class="label">You need:</div>
    <div class="short-line"></div>
    <div class="points"></div>
    <div class="unit">POINTS</div>

  </div>
  <div id="you-have">
    <div class="label">You have:</div>
    <div class="short-line"></div>
    <div class="points"><?php print $points;?></div>
    <div class="unit">POINTS</div>
  </div>

  </div><!--/#gift-and-points-info-->

  <div id='questions'>
    <div id='title'>Gift Redeem: questions</div>
    <?php print $form; ?>
  </div>

  <div id="congrats">
    <div id='title'>CONGRATS, You Got Your Swag!</div>
    <div class="short-line"></div>
    <div id='social'><div style="float:right">social</div></div>
    <div id='left'>

       Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text Some Text
      <div class="short-line" style="margin-left:0;margin-top:20px;"></div>
    </div>

    <div id="gift-photo"> photo</div>
    <div id="email-wrapper">
      <form id="email" >
        <label>Email</label>
        <input type="text" id='email-input'>
        <input type="submit" value="SEND" class="form-submit">
      </form>

    </div>
  </div>

</div>
