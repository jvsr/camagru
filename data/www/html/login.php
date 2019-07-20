<!DOCTYPE html>
<html>
<head>
	<title>Camagru | Login</title>
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
	<script type="text/javascript" charset="utf-8" src="scripts/setActive.js"></script>
</head>

<body>
<?php include ('navbar.html') ?>
<div class="loginContainer">
	<h1>Log in</h1>
	<form>
		<input type="text" placeholder="Username" required>
		<input type="password" placeholder="Password" required>
		<button onclick="submitForm()">Login</button><br/>
		<button onclick="redirectRegister()">New here? Sign up</button>
	</form>
</div>

<script>
	window.onload = function() {
		setActive();
	};
</script>
</body>
</html>
