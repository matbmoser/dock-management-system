<?php
session_start();
if (!empty( $_GET )) {
    if(!empty( $_GET['token'] ) && !empty( $_GET['nombre'] )){
        $_SESSION['nombre'] = $_GET['nombre'];
        $_SESSION['token'] = $_GET['token'];
        header('Location: ./');
    }
}
?>
