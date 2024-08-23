<script type="text/javascript">
$(document).ready( function () {
    $('#MedicosExpress').DataTable({
	
      "language": {
        "url": "Componentes/Spanish.json"
		}
		
	  } 
	  
	  );
} );
</script>
<?php
include("Consultas/db_connection.php");
include "Consultas/Consultas.php";
$user_id=null;
$sql1="SELECT
AgendaCitas_EspecialistasExt.ID_Agenda_Especialista,
Especialidades_Express.ID_Especialidad,
Especialidades_Express.Nombre_Especialidad,
Personal_Medico_Express.Medico_ID,
Personal_Medico_Express.Nombre_Apellidos,
SucursalesCorre.ID_SucursalC,
SucursalesCorre.Nombre_Sucursal,
Fechas_EspecialistasExt.ID_Fecha_Esp,
Fechas_EspecialistasExt.Fecha_Disponibilidad,
Horarios_Citas_Ext.ID_Horario,
Horarios_Citas_Ext.Horario_Disponibilidad,
AgendaCitas_EspecialistasExt.AgendadoPor,
AgendaCitas_EspecialistasExt.Nombre_Paciente,
AgendaCitas_EspecialistasExt.Telefono,
AgendaCitas_EspecialistasExt.Observaciones,
AgendaCitas_EspecialistasExt.Fecha_Hora
FROM
AgendaCitas_EspecialistasExt
LEFT JOIN
Especialidades_Express ON AgendaCitas_EspecialistasExt.Fk_Especialidad = Especialidades_Express.ID_Especialidad
LEFT JOIN
Personal_Medico_Express ON AgendaCitas_EspecialistasExt.Fk_Especialista = Personal_Medico_Express.Medico_ID
LEFT JOIN
SucursalesCorre ON AgendaCitas_EspecialistasExt.Fk_Sucursal = SucursalesCorre.ID_SucursalC
LEFT JOIN
Fechas_EspecialistasExt ON AgendaCitas_EspecialistasExt.Fecha = Fechas_EspecialistasExt.ID_Fecha_Esp
LEFT JOIN
Horarios_Citas_Ext ON AgendaCitas_EspecialistasExt.Hora = Horarios_Citas_Ext.ID_Horario
WHERE
(AgendaCitas_EspecialistasExt.Fk_Especialidad = 14 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 15 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 16 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 17 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 18 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 19 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 20 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 65 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 66 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 67 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 68 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 76 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 80 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 81 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 84 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 85 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 86 OR
AgendaCitas_EspecialistasExt.Fk_Especialidad = 87)
AND DATE(Fechas_EspecialistasExt.Fecha_Disponibilidad) = CURRENT_DATE();";
$query = $conn->query($sql1);
?>

<!-- Central Modal Medium Info -->
<div class="modal fade" id="PacientesDentalModalVista" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-="true" style="overflow-y: scroll;">
   <div class="modal-dialog modal-xl modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Pacientes agendadados</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-="true" class="white-text">&times;</span>
         </button>
       </div>
     
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
         <?php if($query->num_rows>0):?>
  <div class="text-center">
  <table id="MedicosExpress" class="table ">
<thead>
<th>Paciente</th>
<th>Telefono</th>
<th>Fecha</th>
<th>Hora</th>
<th>Especialidad</th>
<th>Doctor </th>
<th>Sucursal</th>
<th>Observaciones</th>


</thead>
<?php while ($Especialidades=$query->fetch_array()):?>
<tr>
	
	<td><?php echo $Especialidades["Nombre_Paciente"]; ?></td>
    <td><?php echo $Especialidades["Telefono"]; ?></td>
    <td><?php echo fechaCastellano($Especialidades["Fecha_Disponibilidad"]); ?></td>
    <td><?php echo date('h:i A', strtotime($Especialidades["Horario_Disponibilidad"])); ?></td>
    <td><?php echo $Especialidades["Nombre_Especialidad"]; ?></td>
    <td><?php echo $Especialidades["Nombre_Apellidos"]; ?></td>
    <td><?php echo $Especialidades["Nombre_Sucursal"]; ?></td>
    <td><?php echo $Especialidades["Observaciones"]; ?></td>
	
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<h3 class="alert alert-warning"> No se encontraron Especialidades <i class="fas fa-exclamation-circle"></i> </h3>
<?php endif;?>
  
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 </div>

