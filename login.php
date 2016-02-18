<?php
	session_start();
	if(isset($_SESSION['status']) && !$_SESSION['status']){
		$incorrecto = TRUE;
	}else if(!isset($_SESSION['status'])){
		session_unset();
		session_destroy();
	}
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Welcome</title>

	<link media="screen" type="text/css" rel="stylesheet" href="Styles/stylesheet.css" />
</head>
<body>
	<div id="login">
		<img id="logoDoyang" src="http://imagizer.imageshack.us/a/img922/5145/X1Di4f.png">
			<ul>
				<li>
				<div id="formlogin" class="loginblock">
					<h2 id="loginTitle">Login</h2>
					<form action="login.php" method="POST" name="login">
					<li><input type="text" value="" placeholder="Username" name="nombre_usuario"></li>
					<li><input type="password" value="" placeholder="Password" name="password"></li>
					<li><input id="submit" type="submit" name="Submit"></li>
					</form>
			</ul>
		</div>
	</div>
</body>
</html>
