<?php
$configs = include('assets/mod/config.php');
$dbconfig = include("assets/mod/db.config.php");
require_once("assets/mod/connect.php");
require_once("assets/mod/session.php");


if(empty( $_SESSION["token"] )){
    setcookie("__LOGIN__", "", time() - 3600, "/");
    header('Location: login/');
    exit;
  }

require_once("assets/mod/token.php");
require_once("assets/mod/fallos.php");

if (empty($nombre)){
    header('Location: login/?result='.$configs["securityErrorToken"]);
} 

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuario</title>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://kit.fontawesome.com/6d67b863f5.js" crossorigin="anonymous"></script>
    <link href="assets/css/main.css" rel="stylesheet">
    <link rel="icon" href="media/favicon.ico" type="image/x-icon">
    <link href="assets/bt/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<header class="header sticky-top">
      <nav class="navbar navbar-expand-lg">
        <div class="container">

          <a class="navbar-brand me-2" href="">
            <img id="mylogo" src="media/img/feedex.png" height="90" loading="lazy" class="img-light" style="margin-top: -1px;"/>
          </a>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link logoName" href="#"></a>
              </li>
            </ul>

              <button
                id="openbtn"
                class="openbtn navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#buttonArea"
                aria-controls="buttonArea"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
              <i class="fas fa-bars"></i>
            </button>

          <div id="buttonArea" class="collapse navbar-collapse justify-content-end">

            <div class="d-flex align-items-center justify-content-end">
              <div class="px-3 me-2">
                <?php if ($nombre != "") { echo "<span>Welcome <strong>" . $_SESSION['nombre'] . "</strong>!</span>"; } ?>
              </div>
              <button type="button" class="btn me-3 btn-light btn-outline-dark" onclick="window.location.href= './assets/mod/logout.php?uuid=<?php echo $configs['logoutToken'] ?>'">
                <i class="fas fa-sign-out-alt"></i> 
                <span>Log out</span>
              </button>
            </div>
          </div>
        </div>
      </nav>
    </header>
<body>