<?php

/**
 * @file
 * Default theme implementation to display a block.
 *
 * Available variables:
 * - $block->subject: Block title.
 * - $content: Block content.
 * - $block->module: Module that generated the block.
 * - $block->delta: An ID for the block, unique within each module.
 * - $block->region: The block region embedding the current block.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - block: The current template type, i.e., "theming hook".
 *   - block-[module]: The module generating the block. For example, the user
 *     module is responsible for handling the default user navigation block. In
 *     that case the class would be 'block-user'.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Helper variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $block_zebra: Outputs 'odd' and 'even' dependent on each block region.
 * - $zebra: Same output as $block_zebra but independent of any block region.
 * - $block_id: Counter dependent on each block region.
 * - $id: Same output as $block_id but independent of any block region.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 * - $block_html_id: A valid HTML ID and guaranteed unique.
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>

<style type="text/css">

#help-overlay-inner{
	position:absolute;
  z-index:300;
	left:0;
	right:0;
  height:500px;
  width:800px;
	margin-left:auto;
	margin-right:auto;
  background-color:#e2dbd2;
	border:solid 20px #53302a;
  border-top: solid 35px #53302a;

}
#help-overlay-close{
  position:absolute;
  right:0px;
  top:-20px;
  color:#a38d50;
}
#help-title{
  color: #a38d50;
  font-size:30px;
  font-family:"georgia";
  margin-left:20px;
  margin-top:20px;

}
#help-overlay-inner ol li{
  margin-bottom:10px;
}

#help-overlay-inner .short-line{
  width:50px;
  height:1px;
  border-top:2px #555555 solid;
  margin-left:20px;
  margin-top:10px;
}
</style>
<div id="help-overlay-inner" >
  <div id="help-overlay-close" onclick="myngl.help_overlay_close()">X</div>
  <div id="help-title" >Need Help? Find your problem below:</div>
  <div class="short-line"></div>
  <ol style="list-style-type:decimal">
    <li>I'm having problems with the sound</li>
    <li>I'm having problems with the videos</li>
    <li>I have problems watching/hearing LIVE performance</li>
    <li>How do I chat with others?</li>
    <li>How do I move from room to room?</li>
    <li>How do I make comments on Shout Out?</li>
    <li>How do I redeem Reward Points?</li>
    <li>How do I use social media tools?</li>
  </ol>
  <div class="short-line"></div>
</div>
