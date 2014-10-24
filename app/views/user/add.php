<?php
$username_length_min = $user->validation['username']['length'][1];
$username_length_max = $user->validation['username']['length'][2];
?>
<h1>Create new user</h1>

<?php if($user->hasError()): ?>
	<div class="alert alert-block">

	<h4 class="alert-heading">Validation error!</h4>  

	<?php if(!empty($user->validation_errors['username']['format'])): ?>
		<div><em>Username</em> must only contain alpha-numeric values.</div>
	<?php endif ?>
	
        <?php if(!empty($user->validation_errors['username']['length'])): ?>        
                <div><em>Username</em> must have between <?php outputText($username_length_min) ?> and <?php outputText($username_length_max) ?> characters.</div>                                                                  
        <?php endif ?>	

      
	</div>
<?php endif ?>

<form class="well" method="post" action="<?php outputText(url('user/add'))?>">
   <label>Username</label>
   <input type="text" class="span3" name="username" value="<?php outputText(Param::get('username')) ?>">
   <label>Password</label>
   <input type="password" class="span3" name="password" value="<?php outputText(Param::get('password'))?>">
   <br />
   <input type="hidden" name="page_next" value="login">
   <button type="submit" class="Btn btn-primary">Submit</button>
</form>
