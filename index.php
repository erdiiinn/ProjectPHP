<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Stark Industries - Login</title>

	<style>
		body {
			background-color: #0b0d17;
			color: #ffffff;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			margin: 0;
		}

		.login {
			background: #1e273b;
			padding: 40px 50px;
			border-radius: 10px;
			box-shadow: 0 0 15px #00bcd4;
			width: 350px;
			text-align: center;
		}

		form > input {
			margin-bottom: 15px;
			font-size: 18px;
			padding: 10px;
			width: 100%;
			border-radius: 5px;
			border: none;
		}

		form > input:focus {
			outline: none;
			box-shadow: 0 0 5px #00bcd4;
		}

		button {
			background: #00bcd4;
			border: none;
			color: #0b0d17;
			font-weight: bold;
			padding: 10px 0;
			font-size: 18px;
			width: 100%;
			border-radius: 5px;
			cursor: pointer;
			transition: background 0.3s ease;
		}

		button:hover {
			background: #0288a7;
		}

		small {
			color: #a0a0a0;
		}

		small a {
			color: #00bcd4;
			text-decoration: none;
		}

		small a:hover {
			text-decoration: underline;
		}

		p.text-muted {
			color: #4b4f60;
			margin-top: 30px;
		}
	</style>
</head>
<body>
	<?php include("header.php"); ?>
	
	<div class="login">
		<form class="form-signin" action="loginLogic.php" method="post">
			<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

			<label for="inputEmail" class="sr-only">Username</label>
			<input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" required autofocus>

			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>

			<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>

			<small>Don't have an account? <a href="signup.php">Sign Up</a></small>

			<p class="mt-5 mb-3 text-muted">Stark Industries &copy; 2023</p>
		</form>
	</div>

	<?php include("footer.php"); ?>
</body>
</html>
