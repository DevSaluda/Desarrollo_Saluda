
<?php

include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/AnalisisIndex.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>EMPLEADOS | <?echo $row['ID_H_O_D']?> </title>

<?include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}
#resultado {
    background-color: red;
    color: white;
    font-weight: bold;
}
#resultado.ok {
    background-color: green;
}
    </style>
</head>
<?include_once ("Menu.php")?>
<div class="card text-center">
  <div class="card-header">
    Personal actualmente registrado <?echo $row['ID_H_O_D']?>
  </div>
  <span id="Finaliza" class="alert alert-success" style="display: none"></span>
  <div class="card-footer">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AltaData" class="btn btn-default">
  Añadir nuevo personal <i class="fas fa-plus-circle"></i>
</button>  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AltaPersonal" class="btn btn-default">
  Cargar datos por excel <i class="far fa-file-excel"></i>
</button>


</div>
</div>
      
<div class="container">
<div class="row">
<div class="col-md-12">
    
<div id="DatosPersonal"></div>


</div>
</div>
</div> 


  
         
</div>
</div>

     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?
    
  include ("Modales/AltaDataPersonal.php");
  include ("Modales/Vacios.php");
  include ("Modales/Exito.php");
  
  include ("footer.php")?>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="js/ControlPersonal.js"></script>
<script src="js/AltaDataGeneral.js"></script>
<script src="js/ObtieneMunicipio.js"></script>
<script src="js/ObtieneLocalidad.js"></script>
<script src="js/Validacurp.js"></script>
<script src="js/CapturaResidencias.js"></script>
<script src="js/CapturaMunicipio.js"></script>
<script src="js/CapturaLocalidad.js"></script>
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
