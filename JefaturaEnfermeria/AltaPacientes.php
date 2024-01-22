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

  <title>Alta de pacientes <?echo $row['ID_H_O_D']?></title>

  <? include "Header.php"?>
</head>
<?include_once ("Menu.php")?>
<div class="card text-center">
  <div class="card-header">
  </div>
  <div class="card-body">
  <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#AltaDePacientes">
  Alta de paciente <i class="fas fa-hospital-user"></i>
  </button>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#DatPac"
    aria-expanded="false" aria-controls="collapseExample">
    Ver pacientes registrados
  </button>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#AltPac"
    aria-expanded="false" aria-controls="collapseExample">
    Ver registro de signos vitales
  </button>
  </div>
</div>


<div class="collapse" id="DatPac">
<div class="card text-center">
  <div class="card-header">
    Pacientes ingresados recientemente al sistema
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
<div class="collapse" id="AltPac">
<div class="card text-center">
  <div class="card-header">
 Registro de pacientes
  </div>
  </div>
  <div class="container">
<div class="row">
<div class="col-md-12">
    
<div id="DataSignos"></div>


</div>
</div>
</div>
</div>

  <!-- Main Footer -->
  <?
include ("Modales/NuevoPaciente.php");
include ("Modales/Exito.php");
  include ("footer.php");?>
<!-- ./wrapper -->
<script src="js/ControlAltaPacientes.js"></script>
<script src="js/ControlSignosVitalesnew.js"></script>
<script src="js/AltaPacientes.js"></script>



<!-- Bootstrap -->

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
