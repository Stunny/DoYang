<?php
	require_once('connect.php');
	
	$activity_name = $_POST['activity_name'];
	$activity_quantity = $_POST['activity_quantity'];
	$activity_price = $_POST['activity_price'];
	
	//Comprobacion de campos vacíos
	
	if($activity_name == '' || $activity_price == '' || $activity_quantity == ''){
		echo '<p>Faltan datos por introducir.</p>';
	}else{
		
		//Comprobacion de existencia de actividad
		
		$query = <<<SQL
SELECT *
FROM activities
WHERE activity_name = $activity_name;
SQL;
		$result = $conn->query($query);
		$rows = $result->num_rows;
		
		if($rows > 0){
			echo '<p>La actividad ya existe.</p>';
		}else{
			
			//Comprobamos la llegada de id_activity
			
			if(isset($_POST['id_activity']) && $_POST['id_activity'] != ''){
				$id_activity = $_POST['id_activity'];
				
				//Procedemos a hacer un update
				
				$query=<<<SQL
UPDATE activities
SET activity_name = '$activity_name', activity_price = $activity_price,
	activity_quantity = $activity_quantity
WHERE id_activity = $id_activity;
SQL;
				printf($query);
				$result = $conn->query($query);
			}
			//INSERT y nueva comprobacion de que no es una actividad existente
			else if($_POST['id_activity'] == ''){
				$query =<<<SQL
SELECT *
FROM activities
WHERE activity_name = '$activity_name';
SQL;
				$result = $conn->query($query);
				$rows = $result->num_rows;
				
				if($rows > 0){
					echo '<p>La actividad ya existe.</p>';
				}else{
					$query =<<<SQL
INSERT INTO activities (activity_name, activity_price, activity_quantity)
VALUES ('$activity_name', $activity_price, $activity_price);				
SQL;
					printf($query);
					$result = $conn->query($query);
				}
			}
		}
	}
?>