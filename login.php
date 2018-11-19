<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>login</title>
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div>
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div>
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div>
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Didn't signed yet? <a href="register.php">Sign up</a>
  	</p>
  </form>

</body>
</html>