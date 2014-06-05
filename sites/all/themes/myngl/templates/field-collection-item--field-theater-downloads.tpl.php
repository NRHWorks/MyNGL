<?php

/**
 * @file
 * Default theme implementation for field collection items.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) field collection item label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-field-collection-item
 *   - field-collection-item-{field_name}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */
?>
<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>
    <?
      if(isset($content['field_downloads_image'])){
        print render($content['field_downloads_image']);
      }
      else {
        print "<div class='field_downloads_image_place_holder'></div>";
      }
      print "<div class='text-wrapper'>";
      print "<div class='social-icons'><img src='".base_path()."sites/all/themes/myngl/images/theater-downloads-social-icons1.png'/></div>";

      print render($content['field_title']);
      print render($content['field_description']);
      if(isset($content['field_downloadable_file'])){
        print "<div class='file-download'><a href='http:".strip_tags(render($content['field_downloadable_file']))."' target='_blank'>DOWNLOAD <div class='button'>></div></a></div>";
      }
      else {
        print "NO FILE AVAILABLE";
      }
      print "</div>";

      //print render($content);
      //print_r($content);
    ?>
  </div>
</div>
