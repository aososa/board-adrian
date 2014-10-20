<h1>All threads</h1>
        
<ul>
  <!--<li>TODO: Link to thread</li>
  <li>TODO: Link to thread</li>
  <li>TODO: Link to thread</li> --!>
  <?php foreach ($threads as $row):?>
    <li><a href="<?php outputText(url('thread/view', array('thread_id' => $row->id)))?>"><?=$row->title?></a></li>
  <?php endforeach ?>
<li><a class="btn btn-large btn-primary" href="<?php outputText(url('thread/create'))?>">Create New Thread</a></li>
</ul>
