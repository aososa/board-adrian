<?php
#Initialize variables for shorter names
$title_length_min = $thread->validation['title']['length'][1];
$title_length_max = $thread->validation['title']['length'][2];

$username_length_min = $comment->validation['username']['length'][1];
$username_length_max = $comment->validation['username']['length'][2];

$comment_body_length_min = $comment->validation['body']['length'][1];
$comment_body_length_max = $comment->validation['body']['length'][2];
?><h1>Create a thread</h1>

<?php if($thread->hasError() || $comment->hasError()): ?>
<div class="alert alert-block">

<h4 class="alert-heading">Validation error!</h4>
<?php if(!empty($thread->validation_errors['title']['length'])): ?>
   <div><em>Title</em> must be between <?php outputText($title_length_min)?> and <?php outputText($title_length_max)?> </div>
<?php endif ?>

<?php if(!empty($comment->validation_errors['body']['length'])): ?>
   <div><em>Comment content</em> must be between <?php outputText($comment_body_length_min)?> and <?php outputText($comment_body_length_max)?> </div>
<?php endif ?>

<?php endif ?>

<form class="well" method="post" action="<?php outputText(url(''))?>">
   <label>Title</label>
   <input type="text" class="span2" name="title" value="<?php outputText(Param::get('title')) ?>">
   <label>Comment</label>
   <textarea name="body"><?php outputText(Param::get('body'))?></textarea>
   <br />
   <input type="hidden" name="page_next" value="create_end">
   <button type="submit" class="Btn btn-primary">Submit</button>
</form>
