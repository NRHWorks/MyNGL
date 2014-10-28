<html>
  <head>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
  </head>
  <body style="background-color:#e1e1e1; font: 300 14px 'Lato', 'sans-serif';">
    <div style="width:80%; margin-left:auto; margin-right:auto; background-color:#FFF; padding:25px; overflow:auto;">
      <div style="margin-top:25px; float:left; height:125px;"><img src="http://166.78.241.22/sites/all/themes/myngl/images/logo_small.png" style="width:140px; height:auto;"></div>
      <div style="margin-top:25px; float:right; height:125px;"><img src="<?php print $banner; ?>" style="width:140px; height:auto;"></div>
      <div style="border-top: 1px solid #999; color:#555; clear:both; padding-top:25px; padding:25px;">
        <img src="<?php print $gift_image; ?>" style="float:left; margin-right:25px; width:150px; height:auto;">
        <h1 style="font-famiy:'helvetica';font-weight:normal; color: #957f57; font-size: 34px; text-transform: uppercase; letter-spacing: 1px;">YOU'RE INVITED TO <?php print $title; ?></h1>
        <div style="clear:both; padding-top:25px;">
          <?php print str_replace('[friend-name]', $friend ,str_replace('[first-name]',$invitee,$text)); ?>
        </div>
        <div style="text-align:center; color:#555;">
          <a href="<?php global $base_url; print $base_url."/myngl/".  $myngl_id; ?>/rsvp/<?php print $date_index;?>" style="color:#555;text-decoration:none;">
            <img src="http://www.themyngl.com/sites/all/themes/myngl/images/rsvp-button.png" /><br />
            Click Here to RSVP your spot.
          </a>
        </div>
      </div>
    </div>
  </body>
</html>
