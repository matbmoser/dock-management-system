<?php
$configs = include('config.php');
$dbconfig = include("db.config.php");
include("connect.php");
if (empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['documento']) || empty($_POST['pass']) ||  empty($_POST['email']) || empty($_POST['fechaNacimiento']) || empty($_POST['token']) || $_POST['uuid'] != $configs["securityUUIDToken"]){

    echo json_encode(array('responseCode' => $configs["wrongRequestToken"]));
    exit;

}
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$documento = $_POST['documento'];
$password = $_POST['pass'];
$email = $_POST['email'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$token = $_POST['token'];
$empresa = "";
if (!empty($_POST['empresa'])){
    $empresa = $_POST['empresa'];
}
$date = date('Y-m-d H:i:s');
$sql = "INSERT INTO `sgm`.`usuario`
        (
        `nombre`,
        `apellidos`,
        `documento`,
        `empresa`,
        `email`,
        `password`,
        `fechaNacimiento`,
        `created`,
        `modified`,
        `idRol`,
        `token`)
        VALUES (
        '$nombre',
        '$apellidos',
        '$documento',
        '$empresa',
        '$email',
        '$password',
        '$fechaNacimiento',
        '$date',
        '$date',
        (SELECT id FROM sgm.rol WHERE nombre='Transportista'),
        '$token'
        );";

if($result = $conexion->query($sql)){
    $arraySucess=array('responseCode' => $configs["successToken"]);
    $userData = array('nombre' => $nombre, 'token' => $token);
    echo json_encode(array_merge($arraySucess,$userData));

}else{
    echo json_encode(array('responseCode' => $configs["registerFailToken"]));
}
