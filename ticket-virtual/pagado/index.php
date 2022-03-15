<?php

if (isset($_GET)) {
    if ($_GET["result"] === "5e5f6056ef6d09793eac4b523012c45c"){
        setcookie("__err__", "TRUE",time() + 1,"/");
        session_start();
        session_unset();
        session_destroy();
        session_write_close();
        setcookie("PHPSESSID","", time() - 3600, "/");
        header("Location:   index.php");
    }
    if ($_GET["result"] === "26862e06e617a850abae808f879e2861") {
        setcookie("__err__", "FALSE",time() + 1,"/");
        session_start();
        session_unset();
        session_destroy();
        session_write_close();
        setcookie("PHPSESSID","", time() - 3600, "/");
        header("Location:   index.php");
    }
    if ($_GET["result"] === "6d720b64a17feb80f83961e8bdbba396") {
        setcookie("__err__", "6d720b64a17feb80f83961e8bdbba396",time() + 1,"/");
        header("Location:   index.php");
    }
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
    <title>Pagado</title>
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
        .btn-close{
            height: 0;
            line-height: 1.7;
            box-shadow: none!important;
            color: #856404;
            float: right;
            z-index: 2;
            padding: 0 5px;
        }
        .btn-close:hover{
            background: white!important;
            color: #4e4527!important;
        }
        body.is-loading .digit-flipper__digit--flip-bottom .digit-flipper__digit-bottom {
            -webkit-animation: flip-bottom var(--flip-duration) ease-in 0s 1 forwards!important;
            animation: flip-bottom var(--flip-duration) ease-in 0s 1 forwards!important;
        }

        body.is-loading .digit-flipper__digit--flip-top .digit-flipper__digit-top {
            -webkit-animation: flip-top var(--flip-duration) ease-in 0s 1 forwards!important;
            animation: flip-top var(--flip-duration) ease-in 0s 1 forwards!important;
        }
        body.is-loading .revealLeft {
            animation-name: revealLeft!important;
            -webkit-animation-name: revealLeft!important;
            animation-duration: 1s!important;
            -webkit-animation-duration: 1s!important;
            animation-timing-function: ease!important;
            -webkit-animation-timing-function: ease!important;
            animation-fill-mode: forwards!important;
            -webkit-animation-fill-mode: forwards!important;
            visibility: visible!important;
            transition: all .35s!important;
        }
        body.is-loading #one {
            -moz-transition: -moz-transform 0.75s ease, opacity 0.75s ease!important;
            -webkit-transition: -webkit-transform 0.75s ease, opacity 0.75s ease!important;
            -ms-transition: -ms-transform 0.75s ease, opacity 0.75s ease!important;
            transition: transform 0.75s ease, opacity 0.75s ease!important;
            -moz-transition-delay: 0.5s!important;
            -webkit-transition-delay: 0.5s!important;
            -ms-transition-delay: 0.5s!important;
            transition-delay: 0.5s!important;
            -moz-transform: translateY(0) !important;
            -webkit-transform: translateY(0)!important;
            -ms-transform: translateY(0)!important;
            transform: translateY(0)!important;
            border: none;
            bottom: 0;
            color: white;
            font-size: 0.8em;
            height: 9em;
            left: 50%;
            letter-spacing: 0.225em;
            margin-left: -8em;
            opacity: 1;
            outline: 0;
            padding-left: 0.225em;
            position: absolute;
            text-align: center;
            text-transform: uppercase;
            width: 16em;
            z-index: 1;

        }
        #tallas{
            display: none;
        }
        #formulario{
            padding: 1em 0 4em 0!important;
        }
        .wrapper.style1 strong, .wrapper.style1 b {
            color: #ffffff;
        }
    </style>
</head>
<body data-spy="scroll" class="landing">
<!-- Page Wrapper -->
<div id="page-wrapper">

    <!-- Header -->
    <header id="header" class="">
        <h1><a href="../../"><img style="height: 100%; padding: 1px 10px 3px 0;" src="../../images/cruztrans.png">Misión País
                <img src="../../images/esp2.png" style="margin-bottom: 5px;width: 35px; height: 35px"></a></h1>
        <nav id="nav">
            <ul>
                <li class="special">
                    <a href="#menu" class="menuToggle"><span>Menu</span></a>
                    <div id="menu">
                        <ul>
                            <li><a href="../../">Inicio</a></li>
                            <li><a href="../../historia/">Historia</a></li>
                            <li><a href="../../testimonios/">Testimonios</a></li>
                            <li><a href="../../fiesta_benefica/">Misión Party</a></li>
                            <li><a href="../../contador/" class="button">Consagraciones</a></li>
                            <li><a href="https://misionpais.es/pack" class="button">Pack Misionero</a></li>
                        </ul>
                        <p class="text-center"><img style="max-width: 180px;width: 100%;" src="../../images/cruztrans.png">
                        </p>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <!-- Main -->
    <!-- Two -->
    <article id="main">

        <div class="c8 c7 img7 parallax-background container-fluid">
            <div class="soft">
                <div class="c2 d-flex align-items-center fadeIn">
                    <div class="row" style="display: contents;">
                        <div class="col main expand"><span class="maintitle">Pack Misionero</span>
                            <div class="space">
                                <h3>Acceso a confirmar pago</h3>
                                <br>
                                <p style="font-size: 1.2em;text-align: center;">
                                    Introduce la contraseña:
                                </p>
                                <div style="padding-bottom: 20px;color:black!important" class="fc container">
                                    <form action="../mod/checkAuth.php" method="post" class="needs-validation" novalidate autocomplete="off">
                                        <div class="form-row">
                                            <div class="col-12">
                                                <label for="validationServer01" style="color:black!important">Contraseña</label>
                                                <input type="password" style="background: rgba(144, 144, 144, 0.25)!important;" class="form-control" name="code" id="validationServer01" placeholder="Constraseña" required>
                                                <div class="invalid-feedback">
                                                    ¡Introduce la contraseña!
                                                </div>
                                                <?php
                                                if(isset($_COOKIE["__err__"]) && $_COOKIE["__err__"] === "6d720b64a17feb80f83961e8bdbba396"){
                                                    echo"<div style='display: block' class='invalid-feedback'>
                                                    La contraseña es incorreta, vuelve a introducirla.
                                                    </div>";
                                                }
                                                if(isset($_COOKIE["__err__"]) && $_COOKIE["__err__"] === "TRUE"){
                                                    echo"<div style='display: block' class='invalid-feedback'>
                                                        ¡Acceso prohibido!, debes introducir la contraseña.
                                                    </div>";
                                                }
                                                if(isset($_COOKIE["__err__"]) && $_COOKIE["__err__"] === "FALSE"){
                                                    echo"<div style='color: #dc3545!important;display: block' class='invalid-feedback'>
                                                        Sessión expirada, haz el login otra vez.
                                                    </div>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="t3" style="margin-top:20px">
                                            <button type="submit" class="b1 RevealLeft"><span><span class="know">Entrar</span></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </article>
    <script>
        // Disable form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <?php require('../../mod/footer.php'); ?>
    <script src="../js/retro-mechanical-counter.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/jarallax.min.js"></script>
    <script src="../js/parallax.js"></script>
    <script src="../js/smooth-scroll.js"></script>