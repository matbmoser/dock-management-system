<?php
if(session_id() !== null){
    session_start();
}
require_once("fallos.php");
if(isset($_GET)){
    if(!empty($_GET['id']) && !empty($_GET['admtoken'])){
        include("connect.php");
        $userid = $conexion->real_escape_string($_GET['id']);
        $newrole = $conexion->real_escape_string($_GET['newrol']);
        if(!empty($userid) && $newrole !== ""){
            $sessid= $_SESSION['id'];
            $q1 = 'SELECT userid, email, password FROM user WHERE userid = \''.$sessid.'\'';
            if($result = $conexion->query($q1)){
                $row = $result->fetch_object();
                $maintoken = hash('sha256',$row->email.$row->password);
                $token = hash('sha256', $maintoken.$row->userid);
                if($token == $_GET["admtoken"]){
                    $fecha = new DateTime("now", new DateTimeZone("Europe/Madrid"));
                    $up1 = 'UPDATE user SET rol = \''.$newrole.'\', modified=\''.$fecha->format('Y-m-d H:i:s').'\' WHERE userid = \''.$userid.'\'';
                    if($conexion->query($up1) === TRUE){
                        usrsuccess();
                    }else{
                        error212();
                    }
                }else{
                    error151();
                }
            }else{
                error212();
            }
        }else{
            error151();
        }
    }else{
        error151();
    }
}else{
    error151();
}



?>