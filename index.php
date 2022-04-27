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
$modals = include("assets/mod/modals.php");
if (empty($nombre)){
    header('Location: login/?result='.$configs["securityErrorToken"]);
} 
require_once("assets/mod/class.Table.php");
$tablaPedidos = new Table($dbconfig, "Pedido");
$pedidos = $tablaPedidos->getRows(array('return_type' => 'all'));

$tablaReservas = new Table($dbconfig, "Reserva");
$reservas = $tablaReservas->getRows(array('return_type' => 'all'));

$tablaMuelles = new Table($dbconfig, "Muelle");
$muelles = $tablaMuelles->getRows(array('return_type' => 'all'));

$tablaPeriodo = new Table($dbconfig, "Periodo");
$periodos = $tablaPeriodo->getRows(array('return_type' => 'all'));

$tablaTipoCamion = new Table($dbconfig, "TipoCamion");
$tiposCamiones = $tablaTipoCamion->getRows(array('return_type' => 'all'));


function getIDValue($arr, $id, $value){
  $ids = array();
  foreach ($arr as $elem){
    $ids[$elem[$id]] = $elem[$value];
  }
  return $ids;
}

$nPeriodos = count($periodos); 
$muellesDisponibles = 0;
$periodosDisponibles = array();
function getNumDisponibles($periodos, $reservas, $muelles, &$muellesDisponibles, &$periodosDisponibles){
  $disponibilidadMuelles = array();
  foreach ($muelles as $muelle) {
    $num = 0;
    $periodosDisponibles[$muelle["id"]] = array();
    foreach ($periodos as $periodo){
      $perDisponibles = array();
      $element = "<td>NO DISPONIBLE</td>";
      foreach ($reservas as $reserva){
        if ($reserva["idMuelle"] == $muelle['id'] && $reserva["idPeriodo"] == $periodo["id"]){
          $actividad = $reserva['actividad'];
          if($actividad != "NO DISPONIBLE" && $reserva['idUsuario'] == null){
            array_push($periodosDisponibles[$muelle["id"]],$periodo["id"]);
            $num++;
          }
        }
      }
    }
    if($num > 0){
      $muellesDisponibles++;
    }
    $disponibilidadMuelles[$muelle["id"]] = $num;
  }
  return $disponibilidadMuelles;
}
$tiposCamion = getIDValue($tiposCamiones, "id", "nombre");

$tiposCamionMuelles = getIDValue($muelles, "id", "idTipoCamion");

$tiposPeriodos = getIDValue($periodos, "id", "horario");

$disponibilidadMuelles = getNumDisponibles($periodos, $reservas, $muelles,$muellesDisponibles, $periodosDisponibles);


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
<script>
var modals = <?php echo json_encode($modals); ?>;

</script>
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
                <?php if ($nombre != "") { echo "<span>Bienvenido <strong>" . $_SESSION['nombre'] . "</strong>!</span>"; } ?>
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
  
