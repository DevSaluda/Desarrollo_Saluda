<?php
include "Consultas/Consultas.php";


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Productos en sucursales de <?echo $row['ID_H_O_D']?> </title>

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
<?php include_once ("Menu.php")?>



<div class="tab-content" id="pills-tabContent">

<div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  <div class="card text-center">
  <div class="card-header" style="background-color:#0057b8 !important;color: white;">
  Stock por sucursales de <?php echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
 
  <div >
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#FiltroPorSucursales" class="btn btn-default">
  Filtrar por sucursal <i class="fas fa-clinic-medical"></i>
</button>
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#FiltroPorServicio" class="btn btn-default">
  Filtrar por servicio <i class="fas fa-id-card-alt"></i>
</button> -->
<!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#IngresoMedicamentos" class="btn btn-default">
  Ingresar medicamentos <i class="fas fa-id-card-alt"></i>
</button> -->
</div>
  <div >
 
</div>

</div><div class="col-md-12">
<div id="TableStockSucursales"></div>
  </div></div>
<!-- POR CADUCAR -->
  <div class="tab-pane fade" id="PorCaducar" role="tabpanel" aria-labelledby="pills-profile-tab">
  <div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
  Productos por caducar de <?php echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div >
 
</div>

</div>
<div id="TableProdCaducaPronto"></div>
  </div>



    
</div></div>





     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?php 
  include ("Modales/FiltroSucursales.php");
  include ("Modales/FiltroServicios.php");
  include ("Modales/Vacios.php");
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("Modales/ActualizaProductosRegistrados.php");
  include("Modales/IniciaCapturaIngresosMedicamentos.php");
  include ("footer.php")?>

<!-- ./wrapper -->


<script src="js/ControlStockSucursalesV2.js"></script>

<script src="js/CambiaDeSucursal.js"></script>


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