<?php
$username = "root";
$servername = "localhost";
$password = "22clase0196";
$database = "Doyang_App";

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_errno > 0){
	die('No se pudo conectar a la base de datos ['.$connect->connect_errno .']');
}


?>
