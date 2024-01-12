<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/Conexion_selects.php";
include "Consultas/ConeSelectDinamico.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title> Cita en sucursal <?echo $row['Nombre_Sucursal']?></title>

  <? include "Header.php"?>
</head>
<?include_once ("Menu.php")?>
<div class="card text-center">
  <div class="card-header">
    Cita en sucursal <?echo $row['Nombre_Sucursal']?>
  </div>
  </div>
  <div class="card-footer">
  <button type="button" class="btn btn-primary"  data-toggle="collapse" data-target="#Clientes" aria-expanded="false" aria-controls="collapseExample">
  Buscar paciente <i class="fas fa-hospital-user"></i>
  </button>
  <a type="button" class="btn btn-success" href="AltaPacientes">
  Alta de paciente <i class="fas fa-plus-square"></i>
  </a>
  
  </div>    
  <div class="collapse" id="Clientes">
  <div class="card text-center">
  <div class="card-header">
  Pacientes registrados de <?echo $row['ID_H_O_D']?>
  </div>
  </div>
  <div class="container">
<div class="row">
<div class="col-md-12">
    
<div id="tabla"></div>


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
    
<div id="sv"></div>


</div>
</div>
</div>


  <!-- Main Footer -->
  <?
include ("Modales/AltaCitaSucursal.php");
include ("Modales/Exito.php");
  include ("footer.php");?>
<!-- ./wrapper -->
<script src="js/ControlPacientes.js"></script>
<script src="js/ControlSignosVitales.js"></script>
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
