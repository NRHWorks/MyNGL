<style type="text/css">

.question{
  height:40px;
}
</style>

<h3>Questions</h3>

<?php
 $questions = array_reverse($questions);
 ?>
<div id='question-list'>
  <?php foreach ($questions as $q): ?>
    <div class='question' id='question-<?php print $q["date"];?>'>
      <?php print $q['question']; ?>
      <hr/>
    </div>
  <?php endforeach; ?>
</div>
