<?php $isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad'); ?>

<div class="video-container">
  <div style="max-width:80%; width:845px;">
    <video style="max-width:95%;" width="845px" height="455px" autoplay='true' preload='auto' <?php if ($isiPad) { print ' controls ';} ?>>
      <source src="<?php echo file_create_url($myngl->field_video_mp4['und'][0]['uri']) ?>" type="video/mp4" />
      <source src="<?php echo file_create_url($myngl->field_welcome_video['und'][0]['uri']) ?>" type="video/webm" />
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
">
</div>
