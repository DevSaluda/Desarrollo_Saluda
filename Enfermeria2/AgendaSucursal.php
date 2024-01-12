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
  <style>
    label.error {
    display:block;
}
  </style>

  <? include "Header.php"?>
</head>
<?include_once ("Menu.php")?>
<div class="card text-center">
  <div class="card-header">
  CITAS DE CAMPAÑAS MEDICAS POR SUCURSAL
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
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?  
 
  include ("footer.php");
 ?>
<!-- ./wrapper -->
<script src="js/CampanasSucursal.js"></script>



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
