<h1>Create new user</h1>

<form class="well" method="post" action="<?php outputText(url('user/add'))?>">
   <label>Username</label>
   <input type="text" class="span3" name="username" value="<?php outputText(Param::get('username')) ?>">
   <label>Password</label>
   <input type="password" class="span3" name="password" value="<?php outputText(Param::get('password'))?>">
   <br />
   <input type="hidden" name="page_next" value="add_end">
   <button type="submit" class="Btn btn-primary">Submit</button>
</form>
