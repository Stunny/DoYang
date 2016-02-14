<?php
require_once('connect.php');

$id_user = $_POST['id_user'];
$user_name = $_POST['user_name'];
$user_password = $_POST['user_password'];
$user_age = $_POST['user_age'];
$id_rank = $_POST['id_rank'];
$id_belt = $_POST['id_belt'];
$id_activity = $_POST['id_activity'];

//Comprobar campos vacíos

if ($user_name == '' || $password  == '' || $user_age  == ''  || $id_rank  ==
	''  || $id_belt   == '' || $id_activity  == ''){
		echo '<p>faltan datos por intoducir</p>';
	}
	else{

//Comprobar existencia de usuario

		$query =<<<SQL
SELECT *
FROM users
WHERE user_name = "$user_name";
SQL;

		$result = $conn->query($query);
		$rows = $result->num_rows();

		if($rows > 0){
			echo '<p>Este usuario ya existe</p>';
		}else{

//Comprobar la llegada del id

		if(isset($_POST['id_user']) && $_POST['id_user'] != ''){
			$id_user = $_POST['id_user'];
//update
		$query =<<<SQL
UPDATE users
SET user_password = '$user_password', user_name = '$user_name',
	user_age = '$user_age', id_rank = $id_rank, id_belt = $id_belt,
	id_activity = $id_activity
WHERE id_user = $id_user;
SQL;

printf($query);

		$result = $conn->query($query);
		}
//insert y comprobación de nuevo que no sea un usuario existente
		else if($_POST['id_user'] == ''){
			$query =<<<SQL
SELECT *
FROM users
WHERE user_name = "$user_name";
SQL;

			$result = $conn->query($query);
			$rows = $result->num_rows;

			if($rows > 0){
				echo '<p>Este usuario ya existe</p>';
			}
			else{
				$query =<<<SQL
INSERT INTO users (user_password, user_name, user_age, id_rank, id_belt, id_activity)
VALUES ('$user_password', '$user_name', $user_age, $id_rank, $id_belt, $id_activity);
SQL;

					printf($query);
					try{
						$result = $conn->query($query);
					}catch($Exception){printf($Exception);}
				}
			}
		}
	}
?>
