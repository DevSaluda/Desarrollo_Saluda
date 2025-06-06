
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
<div id="calendar"></div>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'es',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
    },
    events: {
      url: 'Consultas/ArrayCitasIndex.php',
      method: 'GET',
      failure: function() {
        alert('Error al cargar las citas');
      },
      extraParams: {
        // Puedes agregar parámetros extra si necesitas
      }
    },
    eventDataTransform: function(eventData) {
      // Transforma los datos de la API PHP al formato FullCalendar
      return {
        id: eventData.Folio,
        title: eventData.Paciente + ' (' + eventData.Tipo_Consulta + ')',
        start: eventData.Fecha.split(' de ').reverse().join('-') + 'T' + (eventData.Hora ? eventData.Hora : '09:00'),
        extendedProps: {
          telefono: eventData.Telefono,
          especialidad: eventData.Especialidad,
          doctor: eventData.Doctor,
          sucursal: eventData.Sucursal,
          observaciones: eventData.Observaciones,
          agendadoPor: eventData.AgendadoPor,
          agendamientoRealizado: eventData.AgendamientoRealizado
        }
      };
    },
    eventClick: function(info) {
      var e = info.event;
      var details =
        '<b>Paciente:</b> ' + e.title + '<br>' +
        '<b>Teléfono:</b> ' + (e.extendedProps.telefono || '-') + '<br>' +
        '<b>Especialidad:</b> ' + (e.extendedProps.especialidad || '-') + '<br>' +
        '<b>Doctor:</b> ' + (e.extendedProps.doctor || '-') + '<br>' +
        '<b>Sucursal:</b> ' + (e.extendedProps.sucursal || '-') + '<br>' +
        '<b>Observaciones:</b> ' + (e.extendedProps.observaciones || '-') + '<br>' +
        '<b>Agendado por:</b> ' + (e.extendedProps.agendadoPor || '-') + '<br>' +
        '<b>Agendamiento Realizado:</b> ' + (e.extendedProps.agendamientoRealizado || '-');
      // Puedes mostrar detalles en un modal o alert
      alert(details);
    }
  });
  calendar.render();
});
</script>
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