<?php 
$configs = include("../config.php");

if (empty( $_GET )) {
    echo "[ERROR] GET must be set!";
    exit;
}

if(empty( $_GET['matricula'] ) || empty( $_GET['uuid']) ||  $_GET['uuid'] != $configs["securityUUIDToken"] || empty( $_GET['periodo']) || empty( $_GET['token']) || empty( $_GET['muelle'])){

    echo "[ERROR] Empty Fields!";
    exit;
}

$dbconfig = include("../db.config.php");
include("../connect.php");
$reserva = array();
$reserva["matricula"] = mysqli_real_escape_string($conexion,$_GET['matricula']);
$reserva["periodo"] = mysqli_real_escape_string($conexion,$_GET['periodo']);
$reserva["token"] = mysqli_real_escape_string($conexion,$_GET['token']);
$reserva["muelle"] = mysqli_real_escape_string($conexion,$_GET['muelle']);


$prequery = "SELECT * FROM sgm.reserva WHERE idMuelle=".$reserva["muelle"]." AND idPeriodo=".$reserva["periodo"].";";

$preres = $conexion->query($prequery);
$prereserva = $preres->fetch_object();
if(!empty($prereserva->idUsuario)){
    echo "[ERROR] Este muelle ya esta reservado!";
    exit;
}
$date = date('Y-m-d H:i:s');
$query = "UPDATE sgm.reserva SET idUsuario=(SELECT id FROM sgm.Usuario WHERE token='".$reserva["token"]."'), matricula='".$reserva["matricula"]."', modified=now() WHERE idMuelle=".$reserva["muelle"]." AND idPeriodo=".$reserva["periodo"].";";

if($res = $conexion->query($query)){
    echo "<span style='font-size:2em'>RESERVA COMPLETADA!</span>!";
    echo "<p style='font-size:2em'><strong>Datos de la reserva:</strong><br>
    <ol>
        <li>Muelle: ".$reserva["muelle"]."</li>
        <li>Periodo: ".$reserva["periodo"]."</li>
        <li>Matricula: ".$reserva["matricula"]."</li>
        <li>Actividad: ".$prereserva->actividad."</li>
        <li>Fecha Creación: ".$date."</li>
    </ol>
    </p>";
}
?>

<a href="../../../">Volver</a>

