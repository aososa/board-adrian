<h1>All threads</h1>
        
<ul>
  <?php foreach ($threads as $row):?>
    <li><a href = "<?php outputText(url('comment/view', array('thread_id' => $row->id)))?>"><?php outputText($row->title) ?></a></li>
  <?php endforeach ?>
<div class="pagination">
<?php if($pagination->current > 1): ?>
<a class='btn btn-small' href='?page=<?php outputText($pagination->prev) ?>'>Previous</a>
<?php endif ?>

<?php echo $page_links ?>

<?php if(!$pagination->is_last_page): ?>
    <a class='btn btn-small' href='?page=<?php outputText($pagination->next) ?>'>Next</a>
<?php endif ?>

</div>
</ul>
