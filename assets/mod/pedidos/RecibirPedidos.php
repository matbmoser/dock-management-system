<?php
$configs = include('../config.php');
$dbconfig = include("../db.config.php");
include('../connect.php');

$tipo       = $_FILES['dataPedidos']['type'];
$tamanio    = $_FILES['dataPedidos']['size'];
$archivotmp = $_FILES['dataPedidos']['tmp_name'];
$lineas     = file($archivotmp);

$i = 0;
$queryTotal = "";
foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {

        $datos = explode(";", $linea);

        $ID          = !empty($datos[0])  ? ($datos[0]) : '';
        $pedidoid    = !empty($datos[1])  ? ($datos[1]) : '';
        $actividad   = !empty($datos[2])  ? ($datos[2]) : '';
    
    
    $trucateTable = "DELETE FROM sgm.pedido WHERE id=$ID";
    // echo $insertarData;
    mysqli_query($conexion, $trucateTable); 

    $date = date('Y-m-d H:i:s');
    $insertarData = "INSERT INTO sgm.pedido ( 
        id,
        pedidoid,
        actividad,
        created,
        modified
    )VALUES(
        '$ID',
        '$pedidoid',
        '".$actividad."',
        '$date',
        '$date');";
    
        
        $conexion->query($insertarData);
    }
 $i++;

}

?>

<a href="../../../">Volver</a>