  <footer>
    <div id="myngl-event-menu" class="branded">
      <div id="myngl-event-menu-center">
        <ul>
          <li class="inactive" id="lounge"><a href="/myngl-event/<?php print $myngl->nid; ?>/social-area">theMyngl Lounge</a></li>
          <li class="inactive" id="theater"><a href="/myngl-event/<?php print $myngl->nid; ?>/theater">Theater</a></li>
          <li class="inactive" id="play-room"><a href="/myngl-event/<?php print $myngl->nid; ?>/activity-room">PlayRoom</a></li>
          <li class="inactive" id="gifting-suite"><a href="/myngl-event/<?php print $myngl->nid; ?>/rewards">Gifting Suite</a></li>
          <li class="inactive" id="exit"><a href="/myngl-event/<?php print $myngl->nid; ?>/exit">Exit</a></li>
          <li class="inactive" id="help"><a href="#" onclick="myngl.overlay('help-overlay',500,800);">HELP</a></li>
          <li class="inactive" id="pause"><a href="#" id="audio_pause"><i class="fa fa-pause"></i></a></li>
          <li class="inactive" id="the-myngl"><a href="/">theMyngl</a></li>
        <ul>
      </div>
    </div>
  <footer>

<script type="text/javascript">

  var background_music_playing = true;
  var user_turn_off_music = false;

  (function ($) {
    $(document).ready(function() {

      // added by ming because this shit is annoying.
      //$('audio').trigger('pause');

      $('#audio_pause').click(function() {
        if (background_music_playing == true) {
          background_music_playing = false;
          $('audio').trigger('pause');
          $('.fa-pause').removeClass('fa-pause').addClass('fa-play');
          user_turn_off_music = true;
        } else {
          background_music_playing = true;
          $('audio').trigger('play');
          $('.fa-play').removeClass('fa-play').addClass('fa-pause');
          user_turn_off_music = false;
        }
      });
    });
  }) (jQuery);
</script>

<?php
    $block = block_load('block', '3');
    $renderable = _block_get_renderable_array(_block_render_blocks(array($block)));
    print render ($renderable);
  ?>

<?php /* TODO: MOVE THIS TO A MODULE */ ?>

<div id='help-overlay'>
  <?php
    $block = block_load('block', '1');
    $renderable = _block_get_renderable_array(_block_render_blocks(array($block)));
    print render ($renderable);
  ?>
</div>
