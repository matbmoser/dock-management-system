
<?php
$confirm = false;
require "../mod/class.Misionero.php";
if(isset($_GET) && !empty($_GET["token"])){
    require "../mod/connect.php";
    $token = mysqli_real_escape_string($conn, $_GET["token"]);
    $token = filter_var($token, FILTER_SANITIZE_STRING);
    if(!empty($token)){
        $misionero = new Misionero();
        $confirm = $misionero->verify($token);
        if($confirm) {
            $data = $misionero->getData($token);
        }else{
            echo "is false";
        }
    }else{
        error_log("Token Inválido Posible SQLI",0);
        echo "<script>window.location.href = '../index.php?result=fc6a3af9fa9577cea06eed12dee27ec8';</script>";
    }
}
else{
    error_log("Token no enviado",0);
    echo "<script>window.location.href = '../index.php?result=fc6a3af9fa9577cea06eed12dee27ec8';</script>";
}
?>


<!DOCTYPE HTML>

<html>
<head>
<title>Verify</title>
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
        <h1><a href="../../"><img style="height: 100%; padding: 1px 10px 3px 0;" src="../../images/cruztrans.png">Misión País
                <img src="../../images/esp2.png" style="margin-bottom: 5px;width: 35px; height: 35px"></a></h1>
        <nav id="nav">
            <ul>
                <li class="special">
                    <a href="#menu" class="menuToggle"><span>Menu</span></a>
                    <div id="menu">
                        <ul>
                            <li><a href="../../">Inicio</a></li>
                            
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
        <?php if($confirm){ ?>
        <div class="c9 c7 img7 parallax-background container-fluid">
            <div class="soft">
                <div class="c2 d-flex align-items-center fadeIn">
                    <div class="row" style="display: contents;">
                        <div class="col main expand"><span class="maintitle">Pack Misionero</span>
                            <div class="space">
                                <p style="font-size: 1.2em;text-align: center;">
                                    <strong>¡El Misionero existe, ha confirmado su reserva y ha pagado!</strong>
                                </p>
                                <p style="display=flex; align-content: center;justify-items: center"><img style="height:200px; weight:200px" src="../../images/kitmisionero/check.png"></p>
                                <div><p><strong>Nombre: </strong> <?php echo $data["nombre"]?>
                                <br><strong>Correo: </strong> <?php echo $data["correo"]?>
                                    <br><strong>Local de Recogida:</strong> Santuario de <?php echo $data["santu"]?>
                                    <br><strong>Talla: </strong> <?php echo $data["talla"]?>
                                </p>
                                </div>
                                <?php
                                if($data["entregado"] == 0){?>
                                    <form action="../mod/entregarPack.php" method="post">
                                        <input type="hidden" name="token" value="<?php echo $data["token"]?>">
                                        <div class="t3" style="margin-top:20px">
                                            <button type="submit" class="b1 RevealLeft"><span><span class="know">Entregar</span></span></button>
                                        </div>
                                    </form>
                                <?php }else{?>
                                    <form>
                                        <div class="t3" style="margin-top:20px">
                                            <button class="b1 RevealLeft" style="background: #28a745!important;opacity:1;pointer-events: fill;" disabled><span><span class="know">Entregado <i class="fas fa-check"></i> </span></span></button>
                                        </div>
                                    </form>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <? }else if(!$confirm && isset($_GET["result"]) && $_GET["result"] === "5e5f6056ef6d09793eac4b523012c45c"){?>
        <div class="c9 c7 img7 parallax-background container-fluid">
            <div class="soft">
                <div class="c2 d-flex align-items-center fadeIn">
                    <div class="row" style="display: contents;">
                        <div class="col main expand"><span class="maintitle">Pack Misionero</span>
                            <div class="space">
                                <p style="font-size: 1.2em;text-align: center;">
                                    <strong>¡El Misionero no existe y si ha confirmado su reserva no ha pagado!</strong>
                                </p>
                                <p style="display=flex; align-content: center;justify-items: center"><img style="height:200px; weight:200px" src="../../images/kitmisionero/fail.png"></p>
                                <?php
                                echo"<div style='display: block' class='invalid-feedback'>
                                    ¡No ha sido posible actualizar el usuario, escanea otra vez el QR!
                                </div>";
                                ?>
                                <strong>+ VAYAMOS A VERLO, SALDREMOS CONFIADOS +</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{?>
            <div class="c9 c7 img7 parallax-background container-fluid">
                <div class="soft">
                    <div class="c2 d-flex align-items-center fadeIn">
                        <div class="row" style="display: contents;">
                            <div class="col main expand"><span class="maintitle">Pack Misionero</span>
                                <div class="space">
                                    <p style="font-size: 1.2em;text-align: center;">
                                        <strong>¡El Misionero no existe y si ha confirmado su reserva no ha pagado!</strong>
                                    </p>
                                    <p style="display=flex; align-content: center;justify-items: center"><img style="height:200px; weight:200px" src="../../images/kitmisionero/fail.png"></p>
                                    <strong>+ VAYAMOS A VERLO, SALDREMOS CONFIADOS +</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </article>
    <?php require('../../mod/footer.php'); ?>
    <script src="../js/retro-mechanical-counter.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/jarallax.min.js"></script>
    <script src="../js/parallax.js"></script>
    <script src="../js/smooth-scroll.js"></script>
