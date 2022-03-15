<?php
if(session_id() !== null){
    session_start();
}
require_once("fallos.php");
if(isset($_GET)){
    if($_GET['id'] !== "" && !empty($_GET['admtoken'])&& !empty($_GET['type'])){
        include("connect.php");
        $type = $conexion->real_escape_string($_GET['type']);
        if($type === "true"){
        $userid = $conexion->real_escape_string($_GET['userid']);
        $id = $conexion->real_escape_string($_GET['id']);
        if(!empty($userid) && $id !== "") {
            $sessid= $_SESSION['id'];
            $q1 = 'SELECT userid, email, password FROM user WHERE userid = \''.$sessid.'\'';
            if($result = $conexion->query($q1)){
                $row = $result->fetch_object();
                $maintoken = hash('sha256',$row->email.$row->password);
                $token = hash('sha256', $maintoken.$row->userid);
                if($token == $_GET["admtoken"]){
                    $up1 = 'DELETE FROM user WHERE userid = \''.$userid.'\' AND id = \''.$id.'\'';
                    if($conexion->query($up1) === TRUE){
                        require("actualizar.php");
                        if(actualizarusuario($id) === true){
                            usrsuccess_off();
                        }else{
                            error312();
                        }
                    }else{
                        error312();
                    }
                }else{
                    error151();
                }
            }else{
                error312();
            }
        }else{
            error312();
        }
    }else if($type === "false"){
        $id = $conexion->real_escape_string($_GET['id']);
        if(!empty($id) && $newrole !== ""){
            $sessid= $_SESSION['id'];
            $q1 = 'SELECT userid, email, password FROM user WHERE userid = \''.$sessid.'\'';
            if($result = $conexion->query($q1)){
                $row = $result->fetch_object();
                $maintoken = hash('sha256',$row->email.$row->password);
                $token = hash('sha256', $maintoken.$row->userid);
                if($token == $_GET["admtoken"]){
                    $up1 = 'DELETE FROM producto WHERE id = \''.$id.'\'';
                    if($conexion->query($up1) === TRUE){
                        require("actualizar.php");
                        if(actualizarproducto($id) === true){
                            success_off();
                        }else{
                            error312();
                        }
                    }else{
                        error412();
                    }
                }else{
                    error151();
                }
            }else{
                error412();
            }
        }else{
            error412();
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