<!DOCTYPE html>
<html>
<head>
	<title>Camagru | Register</title>
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
	<script type="text/javascript" charset="utf-8" src="scripts/register.js"></script>
</head>

<body>
<?php include ('navbar.html') ?>
<div class="loginContainer">
	<h1>Register</h1>
	<form method="POST" action="api/user/create.php" id="registerForm">
        <input type="text" name="firstname" placeholder="First Name">
        <input type="text" name="lastname" placeholder="Last Name">
		<input type="text" name="username" placeholder="Username">
        <input type="text" name="email" placeholder="Email">
		<input type="password" name="password" placeholder="Password">
		<i><small>Password needs to be at least 6 characters long</small></i>
        <button type="submit" onclick="submitForm('registerForm')">Register</button>
	</form>
</div>

<script>
</script>
</body>
</html>
