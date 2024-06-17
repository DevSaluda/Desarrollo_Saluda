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

  <title>Administración de caja | <?echo $row['ID_H_O_D']?> </title>

<?include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}

    </style>
</head>
<?include_once ("Menu.php")?>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Totales sin corte de caja del <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Totales con corte de caja del <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#totalgeneralsin" role="tab" aria-controls="pills-profile" aria-selected="false">Total general sin corte de caja </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#totalgeneralcon" role="tab" aria-controls="pills-profile" aria-selected="false">Total general con corte de caja</a>
  </li>
 
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"><div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
  Ganancia total sin corte del <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?></div>
  
  <div >
 

</div>

</div>
<div id="TotalesDiariosSin"></div>
</div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"><div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
  Ganancia total con corte del 
  </div>
  
  <div >
  
</div>
</div>
<div id="TotalesDiariosCon"></div></div>
<div class="tab-pane fade" id="totalgeneralsin" role="tabpanel" aria-labelledby="pills-profile-tab"><div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
  Ganancia total sin corte 
  </div>
  
  <div >
  
</div>
</div>
<div id="TotalesGeneralSin"></div></div>
<div class="tab-pane fade" id="totalgeneralcon" role="tabpanel" aria-labelledby="pills-profile-tab"><div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
  Ganancia total con corte 
  </div>
  
  <div >
  
</div>
</div>
<div id="TotalesGeneralesCon"></div></div>
 
</div>


</div></div></div>


      

     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?

  include ("footer.php");?>

<!-- ./wrapper -->

<script src="js/TotalesDiarios.js"></script>
<script src="js/TotalesDiariosConcortes.js"></script>
<script src="js/TotalesGenerales.js"></script>
<script src="js/TotalesGeneralesConCortes.js"></script>

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
<?

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