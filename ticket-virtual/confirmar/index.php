<?php
$confirmado = 0;
$nombre = "Misionero";
$santu = "Madrid";
$token = "";
require "../mod/session.php";
if($confirmado == 1){
    echo "<script>window.location.href = 'https://misionpais.es/pack/misionero/index.php?token=".$token."';</script>";
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
<title>Confirmar</title>
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
                        <div class="col main expand"><span class="maintitle">Gestión Muelles</span>
                            <div class="space">
                                <h3>¡Querid@ <strong><?php echo $nombre; ?>!</strong></h3>
                                <br>
                                <p style="font-size: 1.2em;text-align: center;">
                                   Para poder reservar tu pack, primero introduce el código que te enviamos por correo:
                                </p>
                                <strong>+ VAYAMOS A VERLO, SALDREMOS CONFIADOS +</strong>
                                <div style="padding-bottom: 20px;color:black!important" class="fc container">
                                    <form action="../mod/checkCode.php" method="post" class="needs-validation" novalidate autocomplete="off">
                                        <div class="form-row">
                                            <div class="col-12">
                                                <label for="validationServer01" style="color:black!important">Código</label>
                                                <input type="text" style="background: rgba(144, 144, 144, 0.25)!important;" class="form-control" name="code" id="validationServer01" placeholder="Código" required>
                                                <div class="invalid-feedback">
                                                    ¡Introduce el código!
                                                </div>
                                                <?php
                                                if(isset($_GET["result"]) && $_GET["result"] === "87d7dbd3fbf8f885b6a0341b2dfd674d"){
                                                    echo"<div style='display: block' class='invalid-feedback'>
                                                    Correo ya confirmado, comprueba en tu correo
                                                    </div>";
                                                }
                                                if(isset($_GET["result"]) && $_GET["result"] === "6d720b64a17feb80f83961e8bdbba396"){
                                                    echo"<div style='display: block' class='invalid-feedback'>
                                                    El código es incorreto, vuelve a introducirlo.
                                                    </div>";
                                                            }
                                                if(isset($_GET["result"]) && $_GET["result"] === "95b48dede1ae2072499eeb31b69d82a9"){
                                                                echo"<div style='display: block' class='invalid-feedback'>
                                                    El código debe tener 6 caracteres.
                                                    </div>";
                                                }
                                                ?>
                                            </div>
                                            <input type="hidden" name="token" value="<?php echo $token; ?>">
                                        </div>
                                        <div class="t3" style="margin-top:20px">
                                            <button type="submit" class="b1 RevealLeft"><span><span class="know">Reservar</span></span></button>
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