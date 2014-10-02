
<style type="text/css">
h3 {
  margin-top:90px;
  font-size:200%;
}
.insight-tag {
  display:none;
}
#menu div{
  float:left;

  background-color:#bbbbbb;
  margin: 20px 5px 40px auto;
  border:1px solid #555555;
  padding:5px 20px 7px 20px;

}
#menu div.active{
  background-color:#ffffff;

}
</style>


<div id="menu">
  <div id='menu-0' class="active" onclick='insight.show(0)'>Theater Questions</div>
  <div id='menu-1' onclick='insight.show(1)'>POV Messages</div>
  <div id='menu-2' onclick='insight.show(2)'>Pre-Myngl Questions-answers</div>
  <div id='menu-3' onclick='insight.show(3)'>Post-Myngl Questions-answers</div>
  <div id='menu-4' onclick='insight.show(4)'>Chats</div>
</div>

<div style="clear:both"></div>
<div class = "insight-tag" id="tag-0" style="display:block">
  <h3>Theater Questions:</h3>
  <a href="<?php print base_path();?>node/<?php print $data['nid'];?>/insight/theater-questions-download" target="_blank">
    Download script
  </a>
  <ul>
    <?php foreach ($data['theater_questions'] as $q): ?>
      <li><?php print $q;?></li>
    <?php endforeach; ?>
  </ul>
</div>

<div class = "insight-tag" id="tag-1">
  <h3>POV Messages:</h3>
  <a href="<?php print base_path();?>node/<?php print $data['nid'];?>/insight/pov-download" target="_blank">
    Download script
  </a>
  <br/>
  <table>
    <tr>
      <th>User ID</th>
      <th>Question</th>
      <th>Message</th>
    </tr>
    <?php foreach($data['pov_messages'] as $m): ?>
      <tr>
        <td><?php print $m['user_id'];?></td>
        <td><?php print $m['question'];?></td>
        <td><?php print $m['message'];?></td>
      </tr>
    <?php endforeach;?>
  </table>
</div>

<div class = "insight-tag" id="tag-2">
  <h3>Pre Myngl Questions</h3>
  <a href="<?php print base_path();?>node/<?php print $data['nid'];?>/insight/pre-questions-download" target="_blank">
    Download script
  </a>
  <br/><br/><br/>
  <?php
    foreach($data['invitees'] as $i){
      if($i['uid']!= NULL){
        print "<strong>UID: " . $i['uid']. "</strong><br/>";
        foreach($data['pre_questions'] as $index=>$q){
          print "Question ".$index . ": " .$q. " -- ". $i['pre_questions']['question-'.$index].'<br/>';
        }
        print "<br/>";
      }

    }
  ?>
</div>

<div class = "insight-tag" id="tag-3">
  <h3>Post Myngl Questions</h3>
  <a href="<?php print base_path();?>node/<?php print $data['nid'];?>/insight/post-questions-download" target="_blank">
    Download script
  </a>
  <br/><br/><br/>
  <?php
    foreach($data['invitees'] as $i){
      if($i['uid']!= NULL){
        print "<strong>UID: " . $i['uid']. "</strong><br/>";
        foreach($data['post_questions'] as $index=>$q){
          print "Question ".$index . ": " .$q. " -- ". $i['post_questions']['question-'.$index].'<br/>';
        }
        print "<br/>";
      }
    }
  ?>
</div>



<div class = "insight-tag" id="tag-4">
  <h3>One to One Chats:</h3>
  <a href="<?php print base_path();?>node/<?php print $data['nid'];?>/insight/solo-chat-download" target="_blank">
    Download script
  </a>
  <br/>
  <?php foreach($data['solo_chats'] as $chat): ?>

    <h6>User <?php print $chat['id_1'];?> and User <?php print $chat['id_2'];?></h6>
    <?php foreach($chat['messages'] as $m): ?>
    User <?php print $m;?><br/>
    <?php endforeach; ?>
    <br/><hr/>
  <?php endforeach; ?>


  <h3>Group Chats:</h3>
  <a href="<?php print base_path();?>node/<?php print $data['nid'];?>/insight/group-chat-download" target="_blank">
    Download script
  </a>
  <br/>
  <?php foreach($data['group_chats'] as $chat_id =>$chat): ?>
    <hr/>
    <h6>Chat ID: <?php print $chat_id; ?></h6>
    <?php foreach ($chat as $m): ?>
    User <?php print $m; ?> <br/>
    <?php endforeach; ?>
    <br/><hr/>
  <?php endforeach; ?>
</div>
<script>
var insight = (function ($) {
  return {
    show:function(tag_num){
      $(".insight-tag").hide();
      $("#tag-"+tag_num).show();
      $("#menu div").removeClass("active");
      $("#menu div#menu-"+ tag_num).addClass("active");
    }
  }
}(jQuery));
</script>


<pre>
  <?php //print_r($data); ?>
</pre>
