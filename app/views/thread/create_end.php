<h2><?php outputText($thread->title) ?></h2>

<p class="alert alert-success">
   You successfully created a new thread.
</p>

<a href="<?php outputText(url('comment/view', array('thread_id' => $thread->id))) ?>">
   &larr; Go to Thread.
</a>
