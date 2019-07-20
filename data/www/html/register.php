<!DOCTYPE html>
<html>
<head>
	<title>Camagru | Register</title>
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
	<script type="text/javascript" charset="utf-8" src="scripts/setActive.js"></script>
</head>

<body>
<?php include ('navbar.html') ?>
<div class="loginContainer">
	<h1>Register</h1>
	<form method="POST" action="api/user/create.php">
        <input type="text" placeholder="First Name">
        <input type="text" placeholder="Last Name">
        <input type="text" placeholder="Email">
		<input type="text" placeholder="Username">
		<input type="password" placeholder="Password">
        <button onclick="submitForm()">Register</button>
	</form>
</div>

<script>
	window.onload = function() {
		setActive();
	};
</script>
</body>
</html>
