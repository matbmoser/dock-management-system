<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="icon" href="../../media/favicon.ico" type="image/x-icon">
    <title>Registro</title>
      <script src="../../assets/js/libs/jquery/jquery-3.5.1.slim.min.js"></script>
      <script src="https://kit.fontawesome.com/6d67b863f5.js" crossorigin="anonymous"></script>
    <!-- Bootstrap core CSS -->
    <link href="../../assets/css/main.css" rel="stylesheet">
    <link href="../../assets/bt/css/bootstrap.min.css" rel="stylesheet">
    <script src="../../assets/vendor/jquery/jquery-3.5.1.js"></script>
    <script src="registro.js"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .error{
        display: none;
        color: red;
        position: absolute;
         font-size: 10px;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../floating-labels.css" rel="stylesheet">
  </head>
<body class="body">
<script src="../../assets/js/dark-mode.js"></script>
  <header class="user fixed-top">
      <div class="container-fluid p-0">
          <div class="row">
              <div class="col-4 d-flex justify-content-start align-items-center"><a id="return"class="m-4" href="../../"><i style="font-size: 2em" class="far fa-arrow-alt-circle-left mr-1"></i></a></div>
              <div class="col-8 d-flex justify-content-end"><button type="button" id="dark-mode" class="m-4 btn btn-outline-light"><i class="fas fa-sun mr-1"></i><span>Light Mode</span></button></div>
          </div>
      </div>
    </header>
<main class="form-signin" >
  <form id="formulario" class="needs-validation" action="registro.php" method="post" autocomplete="off" novalidate>
    <div class="text-center">
      <img id="logo" src="../../media/img/logo2.png" alt="logoufv">
    </div>
     <!-- <li><a href="<?php //echo $gpLoginURL; ?>" class="google"><i class="fab fa-google mr-2"></i></i><span>Iniciar sesión con Google</span></a></li>-->
    <div class="form-label-group">
      <input type="text" id="inputname" class="form-control" name="inputname" placeholder="Nombre" required>
      <label for="inputname">Nombre</label>
      <h6 class="error" id="nomv">El nombre no puede estar vacío</h6>
      <h6 class="error" id="nomt">La longitud del nombre debe ser inferior a 10</h6>
    </div>
    <div class="form-label-group">
      <input type="text" id="inputusrid" class="form-control" name="inputusrid" placeholder="Email address" required>
      <label for="inputuserid">Username</label>
      <h6 class="error" id="usrv">El username no puede estar vacío</h6>
      <h6 class="error" id="usrt">La longitud del nombre debe ser inferior a 10</h6>
      <h6 class="error" id="usru">Este username ya está en uso</h6>
      <h6 class="error" id="ussp">El username no puede contener espacios</h6>
    </div>

    <div class="form-label-group">
      <input type="email" id="inputEmail" class="form-control" name="inputEmail" placeholder="Email address" required>
      <h6 class="error" id="emav">El email no puede estar vacío</h6>
      <h6 class="error" id="emac">Introduce un formato de email válido</h6>
      <h6 class="error" id="emau">Este email ya está en uso</h6>
      <label for="inputEmail">Correo electrónico</label>
    </div>

    <div class="form-label-group">
      <input type="password" id="inputPassword" class="form-control" name="inputPassword" placeholder="Password" required>
      <label for="inputPassword">Contraseña</label>
      <h6 class="error" id="clac">La contraseña debe tener al menos 6 carácteres</h6>
      <h6 class="error" id="clan">Las contraseñas no coinciden</h6>
    </div>
    <div class="form-label-group">
      <input type="password" id="inputPassword1" class="form-control" name="inputPassword1" placeholder="Password" required>
      <label for="inputPassword">Repite tu contraseña</label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" id="btnEnviar" name="btnEnviar"  type="submit">Sign in</button>
        <div id="demo" class='mt-5 alert alert-info d-flex justify-content-center align-items-center fade show' role='alert'>
        <span><strong class='mr-2'>Cargando...</strong></span>
        <button type='button' class='spinner-border ml-4 text-info bg-transparent' data-dismiss='alert' aria-label='Close'></button>
      </div>
        <div id="ups" class='error mt-5 alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>¡Qué pena!</strong> Algo salió mal. Intente hacer el registro otra vez.
        <button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button>
      </div>
      <div class="mb-1 mt-2 form-label-group">
      <span>¿Ya tienes una cuenta? <a href="../">Entrar</a></span>
    </div>
  </form>
</main>
<script src="../../assets/bt/js/bootstrap.js"></script>
<script src="../../assets/js/libs/crypto-js/aes.js"></script>
    <style>
        a.google {
            border-color: #eee !important;
            color: #333;
            color: #fff;
            background-color: #E44439;
        }
        a.google:hover, a.google:active {
            opacity: 0.8;
        }
    </style>
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
  </body>
  <script src="assets/js/smooth-scroll.js"></script>
</html>
