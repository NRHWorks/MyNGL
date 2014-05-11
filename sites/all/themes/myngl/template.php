<?php

drupal_add_library('system', 'jquery.cookie');

function myngl_preprocess_page(&$vars) {
  if (arg(0) == 'myngl-event') {
    $myngl = node_load(arg(1));
    $vars['myngl'] = $myngl;

    $brand = node_load($myngl->field_myngl_brand['und'][0]['nid']);
    $vars['brand'] = $brand;

  }
}

function myngl_long_date($date) {
  return date('m.d.Y @ g:i a',strtotime($date)) . ' EST';
}

function myngl_short_date($date) {
  return date('m.d.Y',strtotime($date));
}

function myngl_addthis_date($date) {
  return date('d-m-Y G:i:00',strtotime($date));
}

function myngl_addthis_end_date($date) {
  return date('d-m-Y G:i:00',(strtotime($date)+3600));
}
