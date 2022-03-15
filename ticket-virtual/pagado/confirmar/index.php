<?php
$token = "";
$misionerosdata = [];
session_start();
if(!empty($_SESSION["token"])){
    if($_SESSION["token"] === hash('sha512',"tokenusuario{".session_id()."}misionero")){
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            session_unset();
            session_destroy();
            header("Location: ../index.php?result=26862e06e617a850abae808f879e2861");//Código erroneo
            exit;
        }
        require_once "../../mod/class.Misionero.php";
        $misionero = new Misionero();
        $misioneroCond['return_type'] = 'all';
        $misionerosdata = $misionero->getMisioneros($misioneroCond);
    }else{
        error_log("Acceso prohibido sin token ya no es valido [".$_SESSION["token"]."]",0);
        echo "<script>window.location.href = '../index.php?result=5e5f6056ef6d09793eac4b523012c45c';</script>";
    }
}else {
    error_log("Acceso prohibido sin token session",0);
    echo "<script>window.location.href = '../index.php?result=5e5f6056ef6d09793eac4b523012c45c';</script>";
}
/*if(isset($_GET)){
    if(empty($_GET["result"])){
        error_log("Resultado GET Vacio",0);
        echo "<script>window.location.href = '../index.php?result=5e5f6056ef6d09793eac4b523012c45c';</script>";
    }
}*/
?>
<!--
Design by: Telecoteam
Programmed and Designed by: Mathias Moser
Misión País España
Copyright 2017 - 2021
All Rights Reserved
-->

<!DOCTYPE HTML>

<html xmlns="http://www.w3.org/1999/html">
<head>
<title>Home</title>
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
            height: 100%;
        }
        .wrapper.style1 strong, .wrapper.style1 b {
            color: #ffffff;
        }
        .wrapper.style1.special {
            margin: 0 auto;
            background: #212529!important;
        }


        .tab__content {
            background-color: #000000;
            position: relative;
            width: 100%;
            border-radius: 5px;
        }
        .tab__content > li {
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            display: none;
            list-style: none;
        }
        .tab__content > li .content__wrapper {
            text-align: center;
            border-radius: 5px;
            width: 100%;
            padding: 45px 40px 40px 40px;
            background-color: #000000;
        }

        .content__wrapper h2 {
            width: 100%;
            text-align: center;
            padding-bottom: 20px;
            font-weight: 300;
        }
        .content__wrapper img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .tab__content {
            background-color: #000000;
            position: relative;
            width: 100%;
            border-radius: 5px;
        }
        .tab__content > li {
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            display: none;
            list-style: none;
        }
        .tab__content > li .content__wrapper {
            text-align: center;
            border-radius: 5px;
            width: 100%;
            padding: 45px 40px 40px 40px;
            background-color: #000000;
        }

        .content__wrapper h2 {
            width: 100%;
            text-align: center;
            padding-bottom: 20px;
            font-weight: 300;
        }
        .content__wrapper img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        /* for custom scrollbar for webkit browser*/
        table{
            width:100%;
            position: relative;
            border-collapse: collapse;
        }
        .tbl-header{
            background-color: rgba(255,255,255,0.3);
            position: sticky;
            top:0;
        }
        .tbl-content{
            height: 55vh;
            overflow-x:auto;
            overflow-y:auto;
            margin-top: 0px;
            border: 1px solid rgba(255,255,255,0.3);
        }
        th{
            padding: 20px 15px;
            text-align: left;
            font-weight: 500;
            font-size: 12px;
            color: #fff;
            text-transform: uppercase;
        }
        td{
            padding: 15px;
            text-align: left;
            vertical-align:middle;
            font-weight: 300;
            font-size: 12px;
            color: #fff;
            border-bottom: solid 1px rgba(255,255,255,0.1);
        }

    </style>
