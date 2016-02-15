<?php
  require_once('connect.php');
  $method = $_GET['method'];
  /** PARAMETROS PARA LA API
      MÉTODOS:
      - GETUSER: SOLICITAR LA INFORMACIÓN DE UN USER.
      - GETUSERSLIST:LISTAR A TODOS LOS USUARIOS DE LA APLICACION.
      - POSTUPDATEINFO: MODIFICAR LA INFORMACIÓN DE UN USER.

      ENTRADA(GETUSER):
      - ID
      SALIDA(GETUSER): TODA LA INFO DE ESE USUARIO QUE SEA RELEVANTE.

      ENTRADA (UPDATEINFO):
      - ID
      - USER_NAME
      - USER_AGE
      SALIDA(UPDATE INFO): COMPROBACION DE OPERACION

  */
  switch($method){
    case "getUsersList":
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
              printf("{"res": 0, "msg": "ERROR 404: NOT FOUND"}");
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
              printf("{"res": 0, "msg": "ERROR 404: NOT FOUND"}");
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
              printf("{"res": 0, "msg": "ERROR 404: NOT FOUND"}");
            }else{
              printf(json_encode($list->fetch_assoc()));
            }
            break;
          default:
            printf("{"res": 0, "msg": "ERROR 400: BAD REQUEST"}");
            break;
        }
      }else{
        $query =<<<SQL
SELECT user_name
FROM usuario;
SQL;
        $list = $conn->query($query);
        if($list->num_rows == 0){
          printf("{"res": 0, "msg": "ERROR 404: NOT FOUND"}");
        }else{
          printf(json_encode($list->fetch_assoc()));
        }
      }
      break;
    case "getUser":
      $id_user = $_GET['id'];
      $query=<<<SQL
SELECT user_name, user_age, id_rank, id_belt, id_activity
FROM usuario
WHERE id_usuario = $id_user;
SQL;
      $res = $conn->query($query);
      //echo $res;
      if($res->num_rows != 1){
        printf("{"res": 0, "msg": "Error 403: FORBIDDEN"}");
      }else{{
        $ans = json_encode($res->fetch_assoc());
        echo "$ans";
      }
      break;
    case "postUpdateInfo":
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
        printf("{"res": 0, "msg": "ERROR 400: BAD REQUEST"}");
      }else{
        printf("{"res": 1, "msg": "200: OK"}");
      }
      break;

    default:
      $msg = "ERROR 400: BAD REQUEST";
      printf("{"res": 0,"msg": $msg}");
      break;
  }

 ?>
