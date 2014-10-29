<h1>Welcome <?php outputText($_SESSION['username'])?>!</h1>
<p class="alert alert-success">
You have successfully logged in to your account.
</p>
<a class="btn btn-primary" href="<?php outputText(url('thread/index')) ?>">View threads</a>
