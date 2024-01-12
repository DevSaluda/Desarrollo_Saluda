<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
$consulta_eventos = "SELECT AgendaCitas_EspecialistasV2.ID_Agenda_Especialista,AgendaCitas_EspecialistasV2.Fk_Especialidad,
AgendaCitas_EspecialistasV2.Fk_Especialista,AgendaCitas_EspecialistasV2.Fk_Sucursal,
AgendaCitas_EspecialistasV2.Fk_Fecha,AgendaCitas_EspecialistasV2.Fk_Hora,
AgendaCitas_EspecialistasV2.Tipo_Consulta,
AgendaCitas_EspecialistasV2.Estatus_pago,AgendaCitas_EspecialistasV2.Color_Pago,AgendaCitas_EspecialistasV2.Estatus_cita,
AgendaCitas_EspecialistasV2.Observaciones,AgendaCitas_EspecialistasV2.ColorEstatusCita,AgendaCitas_EspecialistasV2.Estatus_Seguimiento,
AgendaCitas_EspecialistasV2.Color_Seguimiento,AgendaCitas_EspecialistasV2.ID_H_O_D,AgendaCitas_EspecialistasV2.Folio_Paciente,AgendaCitas_EspecialistasV2.Color_Calendario,
Data_Pacientes.ID_Data_Paciente,Data_Pacientes.Nombre_Paciente,Data_Pacientes.Telefono,Data_Pacientes.Correo,
EspecialidadesV2.ID_Especialidad,EspecialidadesV2.Nombre_Especialidad,EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos,
Sucursales_CampañasV2.ID_SucursalC ,Sucursales_CampañasV2.Nombre_Sucursal,Fechas_EspecialistasV2.ID_Fecha_Esp,Fechas_EspecialistasV2.Fecha_Disponibilidad,
Horarios_Citas_especialistasV2.ID_Horario,Horarios_Citas_especialistasV2.Horario_Disponibilidad, Costos_EspecialistasV2.ID_Costo_Esp,Costos_EspecialistasV2.Costo_Especialista
FROM AgendaCitas_EspecialistasV2,EspecialidadesV2,EspecialistasV2,Sucursales_CampañasV2,Fechas_EspecialistasV2,Horarios_Citas_especialistasV2,
Costos_EspecialistasV2,Data_Pacientes WHERE
AgendaCitas_EspecialistasV2.Fk_Especialidad = EspecialidadesV2.ID_Especialidad AND AgendaCitas_EspecialistasV2.Fk_Especialista =EspecialistasV2.ID_Especialista AND
AgendaCitas_EspecialistasV2.Folio_Paciente=Data_Pacientes.ID_Data_Paciente AND
AgendaCitas_EspecialistasV2.Fk_Sucursal =Sucursales_CampañasV2.ID_SucursalC AND
AgendaCitas_EspecialistasV2.Fk_Fecha = Fechas_EspecialistasV2.ID_Fecha_Esp AND
AgendaCitas_EspecialistasV2.Fk_Hora = Horarios_Citas_especialistasV2.ID_Horario AND 
AgendaCitas_EspecialistasV2.Fk_Costo =  Costos_EspecialistasV2.ID_Costo_Esp AND
AgendaCitas_EspecialistasV2.ID_H_O_D='".$row['ID_H_O_D']."'";
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
						$('#visualizar #start').text(event.start.format('MMMM D, YYYY h:mm A'));
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
								id: '<?php echo $registros_eventos['ID_Agenda_Especialista']; ?>',
								title: '<?php echo $registros_eventos['Nombre_Especialidad']; ?>',
								description:' <?php echo $registros_eventos['Nombre_Paciente']; ?> ',
								start: '<?php echo $registros_eventos['Fecha_Disponibilidad']; ?> <?php echo$registros_eventos['Horario_Disponibilidad']; ?>',
								end: '<?php echo $registros_eventos['Fecha_Disponibilidad']; ?> <?php echo $registros_eventos['Horario_Disponibilidad']; ?>',
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
			<div class="modal-dialog modal-notify modal-info">
			<div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo">Informacion sobre cita</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
	        <div class="modal-body">
          <div class="text-center">
						<dl class="dl-horizontal">
							
							<dt>Especialidad</dt>
							<dd id="title"></dd>
							<dt>Nombre de paciente</dt>
							<dd id="description"></dd>
							<dt>Fecha de cita</dt>
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
  
  include ("footer.php")?>

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