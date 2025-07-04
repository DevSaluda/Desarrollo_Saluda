
<?php
 include "Consultas/Consultas.php";
include "Consultas/ConsultaEstadoConexion.php";
include "Consultas/Mensaje.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AGENDA DE CITAS |  </title>

  <!-- Font Awesome Icons -->
  <?php include "Header.php"?>

  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet" />
  <!-- FullCalendar JS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<div id="loading-overlay">
  <div class="loader"></div>
  <div id="loading-text" style="color: white; margin-top: 10px; font-size: 18px;"></div>
</div>
<?php include_once ("Menu.php")?>



<div class="card text-center">
  <div class="card-header" style="background-color: #2E64FE !important;color: white;">
  Citas de especialistas del <?php echo FechaCastellano(date('d-m-Y H:i:s'));  ?>  al <?php echo FechaCastellano(date('d-m-Y H:i:s', strtotime("+4 day")));  ?> 
  </div>
  </div>
 
  <div >
  
</div>
<div class="input-group mb-3" style="max-width:400px;">
  <input type="text" id="busquedaNombreCita" class="form-control" placeholder="Buscar por nombre de paciente...">
  <button class="btn btn-primary" type="button" id="btnBuscarCita">
    <i class="fas fa-search"></i>
  </button>
</div>
<!-- Filtro por estado de cita -->
<div class="mb-3" id="filtro-estados-cita" style="max-width:600px;">
  <label class="form-label"><b>Filtrar por estado de cita:</b></label>
  <div class="form-check form-check-inline">
    <input class="form-check-input estado-cita-checkbox" type="checkbox" value="Agendado" id="estadoAgendado" checked>
    <label class="form-check-label" for="estadoAgendado">Agendado</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input estado-cita-checkbox" type="checkbox" value="Pendiente" id="estadoPendiente" checked>
    <label class="form-check-label" for="estadoPendiente">Pendiente</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input estado-cita-checkbox" type="checkbox" value="Cancelado" id="estadoCancelado" checked>
    <label class="form-check-label" for="estadoCancelado">Cancelado</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input estado-cita-checkbox" type="checkbox" value="Confirmada" id="estadoConfirmada" checked>
    <label class="form-check-label" for="estadoConfirmada">Confirmada</label>
  </div>
</div>
<div id="calendar"></div>
<script>
// Recargar el calendario cuando cambie el filtro de estado
function obtenerEstadosSeleccionados() {
  let estados = [];
  document.querySelectorAll('.estado-cita-checkbox:checked').forEach(function(cb) {
    estados.push(cb.value);
  });
  return estados;
}

document.querySelectorAll('.estado-cita-checkbox').forEach(function(cb) {
  cb.addEventListener('change', function() {
    if(window.calendarGlobal) {
      window.calendarGlobal.refetchEvents();
    }
  });
});
</script>
<!-- Modal para detalles de cita -->
<div class="modal fade" id="modalDetalleCita" tabindex="-1" aria-labelledby="modalDetalleCitaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetalleCitaLabel">Detalles de la cita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body" id="modalDetalleCitaBody">
        <!-- Aquí se llenará la info -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>






     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
 
  <!-- Main Footer -->
  <?php include ("Modales/Ingreso.php");
   include ("Modales/Error.php");
   include ("Modales/Eliminar.php");

 include ("footer.php");?>
<!-- ./wrapper -->

<script src="js/ControlCampanasCalendario.js"></script>
<script src="js/Logs.js"></script>
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

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
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
<?php
if($EstadoIngreso["Estado_Conexion"] == 1){

    
}else{

 echo '
 <script>
$(document).ready(function()
{
// id de nuestro modal

$("#Ingreso").modal("show");
});
</script>
 ';
 
 

}
?>