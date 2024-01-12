<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/AnalisisIndex.php";
$fcha = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Mobiliario de <?echo $row['ID_H_O_D']?> </title>

<?include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}

    </style>

     <script>
     
     </script>


</head>
<?include_once ("Menu.php")?>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link " id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Asignados</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active " id="pills-home-tab" data-toggle="pill" href="#MobiVigente" role="tab" aria-controls="pills-home" aria-selected="true">Mobiliario vigente</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Bajas</a>
  </li>
  <li class="nav-item">
  <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">En mantenimiento</a>
  </li>
  <li class="nav-item">
  <a class="nav-link" id="pills-Mobili" data-toggle="pill" href="#TipoMobiliario" role="tab" aria-controls="pills-contact" aria-selected="false">Tipo de mobiliario</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">


<div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
  Mobiliario Asignado <?echo $row['ID_H_O_D']?> 
  </div>
<div id="TablaMobiliariosAsignados"></div>
</div>

</div>

<!-- MOBILIARIO VIGENTE -->
<div class="tab-pane fade  show active" id="MobiVigente" role="tabpanel" aria-labelledby="pills-profile-tab"><div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
Mobiliario vigente  de <?echo $row['ID_H_O_D']?> 
  </div>
  
  <div >
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AltaMobiliarioNuevo" class="btn btn-default">
  Agregar nuevo mobiliario <!-- MOBILIARIO VIGENTE -->
</button>
</div>
</div>
<div id="tablaMobiliariosNuevos"></div></div>
<!-- MOBILIARIO VIGENTE -->
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"><div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
Cajas abiertas de <?echo $row['ID_H_O_D']?> 
  </div>
  
  <div >
  
</div>
</div>
<div id="MantenimientoBaja"></div></div>
<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-profile-tab"><div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
Cajas abiertas de <?echo $row['ID_H_O_D']?> 
  </div>
  
  <div >
  
</div>
</div>
<div id="MobMantenimiento"></div></div>

<div class="tab-pane fade" id="TipoMobiliario" role="tabpanel" aria-labelledby="pills-profile-tab"><div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
Tipos de mobiliario <?echo $row['ID_H_O_D']?> 
  </div>

  <div >
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AltaTiposMobiliario" class="btn btn-default">
  Agregar nuevo tipo de mobiliario <i class="fas fa-archive"></i>
</button>
</div>
</div>
<div id="tablaTiposmobiliarios"></div></div>
</div>

</div></div>


      

     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?
    
  include ("Modales/AltaMobiliario.php");
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("Modales/AltaNuevoTipoMobi.php");
  
  include ("footer.php")?>

<!-- ./wrapper -->

<script src="js/MobiliarioVigentes.js"></script>
<script src="js/MobiliarioAsignado.js"></script>
<script src="js/MobiliariosPoragregar.js"></script>
<script src="js/ControlTiposMobiliarios.js"></script>
<script src="js/AltaTiposMobiliarios.js"></script>
<script src="js/AltadelosMobiliarios.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->

</body>
</html>
<?

function fechaCastellano ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
?>