<?php

print $myngl->title.'<br><br>';

print theme_image_style(array('style_name' => 'brand_logo', 'path' => $brand->field_brand_logo['und'][0]['uri'], 'height' => null, 'width' => null)).'<br><br>';

print $myngl->field_myngl_dates['und'][0]['value'].'<br><br>';

$link_text = 'Go to "'.$myngl->title.'" now!';
print l($link_text, 'myngl/' . $myngl->nid . '/pre-questions');

?>
