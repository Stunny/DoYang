<?php
  require_once('connect.php');
  $method = $_GET['method'];
  /** PARAMETROS PARA LA API
      MÉTODOS:
      - GETUSER: SOLICITAR LA INFORMACIÓN DE UN USER.
      - GETUSERSLIST:LISTAR A TODOS LOS USUARIOS DE LA APLICACION.
      - UPDATEINFO: MODIFICAR LA INFORMACIÓN DE UN USER.

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
            break;
          case "STH":
            break;
          case "DOS":
            break;
          default:
            printf("{"res": 0, "msg": "ERROR 400: BAD REQUEST"}");
            break;
        }
      }else{

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
        $ans = json_encode($res);
        echo "$ans";
      }
      break;
    case "updateInfo":
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