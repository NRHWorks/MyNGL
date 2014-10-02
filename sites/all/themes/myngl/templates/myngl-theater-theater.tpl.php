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
<style type="text/css">
  .field-name-field-theater .field-label{
    display:none;
  }

body.page-myngl-event-theater{
  background: #000;
  background-image: url("/sites/all/themes/myngl/images/theater-background.jpg");
  background-size: cover;
  background-position: top center;
}

#theater-body{
  width: 1020px;
  min-height: 888px;
  position: relative;
  top: 80px;

  margin-left:auto;
  margin-right:auto;
  height: 100%;

}

#theater-top-message-wrapper{
  position:relative;
  margin-left:auto;
  margin-right:auto;
  width:400px;
  height:70px;
  background-color:#272727;
  color:#cccccc;
  padding-top:20px;
  padding-right:10px;
  padding-bottom:10px;
  padding-left:10px;
}
##theater-top-message{
  overflow:hidden;
}

#theater-body .media-ustream-player{
  position:absolute;
  top:105px;
  left:100px;

}

#theater-body .media-youtube-player {
  position:absolute;
  top:105px;
  left:100px;
}

#theater-body #player {
  position: absolute;
  top: 105px;
  left: 105px;
  height:490px;
  width:830px;
  display: none;
}

#theater-body #question-form-wrapper{
  width:400px;
  height: 100px;
  position: relative;
  margin-left:auto;
  top:600px;
  margin-right:auto;
  background-color:#d6d6d6;
  padding-top:20px;

}

#theater-body #question-form-wrapper #title{
  margin-left:10px;
  color:#888888;
}

#theater-body #question-form-wrapper form{
  margin-top:10px;

}

#theater-body #question-form-wrapper input#question-input{
  position:relative;
  left:10px;
  width:370px;
}

#theater-body #question-form-wrapper input[type="submit"] {
    font: 200 20px  'sans-serif';
    text-transform: uppercase;
    color: #8e8042;
    background:transparent;
    font-weight:bold;
    position:relative;
    top:-5px;
    /*margin-left:350px;*/
    /*float: right;*/
    left:300px;
}

#theater-body #question-form-wrapper input[type="submit"]:focus,
#theater-body #question-form-wrapper input#question-input:focus{
  outline:0;
}


body.page-myngl-event-theater #see-more{
  border:1px solid #ffffff;
  width:200px;
  height:200px;
  display:none;
  position:absolute;
  top:600px;
  left:400px;

}


</style>


<div id="theater-body">
<!--<div id="theater-top-message-wrapper"><div id="theater-top-message"></div></div>-->


<div>

  <?php

    /* variables that will be useful for building this page */
    //print '<pre>'; print_r($myngl); exit;
    //print '<pre>'; print_r($brand); exit;
    $theater = field_view_field('node', $myngl, 'field_theater','full' );

    print render($theater);
    //print str_replace('class="media-ustream-player"','class="media-ustream-player" id="ustreamPlayer"',str_replace('wmode','autoplay=true&wmode',render($theater)));
    //print theme('youtube_video', array('video_id' => $myngl->field_welcome_video['und'][0]['video_id'], 'size' => 'custom', 'height' => '350px', 'width' => '650px'));

  ?>
  
    <iframe id="player"></iframe>


</div>
<div id="question-form-wrapper">
<div id="title">PLEASE SUBMIT YOUR QUESTION HERE </div>
<form id="theater-question-form" action="#" onsubmit="return question.question_submit();">
          <input type="text" id="question-input"  name="question-input" size="40" />
          <input type="submit" value="SUBMIT" />
</form>
</div><!-- /#form-wrapper -->
</div><!-- /#theater-body -->

<style type="text/css">
  #myngl-event-menu {
    display: none;
  }

  #myngl-theater-see-more{
    display:none;
    height:110px;
    width:790px;
    position:absolute;
    margin-left:auto;
    margin-right:auto;
    margin-top:660px;
    z-index:50;
    top:0;
    bottom:0;
    left:0;
    right:0;
    padding-left:30px;
  }


  
  #myngl-theater-see-more p {
    text-align: center; 
    color: #a38d50;
  }

  #myngl-theater-see-more .additional-video{
  display:inline-block;
  margin-right:20px;
}

  #myngl-theater-see-more .additional-video img{
  border:2px solid <?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
  width: 180px;
  height: 104px;
  }
  #additional-videos-wrapper{

    height:inherit;
    width:610px;
    overflow:hidden;
  }
  #additional-videos{
    position:relative;
  }
  #myngl-theater-see-more .fa{
    font-size:50px;
    color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
    position:absolute;
  }
  #myngl-theater-see-more .fa.fa-chevron-circle-left{
    top:30px;
    left: -30px;
  }
  #myngl-theater-see-more .fa.fa-chevron-circle-right{
    top:30px;
    right:-55px;
  }
</style>

<div id="myngl-theater-see-more" >
  <p style="color:#ffffff !important;"><?php print $myngl->field_theater_above_thumbs['und'][0]['safe_value'];  ?></p>
  <div onclick="theater.additional_video_left();" class="fa fa-chevron-circle-left"></div>
  <div onclick="theater.additional_video_right();" class="fa fa-chevron-circle-right"></div>
  <!--<a href="#" onclick="myngl.overlay_close(true);" class="overlay-close">X</a> -->
  <?php
    $download_copy = field_view_field('node', $myngl, 'field_theater_download_box_copy','full' );
  ?>
  <div>
    <a href="#" onclick="myngl.overlay('myngl-theater-downloads',500,800);" style="float:right;background-color:#8f825d;height:88px; width:150px;padding:10px;">
      <?php print render($download_copy); ?>    
    </a>
  </div>
  <div id="additional-videos-wrapper">
    <div id="additional-videos">
      <?php
        $additional_videos = field_view_field('node', $myngl, 'field_theater_additional_video','full' );
        $counter =0;

        while(isset($additional_videos[$counter])){
          print "<div class='additional-video'>";
          print render($additional_videos[$counter]);
          print "</div>";
          $counter ++;
        }
      ?>
    </div>
  </div><!-- /#additional-videos-wrapper"-->
  <p style="color:#ffffff !important;"><?php print $myngl->field_theater_below_thumbs['und'][0]['safe_value'];  ?></p>
