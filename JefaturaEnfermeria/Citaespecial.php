<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/Conexion_selects.php";
include "Consultas/ConeSelectDinamico.php";
include_once "Consultas/BBB.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title> Citas con especialistas Doctor Consulta <?echo $row['Nombre_Sucursal']?></title>

  <? include "Header.php"?>
</head>
<?include_once ("Menu.php")?>
<div class="card text-center">
  <div class="card-header">
    Cita en sucursal <?echo $row['Nombre_Sucursal']?>
  </div>
  <div class="card-footer">
  <button type="button" class="btn btn-primary"  data-toggle="collapse" data-target="#Citasespeciales" aria-expanded="false" aria-controls="collapseExample">
  Citas con especialistas <i class="fas fa-hospital-user"></i>
  </button>
  </div>
  </div>
  
  <div class="collapse" id="Citasespeciales">
  <div class="container">
<div class="row">
<div class="col-md-12">
    
<div id="AgendaSV"></div>


</div>
</div>
</div>
</div>
<div class="card text-center">
  <div class="card-header">
  Registro de pacientes
  </div>
  </div>
<div class="container">
<div class="row">
<div class="col-md-12">
    
<div id="PacAgen"></div>


</div>
</div>
</div>



  <!-- Main Footer -->
  <?
include ("Modales/AltaCitaSucursal.php");
include ("Modales/Exito.php");
  include ("footer.php");?>
<!-- ./wrapper -->
<script src="js/AltaSAgenda.js"></script>
<script src="js/ControlPacientesAgenda.js"></script>
<script src="js/GuardaCita.js"></script>
<script src="js/Capturadata.js"></script>
<script src="js/CalculaIMC.js"></script>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->

<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>


</body>
</html>
