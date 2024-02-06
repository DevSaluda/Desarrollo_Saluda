<?php
include "Consultas/Consultas.php";

include "Consultas/AnalisisIndex.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Traspasos | <?echo $row['ID_H_O_D']?> </title>

<?include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}

    </style> 
 

</head>
<?include_once ("Menu.php")?>
<div id="ContadorDeSolicitudesTraspasos"></div>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="solicitar" role="tabpanel" aria-labelledby="pills-home-tab">
  <div class="card text-center">
  <div class="card-header" style="background-color:#2bbbad !important;color: white;">
    Productos de <?echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  <div id="TableStockSucursales"></div>
</div>
  </div>
  <div class="tab-pane fade" id="solicitudesenviadas" role="tabpanel" aria-labelledby="pills-profile-tab">
  <div class="card text-center">
  <div class="card-header" style="background-color:#2bbbad !important;color: white;">
    Solicitudes enviadas  al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
 
 
</div>
<div id="TableSolicitudes"></div>
  </div>
  <div class="tab-pane fade" id="autorizados" role="tabpanel" aria-labelledby="pills-contact-tab">
  <div class="card text-center">
  <div class="card-header" style="background-color:#2bbbad !important;color: white;">
    Solicitudes autorizadas  al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  <div id="TableSolicitudesAutorizadas"></div>
 
</div>
  </div>

  <div class="tab-pane fade" id="rechazados" role="tabpanel" aria-labelledby="pills-contact-tab">
  <div class="card text-center">
  <div class="card-header" style="background-color:#2bbbad !important;color: white;">
    Solicitudes rechazadas  al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
 
</div>
<div id="TableSolicitudesRechazadas"></div>
  </div>
</div>


    


</div></div></div>








     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("footer.php")?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="js/ControlTraspasos.js"></script>
<script src="js/SolicitudesTraspasos.js"></script>
<script src="js/SolicitudesAutorizadas.js"></script>
<script src="js/SolicitudesRechazadas.js"></script>
<script src="js/AgregaEnStock.js"></script>
<script src="js/ControlContadorSolicitudes.js"></script>


<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>


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
<?php

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