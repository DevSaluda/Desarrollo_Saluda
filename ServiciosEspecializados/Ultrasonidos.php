<?php
include "Consultas/Consultas.php";
include "Consultas/db_connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>SERVICIOS ESPECIALIZADOS |<?php echo $row['ID_H_O_D']?> </title>

  <?php include "Header.php"?>
</head>
<?php include_once ("Menu.php")?>
<!-- <div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">¡ATENCIÓN! </h4>
  <p>El espacio en el disco del servidor está llegando al límite, se recomienda contactar a soporte para realizar tareas de mantenimiento.</p>

</div> -->
<div class="card text-center">
  <div class="card-header"  style="background-color:#0195AF !important;color: white;">
    Añadiendo pacientes
  </div>
  
  <div class="card-footer">
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AltaPaciente" class="btn btn-default">
  Añadir paciente <i class="fas fa-id-card-alt"></i>   
</button>
  
  </div>
</div>
  <!-- Content Wrapper. Contains page content -->
  


    
<div id="TablaPacientes"></div>


</div>
</div>
</div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
 <?php
 include "Modales/AltaPacientes.php";
 include "footer.php" ;
 
 ?>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script type="text/javascript" src="js/Gultrasonidos.js"></script>
<script src="js/ControlPacientes.js"></script>
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
