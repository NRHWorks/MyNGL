<style type="text/css">
  .event-detail-overlay{
    z-index:300;
    position:absolute;
    top:100px;
    left:0;
    right:0;
    margin-left:auto;
    margin-right:auto;
    width:700px;
    background-color:#ffffff;
    padding:10px;
    font-size:16px;

  }

  #event-detail #event-detail-overlay-close{
    position:absolute;
    right:25px;
    top:15px;
    font-size:20px;
  }
  #event-detail{
    padding:50px;
    padding-bottom:30px;
    width:auto;
    background-color:#3b434d; /*dark-blue-gray*/
    color:#ffffff;
    margin-bottom:40px;
  }

  #event-detail #event-title{
    font-size:24px;
    margin-top:5px;
    margin-bottom:50px;
  }
  #event-detail #event-thumb{
    float:left;
  }
  #event-detail #event-date{
    font-size:20px;
  }
  #event-detail #event-detail-text-wrapper{
    margin-left:170px;
    margin-bottom:50px;
  }

  #event-detail .label{
    margin-top:20px;
    font-size:16px;
    color:#999999;
    margin-bottom:-10px;
  }

  #event-detail #add-to-calendar-wrapper form{
    margin-top:20px !important;
    margin-left:170px;
    padding-top:10px;
    width:auto;
  }
  #event-detail #add-to-calendar-wrapper form input[type="submit"]{
    border:1px solid #ffffff;
    background:none;
    color:#ffffff;
    padding-top:0px;
    font-size:16px;
    font-family:'lato';
    text-align:center;
    padding: 5px 0 5px 0;
    width:60px;

    margin-left:50px;

  }
</style>


<?php

  foreach ($myngl->field_myngl_invitees['und'] as $i) {
    $u = array_shift(entity_load('field_collection_item', array($i['value'])));
    if ($u->field_invitee_email_address['und'][0]['safe_value'] == $user->mail) {
      $timestamp = strtotime($u->field_invitee_rsvp_date['und'][0]['value']);
    }
  }
  $brand =node_load($myngl->field_myngl_brand['und'][0]['nid']);
?>

<div id="event-detail">
  <!--<div id='event-detail-overlay-close' onclick='myngl.close_event_detail()'>X</div>-->
  <div id="more-information">MORE INFORMATION ON THIS MYNGL</div>
  <div id='event-title'><?php print $myngl->title;?></div>
  <div id='event-thumb'>
    <?php
      $thumb = field_view_field('node', $brand, 'field_myngl_upcoming_graphic','full' );
      print render($thumb);
    ?>
  </div>
  <div id='event-detail-text-wrapper'>
    <div style='float:right;margin-top:4px;'>Change date? Click here.</div>
    <div id='event-date'><?php print date('m.d.Y @ g:i a T',$timestamp);?></div>
    <div class='label'>SUMMARY</div>
    <div id='event-description'>
      <?php
        $description = field_view_field('node', $myngl, 'field_myngl_description','full' );
        print render($description);
      ?>
    </div>

    <div class='label'>SPONSORED BY</div>
    <div id='event-sponsor'>
      <?php
        $sponsor = field_view_field('node', $myngl, 'field_myngl_sponsor','full' );
        print render($sponsor);
      ?>
    </div>
  </div><!-- /#event-detail-text-wrapper -->

  <div id='add-to-calendar-wrapper'>
    <div class='label' style='float:left;'>ADD TO CALENDAR</div>
      <form>
        <input type="radio" name='calendar' value="gmail">Gmail</input>
        <input type="radio" name='calendar' value="outlook">Outlook</input>
        <input type="radio" name='calendar' value="CS">CS</input>
        <input type="submit" value="Add"/>
      </form>
  </div> <!-- /#add-to-calendar-wrapper -->

</div><!-- /#event-detail -->


<div id='cancel-and-upload-content' style='margin-bottom:40px;padding:0 20px 0 20px;'>
  <!--<div id='upload' style='float:right;'>UPLOAD CONTENT</div>-->
  <div id='cancel-rsvp' style='text-decoration:underline;'>Cancel your RSVP</div>
</div><!-- /#cancel-and-upload-content -->

