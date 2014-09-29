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








<pre>
  <?php //print_r($data); ?>
</pre>
