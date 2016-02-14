<?php
	require_once('connect.php');
	if(!isset($_GET['id_activity'])){
		$activity_name = '';
		$activity_quantity = '';
		$activity_price = '';
	}else{
		$id_activity = $_GET['id_activity'];
		$query =<<<SQL
SELECT activity_name, activity_quantity, activity_price
FROM activities
WHERE id_activity = $id_activity;
SQL;
		$result = $conn->query($query);
		$data = $result->fetch_row();
		
		$activity_name = $data[0];
		$activity_quantity = $data[1];
		$activity_price = $data[2];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Formulario Actividades</title>
</head>
<body>
	<h1>Actividades</h1>
	<form action="register_activity.php" method="POST" name="activityForm">
	<ul>
		<input type="hidden" name="id_activity" value="<?php echo $id_activity ?>">
		<li>Concepto:<input type="text" name="activity_name" value="<?php echo $id_activity; ?>"></li>
		<li>Cantidad de actividades:<input type="number" name="activity_quantity"></li>
		<li>Precio mensual:<input type="number" name="activity_price"></li>
		
	</ul>
	<input type="submit" name="Submit">
	</form>
</body>
</html>