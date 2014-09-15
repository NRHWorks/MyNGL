<style type="text/css">

.question{
  height:40px;
}
</style>

<h3>Questions</h3>

<div id='question-list'>
  <?php foreach ($questions as $q): ?>
    <div class='question' id='question-<?php print $q["delta"];?>'>
      <?php print $q['question']; ?>
      <hr/>
    </div>
  <?php endforeach; ?>
</div>
