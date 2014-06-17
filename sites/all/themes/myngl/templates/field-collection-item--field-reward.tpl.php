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

<?php $item_id=  $content['field_level']["#object"]->item_id; ?>
<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>
    <div class="level-and-points-wrapper">
      <div class="level">
        <strong><?php print strip_tags(render($content['field_level']));?></strong> LEVEL
      </div>
      <div class="points"><strong class="number"><?php print strip_tags( render($content['field_points']));?></strong> Points
      </div>
    </div><!-- /.level-and-points-wrapper"-->

    <div class="short-line short-line-4"></div>
    <div class="image-and-texts-wrapper">
      <?php if(isset($content['field_thumb'])): ?>
        <?php print render($content['field_thumb']); ?>
      <?php else: ?>
        <div class='field-thumb-place-holder'></div>
      <? endif; ?>

      <div class='texts'>
        <?php print render ($content['field_title']); ?>
        <?php print render ($content['field_description']); ?>
        <div class="redeem" onclick="rewards_overlay.show(<?php print $item_id; ?>,<?php print strip_tags( render($content['field_points']));?>)">REDEEM GIFT<div class="redeem-button">></div></div>
      </div><!-- /.texts-->
    </div><!-- /.image-and-texts-wrapper"-->


  </div>
</div>
