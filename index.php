
<?php
    $muelles = 340;
    require_once 'mod/getCamiseta.php';
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
?>



<!DOCTYPE HTML>

<html>
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



    </script>
    <style>

    </style>
</head>
<body data-spy="scroll" class="landing">
<!-- Page Wrapper -->
<div id="page-wrapper">

    <!-- Header -->
    <header id="header" class="">
        <h1><a href="/"><img style="height: 100%; padding: 1px 10px 3px 0;" src="">Gestion Muelles
                <img src="../images/esp2.png" style="margin-bottom: 5px;width: 35px; height: 35px"></a></h1>
        <nav id="nav">
            <ul>
                <li class="special">
                    <a href="#menu" class="menuToggle"><span>Menu</span></a>
                    <div id="menu">
                        <ul>
                            <li><a href="/">Inicio</a></li>
                        </ul>
                        <p class="text-center"><img style="max-width: 180px;width: 100%;" src="../images/cruztrans.png">
                        </p>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Main -->
    <!-- Two -->
    <article id="main">

        <div class="c7 img7 parallax-background container-fluid">
            <div class="soft">
                <div class="c2 d-flex align-items-center fadeIn">
                    <div class="row" style="display: contents;">
                        <div class="col main expand"><span class="maintitle">Gestion Muelles</span>
                            <br><br>
                            <div class="subtitle contador" data-value="<?php echo $muelles?>"></div>
                            <br>
                            <?php
                            if($muelles > 0 && $muelles <= 340)
                            {
                                echo '<p style="color: white;">Muelles Disponibles:<br><span style="border: 1px solid white;padding: 3px 10px;font-size: 17px;">'.$muelles.' / 340 </span></p>';
                            }
                            else {
                                echo '<p style="color: white;"><span style="border: 1px solid #dc3545;padding: 3px 10px;font-size: 17px; background: #dc3545">¡muelles Agotadas!</span></p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div id="one" class="slideIn" onmouseover="bajar()" onmouseout="subir()">
                    <a href="#formulario" class="js-scroll-trigger">
                        <p>¡Hazte con el tuyo!</p><img class="flecha" id="imag" src="../images/Contador/right.png">
                    </a>
                </div>
            </div>
        </div>
    </article>
</div>
</body>
</html>
<?php require('../mod/footer.php'); ?>
<script src="js/retro-mechanical-counter.js"></script>
<script src="js/script.js"></script>
<script src="js/jarallax.min.js"></script>
<script src="js/parallax.js"></script>
<script src="js/smooth-scroll.js"></script>
