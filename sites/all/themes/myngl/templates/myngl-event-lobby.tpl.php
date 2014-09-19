<?php $isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad'); ?>

<div class="video-container">
  <div>
    <video style="max-width:80%" width="845px" height="455px" autoplay='true' preload='auto' <?php if ($isiPad) { print ' controls ';} ?>>
      <source src="http://www.themyngl.com/sites/default/files/themynglgodiva-full1.webmhd.webm" type="video/webm">
      <source src="http://www.themyngl.com/sites/default/files/themynglgodiva-full1.mp4" type="video/mp4">
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
