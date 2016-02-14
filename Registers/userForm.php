<?php
require_once('connect.php');

if (!isset($_GET['id_user'])){
	$id_user = '';	
	$user_name = '';
	$user_password = '';
	$user_age = '';
	$id_rank = '';
	$id_belt = '';
	$id_activity = '';
	
	$query =<<<SQL
SELECT *
FROM ranks; 					
SQL;
	$j = 0;
	$result = $conn->query($query);
	$qrangos = $result->num_rows;
	$nrangos = array();
	$query2 = <<<SQL
SELECT rank_name
FROM ranks
WHERE id_rank = $j;
SQL;
	for($i = 0; $i < $qrangos; $i++){
		$j = $i + 1;
		$nrangos[$i] = $conn->query($query2);
	}
}else{
	
	$id_user = $_GET['id_user'];
	$query =<<<SQL
SELECT user_name, user_password, user_age, id_rank, id_belt, id_activity
FROM users
WHERE id_user = $id_user;
SQL;
	
	$result = $conn->query($query);
	$data = $result->fetch_row();
	
	//Introduzco los datos en sus respectivas variables
	
	$user_name = $data[0];
	$user_password = $data[1];
	$user_age = $data[2];
	$id_rank = $data[3];
	$id_belt = $data[4];
	$id_activity = $data[5];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Formulario de usuarios</title>
</head>
<body>
	<h1>Usuarios</h1>
	<form action="register_user.php" method="POST" name="userForm">
	<input type="hidden" value="<?php echo $id_user; ?>" name="id_user">
	<ul>
		<li>Nombre Completo:<input type="text" value="<?php echo $user_name; ?>" name="user_name"></li>
		<li>Password:<input type="password" value="<?php echo $user_password; ?>" name="user_password"></li>			
		<li>Edad:<input type="text" value="<?php echo $user_age; ?>" name="user_age"></li>
		<li>Rango:
			<select name="id_rank">
				<?php
					for($i = 0; $i < qrangos; $i++){
						echo '<option value="'.($i+1).'">'.'$nrangos[$i]'.'</option>';
					}
				?>
			</select>
		</li>
		<li>Cintur&oacute;n:
		<select name="id_belt">
			<option value="1">test</option>
		</select>
		</li>
		<li>Actividades: 
			<select name="id_activity">
				<option value="1">TKD</option>
			</select></li>
		<li>Ruta de foto de perfil:<input type="text" name="userPhotoRoute"></li>
		
		
		

		<li><input type="submit" name="Submit"></li>
	</ul>
	</form>
</body>
</html>
