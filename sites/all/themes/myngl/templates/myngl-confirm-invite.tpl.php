<div id="confirm-invite-wrapper">
  <div id="confirm-invite-invite">
    <div class="invite-graphic-container">
      <div id="confirm-invite-points-graphic" class="confirm-invite-points-graphic">
        <div id="confirm-invite-points-graphic-2" class="confirm-invite-points-graphic">
        </div>
      </div>
      <div class="invite-graphic-text">
        Earn<br>
        <span><span>+</span>30</span><br>
        Points per Invite
      </div>
    </div>
    <div class="content">
      <p>YOUR RSVP TO THIS EVENT HAS BEEN CONFIRMED!</p>
      <p>
        You are now going to this Myngl event.  Do you want to invite your friends to come as well?  
        You earn points everytime an invited person joins Myngl.
      </p>
      <p>
        Invite your friends to the <?php print $node->title; ?> event via email:
      </p>
      <form>
        <label>Enter Email Address</label>
        <input type="text" name="email" /><br />
        <input type="submit" id="submit" value="SEND INVITE" />
      </form>
      <br /><br />
    </div>
  </div>
  <div id="confirm-invite-share">

    <div id="confirm-invite-invite-graphic">
      <span class="fa-stack fa-lg" id="facebook-share">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
      </span>
      <span class="fa-stack fa-lg" id="twitter-share">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
      </span>
    </div>
    <div>
      <p>Share theMyngl on your social networks and earn +30 points!</p>
    </div>
  </div>
  <div id="confirm-invite-details">
    <div class="content">
      <p>
        Get involved now with theMyngl event.  You can look at the event details or start sharing photos and videos
        with otehr attendees at the upcoming Myngl event.
      </p>
    </div>
    <a href="#"><i class="fa fa-align-left"></i>&nbsp;&nbsp;&nbsp;VIEW EVENT DETAIL</a>
    <a href="#"><i class="fa fa-upload"></i>&nbsp;&nbsp;&nbsp;UPLOAD YOUR CONTENT TO THIS EVENT</a>
  </div>
  <br>
  <div id="footer-links">
    <a href="/user/<?php global $user; print $user->uid; ?>" class="link-small">Go to your Dashboard</a>
  </div>
</div>
