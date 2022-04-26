<?php

$nombre = "";
$token = "";

$token = $_SESSION['token'];
$nombre = $_SESSION['nombre'];

if(empty($token) || empty($nombre)){
  error("securityErrorToken");
  exit;
}

if(!$result = $conexion->query("SELECT * FROM Usuario")){
  error("connectionFailToken");
  exit;
}

$row = $result->fetch_object();
$r_token = hash('sha256',$row->email.$row->password);

if($token != $r_token){
  error("securityErrorToken");
  exit;
}

$roleResult = $conexion->query("SELECT * FROM Rol WHERE `id`=".$row->idRol);
$rowResult = $roleResult->fetch_object();


$userRol = $rowResult;
$nombre = $row->nombre;
?>