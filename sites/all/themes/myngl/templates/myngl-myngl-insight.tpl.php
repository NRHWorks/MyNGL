<?php
  $ugc_posters = 0;
  $gift_getters = 0;
  foreach($data['invitees'] as $i){
    if ($i['uploads'] !=0){
      $ugc_posters++;
    }
    if (count($i['redeem'])!=0){
      $gift_getters ++;
    }
  }

?>
<style type="text/css">
h3 {
  margin-top:90px;
  font-size:200%;
}
</style>


<h3>Users:</h3>
<table>
  <tr>
    <th></th>
    <th>Total</th>
    <th>Invited by admin</th>
    <th>Invited by friend</th>
  </tr>
  <tr>
    <td>Invitees</td>
    <td><?php print $data['total_count']['by_admin'] + $data['total_count']['by_friend']; ?></td>
    <td><?php print $data['total_count']['by_admin'];?></td>
    <td><?php print $data['total_count']['by_friend'];?></td>
  </tr>
  <tr>
    <td>Participants</td>
    <td><?php print $data['attend_count']['by_admin'] + $data['attend_count']['by_friend']; ?></td>
    <td><?php print $data['attend_count']['by_admin'];?></td>
    <td><?php print $data['attend_count']['by_friend'];?></td>
  </tr>

</table>



<h3>Usage:</h3>
<ul>
  <li>Number of users who participated in one-to-one chat(s):<?php print $data['num_solo_chatters'];?></li>
  <li>Number of users who participated in group chat(s):<?php print $data['num_group_chatters'];?></li>
  <li>Number of users who posted on POV wall:<?php print $data['num_pov_posters'];?></li>
  <li>Number of users who uploaded content: <?php print $ugc_posters; ?></li>
  <li>Number of users who redeemed gift(s): <?php print $gift_getters; ?></li>
</ul>



<h3>Room and Time (min):</h3>
<table>
  <tr>
    <th>User ID</th>
    <th>Total</th>
    <th>Lobby</th>
    <th>Lounge</th>
    <th>Theater</th>
    <th>Activity Room</th>
    <th>Gifting Suite</th>
  </tr>
  <?php foreach($data['invitees'] as $i): ?>
    <?php if($i['attend']==1): ?>
      <tr>
        <td><?php print $i['uid'];?></td>
        <td><?php printf("%.1f",$i['room_record']['sum'] / 60.0); ?></td>
        <td><?php printf("%.1f",$i['room_record']['Lobby'] / 60.0); ?></td>
        <td><?php printf("%.1f",$i['room_record']['Lounge'] / 60.0); ?></td>
        <td><?php printf("%.1f",$i['room_record']['Theater'] / 60.0); ?></td>
        <td><?php printf("%.1f",$i['room_record']['PlayRoom']/60.0); ?></td>
        <td><?php printf("%.1f",$i['room_record']['Gifting Suite'] / 60.0); ?></td>
      </tr>
    <?php endif; ?>
  <?php endforeach; ?>
</table>

<h3>Theater Questions:</h3>
<ul>
  <?php foreach ($data['theater_questions'] as $q): ?>
    <li><?php print $q;?></li>
  <?php endforeach; ?>
</ul>

<h3>Rewards:</h3>

<table>
  <tr>
    <th>Reward</th>
    <th>Redeem Count</th>
  </tr>
  <?php foreach($data['redeem_count'] as $name => $count):?>
    <tr>
      <td><?php print $name; ?></td>
      <td><?php print $count; ?></td>
    </tr>
  <?php endforeach; ?>
</table>

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

<h3>Pre Myngl Questions</h3>

<?php foreach($data['pre_questions'] as $index=>$q): ?>
  <?php $answer_count = array(); ?>
  <h5>Question <?php print $index + 1;?>:</h5>
  <?php
    foreach($data['invitees'] as $i){
      if(isset($i['pre_questions']['question-'.$index])&&$i['pre_questions']['question-'.$index]!= NULL){
        if(array_key_exists($i['pre_questions']['question-'.$index], $answer_count)){
          $answer_count[$i['pre_questions']['question-'.$index]] ++;
        }
        else{
          $answer_count[$i['pre_questions']['question-'.$index]] =1;
        }
      }
    }
    foreach($answer_count as $q =>$c){
      print $q . ": " . $c . "<br/>";
    }
  ?>

<?php endforeach; ?>
<br/><br/><br/>
<?php
  foreach($data['invitees'] as $i){
    if($i['uid']!= NULL){
      print "<strong>UID: " . $i['uid']. "</strong><br/>";
      foreach($data['pre_questions'] as $index=>$q){
        print "Question ".$index . ": " .$q. " -- ". $i['pre_questions']['question-'.$index].'<br/>';
      }
    }
    print "<br/>";
  }
?>


<h3>Post Myngl Questions</h3>

<?php foreach($data['post_questions'] as $index=>$q): ?>
  <?php $answer_count = array(); ?>
  <h5>Question <?php print $index + 1;?>:</h5>
  <?php
    foreach($data['invitees'] as $i){
      if(isset($i['pre_questions']['question-'.$index])&&$i['post_questions']['question-'.$index]!= NULL){
        if(array_key_exists($i['post_questions']['question-'.$index], $answer_count)){
          $answer_count[$i['post_questions']['question-'.$index]] ++;
        }
        else{
          $answer_count[$i['post_questions']['question-'.$index]] =1;
        }
      }
    }
    foreach($answer_count as $q =>$c){
      print $q . ": " . $c . "<br/>";
    }
  ?>

<?php endforeach; ?>
<br/><br/><br/>
<?php
  foreach($data['invitees'] as $i){
    if($i['uid']!= NULL){
      print "<strong>UID: " . $i['uid']. "</strong><br/>";
      foreach($data['post_questions'] as $index=>$q){
        print "Question ".$index . ": " .$q. " -- ". $i['post_questions']['question-'.$index].'<br/>';
      }
    }
    print "<br/>";
  }
?>





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





<pre>
  <?php //print_r($data); ?>
</pre>
