<?php
/* variables that will be useful for building this page */

//print '<pre>'; print_r($myngl); exit;

print "EVENT LOGO: ".file_create_url($brand->field_event_logo['und'][0]['uri'])."<br>";
print "BACKGROUND GRAPHIC: ".file_create_url($brand->field_lobby_background_graphic['und'][0]['uri'])."<br>";
print "PRIMARY COLOR: ".$brand->field_brand_primary_color['und'][0]['rgb']."<br>";
print "SECONDARY COLOR: ".$brand->field_brand_secondary_color['und'][0]['rgb']."<br>";

print "VIDEO: ".theme('youtube_video', array('video_id' => $myngl->field_welcome_video['und'][0]['video_id']));

?>