</div> <!-- myngle-theater-see-more -->
<style type="text/css">


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

    background-color:#3a2b29;
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


#myngl-theater-downloads{
  background-color:<?php print $brand->field_brand_background_color['und'][0]['rgb'];?>;
  border:solid 20px <?php print $brand->field_brand_tertiary_color['und'][0]['rgb'];?>;
  border-top: solid 35px <?php print $brand->field_brand_tertiary_color['und'][0]['rgb'];?>;;
  display:none; /* should be none after done developming */
  height:500px;
  width:800px ;
  position:absolute;
  margin:auto;
  z-index:200;
  top:0;
  bottom:0;
  left:0;
  right:0;
  padding-left:50px;
  padding-right:50px;


}

i.fa {
  color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
}

#downloads-slides-wrapper{
  position:relative;
  top:30px;
  height:400px;
  width:800px;

  overflow:hidden;

}
.downloads-slide{
  position:absolute;
  left:900px;
  width: 800px;
  height:400px;
}


.element-0-in-slide,
.element-1-in-slide,
.element-2-in-slide,
.element-3-in-slide{
  height:200px;
  width:400px;


}

.element-0-in-slide,
.element-2-in-slide{
  float:left;
}


.element-1-in-slide,
.element-3-in-slide{
  float:right;
}
.field_downloads_image_place_holder{
  height:150px;
  width:150px;
  background-color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
}

.downloads-element .field-collection-view-links{
  display:none;
}
.downloads-element  .field_downloads_image_place_holder,
.downloads-element  .field-name-field-downloads-image{
  float:left;

}

.downloads-element .text-wrapper{
  position:relative;
  margin-left: 170px;
  height:150px;
  padding-right:20px;


}
.downloads-element .social-icons{
  float:right;

}

.downloads-element .field-name-field-title{
  font-size:14px;
  font-family:'lato';
  color:#666666;

}

.downloads-element .field-name-field-description{
padding-top:10px;
}

.downloads-element .file-download{
  width:100%;

  position: absolute;
  bottom:10px;
}
.downloads-element .file-download a{
  font-style:italic;

  color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;

  font-family:'georgia';
}

.downloads-element .button{
  position:absolute;
  left:120px;
  top:-3px;
  font-size:24px;
  font-weight: bold;
  color:<?php print $brand->field_brand_tertiary_color['und'][0]['rgb'];?>;
 padding-left:8px;
 padding-right:8px;
 background-color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
 -moz-border-radius: 30px 30px 30px 30px;
 -webkit-border-radius: 30px 30px 30px 30px;
  height: 30px;
  width: 16px;
}


</style>


<div id="myngl-theater-downloads" class="overlay" >
  <a href="#" onclick="myngl.overlay_close(true);" class="overlay-close" style="position:absolute; top:-25px; right:0px; color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>">X</a>
  <div ><h1 style="font-family:'georgia'; color:<?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>">DOWNLOAD FROM <?php print strtoupper($brand->title);?> MYNGL</h1></div>

  <div id="short-line-below-download-title" style="border-top:1px solid #000000; height:1px; width:50px;"></div>

  <?php    $downloadable_files = field_view_field('node', $myngl, 'field_theater_downloads','full' );  ?>
  <div id="downloads-slides-wrapper">


    <?php
      $slide_counter = 0;
      $num_of_elements_in_slide =0;
      $element_counter = 0;

      while(isset($downloadable_files[$element_counter])){
        if ($num_of_elements_in_slide ==0){
          print  "<div class = 'downloads-slide' id = 'download-slide-".$slide_counter."'>";
        }
        print "<div class='downloads-element element-".$num_of_elements_in_slide."-in-slide'>";
        print render($downloadable_files[$element_counter]);
        print "</div>";
        $num_of_elements_in_slide ++;

        if ($num_of_elements_in_slide ==4){
          print "</div><!-- /.downloads-slide-->";
          $slide_counter ++;
          $num_of_elements_in_slide = 0; // reset num of elements in slides to 0
        }
        $element_counter ++;
      } //end of while loop

      if ($num_of_elements_in_slide!=0){ //extra closing tag
        print "</div><!-- /.downloads-slide-->";
      }
    ?>
  </div><!-- /#downloads-slides-wrapper" -->

  <div  class="halfCircleRight" id="halfCircleRight"><i class="fa fa-angle-left"></i></div>
  <div  class="halfCircleLeft" id="halfCircleLeft"><i class="fa fa-angle-right"></i></div>
</div><!-- #myngl-theater-downloads -->

<?php /* ?>

<script src="/sites/all/themes/myngl/js/embedapi-master/src/ustream-embedapi.js"></script>

<script type="text/javascript">
  jQuery(document).ready(function () {
	alert('embed api loaded');	
  	var viewer = UstreamEmbed("ustreamPlayer");
			
	console.log(viewer);

	 	viewer.addListener('offline', function() {
	alert('live stream offline');	
		      jQuery('#myngl-theater-see-more').css('display','block');
		      jQuery("#question-form-wrapper").hide();
		});
	});
</script>

<?php */ ?>
