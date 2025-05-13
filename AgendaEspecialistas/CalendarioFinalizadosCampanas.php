<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
$consulta_eventos = "Select Fechas_EspecialistasV2.ID_Fecha_Esp,Fechas_EspecialistasV2.Fecha_Disponibilidad,Fechas_EspecialistasV2.FK_Especialista,Fechas_EspecialistasV2.Estatus_fecha, EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos, EspecialistasV2.Especialidad, EspecialidadesV2.ID_Especialidad,EspecialidadesV2.Nombre_Especialidad, EspecialistasV2.Fk_Sucursal,
Sucursales_CampañasV2.ID_SucursalC,Sucursales_CampañasV2.Nombre_Sucursal FROM EspecialistasV2,EspecialidadesV2,Fechas_EspecialistasV2,Sucursales_CampañasV2 WHERE Fechas_EspecialistasV2.Estatus_fecha='Vencido' AND
Fechas_EspecialistasV2.FK_Especialista = EspecialistasV2.ID_Especialista AND EspecialistasV2.Fk_Sucursal = Sucursales_CampañasV2.ID_SucursalC AND EspecialidadesV2.ID_Especialidad = EspecialistasV2.Especialidad ";
$resultado_eventos = mysqli_query($conn, $consulta_eventos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>CALENDARIO DE CITAS | AGENDA DE CITAS </title>

<?include ("Header.php")?>

		<style>
			.fc-content {
	color:white;
}
.fc-time{
      display : none;
}
.fc-day-grid-event .fc-content {
    white-space: nowrap;
    overflow: hidden;
    background-color: #80391e !important;
}
		</style>
  
	<link href='js/fullcalendar/fullcalendar.css' rel='stylesheet' />
	
	<script>
			$(document).ready(function() {
				
				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
					defaultDate: moment(new Date()).format('YYYY-MM-DD ,h:mm A'),
					navLinks: true, // can click day/week names to navigate views
					editable: true,
					eventLimit: true, // allow "more" link when too many events
					eventClick: function(event) {
						
				
						$('#visualizar #title').text(event.title);
						$('#visualizar #start').text(event.start.format('MMMM D, YYYY'));
						$('#visualizar #description').text(event.description);
						$('#visualizar #status').text(event.status);
					
						$('#visualizar').modal('show');
						return false;

					},
					
				
					events: [
						<?php
							while($registros_eventos = mysqli_fetch_array($resultado_eventos)){
								?>
								{
								id: '<?php echo $registros_eventos['ID_Fecha_Esp']; ?>',
								title: '<?php echo utf8_encode(utf8_decode($registros_eventos['Nombre_Especialidad'])); ?>',
								description:' <?php echo $registros_eventos['Nombre_Apellidos']; ?> ',
								start: '<?php echo $registros_eventos['Fecha_Disponibilidad']; ?> ',
								end: '<?php echo $registros_eventos['Fecha_Disponibilidad']; ?> ',
								status:'<?php echo $registros_eventos['Nombre_Sucursal']; ?>',
								color: '<?php echo $registros_eventos['Color_Calendario']; ?>',
								},<?php
							}
						?>
					],
					
					eventRender: function(event, element) { 
			element.find('.fc-title').append("<br/>" + event.description); 
					 } // uppercase H for 24-hour clock
				});
			});
			
		
		</script>
</head>
<?include_once ("Menu.php")?>
<div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
               
               
                <div id="calendar" class="col-centered">
                </div>
            </div>
			<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
			<div class="modal-dialog modal-notify modal-success">
			<div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo">Información sobre especialidades</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
	        <div class="modal-body">
          <div class="text-center">
						<dl class="dl-horizontal">
							
							<dt>Especialidad</dt>
							<dd id="title"></dd>
							<dt>Especialista</dt>
							<dd id="description"></dd>
							<dt>Fecha disponible</dt>
							<dd id="start"></dd>
							<dt>Sucursal</dt>
							<dd id="status"></dd>
							
						</dl>
					</div>
				</div>
			</div>
		</div>
		

		</div>
		</div>
		</div>	</div>
		</div>
		</div>

 
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?
   include ("Modales/Precarga.php");
  include ("footer.php");?>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar/fullcalendar.min.js'></script>
	<script src='js/fullcalendar/fullcalendar.js'></script>
	<script src='js/fullcalendar/locale/es.js'></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script src="js/CargaData.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

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