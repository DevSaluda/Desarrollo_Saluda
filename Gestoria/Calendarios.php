<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
$consulta_eventos = "SELECT AgendaCitas_EspecialistasSucursales.ID_Agenda_Especialista,AgendaCitas_EspecialistasSucursales.Fk_Especialidad,AgendaCitas_EspecialistasSucursales.Fk_Especialista,
AgendaCitas_EspecialistasSucursales.Fk_Sucursal,AgendaCitas_EspecialistasSucursales.Fecha,AgendaCitas_EspecialistasSucursales.Hora,AgendaCitas_EspecialistasSucursales.Nombre_Paciente,AgendaCitas_EspecialistasSucursales.Color_Calendario,AgendaCitas_EspecialistasSucursales.ID_H_O_D,
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Roles_Puestos.ID_rol,Roles_Puestos.Nombre_rol,Personal_Medico.Medico_ID,Personal_Medico.Nombre_Apellidos,
Fechas_Especialistas_Sucursales.ID_Fecha_Esp,Fechas_Especialistas_Sucursales.Fecha_Disponibilidad,Horarios_Citas_Sucursales.ID_Horario,Horarios_Citas_Sucursales.Horario_Disponibilidad FROM AgendaCitas_EspecialistasSucursales,SucursalesCorre,Roles_Puestos,Fechas_Especialistas_Sucursales,Horarios_Citas_Sucursales,Personal_Medico WHERE
AgendaCitas_EspecialistasSucursales.Fk_Sucursal=SucursalesCorre.ID_SucursalC AND AgendaCitas_EspecialistasSucursales.Fk_Especialidad = Roles_Puestos.ID_rol 
AND AgendaCitas_EspecialistasSucursales.Fk_Especialista = Personal_Medico.Medico_ID 
AND AgendaCitas_EspecialistasSucursales.Fecha = Fechas_Especialistas_Sucursales.ID_Fecha_Esp 
AND Horarios_Citas_Sucursales.ID_Horario = AgendaCitas_EspecialistasSucursales.Hora AND AgendaCitas_EspecialistasSucursales.Fk_Sucursal='".$row['Fk_Sucursal']."' AND AgendaCitas_EspecialistasSucursales.ID_H_O_D='".$row['ID_H_O_D']."'";
;
$resultado_eventos = mysqli_query($conn, $consulta_eventos);

$consulta_eventos2 = "SELECT AgendaCitas_EspecialistasExt.ID_Agenda_Especialista,AgendaCitas_EspecialistasExt.Fk_Especialidad,AgendaCitas_EspecialistasExt.Nombre_Paciente,
AgendaCitas_EspecialistasExt.Fk_Especialista,AgendaCitas_EspecialistasExt.Fk_Sucursal,
AgendaCitas_EspecialistasExt.Fecha,AgendaCitas_EspecialistasExt.Hora,AgendaCitas_EspecialistasExt.Color_Calendario,
AgendaCitas_EspecialistasExt.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Especialidades_Express.ID_Especialidad,Especialidades_Express.Nombre_Especialidad,Personal_Medico_Express.Medico_ID,Personal_Medico_Express.Nombre_Apellidos,
Fechas_EspecialistasExt.ID_Fecha_Esp,Fechas_EspecialistasExt.Fecha_Disponibilidad,Horarios_Citas_Ext.ID_Horario,Horarios_Citas_Ext.Horario_Disponibilidad
FROM AgendaCitas_EspecialistasExt,SucursalesCorre,Especialidades_Express,Personal_Medico_Express,Fechas_EspecialistasExt,Horarios_Citas_Ext WHERE AgendaCitas_EspecialistasExt.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND AgendaCitas_EspecialistasExt.Fk_Especialidad = Especialidades_Express.ID_Especialidad AND AgendaCitas_EspecialistasExt.Fk_Especialista = Personal_Medico_Express.Medico_ID AND AgendaCitas_EspecialistasExt.Fecha = Fechas_EspecialistasExt.ID_Fecha_Esp AND
AgendaCitas_EspecialistasExt.Hora = Horarios_Citas_Ext.ID_Horario AND AgendaCitas_EspecialistasExt.Fk_Sucursal='".$row['Fk_Sucursal']."' AND AgendaCitas_EspecialistasExt.ID_H_O_D ='".$row['ID_H_O_D']."'";
;
$resultado_eventos2 = mysqli_query($conn, $consulta_eventos2);

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Agendamiento de citas </title>

  <? include "Header.php"?>
  <link href='js/fullcalendar/fullcalendar.css' rel='stylesheet' />
</head>
<?include_once ("Menu.php")?>
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
								title: '<?php echo $registros_eventos['Nombre_rol']; ?>',
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


<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-user-md"></i> Campañas por sucursal </a>
  </li>
  <li class="nav-item">
    <a class="nav-link " id="pills-home-tab" data-toggle="pill" href="#CrediClinicas" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-file-medical"></i> Campañas de especialistas</a>
  </li>
 
</ul>
<div class="tab-content" id="pills-tabContent">
<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
		</div>
</div>
<div class="tab-pane fade show " id="CrediClinicas" role="tabpanel" aria-labelledby="pills-home-tab">
<script>
			$(document).ready(function() {
				
				$('#calendarext').fullCalendar({
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
						
				
						$('#visualizarext #title').text(event.title);
						$('#visualizarext #start').text(event.start.format('MMMM D, YYYY h:mm A'));
						$('#visualizarext #description').text(event.description);
						$('#visualizarext #status').text(event.status);
					
						$('#visualizarext').modal('show');
						return false;

					},
					
				
					events: [
						<?php
							while($registros_eventos2 = mysqli_fetch_array($resultado_eventos2)){
								?>
								{
								id: '<?php echo $registros_eventos2['ID_Agenda_Especialista']; ?>',
								title: '<?php echo $registros_eventos2['Nombre_Especialidad']; ?>',
								description:' <?php echo $registros_eventos2['Nombre_Paciente']; ?> ',
								start: '<?php echo $registros_eventos2['Fecha_Disponibilidad']; ?> <?php echo$registros_eventos2['Horario_Disponibilidad']; ?>',
								end: '<?php echo $registros_eventos2['Fecha_Disponibilidad']; ?> <?php echo $registros_eventos2['Horario_Disponibilidad']; ?>',
								status:'<?php echo $registros_eventos2['Nombre_Sucursal']; ?>',
								color: '<?php echo $registros_eventos2['Color_Calendario']; ?>',
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
<div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
               
               
                <div id="calendarext" class="col-centered">
                </div>
            </div>
			<div class="modal fade" id="visualizarext" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
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
		</div>
</div>
</div>

<div></div></div></div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <?
   
  include ("footer.php")?>
  
  <script src='js/moment.min.js'></script>
	<script src='js/fullcalendar/fullcalendar.min.js'></script>
	<script src='js/fullcalendar/fullcalendar.js'></script>
	<script src='js/fullcalendar/locale/es.js'></script>
<!-- Bootstrap -->
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