<div class="container-fluid mt-4">
      <div class="row d-flex justify-content-center">
      <?php 
      if ($permits->backoffice_muelles == 1){ ?>
        <div class="col-md-3 d-flex justify-content-center">
          <button type="button" id="configMuelles" data-bs-toggle="modal" data-bs-target="#Modal" class="btnAccion btn btn-primary w-100" ><i class="fa-solid fa-warehouse"></i> Admin Muelles</button>
        </div>
      <?php }
      if ($permits->backoffice_pedidos == 1){ ?>
        <div class="col-md-3 d-flex justify-content-center">
          <button type="button" id="configPedidos" data-bs-toggle="modal" data-bs-target="#Modal" class="btnAccion btn btn-primary w-100" ><i class="fa-solid fa-list-check"></i> Admin Pedidos</button>
        </div>
        <?php }
      if ($permits->portal_incidencias == 1){ ?>
        <div class="col-md-3 d-flex justify-content-center">
          <button type="button" id="barreras" data-bs-toggle="modal" data-bs-target="#Modal" class="btnAccion btn btn-primary w-100" ><i class="fa-solid fa-triangle-exclamation"></i> Barreras</button>
        </div>
        <?php }?>
      </div>
    </div>
    <?php if ($permits->backoffice_pedidos == 1){ ?>
    <div class="container-fluid mt-4 d-flex justify-content-center table-responsive" style="background: var(--color); color: var(--bg-color);">
      <div class="col-sm-8">

        <h6 class="text-center" style="">
          Lista de pedidos <strong><?php echo count($pedidos); ?></strong>
        </h6>

          <table class="table table-striped table-hovertext-nowrap">
            <thead>
              <tr>
                <th>Id</th>
                <th>idPedido</th>
                <th>Actividad</th>
                <th>Created</th>
                <th>Modified</th>
              </tr>
            </thead>
            <tbody>
              <?php       
              foreach ($pedidos as $pedido) { ?>
              <tr>              
                <td><?php echo $pedido['id']; ?></td>
                <td><?php echo $pedido['pedidoid']; ?></td>
                <td><?php echo $pedido['actividad']; ?></td>
                <td><?php echo $pedido['created']; ?></td>
                <td><?php echo $pedido['modified']; ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
      </div>
    </div>
    <?php }?>
    <?php if ($permits->backoffice_muelles == 1){ ?>
    <div class="container-fluid mt-4 d-flex justify-content-center table-responsive" style="background: var(--color); color: var(--bg-color);">
    <div class="col-sm-8">

        <h6 class="text-center" style="">
          Lista de Muelles <strong><?php echo count($muelles); ?></strong>
        </h6>

          <table class="table table-striped table-hovertext-nowrap">
            <thead>
              <tr>
                <th>Id</th>
                <th>TipoCamion</th>
                <th>created</th>
                <th>modified</th>
              </tr>
            </thead>
            <tbody>
              <?php       
              foreach ($muelles as $muelle) { ?>
              <tr>              
                <td><?php echo $muelle['id']; ?></td>
                <td><?php echo $tiposCamion[$muelle['idTipoCamion']]; ?></td>
                <td><?php echo $muelle['created']; ?></td>
                <td><?php echo $muelle['modified']; ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
      </div>
    </div>
    <div class="container-fluid mt-4 d-flex justify-content-center table-responsive" style="background: var(--color); color: var(--bg-color);">
      <div class="col-12">

        <h6 class="text-center" style="">
          Reservas muelles <strong><?php echo count($muelles); ?></strong>
        </h6>

          <table class="table table-striped table-hovertext-nowrap">
            <thead>
              <tr>
                <th>Muelle</th>
                <th>Tipo</th>
                <?php foreach ($periodos as $periodo){?>
                <th><?php echo $periodo["horario"]; ?></th>
                <?php }?>
                <th>created</th>
                <th>modified</th>
              </tr>
            </thead>
            <tbody>
            <?php       
              foreach ($muelles as $muelle) { ?>
              <tr>              
                <td><?php echo $muelle['id']; ?></td>
                <td><?php echo $tiposCamion[$muelle['idTipoCamion']]; ?></td>
                
                <?php
               
                foreach ($periodos as $periodo){
                  $element = "<td>NO DISPONIBLE</td>";
                  foreach ($reservas as $reserva){
                    if ($reserva["idMuelle"] == $muelle['id'] && $reserva["idPeriodo"] == $periodo["id"]){
                     
                      $element = "<td>".$reserva['actividad']."</td>"; 
                    }else{
                    }
                    
                  }
                  echo $element;
                }
                ?>
                <td><?php echo $reserva['created']; ?></td>
                <td><?php echo $reserva['modified']; ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
      </div>
    </div>
    <?php }?> 
    <?php if ($permits->ticket_virtual == 1) { ?>
      <div class="container-fluid mt-4 d-flex justify-content-center table-responsive" style="background: var(--color); color: var(--bg-color);">
    <div class="col-sm-8">

        <div class="row mt-5">    
        <div class="col-12">
        <h2 class="text-center">
         Mis tickets <strong style="color:green"></strong>
        </h2>
        </div>

          <table class="table table-striped table-hovertext-nowrap">
            <thead>
              <tr>
                <th>Muelle</th>
                <th>TipoCamion</th>
                <th>Horario</th>
                <th>Matricula</th>
                <th>Creado</th>
              </tr>
            </thead>
            <tbody>
              <?php       
              foreach ($reservas as $reserva){ if($reserva["idUsuario"] == $usuario->id){ ?>
              <tr>              
                <td><?php echo $reserva['idMuelle']; ?></td>
                <td><?php echo $tiposCamion[$tiposCamionMuelles[$reserva['idMuelle']]]; ?></td>
                <td><?php echo $tiposPeriodos[$reserva['idPeriodo']]?></td>
                <td><?php echo $reserva['matricula'] ?></td>
                <td><?php echo $reserva['created']; ?></td>
              </tr>
            <?php }} ?>
            </tbody>
          </table>
      </div>
    </div>
    </div>
    <div class="container-fluid mt-4 table-responsive" style="background: var(--color); color: var(--bg-color);">
    <div class="row mt-5">    
      <div class="col-12">
    <h2 class="text-center">
         Reserva de Muelles: <?php if($muellesDisponibles > 0){echo '<strong style="color:green">';}else{echo '<strong style="color:red">';} echo $muellesDisponibles."/".count($muelles); ?></strong> Muelles Disponibles.
        </h2>
        </div>
    </div>
        <div class="row mt-5">
        <?php       
              foreach ($muelles as $muelle) { ?>
               <div class="col-md-2 mb-2">
                <div class="card d-flex justify-content-center">
                  <div class="card-body">
                    <h5 class="card-title">Muelle <?php echo $muelle['id']; ?></h5>
                    <p class="card-text"><span style="color:blue"><?php echo $tiposCamion[$muelle['idTipoCamion']]; ?></span></p>
                    <p class="card-text"><?php 
                    if($disponibilidadMuelles[$muelle['id']] <= 0){?>
                      <span style='color:red'><?php echo $disponibilidadMuelles[$muelle['id']]."/".$nPeriodos;?></span>
                      </p>
                      <button class="d-flex justify-content-center btn btn-danger w-100" disabled>NO DISPONIBLE</button>
                    <?php }else{?>
                      <span style='color:green'><?php echo $disponibilidadMuelles[$muelle['id']]."/".$nPeriodos;?></span>
                      </p>
                      <button class="d-flex justify-content-center btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#muelle<?php echo $muelle["id"]?>">RESERVAR</button>
                      <?php } ?>
                  </div>
                </div>
              </div>
              <?php 
               if($disponibilidadMuelles[$muelle['id']] > 0){?>
              <div class="modal fade" id="muelle<?php echo $muelle["id"]?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div id="modalContent" class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reservar Muelle <?php echo $muelle["id"];?></h5>
                <h6 style="position:relative; top:5px; left:5px; color:blue; ml-2">Tipo Vehiculo: <?php echo $tiposCamion[$muelle['idTipoCamion']]; ?></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <form class="needs-validation" action="assets/mod/reserva/reservar.php" method="GET" target="_blank">
                <div class="modal-body">
                <input type="text" class="form-control" name="matricula" maxlength = "12" placeholder="Matricula <?php echo $tiposCamion[$muelle['idTipoCamion']]; ?>" required/>
                <select class="form-select mt-2" name="periodo" aria-label="Select Periodo" required>
                  <option selected>Seleccione un horario:</option>
                  <?php foreach ($periodos as $periodo){
                      $element = "";
                      foreach ($reservas as $reserva){
                        if ($reserva["idMuelle"] == $muelle['id'] && $reserva["idPeriodo"] == $periodo["id"]){
                          if($reserva["idUsuario"] == null){
                            $element = "<option value=".$periodo["id"].">[".$reserva["actividad"]."]: ".$periodo["horario"]."</option>"; 
                        }}  
                      }
                      echo $element;
                  }
              ?>
                </select>
                <input type="hidden" name="muelle" value="<?php echo $muelle['id'];?>">
                <input type="hidden" name="token" value="<?php echo $_SESSION["token"];?>">
                <input type="hidden" name="uuid" value="<?php echo $configs["securityUUIDToken"];?>"> 
                </div>
                <div class="modal-footer">
                <button class="btn btn-success" type="submit">Reservar</button>
                </form>
                </div></div>
                </div>
              </div>
            <?php }} ?>
              </div>
      </div>
    </div>
    <?php }?>
    <?php if ($permits->backoffice_dashboard == 1){ ?>
      <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div id="modalContent" class="modal-content">
                  </div>
                </div>
              </div>  
    </div>
    <?php }?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="assets/bt/js/bootstrap.js"></script>
    <script>
      $(function(){
        var modalContent = document.getElementById("modalContent");
        var configMuelles = document.getElementById("configMuelles");
        var configPedidos = document.getElementById("configPedidos");
        var barreras = document.getElementById("barreras");
        

        configMuelles.addEventListener('click', function() {

            modalContent.innerHTML  = `<?php echo $modals["configMuelles"]; ?>`;

        });
        configPedidos.addEventListener('click', function() {

          modalContent.innerHTML  = `<?php echo $modals["configPedidos"]; ?>`;

        });
        barreras.addEventListener('click', function() {
          modalContent.innerHTML  = `<?php echo $modals["barreras"]; ?>`;
          localStorage.setItem("barreraSelected", "ENTRADA");
          var barreraEntrada = document.getElementById("barreraEntrada");
          var barreraSalida = document.getElementById("barreraSalida");
          barreraEntrada.addEventListener('change', function() {
            if (this.checked) {
              localStorage.setItem("barreraSelected", "ENTRADA");
            }
          });
          barreraSalida.addEventListener('change', function() {
            if (this.checked) {
              localStorage.setItem("barreraSelected", "SALIDA");
            }
          });
          let abrir = document.getElementById("abrirBarrera");
          let cerrar = document.getElementById("cerrarBarrera");
          let monitor = document.getElementById("monitor");
          localStorage.setItem("barrera", "CERRADA");
          var selected = localStorage.getItem("barreraSelected");
          monitor.innerHTML  =`<span style="color:red">Barrera de la `+selected+` CERRADA</span>`
          cerrar.addEventListener('click', function() {
            if(localStorage.getItem("barrera") == "CERRADA"){
              selected = localStorage.getItem("barreraSelected");
              monitor.innerHTML = `<span style="color:green">La barrera de la `+selected+` ya esta cerrada!</span>`;
              const myTimeout = setTimeout(function(){
                selected = localStorage.getItem("barreraSelected");
                monitor.innerHTML  =`<span style="color:red">Barrera de la `+selected+` CERRADA</span>`
              }, 2000);
            }else{
              monitor.innerHTML = `<span style="color:green">Cerrando barrera...</span>`;
              const myTimeout = setTimeout(function(){
                selected = localStorage.getItem("barreraSelected");
                localStorage.setItem("barrera", "CERRADA");
                monitor.innerHTML  =`<span style="color:red">Barrera de la `+selected+` CERRADA</span>`
              }, 2000);
            }
          });
          abrir.addEventListener('click', function() {
            if(localStorage.getItem("barrera") == "CERRADA"){
              localStorage.setItem("barrera", "ABIERTA");
              selected = localStorage.getItem("barreraSelected");
              monitor.innerHTML =`
              <span style="color:green">Barrera de la `+selected+` ABIERTA</span> Cerrando en 10s:
              <progress value="0" max="10" id="progressBar"></progress>`;
              
              const myTimeout = setTimeout(function(){
                let monitor = document.getElementById("monitor");
                if(localStorage.getItem("barrera") == "ABIERTA"){
                  selected = localStorage.getItem("barreraSelected");
                  localStorage.setItem("barrera", "CERRADA");
                  monitor.innerHTML  =`<span style="color:red">Barrera de la `+selected+` CERRADA</span>`
                }
              }, 5000);

              var timeleft = 10;
              var downloadTimer = setInterval(function(){
                if(timeleft <= 0){
                  clearInterval(downloadTimer);
                }
                document.getElementById("progressBar").value = 10 - timeleft;
                timeleft -= 1;
              }, 435);

            }else{
              monitor.appendChild = `<span style="color:green">La barrera ya esta abierta</span>`;
            }
          });
        });
        
       });

    </script>
  </body>