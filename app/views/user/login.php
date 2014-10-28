<h1>Login</h1>
<?php if(isset($login_from_add)): ?>
    <p class="alert alert-success">
        Account registered. Try logging in. :)
    </p>
<?php endif ?>
<?php if(isset($login_failed)): ?>
    <p class="alert alert-danger">
        Wrong user credentials.
    </p>
<?php endif ?>
<h3>Please type your username and password</h3>
<form class="well" method="post" action="<?php outputText(url('user/login'))?>">
   <label>Username</label>
   <input type="text" class="span2" name="username" value="<?php outputText(Param::get('username')) ?>">
   <label>Password</label>
   <input type="password" class="span2" name="password">
   <br />
   <input type="hidden" name="page_next" value="home">
   <button type="submit" class="Btn btn-primary">Submit</button>
</form>
