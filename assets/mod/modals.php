<?php
return array(

"configMuelles" =>

'<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Configurar Muelles</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
<div class="modal-body">
<form action="assets/mod/muelles/RecibirMuelles.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
<div class="file-input text-center"><input class="form-control" type="file" name="dataMuelles" id="file-input" class="file-input__input"/><label class="file-input__label" for="file-input"><i class="zmdi zmdi-upload zmdi-hc-2x"></i><span>Muelles</span></label></div><div class="text-center mt-5">
<input type="submit" name="subir" class="btn btn-primary" value="Subir Excel/CSV"/>
</div>
</form>
</div>
<div class="modal-footer">
<form class="" action="assets/mod/informes/InformeMuelles.php" method="post" target="_blank">
  	
<button class="btn btn-success" type="submit" name="button"> Generar Informe Muelles </button>

</form></div>',

"configPedidos" =>

'<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Configurar Pedidos</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
<div class="modal-body">
<form action="assets/mod/Pedidos/RecibirPedidos.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
<div class="file-input text-center">
<input class="form-control" type="file" name="dataPedidos" id="file-input" class="file-input__input"/>
<label class="file-input__label" for="file-input"><i class="zmdi zmdi-upload zmdi-hc-2x">
</i><span>Pedidos</span></label>
</div><div class="text-center mt-5">
<input type="submit" name="subir" class="btn btn-primary" value="Subir Excel/CSV"/>
</div>
</form>
</div>
<div class="modal-footer">
<form class="" action="assets/mod/informes/InformePedidos.php" method="post" target="_blank">
  	
<button class="btn btn-success" type="submit" name="button"> Generar Informe Pedidos </button>

</form></div></div>',

"barreras" =>

'<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Manejar Barrera</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
<div class="modal-body">
    <textfield class="w-100 h-100" id="monitor" disable></textfield>
</div>
<div class="modal-footer">
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="barreraEntrada" checked>
  <label class="form-check-label" for="flexRadioDefault1">
    Entrada
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="barreraSalida">
  <label class="form-check-label" for="flexRadioDefault2">
    Salida
  </label>
</div>
<button class="btn btn-danger" id="cerrarBarrera" type="submit" name="button">Cerrar Barrera</button>
<button class="btn btn-success"id="abrirBarrera" type="submit" name="button">Abrir Barrera</button>
</div></div>'
);