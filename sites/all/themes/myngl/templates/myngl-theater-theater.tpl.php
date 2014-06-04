<style type="text/css">
  .field-name-field-theater .field-label{
    display:none;
  }

body.page-myngl-event-theater{
    background: <?php print $brand->field_brand_primary_color['und'][0]['rgb'];?>;
  }

#theater-body{
background:url("<?php print base_path()?>sites/all/themes/myngl/images/TheaterBackground.png") no-repeat;
  width: 1020px;
  min-height: 768px;
  position: relative;
  top: 0;

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

#theater-body #question-form-wrapper input[type="submit"]:focus{
  outline:0;
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

