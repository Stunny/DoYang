<?php
	$nombre_usuario = $_POST['nombre_usuario'];
	$password = $_POST['password'];
	require_once('connect.php');
	session_start();
	session_unset();

	$query =<<<SQL
SELECT *
FROM usuario
WHERE (nombre_usuario = '$nombre_usuario' AND password = '$password');
SQL;

	$result = $conn->query($query);
	$rows = $result->num_rows;
	if($rows == 1){
		$_SESSION['status'] = TRUE;
		header("Location:menuPpal.html");
	}else{
		$_SESSION['status'] = FALSE;
		header("Location:login.html");
	}
?>
