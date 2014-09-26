<?php

drupal_add_library('system', 'jquery.cookie');

function myngl_preprocess_html(&$vars) {

  if ((arg(0)=='user') && isset($_COOKIE['Drupal_visitor_rsvp_date'])) {
    drupal_goto('myngl/'.$_COOKIE['Drupal_visitor_rsvp'].'/rsvp/complete');
  }

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

