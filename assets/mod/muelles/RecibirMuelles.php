<?php
$configs = include('../config.php');
$dbconfig = include("../db.config.php");
require_once("../class.Table.php");
$tablaPeriodo = new Table($dbconfig, "Periodo");
$periodos = $tablaPeriodo->getRows(array('return_type' => 'all'));

$tablaTipoCamion = new Table($dbconfig, "TipoCamion");
$tiposCamiones = $tablaTipoCamion->getRows(array('return_type' => 'all'));

require('../connect.php');
$tipo       = $_FILES['dataMuelles']['type'];
$tamanio    = $_FILES['dataMuelles']['size'];
$archivotmp = $_FILES['dataMuelles']['tmp_name'];
$lineas     = file($archivotmp);

$i = 0;

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {

        $datos = explode(";", $linea);
        $HORAS = array();
        $ID    = !empty($datos[0])  ? ($datos[0]) : '';
        $Tipo  = !empty($datos[1])  ? ($datos[1]) : '';
        array_push($HORAS,!empty($datos[2])  ? ($datos[2]) : '');
        array_push($HORAS,!empty($datos[3])  ? ($datos[3]) : '');
        array_push($HORAS,!empty($datos[4])  ? ($datos[4]) : '');
        array_push($HORAS,!empty($datos[5])  ? ($datos[5]) : '');
        array_push($HORAS,!empty($datos[6])  ? ($datos[6]) : '');
        array_push($HORAS,!empty($datos[7])  ? ($datos[7]) : '');
        array_push($HORAS,!empty($datos[8])  ? ($datos[8]) : '');
        array_push($HORAS,!empty($datos[9])  ? ($datos[9]) : '');
 
    
    $trucateTable = "DELETE FROM sgm.muelle WHERE id=$ID";
    // echo $insertarData;
    mysqli_query($conexion, $trucateTable); 

    $date = date('Y-m-d H:i:s');
    $insertarData = "INSERT INTO sgm.muelle ( 
        id,
        idTipoCamion,
        created,
        modified
        ) VALUES(
        '$ID',
        (SELECT id FROM sgm.TipoCamion WHERE nombre='$Tipo'),
        '$date',
        '$date');";
    #echo $insertarData;
    mysqli_query($conexion, $insertarData);


    $j = 0;
    $lenHoras = count($HORAS);
    while($j < $lenHoras){
        $periodo = $periodos[$j]['id']+1;
        $trucateTable = "DELETE FROM sgm.reserva WHERE idPeriodo=".$periodo." AND idMuelle=$ID";
        // echo $insertarData;
        mysqli_query($conexion, $trucateTable); 

        $insertarReserva = "INSERT INTO sgm.reserva ( 
            idMuelle,
            idPeriodo,
            actividad,
            created,
            modified
            ) VALUES(
            '$ID',
            '".$periodo."',
            '".$HORAS[$j]."',
            '$date',
            '$date');";
        echo $insertarReserva;
        mysqli_query($conexion, $insertarReserva);
        $j++;
    }     
   
  }
$i++;
}
?>
<a href="../../../">Volver</a>


