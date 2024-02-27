<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/Conexion_selects.php";
include "Consultas/ConeSelectDinamico.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>VERIFICACION DE HORAS </title>


  <? include "Header.php"?>

</head>
<?include_once ("Menu.php")?>
<div class="card text-center">
<div class="card-header" style="background-color: #2E64FE !important;color: white;">
    Horarios vigentes para campañas al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div class="card-footer">
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AltaHorario" class="btn btn-default">
  Añadir nueva horario <i class="fas fa-clock"></i>   
</div></div>



    
  

  <div class="container">
<div class="row">
<div class="col-md-12">
    
<div id="HorariosCampanas"></div>


</div>
</div>
</div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?
    include ("Modales/AltaHorarioCampana.php");
  include ("Modales/VerificaHoras.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("footer.php")?>
<!-- ./wrapper -->
<script src="js/ControlHorariosCampanas.js"></script>
<script src="js/GuardaHoras.js"></script>
<script src="js/ObtieneEspecialidad.js"></script>
<script src="js/ObtieneMedico.js"></script>
<script src="js/ObtieneFecha.js"></script>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->

<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>
<script>
$( document ).ready(function() {
    $('#VerificaHoras').modal('toggle')
});
</script>

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