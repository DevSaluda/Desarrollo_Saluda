<?php
include "Consultas/Consultas.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>SERVICIOS ESPECIALIZADOS |<?php echo $row['ID_H_O_D']?> </title>

<?php include "Header.php";?>
</head>
<?php include_once ("Menu.php")?>
<!-- <div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">¡ATENCIÓN! </h4>
  <p>El espacio en el disco del servidor está llegando al límite, se recomienda contactar a soporte para realizar tareas de mantenimiento.</p>

</div> -->
<div class="card text-center">
  <div class="card-header" style="background-color: #c80096 !important;color: white;">
Resultados de Ultrasonidos  <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  <div >
  
</div>

</div>
<div class="card text-center">
  <div class="card-header" style="background-color:#0195AF !important;color: white;">
 
  </div>
  <div class="collapse" id="collapseExample">
  <div class="card-body">
  <div class="table-responsive">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Descarga pdf</th>
      <th scope="col">Descarga pdf movil</th>
      <th scope="col">Abrir whatsapp</th>
      <th scope="col">Editar informacion</th>
    </tr>
      <td><button class="btn btn-warning"><span class="far fa-file-pdf"></span></button></td>
      <td>  <button class="btn btn-secondary"><span class="far fa-file-pdf"></span></button></td>
      <td>  <button class="btn btn-success"><span class="fab fa-whatsapp"></span></button></td>
     <td>  <button class="btn btn-info"><i class="far fa-edit"></i></button></td>
    </tr>
  </thead>
  <tbody>
</table>
  </div>
  </div>
</div>
</div>
  <!-- Content Wrapper. Contains page content -->
  

  <div class="container">
<div class="row">
<div class="col-md-12">
    
<div id="TablaResultadosUltrasonidos"></div>


</div>
</div>
</div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
 <?php include "footer.php" ?>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="js/ControlUltras.js"></script>
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
