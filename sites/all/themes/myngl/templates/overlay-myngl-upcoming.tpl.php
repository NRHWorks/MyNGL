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
    <h1 class="title">YOUR UPCOMING MYNGLS</h1>
    <?php foreach ($myngls as $k => $m) : ?>
      <div class="upcoming-myngl-wrapper">
        <span class="title"><?php print $m['brand']->title; ?></span><br />
        <span class="date"><?php print myngl_short_date($m['date']); ?></span><br />

        <div class="upcoming-myngl-border">
          <div class="upcoming-myngl-background" style="background-image: url(<?php print image_style_url('myngl_upcoming_overlay', $m['brand']->field_myngl_upcoming_graphic['und'][0]['uri']); ?>)">
            <div class="upcoming-myngl-cover">
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
                <a href="#" onclick="return myngl_upcoming.cancel_rsvp(<?php print arg(1); ?>, <?php print $k; ?>);">
                  <i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;Cancel Attendance</a>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="upcoming-myngls-pane" id="upcoming-myngls-pane-details-<?php print $k; ?>">
        <div class="upcoming-myngls-pane-content">
          <a href="#" onclick="return myngl_upcoming.close_pane();" class="overlay-close">X</a>
          <div class="upcoming-pane-details">
            MORE INFORMATION ON THIS MYNGL<br>
            <span class="title"><?php print $m['myngl']->title; ?></span><br>
            <?php print theme_image_style(array('style_name' => 'myngl_upcoming_overlay_small', 'path' => $m['brand']->field_myngl_upcoming_graphic['und'][0]['uri'], 'height' => null, 'width' => null)); ?><br />
            <div class="upcoming-myngls-pane-info">
              <span class="date"><?php print myngl_long_date($m['date']); ?></span>&nbsp;
              <a href="#" onclick="return myngl_upcoming.change_date(<?php print $k; ?>)">Select Another Date</a><br><br>
              <span class="info-header">SUMMARY</span><br>
              <?php print $m['myngl']->field_myngl_description['und'][0]['safe_value']; ?><br><br>
              
              <span class="info-header">SPONSORED BY</span<br>
              <?php print $m['myngl']->field_myngl_sponsor['und'][0]['safe_value']; ?><br>
            </div><br><br>

            <span class="info-header">ADD TO CALENDAR</span><br><br>
            <a href="http://example.com/link-to-your-event" title="Add to Calendar" class="addthisevent">
              <span class="_start"><?php print myngl_addthis_date($m['date']); ?></span>
              <span class="_end"><?php print myngl_addthis_end_date($m['date']); ?></span>
              <span class="_zonecode">35</span>
              <span class="_summary"><?php print $m['myngl']->title; ?></span>
              <span class="_description"><?php print strip_tags($m['myngl']->field_myngl_description['und'][0]['safe_value']); ?></span>
              <span class="_location"><?php print $m['brand']->title; ?>.myngl.com</span>
              <span class="_organizer"><?php print $m['brand']->title; ?></span>
              <span class="_organizer_email">admin@myngl.com</span>
              <span class="_facebook_event">http://www.facebook.com/events/160427380695693</span>
              <span class="_all_day_event">false</span>
              <span class="_date_format">DD/MM/YYYY</span>
            </a>
          </div>
        </div>
        <div class="upcoming-myngls-pane-footer">
          <div class="upcoming-myngls-pane-footer-left">
            <a href="#" onclickd="return myngl_upcoming.cancel_rsvp(<?php print arg(1); ?>, <?php print $k; ?>);">Cancel your RSVP</a>
          </div>
          <div class="upcoming-myngls-pane-footer-right">
              <input type="button" value="UPLOAD CONTENT" onclick="return myngl_upcoming.upload_images(<?php print $k ?>);"  />
          </div>
        </div>
      </div>

      <div class="upcoming-myngls-pane" id="upcoming-myngls-pane-upload-images-<?php print $k; ?>">
        <div class="upcoming-myngls-pane-content">
          <a href="#" onclick="return myngl_upcoming.close_pane();" class="overlay-close">X</a>
          UPLOAD YOUR CONTENT<br />
          <?php print $m['myngl']->title; ?><br /><br />
          
          SUMMARY<br />
          <?php print $m['myngl']->field_myngl_description['und'][0]['safe_value']; ?><br /><br />

          <strong>IMAGES --icon--</strong></a>
          <a href="#" onclick="return myngl_upcoming.upload_videos(<?php print $k; ?>);">VIDEO --icon--</a>
          <a href="#" onclick="return myngl_upcoming.upload_doc(<?php print $k; ?>);">.DOC --icon--</a>
          <br /><br />
      
          <form>
            <input type="file" />
            <input type="submit" value="Submit" />
          </form>
          Only file formats to upload: .jpg. .png, or .gif 
          <a href="">+ Add Another</a>
        </div>
        <div class="upcoming-myngls-pane-footer">
          <div class="upcoming-myngls-pane-footer-left">
            <a href="#" onclick="return myngl_upcoming.cancel_upload();">Cancel Upload</a>
          </div>
          <div class="upcoming-myngls-pane-footer-right">
              <input type="button" value="UPLOAD FINISHED" onclick="return myngl_upcoming.upload_finished(<?php print $k ?>);"  />
          </div>
        </div>
      </div>
      
      <div class="upcoming-myngls-pane" id="upcoming-myngls-pane-upload-docs-<?php print $k; ?>">
        <div class="upcoming-myngls-pane-content">
          <a href="#" onclick="return myngl_upcoming.close_pane();" class="overlay-close">X</a>
          UPLOAD YOUR CONTENT<br />
          <?php print $m['myngl']->title; ?><br /><br />
          
          SUMMARY<br />
          <?php print $m['myngl']->field_myngl_description['und'][0]['safe_value']; ?><br /><br />

          <a href="#" onclick="return myngl_upcoming.upload_images(<?php print $k; ?>);">IMAGES --icon--</a>  
          <a href="#" onclick="return myngl_upcoming.upload_videos(<?php print $k; ?>);">VIDEO --icon--</a>  
          <strong>.DOC --icon--</strong> 
          <br /><br />
      
          <form>
            <input type="file" />
            <input type="submit" value="Submit" />
          </form>
          Only file formats to upload: .doc. .docx, .txt 
          <a href="">+ Add Another</a>
        </div>
        <div class="upcoming-myngls-pane-footer">
          <div class="upcoming-myngls-pane-footer-left">
            <a href="#" onclick="return myngl_upcoming.cancel_upload();">Cancel Upload</a>
          </div>
          <div class="upcoming-myngls-pane-footer-right">
              <input type="button" value="UPLOAD FINISHED" onclick="return myngl_upcoming.upload_finished(<?php print $k ?>);"  />
          </div>
        </div>
      </div>

      <div class="upcoming-myngls-pane" id="upcoming-myngls-pane-upload-videos-<?php print $k; ?>">
        <div class="upcoming-myngls-pane-content">
          <a href="#" onclick="return myngl_upcoming.close_pane();" class="overlay-close">X</a>
          UPLOAD YOUR CONTENT<br />
          <?php print $m['myngl']->title; ?><br /><br />
          
          SUMMARY<br />
          <?php print $m['myngl']->field_myngl_description['und'][0]['safe_value']; ?><br /><br />

          <a href="#" onclick="return myngl_upcoming.upload_images(<?php print $k; ?>);">IMAGES --icon--</a>  
          <strong>VIDEO --icon--</strong>  
          <a href="#" onclick="return myngl_upcoming.upload_docs(<?php print $k; ?>);">.DOC --icon--</a> 
          <br /><br />
      
          <form>
            <input type="file" />
            <input type="submit" value="Submit" />
          </form>
          YouTube Video only.  Include http:// 
          <a href="#">+ Add Another</a>
        </div>
        <div class="upcoming-myngls-pane-footer">
          <div class="upcoming-myngls-pane-footer-left">
            <a href="#" onclick="return myngl_upcoming.cancel_upload();">Cancel Upload</a>
          </div>
          <div class="upcoming-myngls-pane-footer-right">
              <input type="button" value="UPLOAD FINISHED" onclick="return myngl_upcoming.upload_finished(<?php print $k ?>);"  />
          </div>
        </div>
      </div>
      
      <div class="upcoming-myngls-pane" id="upcoming-myngls-pane-change-date-<?php print $k; ?>">
        <form>
        <div class="upcoming-myngls-pane-content">
          <a href="#" onclick="return myngl_upcoming.close_pane();" class="overlay-close">X</a>
          More information on this Myngl<br>
          <?php print $m['myngl']->title; ?><br>
          <?php print theme_image_style(array('style_name' => 'myngl_upcoming_overlay_small', 'path' => $m['brand']->field_myngl_upcoming_graphic['und'][0]['uri'], 'height' => null, 'width' => null)); ?><br />
          <?php print myngl_long_date($m['date']); ?><br />
          This Myngl will also run on the following dates.  Pick one that will work for you:
          <?php 
            foreach ($m['myngl']->field_myngl_dates['und'] as $d) : 
              print "<div>";
              print "<input type='radio' name='change-date-radio' value='".$d['value']." EST' style='margin-left:60px;margin-right:10px;'>";
              print '<div style="font-size: 18px; display: inline;">' . myngl_long_date($d['value']) . 'EST</div><br /><br />';
              print "</div>";
            endforeach; 
          ?>
        </div>
        <div class="upcoming-myngls-pane-footer">
          <div class="upcoming-myngls-pane-footer-left">
            <a href="#" onclick="return myngl_upcoming.details(<?php print $k; ?>);">Go Back</a>
          </div>
          <div class="upcoming-myngls-pane-footer-right">
            <input type="submit" value="Confirm" />
          </div>
        </div>
        </form>
      </div>
    <?php endforeach; ?>
  </div>
  
</div>
