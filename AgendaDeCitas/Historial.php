<?php
include "Consultas/Consultas.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AGENDA DE CITAS |<?php echo $row['ID_H_O_D']?> </title>

  <!-- Font Awesome Icons -->
 
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<!-- JS, Popper.js, and jQuery -->

<script src="https://code.jquery.com/jquery-3.5.0.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://kit.fontawesome.com/b5ed0deb1b.js" crossorigin="anonymous"></script>
</head>
<?php include_once ("Menu.php")?>
<!-- <div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">¡ATENCIÓN! </h4>
  <p>El espacio en el disco del servidor está llegando al límite, se recomienda contactar a soporte para realizar tareas de mantenimiento.</p>

</div> -->
<div class="card text-center">
  <div class="card-header" style="background-color:#0195AF !important;color: white;">
  <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Desplegar ayuda <i class="far fa-comment-alt"></i></button>
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
    
<div id="Tablahistorial"></div>


</div>
</div>
</div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
 <?php include "footer.php";
 
include ("Modales/Eliminarresultado.php"); ?>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="js/ControlHistorial.js"></script>
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
