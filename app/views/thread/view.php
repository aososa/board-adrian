<h1><?=$thread->title?></h1>
<!-- I'll try to write this in my own style. --!>
<?php foreach ($comments as $com_key => $com_val): ?>
<div class = "comment">

<div class = "meta">
  <?php echo($com_key + 1)?>: <?=$com_val->username?> <?=$com_val->created?>
</div>

<div><?php echo readable_text($com_val->body)?></div>

</div>
<?php endforeach ?>
<form class="well" method="post" action="<?php echo url('thread/write')?>">
  <label>Your Name: </label>
  <input type="text" class="span2" name="username" value="<?php echo Param::get('username')?>">
  <label>Comment</label>
  <textarea name="body"><?php echo Param::get('body')?></textarea>
  <br />
  <input type="hidden" name="thread_id" value="<?=$thread->id?>">
  <input type="hidden" name="page_next" value="write_end">
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
