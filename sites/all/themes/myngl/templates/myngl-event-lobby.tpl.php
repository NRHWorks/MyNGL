

<div class="video-container">
  <div>
    <?php
    /* variables that will be useful for building this page */

    //print '<pre>'; print_r($myngl); exit;

    print theme('youtube_video', array('video_id' => $myngl->field_welcome_video['und'][0]['video_id']));

    ?>
  </div>
</div>

<div class="event-lobby-background">
  <img src="<?php echo file_create_url($brand->field_lobby_background_graphic['und'][0]['uri']) ?>">
</dv>