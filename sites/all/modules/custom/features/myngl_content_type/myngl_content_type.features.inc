<?php
/**
 * @file
 * myngl_content_type.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function myngl_content_type_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_node_info().
 */
function myngl_content_type_node_info() {
  $items = array(
    'myngl' => array(
      'name' => t('MyNGL'),
      'base' => 'node_content',
      'description' => t('Use this content type to create MyNGLs'),
      'has_title' => '1',
      'title_label' => t('MyNGL'),
      'help' => '',
    ),
  );
  return $items;
}
