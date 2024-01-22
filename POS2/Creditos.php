<?php
include "Consultas/Consultas.php";
include "Consultas/ConsultaCaja.php";
$fcha = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Apertura de credito|  </title>

<?php include "Header.php"?>
</head>
<?php include_once ("Menu.php")?>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Créditos dentales</a>
  </li>
 
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-TipPro" role="tab" aria-controls="pills-profile" aria-selected="false">Finalizados</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#Porvencercred" role="tab" aria-controls="pills-profile" aria-selected="false">Por vencer</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#Vencidos" role="tab" aria-controls="pills-profile" aria-selected="false">Vencidos</a>
  </li>
</ul>

<div class="tab-content" id="pills-tabContent">
<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color: #2bbbad !important;color: white;">
    Creditos en clinicas  al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div >
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AperturaCredit" class="btn btn-default">
  Apertura de credito <i class="fas fa-address-card"></i>
</button>
</div>
</div>
    
  


    

<div id="tablaCreditos"></div>
</div>

<!-- Tipos_productos -->
<div class="tab-pane fade show " id="pills-TipPro" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color: #2bbbad !important;color: white;">
  Créditos finalizados de  al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div >
  
</div>
</div>
    
<div id="tablaCreditosFinalizados"></div>

</div>

<div class="tab-pane fade show " id="Porvencercred" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color: #2bbbad !important;color: white;">
  Créditos por vencer de  al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div >
  
</div>
</div>
    
<div id="tablaCreditosPorVencer"></div>

</div>

<div class="tab-pane fade show " id="Vencidos" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color: #2bbbad !important;color: white;">
  Créditos vencidos de  al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div >
  
</div>
</div>
    
<div id="tablaCreditosVencidos"></div>

</div>
</div>

  


 
        <!-- /.row -->
       
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  

  <!-- Main Footer -->
  <?php include ("Modales/AperturaCredito.php");
  include ("Modales/AperturaCreditoClinicas.php");
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/AdvierteDeCaja.php");
  include ("Modales/ExitoActualiza.php");
  include ("footer.php");?>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="js/Creditos.js"></script>
<script src="js/CreditosClinicas.js"></script>
<script src="js/CreditosFinalizados.js"></script>
<script src="js/CreditosPorVencer.js"></script>
<script src="js/CreditosVencidos.js"></script>
<script src="js/AperturaCredito.js"></script>
<script src="js/AperturaCreditosClinicas.js"></script>
<script src="js/ObtieneCostoTratamiento.js"></script>
<script src="js/ObtieneDescuento.js"></script>
<script src="js/ObtieneValorTrata.js"></script>
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
?> <?php
if($ValorCaja["Estatus"] == 'Abierta'){

    
     }else{
    
      echo '
      <script>
$(document).ready(function()
{
  // id de nuestro modal
  $("#NoCaja").modal("show");
});
</script>
      ';
      
      
    
     } ?>