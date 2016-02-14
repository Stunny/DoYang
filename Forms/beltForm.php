<?php
	
	require_once('connect.php');
	if(!isset($_GET['id_belt'])){
		$id_belt = '';
		$belt_name = '';
		$belt_exam_price = '';
		$belt_exam_pumsae = '';
	}else{
		$id_belt = $_GET['id_belt'];
		$query =<<<SQL
SELECT belt_name, belt_exam_price, belt_exam_pumsae
FROM belt
WHERE id_belt = $id_belt;
SQL;
		$result = $conn->query($query);
		$data = $result->fetch_row();	
		$belt_name = $data[0];
		$belt_exam_price = $data[1];
		$belt_exam_pumsae = $data[2];
	}	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Formulario Cinturones</title>
</head>
<body>
	<h1>Cinturones</h1>
	<form action="register_belt.php" method="POST" name="beltForm">
	<input type="hidden" value="<?php echo $id_belt; ?>" name="id_user">
	<ul>
		<li>Color:<input type="text" name="belt_name"></li>
		<li>Precio Examen:<input type="text" name="belt_exam_price"></li>
		<li>Pumsae Requerido:<input type="text" name="belt_exam_pumsae"></li>
		<li><input type="submit" name="Submit"></li>
	</ul>	
	</form>
</body>
</html>