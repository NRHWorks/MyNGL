<?php
  if ($myngl->field_show_pov_and_ugc_borders['und'][0]['value']!=1){
    if (isset($_COOKIE['myngl_event_ends_'.$myngl->nid])){
      global $base_url;
      $redirect = 'Location: '. $base_url . '/myngl-event/' . $myngl->nid ."/exit";
      header($redirect);
      exit;
    }
  }
?>


<div class="video-container">
  <div>
    <video width="845px" height="455px" autoplay preload='auto'>
      <source src="http://www.themyngl.com/sites/default/files/themynglgodiva-full1.mp4" type="video/mp4">
      <source src="http://www.themyngl.com/sites/default/files/themynglgodiva-full1.webmhd.webm" type="video/webm">
      Your browser does not support the video tag.
    </video>
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
