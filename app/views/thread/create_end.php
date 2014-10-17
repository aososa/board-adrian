<h2><?=$thread->title?></h2>

<p class="alert alert-success">
   You successfully created a new thread.
</p>

<a href="<?php echo url('thread/view', array('thread_id' => $thread->id)) ?>">
   &larr; Go to Thread.
</a>
