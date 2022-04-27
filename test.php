<!doctype html>
<html lang="es">
  <head>    
    <title>Generador de Informes</title>   
    <!-- Custom styles for this template -->    
  </head>
  <body class="body">
  	<form class="" action="InformePedidos.php" method="post" target="_blank">
  	
  		<button type="submit" name="button"> Generar Informe Pedidos </button>

  	</form>
  	<form class="" action="InformeMuelles.php" method="post" target="_blank">
  	
  		<button type="submit" name="button"> Generar Informe Muelles</button>

  	</form>

  	<div class="row">
    <div class="col-md-7">
      <form action="RecibirPedidos.php" method="POST" enctype="multipart/form-data"/>
        <div class="file-input text-center">
            <input  type="file" name="dataPedidos" id="file-input" class="file-input__input"/>
            <label class="file-input__label" for="file-input">
              <i class="zmdi zmdi-upload zmdi-hc-2x"></i>
              <span>Pedidos</span></label>
          </div>
      <div class="text-center mt-5">
          <input type="submit" name="subir" class="btn-enviar" value="Subir Excel/CSV"/>
      </div>
      </form>
    </div>

    <div class="row">
    <div class="col-md-7">
      <form action="RecibirMuelles.php" method="POST" enctype="multipart/form-data"/>
        <div class="file-input text-center">
            <input  type="file" name="dataMuelles" id="file-input" class="file-input__input"/>
            <label class="file-input__label" for="file-input">
              <i class="zmdi zmdi-upload zmdi-hc-2x"></i>
              <span>Muelles</span></label>
          </div>
      <div class="text-center mt-5">
          <input type="submit" name="subir" class="btn-enviar" value="Subir Excel/CSV"/>
      </div>
      </form>
    </div>
  </div>

  <div class="col-md-5">
	  <?php
	  header("Content-Type: text/html;charset=utf-8");
	  include('conexion.php');
	  $sqlPedidos = ("SELECT * FROM pedidos");
	  $queryData   = mysqli_query($conexion, $sqlPedidos);
	  $total_client = mysqli_num_rows($queryData);
	  ?>

      <h6 class="text-center">
        Lista de pedidos <strong>(<?php echo $total_client; ?>)</strong>
      </h6>

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
            
              <th>Id</th>
              <th>Identificador</th>
              <th>Tipo</th>
            </tr>
          </thead>
          <tbody>
            <?php       
            while ($data = mysqli_fetch_array($queryData)) { ?>
            <tr>              
              <td><?php echo $data['ID']; ?></td>
              <td><?php echo $data['Identificador']; ?></td>
              <td><?php echo $data['Tipo']; ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
    </div>

  <div class="col-md-10">
	  <?php
	 // header("Content-Type: text/html;charset=utf-8");
	  include('conexion.php');
	  $sqlMuelles = ("SELECT * FROM muelles");
	  $queryData   = mysqli_query($conexion, $sqlMuelles);
	  $total_client = mysqli_num_rows($queryData);
	  ?>

      <h6 class="text-center">
        Lista de muelles <strong>(<?php echo $total_client; ?>)</strong>
      </h6>

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
            
              <th>Muelles</th>
              <th>Tipo</th>
              <th>6:00-7:00</th>
              <th>7:00-8:00</th>
              <th>8:00-9:00</th>
              <th>9:00-10:00</th>
              <th>10:00-11:00</th>
              <th>11:00-12:00</th>
              <th>12:00-13:00</th>
              <th>13:00-14:00</th>
            </tr>
          </thead>
          <tbody>
            <?php       
            while ($data = mysqli_fetch_array($queryData)) { ?>
            <tr>              
              <td><?php echo $data['ID']; ?></td>
              <td><?php echo $data['Tipo']; ?></td>
              <td><?php echo $data['Hora1']; ?></td>
              <td><?php echo $data['Hora2']; ?></td>
              <td><?php echo $data['Hora3']; ?></td>
              <td><?php echo $data['Hora4']; ?></td>
              <td><?php echo $data['Hora5']; ?></td>
              <td><?php echo $data['Hora6']; ?></td>
              <td><?php echo $data['Hora7']; ?></td>
              <td><?php echo $data['Hora8']; ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
    </div>
    