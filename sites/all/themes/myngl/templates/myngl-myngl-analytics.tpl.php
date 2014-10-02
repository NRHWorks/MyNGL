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
  <?php $sum = array(
    'sum' =>0,
    'lobby'=>0,
    'lounge'=>0,
    'theater'=>0,
    'playroom'=>0,
    'gifting'=>0,
    );
  ?>
  <?php foreach($data['invitees'] as $i): ?>
    <?php if($i['attend']==1): ?>
      <tr>
        <td><?php print $i['uid'];?></td>
        <td><?php printf("%.1f",$i['room_record']['sum'] / 60.0); $sum['sum']+= $i['room_record']['sum'];?></td>
        <td><?php printf("%.1f",$i['room_record']['Lobby'] / 60.0); $sum['lobby']+= $i['room_record']['Lobby'];?></td>
        <td><?php printf("%.1f",$i['room_record']['Lounge'] / 60.0); $sum['lounge']+= $i['room_record']['Lounge'];?></td>
        <td><?php printf("%.1f",$i['room_record']['Theater'] / 60.0); $sum['theater']+= $i['room_record']['Theater'];?></td>
        <td><?php printf("%.1f",$i['room_record']['PlayRoom']/60.0); $sum['playroom']+= $i['room_record']['PlayRoom'];?></td>
        <td><?php printf("%.1f",$i['room_record']['Gifting Suite'] / 60.0); $sum['gifting']+= $i['room_record']['Gifting Suite'];?></td>
      </tr>
    <?php endif; ?>
  <?php endforeach; ?>
  <tr style="background-color:#cccccc">
    <td>Total</td>
    <td><?php printf("%.1f",$sum['sum'] / 60.0);?></td>
    <td><?php printf("%.1f",$sum['lobby'] / 60.0);?></td>
    <td><?php printf("%.1f",$sum['lounge'] / 60.0);?></td>
    <td><?php printf("%.1f",$sum['theater'] / 60.0);?></td>
    <td><?php printf("%.1f",$sum['playroom'] / 60.0);?></td>
    <td><?php printf("%.1f",$sum['gifting'] / 60.0);?></td>
  </tr>
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


<h3>Social Sharings</h3>
<?php
  $social_sharings = $data['social_sharings'];
  $counts = array(
    'lounge' => array(
      'facebook'=>0,
      'twitter' =>0,
      'email' => 0,
    ),
    'confirmed' => array(
      'facebook'=>0,
      'twitter' =>0,
      'email' => 0,
    ),
    'gifting' => array(
      'facebook'=>0,
      'twitter' =>0,
      'email' => 0,
    ),
  );

  foreach($social_sharings as $v){
    $counts[$v['page']][$v['media_type']] ++;
  }
?>

<table>
  <tr>
    <th></td>
    <th>Facebook</td>
    <th>Twitter</td>
    <th>Email</td>
  </tr>
  <tr>
    <td>Confirm Page</td>
    <td><?php print $counts['confirmed']['facebook'];?></td>
    <td><?php print $counts['confirmed']['twitter'];?></td>
    <td><?php print $counts['confirmed']['email'];?></td>
  </tr>
  <tr>
    <td>Lounge</td>
    <td><?php print $counts['lounge']['facebook'];?></td>
    <td><?php print $counts['lounge']['twitter'];?></td>
    <td><?php print $counts['lounge']['email'];?></td>
  </tr>
  <tr>
    <td>Gifting Suite</td>
    <td><?php print $counts['gifting']['facebook'];?></td>
    <td><?php print $counts['gifting']['twitter'];?></td>
    <td><?php print $counts['gifting']['email'];?></td>
  </tr>
</table>



<h3>User Activities:</h3>

<?php
  foreach ($data['invitees'] as $i){
    if($i['uid']!=NULL){
      print "<h5>User " . $i['uid'] . "</h5>";
      foreach($i['activity_history'] as $h){
        print $h['points']." points -- ".$h['description']."<br/>";
      }
    print "<br/><br/><hr/>";
    }
  }
?>





<pre>
  <?php //print_r($data); ?>
</pre>
