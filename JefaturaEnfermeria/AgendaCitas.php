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

  <title>AGENDAR CITA CON ESPECIALISTAS</title>

  <? include "Header.php"?>
</head>
<?include_once ("Menu.php")?>
<div class="card text-center">
  <div class="card-header">
  AGENDAR CITA CON ESPECIALISTAS
  </div>
  
  <div class="card-footer">

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AltaAgenda">Agendar nueva cita <i class="fas fa-plus-square"></i>   </button>
  </div>
  </div>
    
  

  <div class="container">
<div class="row">
<div class="col-md-12">
    
<div id="TablaCampanas"></div>


</div>
</div>
</div>
</div>
</div>
</div>


  <!-- Main Footer -->
  <?  
  include ("Modales/AltaAgenda.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("footer.php");
 ?>
<!-- ./wrapper -->
<script src="js/ControlCampanas.js"></script>
<script src="js/AgendaCitaEspecial.js"></script>
<script src="js/ObtieneEspecialidad.js"></script>
<script src="js/ObtieneMedico.js"></script>
<script src="https://controlfarmacia.com/Controldecitas/js/ObtieneFecha.js"></script>
<script src="https://controlfarmacia.com/Controldecitas/js/ObtieneHora.js"></script>
<script src="https://controlfarmacia.com/Controldecitas/js/ObtieneCosto.js"></script>


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
