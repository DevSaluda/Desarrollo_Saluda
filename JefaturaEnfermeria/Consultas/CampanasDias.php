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

include ("db_connection.php");
include "Consultas.php";
include "../js/Fecha.php";

$user_id=null;
$sql1="SELECT AgendaCitas_EspecialistasExt.ID_Agenda_Especialista,AgendaCitas_EspecialistasExt.Fk_Especialidad,
AgendaCitas_EspecialistasExt.Fk_Especialista,AgendaCitas_EspecialistasExt.Fk_Sucursal,
AgendaCitas_EspecialistasExt.Fecha,AgendaCitas_EspecialistasExt.Hora,AgendaCitas_EspecialistasExt.Nombre_Paciente,
AgendaCitas_EspecialistasExt.Tipo_Consulta,AgendaCitas_EspecialistasExt.Estatus_cita,
AgendaCitas_EspecialistasExt.Observaciones,AgendaCitas_EspecialistasExt.ID_H_O_D,AgendaCitas_EspecialistasExt.AgendadoPor,AgendaCitas_EspecialistasExt.Sistema,
Especialidades_Express.ID_Especialidad,Especialidades_Express.Nombre_Especialidad,EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos,
Sucursales_CampañasV2.ID_SucursalC ,Sucursales_CampañasV2.Nombre_Sucursal,Fechas_EspecialistasExt.ID_Fecha_Esp,Fechas_EspecialistasExt.Fecha_Disponibilidad,
Horarios_Citas_Ext.ID_Horario,Horarios_Citas_Ext.Horario_Disponibilidad
FROM AgendaCitas_EspecialistasExt,Especialidades_Express,EspecialistasV2,Sucursales_CampañasV2,Fechas_EspecialistasExt,Horarios_Citas_Ext WHERE
AgendaCitas_EspecialistasExt.Fk_Especialidad = Especialidades_Express.ID_Especialidad AND AgendaCitas_EspecialistasExt.Fk_Especialista =EspecialistasV2.ID_Especialista AND
AgendaCitas_EspecialistasExt.Fk_Sucursal =Sucursales_CampañasV2.ID_SucursalC AND
AgendaCitas_EspecialistasExt.Fecha = Fechas_EspecialistasExt.ID_Fecha_Esp AND
AgendaCitas_EspecialistasExt.Hora = Horarios_Citas_Ext.ID_Horario AND
Fechas_EspecialistasExt.Fecha_Disponibilidad BETWEEN CURDATE() and CURDATE() + INTERVAL 1 DAY AND
AgendaCitas_EspecialistasExt.Fk_Sucursal ='".$row['Fk_Sucursal']."' AND
AgendaCitas_EspecialistasExt.ID_H_O_D='".$row['ID_H_O_D']."'  order by Horarios_Citas_Ext.Horario_Disponibilidad ASC";

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
    <th>Acciones</th>



</thead>
<?php while ($Especialista=$query->fetch_array()):?>
<tr>
    <td><?php echo $Especialista["Nombre_Especialidad"]; ?> </td>
	<td><?php echo $Especialista["Nombre_Paciente"]; ?></td>
	<td><?php echo $Especialista["Nombre_Sucursal"]; ?></td>

	<td><?php echo fechaCastellano($Especialista["Fecha_Disponibilidad"]); ?><br>
	<?php echo date('h:i A', strtotime($Especialista["Horario_Disponibilidad"])); ?>
</td>

<td>
		 <!-- Basic dropdown -->
<button class="btn btn-info dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-info-circle"></i></button>

<div class="dropdown-menu">
    <div class="text-center">
<a class="dropdown-item" >Cita</a>

</div>
</div>
<!-- Basic dropdown -->
	 </td>
     <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo $Especialista["ID_Agenda_Especialista"];?>" class="btn-edit1 dropdown-item" >Contacto a paciente <i class="fas fa-id-card-alt"></i></a>
  

 
</div>
<!-- Basic dropdown -->
	 </td>
	

	
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
 