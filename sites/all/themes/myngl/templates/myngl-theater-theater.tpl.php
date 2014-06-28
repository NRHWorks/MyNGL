<style type="text/css">
  .field-name-field-theater .field-label{
    display:none;
  }

body.page-myngl-event-theater{
  background: #000;
}

#theater-body{
  width: 1020px;
  min-height: 768px;
  position: relative;
  top: 0;

  margin-left:auto;
  margin-right:auto;
  height: 100%;

  background-image: url("/sites/all/themes/myngl/images/theater-background.jpg");
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

#theater-body .media-ustream-player{
  position:absolute;
  top:105px;
  left:175px;

}

#theater-body #question-form-wrapper{
  width:400px;
  height: 100px;
  position: relative;
  margin-left:auto;
  top:470px;
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
    top:40px;
    margin-left:320px;
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
#myngl-theater-see-more .additional-video{
  float:right;
  margin-right:20px;

}

#myngl-theater-see-more .additional-video img{
  border:2px solid <?php print $brand->field_brand_secondary_color['und'][0]['rgb'];?>;
}

</style>


<div id="theater-body">
<div id="theater-top-message-wrapper"><div id="theater-top-message"></div></div>


<div>
  <?php

    /* variables that will be useful for building this page */
    //print '<pre>'; print_r($myngl); exit;
    //print '<pre>'; print_r($brand); exit;
    $theater = field_view_field('node', $myngl, 'field_theater','full' );

    print render($theater);
    //print theme('youtube_video', array('video_id' => $myngl->field_welcome_video['und'][0]['video_id'], 'size' => 'custom', 'height' => '350px', 'width' => '650px'));

  ?>
</div>
<div id="question-form-wrapper">
<div id="title">PLEASE SUBMIT YOUR QUESTION HERE </div>
<form id="theater-question-form" action="#" onsubmit="return question.question_submit();">
          <input type="text" id="question-input"  name="question-input" size="40" />
          <input type="submit" value="SUBMIT" />
</form>
</div><!-- /#form-wrapper -->
</div><!-- /#theater-body -->


<div id="myngl-theater-see-more" style="display:none;height:150px; width:870px;position:absolute; margin-left:auto;margin-right:auto; margin-top:600px;z-index:50;top:0;bottom:0;left:0;right:0;">
  <!--<a href="#" onclick="myngl.overlay_close(true);" class="overlay-close">X</a> -->
  <div><a href="#" onclick="myngl.overlay('myngl-theater-downloads',500,800);" style="float:right;background-color:#8f825d;height:98px; width:150px;padding:10px;">Check out other cool stuff from Godiva</a> </div>
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
