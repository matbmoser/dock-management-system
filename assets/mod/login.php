
<?php
if (empty($_POST['names']) || empty($_POST['numbers']) || $_POST['numbers'] == 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855'){

    echo json_encode(array('success' => '0'));

} else {
    include ("connect.php");
    require_once("sha.php");
    $sql = "SELECT `userid` AS ID, `email` AS CORREO ,`password` AS PASS from `user` where `email`="."'".mysqli_real_escape_string($conexion,$_POST['names'])."'"." AND `password`="."'".mysqli_real_escape_string($conexion,$_POST['numbers'])."'";
    if($result = $conexion->query($sql)){
            $row = $result->fetch_object();
            $token = sha256($row->CORREO.$row->PASS);
        if($row->ID != NULL && $_POST['token'] == $token){
            echo json_encode(array('success' => '1','userid' => $row->ID, 'token' => $token));
        }else{
            echo json_encode(array('success' => '0'));
        }
    }else{
        echo json_encode(array('success' => '0'));
    }
}
?>