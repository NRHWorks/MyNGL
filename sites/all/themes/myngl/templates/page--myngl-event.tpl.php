<div id="page-myngl-event-wrapper">
      <?php print $messages; ?>
      <div class="event-logo">
        <img src="<?php echo file_create_url($brand->field_event_logo['und'][0]['uri']); ?>">
        <div id="myngl-event-message">
    </div>
      </div>

    <div id="main-wrapper"><div id="main" class="clearfix">

      <div id="content" class="column"><div class="section">
        <?php print render($page['content']); ?>
      </div></div> <!-- /.section, /#content -->

    </div></div> <!-- /#main, /#main-wrapper -->

<?php include "footer.php"; ?>

<?php if (in_array(arg(2), array('social-area','activity-room','rewards', 'exit'))) : ?>
<audio autoplay loop style="display:none;">
  <source src="http:<?php $node = node_load(arg(1)); print file_create_url($node->field_audio['und'][0]['uri']); ?>" type="audio/mp3">
</audio>
<?php endif; ?>

</div>
