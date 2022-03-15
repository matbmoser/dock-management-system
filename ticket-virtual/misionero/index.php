
<?php
$confirmado = 0;
$nombre = "Misionero";
$santu = "Madrid";
require "../mod/session.php";
if($confirmado == 0){
    echo "<script>window.location.href = 'https://misionpais.es/pack/confirmar/index.php?token=".$token."';</script>";
}
?>
<!--
Design by: Telecoteam
Programmed and Designed by: Mathias Moser
Misión País España
Copyright 2017 - 2021
All Rights Reserved
-->



<!DOCTYPE HTML>

<html>
<head>
<title>Confirmacion</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" href="">
    <meta name="description" content="Página principal de Gestion de Muelles"/>
    <meta name="keywords" content="GestionMuelles, Muelles, API, QRcode, PGPI, UFV"/>
    <meta name="author" content="Feedex"/>

    <script src="https://kit.fontawesome.com/6d67b863f5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <link rel="stylesheet" href="../assets/css/main.css"/>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-108480075-1');


        function partymode(boton) {
            var id = document.getElementById('comming');

            if (boton == true) {
                id.style.visibility = "visible";

            }
        }

    </script>
    <style>
      
    </style>
</head>
<body data-spy="scroll" class="landing">
<!-- Page Wrapper -->
<div id="page-wrapper">

    <!-- Header -->
    <header id="header" class="">
        <h1><a href="../../"><img style="height: 100%; padding: 1px 10px 3px 0;" src="">Gestor Muelles
                <img src="../../images/esp2.png" style="margin-bottom: 5px;width: 35px; height: 35px"></a></h1>
        <nav id="nav">
            <ul>
                <li class="special">
                    <a href="#menu" class="menuToggle"><span>Menu</span></a>
                    <div id="menu">
                        <ul>
                            <li><a href="../../">Inicio</a></li>
                        </ul>
                        <p class="text-center"><img style="max-width: 180px;width: 100%;" src="">
                        </p>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <!-- Main -->
    <!-- Two -->
    <article id="main">

        <div class="c9 c7 img7 parallax-background container-fluid">
            <div class="soft">
                <div class="c2 d-flex align-items-center fadeIn">
                    <div class="row" style="display: contents;">
                        <div class="col main expand"><span class="maintitle">Pack Misionero</span>
                            <div class="space">
                                <h3>¡Querid@ <strong><?php echo $nombre; ?>!</strong></h3>
                                <br>
                                <p style="font-size: 1.2em;text-align: center;">
                                    <strong>¡Enhorabuena, Tu pack del misionero ha sido reservado!</strong>
                                    <br>
                                    <span>Te hemos enviado un correo con las instrucciones para realizar el pago.<a style="box-shadow: none;cursor: pointer" data-toggle="modal" data-target="#exampleModalCenter">
                                        <i class="fas fa-info-circle"></i>
                                    </a><br>
                                        Síguelas para poder recogerlo en el: <br> <strong>Santuario de <?php echo $santu; ?></strong><br>
                                    Esperamos que puedas disfrutar de esta semana de misión online con tu pack de Misión Pais 2021.
                                    </span>
                                </p>
                                <strong>+ VAYAMOS A VERLO, SALDREMOS CONFIADOS +</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="color: black!important;text-align: justify;" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">¡Información Importante!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¡El pago se realizará mediante una <strong style="color: black">transferencia bancaria</strong>!
                            Te facilitaremos por correo los datos necesarios para realizarla.</p>
                        <p>Si no te llega el correo, puede que esté en la carpeta de <strong style="color: black">spam</strong></p>
                        <p><strong style="color: black">¡Importante!</strong> Los packs son individuales, por lo que una vez realizada la reserva, no podrás reservar para un amigo.</p>
                        <p>Si tienes algún problema con tu transferencia, no dudes en contactar con nosotros, enviando un correo a:</p>
                        <p style="text-align: center"><a href="mailto:comunicacion@misionpais.es">comunicacion@misionpais.es</a></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" style="box-shadow: none;" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <?php require('../../mod/footer.php'); ?>
    <script src="../js/retro-mechanical-counter.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/jarallax.min.js"></script>
    <script src="../js/parallax.js"></script>
    <script src="../js/smooth-scroll.js"></script>
