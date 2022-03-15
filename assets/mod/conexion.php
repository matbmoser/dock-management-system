<?php
$servidor= "localhost";
$usuario= "root";
$password = "";
$nombreBD= "";

$enlace= mysqli_connect($servidor, $usuario, $password, $nombreBD);

    if(!$enlace){
    echo"Error en la conexion con el servidor";
  }
?>