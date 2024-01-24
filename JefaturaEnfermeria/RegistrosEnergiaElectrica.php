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

  <title>Registro de uso de energia electrica <?php echo $row['ID_H_O_D']?> </title>

<?php include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
  
}
table td {
  word-wrap: break-word;
  max-width: 400px;
}

    </style>
</head>
<div id="loading-overlay">
  <div class="loader"></div>
  <div id="loading-text" style="color: white; margin-top: 10px; font-size: 18px;"></div>
</div>
<?php include_once ("Menu.php")?>



  <div class="card text-center">
  <div class="card-header" style="background-color:#0057b8 !important;color: white;">
  Registro diario de uso de energia electrica  al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
 
  <div >
  <button type="button"  class="btn btn-success" data-toggle="modal" data-target="#RegistroEnergiaVentanaModal" class="btn btn-default">
 Registrar informacion de energia electrica <i class="fas fa-lightbulb"></i>
</button>
<button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#GeneradorReporteEnergia" class="btn btn-default">
 Generar reporte <i class="fas fa-file-excel"></i>
</button>
<button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#RegistroEnergiaVentanaModal" class="btn btn-default">
Consulta por fechas <i class="fas fa-lightbulb"></i>
</button>
</div>
  <div >
 
</div>

</div><div class="col-md-12">
<div id="RegistrosEnergiatabla"></div>
  </div></div>
<!-- POR CADUCAR -->
  



     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?php
  include ("Modales/RegistroEnergiaModal.php");
  include ("Modales/ReporteExcelEnergia.php");
  include ("Modales/ConsultaPorFechasEnergia.php");
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("footer.php")?>

<!-- ./wrapper -->


<script src="js/ControlEnergiaElectrico.js"></script>
<script src="js/GuardaDatosEnergia.js"></script>
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