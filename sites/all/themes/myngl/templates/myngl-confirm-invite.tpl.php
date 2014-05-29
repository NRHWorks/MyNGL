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

<p>RSVP CONFIRMED!</p>
<p>We look forward to seeing you at “<?php print $node->title; ?>”.
<p>Now, here’s a chance to invite your friends. And…your first chance to begin earning valuable reward Myngl Points to redeem for great gifts at theMyngl.
<p>Invite your friends to the “Godiva Chocolate & Fashion Myngl” via email:
(Earn 10 MynglPoints per invite)
</p>
<p>Share this event on your social networks.<br />
(Earn 5 Myngl  Points per post)
</p>
<p>We want you to be part of theMyngl!  Be creative! Share your videos and photos to be shown at the event by uploading here.<br />
(Earn 20 Myngl Points per submission)
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
