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

  <title>Tratamiento crédito| <?echo $row['ID_H_O_D']?> </title>

<?include "Header.php"?>
</head>
<?include_once ("Menu.php")?>

<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color:#0057b8 !important;color: white;">
     Tratamientos  de <?echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div >
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AltaNTipCred" class="btn btn-default">
  Añadir nuevo  Tratamiento <i class="fas fa-credit-card"></i>
</button>
</div>
</div>
    
 

<div id="tablaCreditos"></div>
  

</div>



 
</div>
</div></div></div>
        <!-- /.row -->
       
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  

  <!-- Main Footer -->
  <?include ("Modales/AltaTipCred.php");
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("footer.php");?>
<!-- ./wrapper -->
<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<!-- REQUIRED SCRIPTS -->
<script src="js/TiposCredito.js"></script>

<script src="js/AltaTipoCred.js"></script>

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