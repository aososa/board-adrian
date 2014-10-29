<h1><?php outputText($thread->title) ?></h1>
<?php foreach ($comments as $comment_key => $comment_value): ?>
<div class = "comment">

<div class = "meta">
  <?php outputText($comment_key + 1)?>: <?php outputText($comment_value->username)?> <?php outputText($comment_value->created)?>
</div>

<div><?php outputText(readable_text($comment_value->body))?></div>

</div>
<?php endforeach ?>
<div class="pagination">
    <?php if($pagination->current > 1): ?> 
        <a class='btn btn-small' href='?page=<?php outputText($pagination->prev) ?>&thread_id=<?php outputText($thread->id)?>'>Previous</a>
    <?php endif ?>

    <?php echo $page_links ?>

    <?php if(!$pagination->is_last_page): ?>
        <a class='btn btn-small' href='?page=<?php outputText($pagination->next)?>&thread_id=<?php outputText($thread->id)?>'>Next</a>
    <?php endif ?> 
</div>
<form class="well" method="post" action="<?php outputText(url('comment/write'))?>">
  <label>Comment</label>
  <textarea name="body"><?php outputText(Param::get('body'))?></textarea>
  <br />
  <input type="hidden" name="thread_id" value="<?php outputText($thread->id) ?>">
  <input type="hidden" name="page_next" value="write_end">
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
