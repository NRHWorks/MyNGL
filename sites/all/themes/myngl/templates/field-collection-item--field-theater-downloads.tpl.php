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

global $fb_count;

$fb_count += 1;

?>

<?php $brand = node_load($node->field_myngl_brand['und'][0]['nid']);  ?>
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
?>

      <div class="social-icons">
          <a href="mailto:?body=<?php print ($u != NULL)?urlencode($u['path']):""; ?>&subject=<?php print $title; ?>">
            <img src="/sites/all/themes/myngl/images/ucg-email.png" />
          </a>

          <script>function fbs_click<?php print $fb_count; ?>() {u='<?php print ($u!= NULL)? $u['path']:""; ?>';t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>
          <a href="http://www.facebook.com/share.php" onclick="return fbs_click_<?php print $fb_count; ?>()" target="_blank" title="Myngl">
            <img src="/sites/all/themes/myngl/images/ucg-facebook.png" />
          </a>

          <script>function twt_click_<?php print $k; ?>() { window.open('https://twitter.com/share?url=<?php print ($u!= NULL)?urlencode($u['path']):""; ?>&text=<?php print urlencode('At theMyngl – Cool new Online Experiential Event! Exclusive content, Chat, FREE gifts! theMyngl.com #'. $brand->title .'Myngl'); ?>','sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>
          <a href="https://twitter.com/share?url=<?php print urlencode($u['path']); ?>&text=<?php print urlencode('At theMyngl – Cool new Online Experiential Event! Exclusive content, Chat, FREE gifts! theMyngl.com #'. $brand->title .'Myngl'); ?>" onclick="return twt_click_<?php print $k; ?>()" target="_blank">
            <img src="/sites/all/themes/myngl/images/ucg-twitter.png" />
          </a>
      </div>

<?php
      print render($content['field_title']);
      print render($content['field_description']);
      if(isset($content['field_downloadable_file'])){
        print "<div class='file-download'><a href='http:".strip_tags(render($content['field_downloadable_file']))."' target='_blank'>DOWNLOAD <div class='button'>></div></a></div>";
      }
      else {
        print "NO FILE AVAILABLE";
      }
      print "</div>";

    ?>
  </div>
</div>
