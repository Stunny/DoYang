<?php
	require_once('connect.php');
	
	$id_belt = $_POST['id_belt'];
	$belt_name = $_POST['belt_name'];
	$belt_exam_price = $_POST['belt_exam_price'];
	$belt_exam_pumsae = $_POST['belt_exam_pumsae'];
	
	//Comprobacion de campos vacíos
	
	if($belt_name == '' || $belt_exam_price == '' || $belt_exam_pumsae == ''){
		echo '<p>Faltan datos por introducir</p>';
	}else{
		
		//Comprobacion de existencia de cinturón
		
		$query =<<<SQL
SELECT *
FROM belt
WHERE belt_name = $belt_name;
SQL;
		$result = $conn->query($query);
		$rows = $result->num_rows;
		
		if($rows > 0){
			echo '<p>El cinturón ya existe.</p>';
		}else{
			
			
			//Comprobar llegada de id_belt
			
			if(isset($_POST['id_belt']) && $_POST['id_belt'] != ''){
				$id_belt = $_POST[''id_belt];
				
				//Procedemos a hacer el update
				$query =<<<SQL
UPDATE belt
SET belt_name = '$belt_name', belt_exam_price = $belt_exam_price, 
	belt_exam_pumsae = '$belt_exam_pumsae'
WHERE id_belt = $id_belt;
SQL;
				printf($query);
				$result = $conn->query($query);
			
			// INSERT y nueva comprobacion de que no es un usuario existente
			}else if($_POST['id_belt'] == ''){
				query=<<<SQL
SELECT *
FROM belt
WHERE belt_name = '$belt_name';
SQL;
				$result = $conn->query($query);
				$rows = $result->num_rows;
				
				if($rows > 0){
					echo '<p>Este usuario ya existe.</p>';
				}else{
					$query=<<<SQL
INSERT INTO belt (belt_name, belt_exam_price, belt_exam_pumsae)
VALUES ('$belt_name', $belt_exam_price, '$belt_exam_pumsae');
SQL;
					$result = $conn->query($query);
					printf($query);
					
				}
			}
			
		}
	}
	
?>