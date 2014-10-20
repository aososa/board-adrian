<h1><?=$thread->title?></h1>
<?php foreach ($comments as $com_key => $com_val): ?>
<div class = "comment">

<div class = "meta">
  <?php outputText($com_key + 1)?>: <?php outputText($com_val->username)?> <?php outputText($com_val->created)?>
</div>

<div><?php outputText(readable_text($com_val->body))?></div>

</div>
<?php endforeach ?>
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
