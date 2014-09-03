<?php

drupal_add_library('system', 'jquery.cookie');

function myngl_preprocess_html(&$vars) {
  if (arg(0) == 'myngl-event') {
    $myngl = node_load(arg(1));
    $brand = node_load($myngl->field_myngl_brand['und'][0]['nid']);

    $vars['colors']['primary'] = $brand->field_brand_primary_color['und'][0]['rgb'] ;
    $vars['colors']['secondary'] = $brand->field_brand_secondary_color['und'][0]['rgb'] ;
    $vars['colors']['background'] = $brand->field_brand_background_color['und'][0]['rgb'] ;
    $vars['colors']['tertiary'] = $brand->field_brand_tertiary_color['und'][0]['rgb'] ;
  }
}

function myngl_preprocess_page(&$vars) {
  if (arg(0) == 'myngl-event') {
    $myngl = node_load(arg(1));
    $vars['myngl'] = $myngl;

    $brand = node_load($myngl->field_myngl_brand['und'][0]['nid']);
    $vars['brand'] = $brand;

  }
}

function myngl_long_date($date) {


  $timestamp = strtotime($date);
  $long_date = date('m.d.Y @ h:i a', $timestamp) . ((date("I",$timestamp)==1)?" EDT":" EST");
  return $long_date;
  //return date('m.d.Y @ h:i a',strtotime($date)) . ' EST';
  // Used to be  m.d.Y @ g:i a. I changed it so that upcoming.js upcoming.update_overlay_short_date works.
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
