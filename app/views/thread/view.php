<h1><?=$thread->title?></h1>
<?php foreach ($comments as $comment_key => $comment_value): ?>
<div class = "comment">

<div class = "meta">
  <?php outputText($comment_key + 1)?>: <?php outputText($comment_value->username)?> <?php outputText($comment_value->created)?>
</div>

<div><?php outputText(readable_text($comment_value->body))?></div>

</div>
<?php endforeach ?>
<div class="pagination"> 
    <?php echo $page_links ?> 
</div>
<form class="well" method="post" action="<?php outputText(url('thread/write'))?>">
  <label>Comment</label>
  <textarea name="body"><?php outputText(Param::get('body'))?></textarea>
  <br />
  <input type="hidden" name="thread_id" value="<?=$thread->id?>">
  <input type="hidden" name="page_next" value="write_end">
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
