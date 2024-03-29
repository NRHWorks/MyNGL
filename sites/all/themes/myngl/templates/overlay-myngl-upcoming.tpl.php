<?php global $user; ?>
<script type="text/javascript" src="http://js.addthisevent.com/atemay.js"></script>

<script type="text/javascript">
addthisevent.settings({
  mouse   : false,
  css     : false,
  outlook   : {show:true, text:"Outlook"},
  google    : {show:true, text:"Google"},
  yahoo   : {show:true, text:"Yahoo"},
  ical    : {show:true, text:"iCal"},
  hotmail   : {show:true, text:"Hotmail"}
});
</script>

<div id="upcoming-myngls" class="overlay">
  <a href="#" onclick="return myngl.overlay_close();" class="overlay-close">X</a>
  <div id="upcoming-myngls-landing">
    <h1 class="title" >YOUR UPCOMING MYNGLS</h1>

    <?php if (count($myngls)>3): ?>
      <style>
        .upcoming-fa{
          font-size:35px;
          position:absolute;
          top:470px;

        }
        .fa-chevron-circle-left.upcoming-fa{
          left:40px;
        }
        .fa-chevron-circle-right.upcoming-fa{
          left:720px;
        }
      </style>
      <div class="fa fa-chevron-circle-left upcoming-fa" id="left" onclick="upcoming_scroll.left();"></div>
      <div class="fa fa-chevron-circle-right upcoming-fa" id="right" onclick="upcoming_scroll.right();"></div>
    <?php endif; ?>

    <div id='myngl-icons-wrapper' style="overflow:hidden;position:relative;">
      <div id='myngl-icons-inner' style=" width:<?php print count($myngls)*249; ?>px; position:relative;">
        <?php foreach ($myngls as $k => $m) : ?>
          <div class="upcoming-myngl" id='upcoming-myngl-<?php print $m['myngl']->nid;?>'>
            <div class="upcoming-myngl-wrapper" id="upcoming-myngl-wrapper-<?php print $m['myngl']->nid;?>">
              <span class="title"><?php print $m['brand']->title; ?></span><br />
              <span class="date short-date"><?php print myngl_timing_short_date($m['date']); ?></span><br />
              <div class="upcoming-myngl-border">
                <div class="upcoming-myngl-background" style="background-image: url(<?php print image_style_url('myngl_upcoming_overlay', $m['brand']->field_myngl_upcoming_graphic['und'][0]['uri']); ?>)" onclick="jQuery('#upcoming-myngl-cover-<?php print $k; ?>').toggle();">
                  <div class="upcoming-myngl-cover" id="upcoming-myngl-cover-<?php print $k; ?>">
                    <div class="upcoming-myngl-link upcoming-myngl-details">
                      <a href="#" onclick="return myngl_upcoming.details(<?php print $k; ?>);">
                        <i class="fa fa-align-left"></i>&nbsp;&nbsp;&nbsp;View Details
                      </a>
                    </div>
                    <div class="upcoming-myngl-link upcoming-myngl-upload">
                      <a href="#" onclick="return myngl_upcoming.upload_images(<?php print $k; ?>);">
                        <i class="fa fa-upload"></i>&nbsp;&nbsp;&nbsp;Upload Content
                      </a>
                    </div>
                    <div class="upcoming-myngl-link upcoming-myngl-attendance">
                      <a href="#" onclick="myngl.cancel_invitation(<?php print $m['myngl']->nid; ?>)">
                        <i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;Cancel Attendance</a>
                      </div>
                  </div>
                </div>
              </div>

              <div class="confirm-cancel" id="confirm-cancel-<?php print $m['myngl']->nid; ?>">
                <p>Are you sure that you want to cancel the event <?php print $m['myngl']->title?>?</p>
                <a style="float:left; margin-top:50px;" href="/myngl/<?php print $m['myngl']->nid; ?>/cancel-invitation">
                  <i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;Cancel Attendance</a>
                </a>
                <a style="float:right;margin-top:50px;" href="#" onclick="myngl.cancel_cancel(<?php print $m['myngl']->nid; ?>)">
                  <i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;Keep my RSVP</a>
                </a>
              </div><!-- /.confirm-cancel -->

            </div><!-- /.upcoming-myngl-wrapper -->


          </div> <!-- /#upcoming-myngl -->
        <?php endforeach; ?>


      </div> <!-- /#myngl-icons-inner-->
    </div><!-- /#myngl-icons-wrapper -->
    <style>
      .upcoming-myngl-detail-panels .form-type-radio.form-item-date{
        display:block !important;
        float:none !important;
        width:400px !important;
        margin-left:90px;
      }
      .upcoming-myngl-detail-panels .form-type-radios.form-item-date .description{
        margin-left:90px;
        margin-top:20px;
      }
    </style>
    <?php foreach($myngls as $k => $m):?>
      <div class="upcoming-myngl-detail-panels" id='upcoming-myngl-details-<?php print $m['myngl']->nid;?>' >
        <div class="upcoming-myngls-pane upcoming-myngls-pane-details-<?php print $m['myngl']->nid; ?>" id="upcoming-myngls-pane-details-<?php print $k; ?>">
          <div class="upcoming-myngls-pane-content">
            <a href="#" onclick="return myngl_upcoming.close_pane();" class="overlay-close">X</a>
            <div class="upcoming-pane-details">
              MORE INFORMATION ON THIS MYNGL<br>
              <span class="title"><?php print $m['myngl']->title; ?></span><br>
              <?php print theme_image_style(array('style_name' => 'myngl_upcoming_overlay_small', 'path' => $m['brand']->field_myngl_upcoming_graphic['und'][0]['uri'], 'height' => null, 'width' => null)); ?><br />
              <div class="upcoming-myngls-pane-info">
                <span class="date long-date"><?php print myngl_timing_long_date($m['date']); ?></span>&nbsp;
                <a href="#" onclick="return myngl_upcoming.change_date(<?php print $k; ?>)">Select Another Date</a><br><br>
                <span class="info-header">SUMMARY</span><br>
                <?php print $m['myngl']->field_myngl_description['und'][0]['safe_value']; ?><br><br>

                <span class="info-header">SPONSORED BY</span><br>
                <?php print $m['myngl']->field_myngl_sponsor['und'][0]['safe_value']; ?>
              </div><br>

              <span class="info-header">ADD TO CALENDAR</span><br><br>
              <a href="<?php global $base_url; print $base_url;?>"
                 title="Add to Calendar"
                 class="addthisevent">
                <span class="_start"></span>
                <span class="_end"></span>
                <span class="_zonecode">15</span>
                <span class="_summary"><?php print $m['myngl']->title; ?></span>
                <span class="_description"><?php print strip_tags($m['myngl']->field_myngl_description['und'][0]['safe_value']); ?></span>
                <span class="_location"><?php print $m['brand']->title; ?>.myngl.com</span>
                <span class="_organizer"><?php print $m['brand']->title; ?></span>
                <span class="_organizer_email">admin@myngl.com</span>
                <!--<span class="_facebook_event">
                  http://www.facebook.com/events/<?php print $m['facebook_event_id'];?></span>-->
                <span class="_all_day_event">false</span>
                <span class="_date_format">DD/MM/YYYY</span>
              </a>
            </div>
          </div>
          <div class="upcoming-myngls-pane-footer">
            <div class="upcoming-myngls-pane-footer-left">
              <a href="/myngl/<?php print $m['myngl']->nid; ?>/cancel-invitation">Cancel your RSVP</a>
            </div>
            <div class="upcoming-myngls-pane-footer-right">
                <input type="button" value="UPLOAD CONTENT" onclick="return myngl_upcoming.upload_images(<?php print $k ?>);"  />
            </div>
          </div>
        </div>

        <div class="upcoming-myngls-pane upcoming-myngls-pane-upload-images-<?php print $m['myngl']->nid; ?>" id="upcoming-myngls-pane-upload-images-<?php print $k; ?>">
          <div class="upcoming-myngls-pane-content upload-pane">
            <a href="#" onclick="return myngl_upcoming.close_pane();" class="overlay-close">X</a>
            <div class="upcoming-pane-details">
              UPLOAD YOUR CONTENT<br />
              <span class="title"><?php print $m['myngl']->title; ?></span><br><br>

              <span class="info-header">SUMMARY</span><br>
              <div style="height:170px; overflow: auto;">
                <?php print $m['myngl']->field_myngl_description['und'][0]['safe_value']; ?>
              </div><br /><br />
              <hr>
              <strong>IMAGES <i class="fa fa-picture-o"></i></strong></a>
              <a href="#" onclick="return myngl_upcoming.upload_videos(<?php print $k; ?>);">VIDEO <i class="fa fa-film"></i></a>
              <a href="#" onclick="return myngl_upcoming.upload_docs(<?php print $k; ?>);">.DOC <i class="fa fa-file-text"></i></a>
              <br /><br />

              <div id="myngl-myngl-image-upload-wrapper-<?php print $k; ?>">
                <div id="myngl-upload-image-success-<?php print $k; ?>"></div>
                <?php $this_form = drupal_get_form('myngl_myngl_image_upload', $k, $m['myngl']->nid, $user->uid);?>
                <?php print render($this_form); ?>
              </div>

             <!--<a class="upload-add" href="#"><i class="fa fa-plus-circle"></i>Add Another</a> -->
            </div>
          </div>
          <div class="upcoming-myngls-pane-footer">
            <div class="upcoming-myngls-pane-footer-left">
              <a href="#" onclick="return myngl_upcoming.cancel_upload();">Cancel Upload</a>
            </div>
            <div class="upcoming-myngls-pane-footer-right">
                <input type="button" value="UPLOAD FINISHED" onclick="return myngl_upcoming.upload_finished(<?php print $k . ",". $m['myngl']->nid . ", " . $user->uid?>);"  />
            </div>
          </div>
        </div>

        <div class="upcoming-myngls-pane" id="upcoming-myngls-pane-upload-docs-<?php print $k; ?>">
          <div class="upcoming-myngls-pane-content upload-pane">
            <a href="#" onclick="return myngl_upcoming.close_pane();" class="overlay-close">X</a>
            <div class="upcoming-pane-details">
              UPLOAD YOUR CONTENT<br />
               <span class="title"><?php print $m['myngl']->title; ?></span><br><br>

              <span class="info-header">SUMMARY</span><br>
              <div style="height:170px; overflow: auto;">
                <?php print $m['myngl']->field_myngl_description['und'][0]['safe_value']; ?>
              </div><br /><br />
              <hr>
              <a href="#" onclick="return myngl_upcoming.upload_images(<?php print $k; ?>);">IMAGES <i class="fa fa-picture-o"></i></a>
              <a href="#" onclick="return myngl_upcoming.upload_videos(<?php print $k; ?>);">VIDEO <i class="fa fa-film"></i></a>
              <strong>.DOC <i class="fa fa-file-text"></i></strong>
              <br /><br />

              <div id="myngl-myngl-doc-upload-wrapper-<?php print $k; ?>">
                <div id="myngl-upload-doc-success-<?php print $k; ?>"></div>
                <?php $this_form = drupal_get_form('myngl_myngl_doc_upload', $k, $m['myngl']->nid, $user->uid);?>
                <?php print render($this_form); ?>
              </div>

             <!--<a class="upload-add" href="#"><i class="fa fa-plus-circle"></i>Add Another</a> -->
            </div>
          </div>
          <div class="upcoming-myngls-pane-footer">
            <div class="upcoming-myngls-pane-footer-left">
              <a href="#" onclick="return myngl_upcoming.cancel_upload();">Cancel Upload</a>
            </div>
            <div class="upcoming-myngls-pane-footer-right">
                <input type="button" value="UPLOAD FINISHED" onclick="return myngl_upcoming.upload_finished(<?php print $k . ",". $m['myngl']->nid . ", " . $user->uid?>);"  />
            </div>
          </div>
        </div>

        <div class="upcoming-myngls-pane" id="upcoming-myngls-pane-upload-videos-<?php print $k; ?>">
          <div class="upcoming-myngls-pane-content upload-pane">
            <a href="#" onclick="return myngl_upcoming.close_pane();" class="overlay-close">X</a>
            <div class="upcoming-pane-details">
              UPLOAD YOUR CONTENT<br />
               <span class="title"><?php print $m['myngl']->title; ?></span><br><br>

              <span class="info-header">SUMMARY</span><br>
              <div style="height:170px; overflow: auto;">
                <?php print $m['myngl']->field_myngl_description['und'][0]['safe_value']; ?>
              </div><br /><br />
              <hr>
              <a href="#" onclick="return myngl_upcoming.upload_images(<?php print $k; ?>);">IMAGES <i class="fa fa-picture-o"></i></a>
              <strong>VIDEO <i class="fa fa-film"></i></strong>
              <a href="#" onclick="return myngl_upcoming.upload_docs(<?php print $k; ?>);">.DOC <i class="fa fa-file-text"></i></a>
              <br /><br />

              <div id="myngl-myngl-youtube-embed-wrapper-<?php print $k; ?>">
                <div id="myngl-upload-youtube-success-<?php print $k; ?>"></div>
                <?php $this_form = drupal_get_form('myngl_myngl_youtube_embed', $k, $m['myngl']->nid, $user->uid);?>
                <?php print render($this_form); ?>
              </div>

              <!--<a class="upload-add" href="#"><i class="fa fa-plus-circle"></i>Add Another</a>-->
            </div>
          </div>
          <div class="upcoming-myngls-pane-footer">
            <div class="upcoming-myngls-pane-footer-left">
              <a href="#" onclick="return myngl_upcoming.cancel_upload();">Cancel Upload</a>
            </div>
            <div class="upcoming-myngls-pane-footer-right">
                <input type="button" value="UPLOAD FINISHED" onclick="return myngl_upcoming.upload_finished(<?php print $k . ",". $m['myngl']->nid . ", " . $user->uid?>);"  />
            </div>
          </div>
        </div>

        <div class="upcoming-myngls-pane" id="upcoming-myngls-pane-change-date-<?php print $k; ?>">
          <div class="upcoming-myngls-pane-content">
            <a href="#" onclick="return myngl_upcoming.close_pane();" class="overlay-close">X</a>
            <div class="upcoming-pane-details">
              MORE INFORMATION ON THIS MYNGL<br>
              <span class="title"><?php print $m['myngl']->title; ?></span><br>
              <?php print theme_image_style(array('style_name' => 'myngl_upcoming_overlay_small', 'path' => $m['brand']->field_myngl_upcoming_graphic['und'][0]['uri'], 'height' => null, 'width' => null)); ?><br />
              <div id="upcoming-myngls-pane-info-<?php print $k; ?>">
                <!--<span class="date">Current <?php print myngl_timing_long_date($m['date']); ?></span><br><br>
                This Myngl will also run on the following dates.  Pick one that will work for you: <br><br>-->

                <div id="myngl-myngl-change-date-wrapper-<?php print $k; ?>">
                  <?php $this_form = drupal_get_form('myngl_myngl_overlay_change_date', $k, $m['myngl']->nid, $user->uid) ?>
                  <?php print render($this_form); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="upcoming-myngls-pane-footer">
            <div class="upcoming-myngls-pane-footer-left">
              <a href="#" onclick="return myngl_upcoming.details(<?php print $k; ?>);">Go Back</a>
            </div>
          </div>
        </div>
      </div>      <!-- /..upcoming-myngl-detail-panels -->
    <?php endforeach; ?>
  </div>
  
</div>