</head>
<body data-spy="scroll" class="landing">
<!-- Page Wrapper -->
<div id="page-wrapper">

    <!-- Header -->
    <header id="header" class="">
        <h1><a href="../../../"><img style="height: 100%; padding: 1px 10px 3px 0;" src="../../../images/cruztrans.png">Misión País
                <img src="../../../images/esp2.png" style="margin-bottom: 5px;width: 35px; height: 35px"></a></h1>
        <nav id="nav">
            <ul>
                <li class="special">
                    <a href="#menu" class="menuToggle"><span>Menu</span></a>
                    <div id="menu">
                        <ul>
                            <li><a href="../../">Inicio</a></li>
                            <li><a href="../../../historia/">Historia</a></li>
                            <li><a href="../../../testimonios/">Testimonios</a></li>
                            <li><a href="../../../fiesta_benefica/">Misión Party</a></li>
                            <li><a href="../../../contador/" class="button">Consagraciones</a></li>
                            <li><a href="https://misionpais.es/pack" class="button">Pack Misionero</a></li>
                        </ul>
                        <p class="text-center"><img style="max-width: 180px;width: 100%;" src="../../../images/cruztrans.png">
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
                                <h3><strong>Bienvenido a Confirmar pago</strong></h3>
                                <br>
                                <p style="font-size: 1.2em;text-align: center;">
                                    Introduce el <strong>correo</strong> del misionero para confirmar el pago:
                                </p>
                                <div style="padding-bottom: 20px;color:black!important" class="fc container">
                                    <form action="../../mod/checkMisionero.php" method="post" class="needs-validation" novalidate autocomplete="off">
                                        <div class="form-row">
                                            <div class="col-12">
                                                <label for="validationServer01" style="color:black!important">Correo</label>
                                                <input type="email" style="background: rgba(144, 144, 144, 0.25)!important;" class="form-control" name="correo" id="validationServer01" placeholder="Correo" required>
                                                <div class="invalid-feedback">
                                                    ¡Introduce el correo correctamente!
                                                </div>
                                                <?php
                                                if(isset($_GET["result"]) && $_GET["result"] === "6d720b64a17feb80f83961e8bdbba396"){
                                                    echo"<div style='color: #dc3545!important;display: block' class='invalid-feedback'>
                                                    El correo es incorrecto vuelve a introducirlo
                                                    </div>";
                                                }
                                                else if(isset($_GET["result"]) && $_GET["result"] === "87d7dbd3fbf8f885b6a0341b2dfd674d"){
                                                    echo"<div style='color: #dc3545!important;display: block' class='invalid-feedback'>
                                                    ¡El pago ya fue confirmado anteriormente!
                                                    </div>";
                                                }
                                                else if(isset($_GET["result"]) && $_GET["result"] === "cb6fbdb6bec97c5b9778c71537d2128e"){
                                                    echo"<div style='color: #dc3545!important;display: block' class='invalid-feedback'>
                                                    ¡El usuario no existe!
                                                    </div>";
                                                }
                                                else if(isset($_GET["result"]) && $_GET["result"] === "faf90f795de0f8995cafc40512729d79"){
                                                    echo"<div style='color: #dc3545!important;display: block' class='invalid-feedback'>
                                                    ¡El usuario no ha confirmado su correo todavia!
                                                    </div>";
                                                }
                                                else if(isset($_GET["result"]) && $_GET["result"] === "4879c7430f8c28bcb6e972b33208a9e1"){

                                                }
                                                else if(isset($_GET["result"]) && $_GET["result"] === "success"){
                                                    echo"<div style='display: block' class='valid-feedback'>
                                                    ¡Pago confirmado correctamente, el correo se ha enviado!
                                                    </div>";
                                                }
                                                else if(isset($_GET["result"]) && $_GET["result"] === "fail"){
                                                    echo"<div style='color: #dc3545!important;display: block' class='invalid-feedback'>
                                                    ¡Pago confirmado correctamente, pero el correo no se ha enviado!
                                                    </div>";
                                                }else if(isset($_GET["result"]) && empty($_GET["result"])){
                                                    error_log("Resultado GET result vacio",0);
                                                    echo "<script>window.location.href = '../index.php?result=5e5f6056ef6d09793eac4b523012c45c';</script>";
                                                }
                                                else if(isset($_GET["result"]) && !empty($_GET["result"])){
                                                    error_log("Resultado GET result no experado [".$_GET["result"]."]",0);
                                                    echo "<script>window.location.href = '../index.php?result=5e5f6056ef6d09793eac4b523012c45c';</script>";
                                                }
                                                ?>
                                                <input type="hidden" name="token" value="<?php echo $token; ?>">
                                            </div>
                                        </div>
                                        <div class="t3" style="margin-top:20px">
                                            <button type="submit" class="b1 RevealLeft"><span><span class="know">Confirmar</span></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <div class="pb-5 pt-5 flex-fill parallax-background">

                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <h3 style="color:black;" class="card-title">Misioneros</h3>
                                    <button type="button" style="position: absolute;right: 10px;top: 10px;box-shadow: none;" class="btn btn-success" data-toggle="modal" data-target="#formModal">Exportar</button>
                                    <?php
                                    if(isset($_GET["result"]) && $_GET["result"] === "4879c7430f8c28bcb6e972b33208a9e1"){
                                        echo"<div style='color: #dc3545!important;display: block' class='invalid-feedback'>
                                                    ¡Exportación fallida, contraseña equivocada!
                                                    </div>";
                                    }
                                    ?>
                            </div>
                            <div class="table-responsive card-body">
                                <table style="background: black;" id="dataTableUsuarios" class="table card-table table-vcenter text-nowrap" data-page-length='100'>

                                    <thead>
                                    <tr>
                                        <th class="w-1">Misionero</th>
                                        <th>Información</th>
                                        <th>Fechas</th>
                                        <th><div class="d-flex justify-content-between"><span>Pagado</span><span><i class="fas fa-grip-lines-vertical"></i></span><span>Entregado</span></div></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($misionerosdata as $i):

                                        if($i['confirmado']=== "0"){
                                            $i['confirmado'] = "No";
                                        }else{
                                            $i['confirmado'] = "Si";
                                        }
                                        if($i['pagado']=== "0"){
                                            $i['pagado'] = "No";
                                        }else{
                                            $i['pagado'] = "Si";
                                        }
                                        if($i['entregado']=== "0"){
                                            $i['entregado'] = "No";
                                        }else{
                                            $i['entregado'] = "Si";
                                        }
                                        setlocale(LC_ALL,"es_ES");
                                        $created = strftime("%d  %b.  %Y",strtotime($i['fecha']));
                                        $entrega = strftime("%d  %b.  %Y  %k:%M",strtotime($i['fechaEntrega']));
                                        ?>
                                        <tr>
                                            <td  style="vertical-align: middle;">
                                                <div class="small text-muted"><?php echo $i['id']?></div>
                                                <div><?php echo $i['nombre']?></div>
                                                <div class="small text-muted"><?php echo  $i['correo'] ?></div>
                                                <div class="small text-muted"><?php echo  $i['telefono']?></div>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <div class="small text-muted">Santuario: <?php if($i['pagado'] === "Si"): echo "<strong>"; endif; ?><?php echo $i['santu']; ?><?php if($i['pagado'] === "Si"): echo "</strong>"; endif; ?></div>
                                                <div class="small text-muted" style="color: white">Talla: <strong><?php echo $i['talla']; ?></strong></div>
                                                <div class="small text-muted" >Confirmado: <?php if($i['confirmado'] === "No") { echo "<strong style='color: #dc3545!important;'>".$i['confirmado']."</strong>";}else{ echo $i['confirmado'];} ?></div>
                                                <div class="small text-muted">Pagado: <?php if($i['pagado'] === "Si"): echo "<strong>"; endif; ?><?php echo $i['pagado']; ?><?php if($i['pagado'] === "Si"): echo "</strong>"; endif; ?></div>
                                                <div class="small text-muted">Entregado: <?php if($i['entregado'] === "Si"): echo "<strong>"; endif; ?><?php echo $i['entregado']; ?><?php if($i['entregado'] === "Si"): echo "</strong>"; endif; ?></div>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <div class="text-muted d-flex align-items-center">Inscripción: <?php echo $created;?> </div>
                                                <?php if($i['pagado'] === "Si" && $i['entregado'] === "Si"){echo "<div class='text-muted d-flex align-items-center'>Entrega: ".$entrega."</div>";}?>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <?php if($i['pagado'] === "Si" && $i['entregado'] === "Si"){ echo "<div class='d-flex align-items-center justify-content-between'> <i style='font-size:2.5em;color: #28a745!important;' class='fas fa-check-square'></i><strong><i style='font-size: 2.1em;margin-left:5px;margin-right:5px;' class='fas fa-people-carry'></i></strong></div>";}else if($i['pagado'] === "Si"){ echo "<div><i style='font-size:2.5em;color: #28a745!important;' class='fas fa-check-square'></i></div>";}else{echo "<div><i style='font-size:2.5em;color: #dc3545!important;' class='fas fa-times'></i></div>"; } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $('#dataTableUsuarios').DataTable( {
                        select: true,
                        language: {
                            search: "Buscar:",
                            paginate: {
                                first:      "Primera",
                                previous:   "Anterior",
                                next:       "Siguiente",
                                last:       "ültima"
                            },
                            lengthMenu:    "Mostrar _MENU_ usuarios",
                            info: "Resultados  _START_ a _END_ de _TOTAL_ usuarios",
                        },
                        ordering:  false
                    });
                </script>
        <div style="color: black!important;text-align: justify;" class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">¡Introduce la contraseña para exportar!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="../../mod/exportarCSV.php" class="needs-validation" novalidate autocomplete="off">
                            <label for="validationServer01" style="color:black!important">Introduce la Contraseña:</label>
                            <input type="password" style="background: rgba(144, 144, 144, 0.25)!important;" class="form-control" name="pass" id="validationServer01" placeholder="Constraseña" required>
                            <div style="color: #dc3545!important;" class="invalid-feedback">
                                ¡Introduce la contraseña!
                            </div>
                            <?php
                            if(isset($_GET["result"]) && $_GET["result"] === "4879c7430f8c28bcb6e972b33208a9e1"){
                                echo"<div style='color: #dc3545!important;display: block' class='invalid-feedback'>
                                                    ¡Exportación fallida, contraseña equivocada!
                                                    </div>";
                            }
                            ?>
                            <button type="submit" style="margin-top:5px;box-shadow: none;" class="btn btn-success" name="CSV">Exportar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" style="box-shadow: none;" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <?php require('../../../mod/footer.php'); ?>
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
    <script src="../../js/retro-mechanical-counter.js"></script>
    <script src="../../js/script.js"></script>
    <script src="../../js/jarallax.min.js"></script>
    <script src="../../js/parallax.js"></script>
    <script src="../../js/smooth-scroll.js"></script>