<?php


function actualizarusuario($id){
    include("connect.php");
    $ok = false;
    $up1 = 'UPDATE user SET id = id - 1 WHERE id >= \''.$id.'\'';
    if($conexion->query($up1) === TRUE){
        $q2 = 'SELECT id FROM user ORDER BY id DESC LIMIT 1';
        if($result = $conexion->query($q2)){
        $row = $result->fetch_object();
        $up2 = 'ALTER TABLE user AUTO_INCREMENT = '.$row->id.'';
        if($conexion->query($up2) === TRUE){
            $ok = true;
        }
        }else{
            $ok = false;  
        }
    }else{
        $ok = false;
    }
    return $ok;
}
function actualizarproducto($id){
    include("connect.php");
    $ok = false;
    $up1 = 'UPDATE producto SET id = id - 1 WHERE id >= \''.$id.'\'';
    if($conexion->query($up1) === TRUE){
        $q2 = 'SELECT id FROM producto ORDER BY id DESC LIMIT 1';
        if($result = $conexion->query($q2)){
        $row = $result->fetch_object();
        $up2 = 'ALTER TABLE producto AUTO_INCREMENT = '.$row->id.'';
        if($conexion->query($up2) === TRUE){
            $ok = true;
        }
        }else{
            $ok = false;  
        }
    }else{
        $ok = false;
    }
    return $ok;
}



?>
