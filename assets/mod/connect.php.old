<?php
    $host_db    = "localhost";
    $user_db    = "root";
    $pass_db    = "NdVd4XxwoBfJ4Qx1";
    $db_name    = "ufveats";
    $conexion   = new mysqli($host_db, $user_db, $pass_db, $db_name);
    $acentos    = $conexion->query("SET NAMES 'utf8'");
    if ($conexion->connect_error) {
        echo json_encode(array('success' => 0));
        die("La conexion falló: " . $conexion->connect_error);
    }
    ?>