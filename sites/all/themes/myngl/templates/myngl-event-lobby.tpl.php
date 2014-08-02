
<div class="video-container">
  <div>
    <video width="845px" height="455px" autoplay preload='auto'>
      <source src="http:<?php print str_replace('+','%2B',file_create_url($myngl->field_welcome_video['und'][0]['uri'])); ?>" type="video/mp4">
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
