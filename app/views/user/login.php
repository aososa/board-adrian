<h1>Login</h1>
<h3>Please type your username and password</h3>
<form class="well" method="post" action="<?php outputText(url('user/login'))?>">
   <label>Username</label>
   <input type="text" class="span2" name="username" value="<?php outputText(Param::get('username')) ?>">
   <label>Password</label>
   <input type="password" class="span2" name="password" value="<?php outputText(Param::get('password'))?>">
   <br />
   <input type="hidden" name="page_next" value="home">
   <button type="submit" class="Btn btn-primary">Submit</button>
</form>
<?php

?>
