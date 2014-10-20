<h2><?=$thread->title?></h2>

<?php if($comment->hasError()): ?>
<div class = "alert alert-block">

<h4 class = "alert-heading">Validation Error!<h4>
  
   <?php if(!empty($comment->validation_errors['username']['length'])): ?>
   <div><em>Your name</em> must be between <?php outputText($comment->validation['username']['length'][1])?> and <?php outputText($comment->validation['username']['length'][2])?> characters in length. </div>

   <?php endif ?>

   <?php if(!empty($comment->validation_errors['body']['length'])): ?>
   <div><em>Your body</em> must be between <?php outputText($comment->validation['body']['length'][1])?> and <?php outputText($comment->validation['body']['length'][2])?> characters in length. </div>

   <?php endif ?>
</div>

<?php endif ?>

<form class="well" method="post" action="<?php outputText(url('thread/write'))?>">
  <label>Your Name: </label>
  <input type="text" class="span2" name="username" value="<?php outputText(Param::get('username'))?>">
  <label>Comment</label>
  <textarea name="body"><?php outputText(Param::get('body'))?></textarea>
  <br />
  <input type="hidden" name="thread_id" value="<?=$thread->id?>">
  <input type="hidden" name="page_next" value="write_end">
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
