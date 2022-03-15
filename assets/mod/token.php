<?php
require_once("fallos.php");
$token = $_SESSION['token'];
$id = $_SESSION['id'];
  if(!empty($token) && !empty($id)){
    include("connect.php");
    require_once("sha.php");
    $query = "SELECT `userid` AS ID, `oauth_provider` AS PROVIDER, `oauth_uid` AS GOOGLEID, `email` AS CORREO ,`password` AS PASS from `user` where `userid`="."'".mysqli_real_escape_string($conexion,$id)."'";
    if($result = $conexion->query($query)){
        $row = $result->fetch_object();
        if(empty($row->PROVDER)){
        $r_token = sha256($row->CORREO.$row->PASS);
        }else{
            $r_token = sha256($row->CORREO.$row->GOOGLEID);
        }
            if($row->ID != NULL && $token == $r_token){
                $username = $row->ID;
            }else{
              error151();
            }
        }else{
          error151();
        }
    }
    else{
      error101();
    }
?>