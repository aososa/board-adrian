<h1><?=$thread->title?></h1>
<?php foreach ($comments as $com_key => $com_val): ?>
<div class = "comment">

<div class = "meta">
  <?php echo($com_key + 1)?>: <?=$com_val->username?> <?=$com_val->created?>
</div>

<div><?=$com_val->body?></div>

</div>
<?php endforeach ?>
