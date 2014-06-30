

<div class="video-container">
  <div>
    <?php
    /* variables that will be useful for building this page */

    //print '<pre>'; print_r($myngl); exit;

    print theme('youtube_video', array('video_id' => $myngl->field_welcome_video['und'][0]['video_id'], 'size' => 'custom', 'height' => '350px', 'width' => '650px'));

    ?>
  </div>
</div>

<div class="event-lobby-background" style="background-image: url(<?php echo file_create_url($brand->field_lobby_background_graphic['und'][0]['uri']) ?>);
width: 100%;
min-height: 650px;
position: absolute;
top: 0;
z-index: -9999;
left: 0;
height: 100%;
}">
</div>
