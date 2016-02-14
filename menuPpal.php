<?php
	if(!isset($SESSION['status']) || $SESSION['status'] == FALSE){
		header("Location:login.html");
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Menu Principal</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<h1>Menu Principal</h1>
<ul>
	<li><a href=".//Forms//userForm.php">Formulario de usuarios</a></li>
	<li><a href=".//Forms//beltForm.php">Formulario de cinturones</a></li>
	<li><a href=".//Forms//activityForm.php">Formulario de actividades</a></li>
	<li><a href=".//Forms//rankForm.html">Formulario de rangos</a></li>
</ul>
</body>
<html>
