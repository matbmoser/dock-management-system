<?php
require_once("session.php");
require_once("token.php");
require_once("class.Producto.php");
require_once("fallos.php");
if(isset($_POST)){
    if(isset($_POST["submit"]) && !empty($_POST["nombre"]) && !empty($_POST["precio"]) && !empty($_POST["calorias"]) && !empty($_POST["ingredientes"]) && !empty($_POST["descripcion"]) && !empty($_FILES["file"]["name"])){
        // File upload path
    $targetDir = "../../media/img/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    $allowTypes = array('png');
    if(in_array($fileType, $allowTypes)){
    $producto = array();
    $producto["imagen"] = basename($_FILES["file"]["name"]);
    $producto["nombre"] = $_POST["nombre"];  
    $producto["precio"] = $_POST["precio"];
    $producto["cantidad"] = $_POST["calorias"];
    $producto["categoria"] = $_POST["categoria"];
    $producto["ingredientes"] = $_POST["ingredientes"];
    $producto["descripcion"] = $_POST["descripcion"];
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            $p = new Producto();
            if($p->insert($producto)){
                success();
                exit;
            }else{
                error621();
            }
        }else{
            error621();
        }
    }else{
        error521(); 
    }
    }else{
        error421(); 
    }
}else{
    error421();
}



?>