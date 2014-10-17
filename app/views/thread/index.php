<h1>All threads</h1>
        
<ul>
  <!--<li>TODO: Link to thread</li>
  <li>TODO: Link to thread</li>
  <li>TODO: Link to thread</li> --!>
  <?php foreach ($threads as $row):?>
    <li><a href="<?php echo url('thread/view', array('thread_id' => $row->id))?>"><?=$row->title?></a></li>
  <?php endforeach ?>
</ul>
