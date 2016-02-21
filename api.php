<?php
  require_once('connect.php');
  $method = $_GET['method'];
  /** PARAMETROS PARA LA API
      MÉTODOS:
      - GETUSER: SOLICITAR LA INFORMACIÓN DE UN USER.
      - GETUSERSLIST:LISTAR A TODOS LOS USUARIOS DE LA APLICACION.
      - PUT -> UPDATEINFO: MODIFICAR LA INFORMACIÓN DE UN USER.
      - PATCH ->
      - POST ->
      - DELETE ->

      ENTRADA(GETUSER):
      - ID
      SALIDA(GETUSER): TODA LA INFO DE ESE USUARIO QUE SEA RELEVANTE.

      ENTRADA (POSTUPDATEINFO):
      - ID
      - USER_NAME
      - USER_AGE
      SALIDA(UPDATE INFO): COMPROBACION DE OPERACION

  */
  switch($method){
    case "GETusersList":
      if(isset($_GET['category'])){
        $cat = $_GET['category'];
        switch ($cat){
          case "TKD":
            $query =<<<SQL
SELECT user_name
FROM usuario
WHERE id_activity = 0;
SQL;
            $list = $conn->query($query);
            if($list->num_rows == 0){
              $ans = '{"result": 0, "msg": "ERROR 404: NOT FOUND"}';
              echo $ans;
            }else{
              printf(json_encode($list->fetch_assoc()));
            }
            break;
          case "STH":
            $query =<<<SQL
SELECT user_name
FROM usuario
WHERE id_activity = 1;
SQL;
            $list = $conn->query($query);
            if($list->num_rows == 0){
              $ans = '{"res": 0, "msg": "ERROR 404: NOT FOUND"}';
              echo $ans;
            }else{
              printf(json_encode($list->fetch_assoc()));
            }
            break;
          case "DOS":
            $query =<<<SQL
SELECT user_name
FROM usuario
WHERE id_activity = 2;
SQL;
            $list = $conn->query($query);
            if($list->num_rows == 0){
              $ans = '{"res": 0, "msg": "ERROR 404: NOT FOUND"}';
              echo $ans;
            }else{
              printf(json_encode($list->fetch_assoc()));
            }
            break;
          default:
            $ans = '{"res": 0, "msg": "ERROR 400: BAD REQUEST"}';
            echo $ans;
            break;
        }
      }else{
        $query =<<<SQL
SELECT user_name
FROM usuario;
SQL;
        $list = $conn->query($query);
        if($list->num_rows == 0){
          $ans = '{"res": 0, "msg": "ERROR 404: NOT FOUND"}';
          echo $ans;
        }else{
          printf(json_encode($list->fetch_assoc()));
        }
      }
      break;
    case "GETuser":
      $id_user = $_GET['id'];
      $query=<<<SQL
SELECT user_name, user_age, id_rank, id_belt, id_activity
FROM usuario
WHERE id_usuario = $id_user;
SQL;
      $res = $conn->query($query);
      //echo $res;
      if($res->num_rows != 1){
        $ans = '{"res": 0, "msg": "Error 403: FORBIDDEN"}';
        echo $ans;
      }else{
        $ans = json_encode($res->fetch_assoc());
        echo "$ans";
      }
      break;
    case "PUT":
      $user_id = $_GET['id'];
      $user_name = $_GET['user_name'];
      $user_age = $_GET['user_age'];
      $query =<<<SQL
UPDATE user_name, user_age
FROM usuario
VALUES "$user_name", $user_age
WHERE id_user = $user_id;
SQL;
      $res = $conn->query($query);
      if(!$res){
        printf('{"res": 0, "msg": "ERROR 400: BAD REQUEST"}');
      }else{
        printf('{"res": 1, "msg": "200: OK"}');
      }
      break;
    case "PATCH":

      break;
    default:
      $msg = "ERROR 400: BAD REQUEST";
      printf('{"res": 0,"msg": $msg}');
      break;
  }

 ?>
