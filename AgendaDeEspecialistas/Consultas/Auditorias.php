<script type="text/javascript">
$(document).ready( function () {
    $('#Campanas').DataTable({
		
      "language": {
        "url": "Componentes/Spanish.json"
        }
      } );
} );
</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "../js/Fecha.php";

$user_id=null;
$sql1="SELECT Cancelaciones_AgendaV2.ID_Agenda_Especialista,Cancelaciones_AgendaV2.Fk_Especialidad,
Cancelaciones_AgendaV2.Fk_Especialista,Cancelaciones_AgendaV2.Fk_Sucursal,
Cancelaciones_AgendaV2.Fk_Fecha,Cancelaciones_AgendaV2.Fk_Hora,
Cancelaciones_AgendaV2.Tipo_Consulta,Cancelaciones_AgendaV2.AgendadoPor,
Cancelaciones_AgendaV2.Estatus_pago,Cancelaciones_AgendaV2.Color_Pago,Cancelaciones_AgendaV2.Estatus_cita,
Cancelaciones_AgendaV2.Observaciones,Cancelaciones_AgendaV2.ColorEstatusCita,Cancelaciones_AgendaV2.Estatus_Seguimiento,
Cancelaciones_AgendaV2.Color_Seguimiento,Cancelaciones_AgendaV2.ID_H_O_D,Cancelaciones_AgendaV2.Nombre_Paciente,
EspecialidadesV2.ID_Especialidad,EspecialidadesV2.Nombre_Especialidad,EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos,
Sucursales_CampañasV2.ID_SucursalC ,Sucursales_CampañasV2.Nombre_Sucursal,Fechas_EspecialistasV2.ID_Fecha_Esp,Fechas_EspecialistasV2.Fecha_Disponibilidad,
Horarios_Citas_especialistasV2.ID_Horario,Horarios_Citas_especialistasV2.Horario_Disponibilidad, Costos_EspecialistasV2.ID_Costo_Esp,Costos_EspecialistasV2.Costo_Especialista
FROM Cancelaciones_AgendaV2,EspecialidadesV2,EspecialistasV2,Sucursales_CampañasV2,Fechas_EspecialistasV2,Horarios_Citas_especialistasV2,
Costos_EspecialistasV2 WHERE
Cancelaciones_AgendaV2.Fk_Especialidad = EspecialidadesV2.ID_Especialidad AND Cancelaciones_AgendaV2.Fk_Especialista =EspecialistasV2.ID_Especialista AND
Cancelaciones_AgendaV2.Fk_Sucursal =Sucursales_CampañasV2.ID_SucursalC AND
Cancelaciones_AgendaV2.Fk_Fecha = Fechas_EspecialistasV2.ID_Fecha_Esp AND
Cancelaciones_AgendaV2.Fk_Hora = Horarios_Citas_especialistasV2.ID_Horario AND
Cancelaciones_AgendaV2.Fk_Costo =  Costos_EspecialistasV2.ID_Costo_Esp AND
Cancelaciones_AgendaV2.ID_H_O_D='".$row['ID_H_O_D']."' order by Cancelaciones_AgendaV2.ID_Agenda_Especialista DESC";

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
    <div class="text-center">
	<div class="table-responsive">
	<table id="Campanas" class="table table-hover">
<thead>
   
    <th>Especialidad</th>
	<th>Paciente</th>
	
	<th>Sucursal</th>
    <th>Fecha | Hora</th>
    <th>Estatus</th>
    <th>Agendado por</th>

	

	



</thead>
<?php while ($Especialista=$query->fetch_array()):?>
<tr>
    <td><?php echo $Especialista["Nombre_Especialidad"]; ?> </td>
	<td><?php echo $Especialista["Nombre_Paciente"]; ?></td>
	<td><?php echo $Especialista["Nombre_Sucursal"]; ?></td>

	<td><?php echo fechaCastellano($Especialista["Fecha_Disponibilidad"]); ?><br>
	<?php echo date('h:i A', strtotime($Especialista["Horario_Disponibilidad"])); ?>
</td>
<td><?php echo $Especialista["Estatus_cita"]; ?></td>
<td><?php echo $Especialista["AgendadoPor"]; ?></td>


  
	

	
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>
  <!-- Modal -->
 <!-- Modal -->
 