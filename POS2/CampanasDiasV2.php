<script type="text/javascript">
$(document).ready( function () {
$('#CampanasV2').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[25,50, 150, 200, -1], [25,50, 150, 200, "Todos"]],   
        language: {
            "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
          
        //para usar los botones   
        responsive: "true",
      
         
   
	   
        	        
    }); });
</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "../js/Fecha.php";

$user_id=null;
$sql1="SELECT AgendaCitas_EspecialistasV3.ID_Agenda_Especialista,AgendaCitas_EspecialistasV3.Fk_Especialidad,
AgendaCitas_EspecialistasV3.Fk_Especialista,AgendaCitas_EspecialistasV3.Fk_Sucursal,
AgendaCitas_EspecialistasV3.Fk_Fecha,AgendaCitas_EspecialistasV3.Fk_Hora,AgendaCitas_EspecialistasV3.Nombre_Paciente,
AgendaCitas_EspecialistasV3.Tipo_Consulta,
AgendaCitas_EspecialistasV3.Estatus_pago,AgendaCitas_EspecialistasV3.Color_Pago,AgendaCitas_EspecialistasV3.Estatus_cita,
AgendaCitas_EspecialistasV3.Observaciones,AgendaCitas_EspecialistasV3.ColorEstatusCita,AgendaCitas_EspecialistasV3.Estatus_Seguimiento,
AgendaCitas_EspecialistasV3.Color_Seguimiento,AgendaCitas_EspecialistasV3.ID_H_O_D,AgendaCitas_EspecialistasV3.AgendadoPor,AgendaCitas_EspecialistasV3.Sistema,
EspecialidadesV2.ID_Especialidad,EspecialidadesV2.Nombre_Especialidad,EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos,
Sucursales_CampañasV2.ID_SucursalC ,Sucursales_CampañasV2.Nombre_Sucursal,Fechas_EspecialistasV2.ID_Fecha_Esp,Fechas_EspecialistasV2.Fecha_Disponibilidad,
Horarios_Citas_especialistasV2.ID_Horario,Horarios_Citas_especialistasV2.Horario_Disponibilidad, Costos_EspecialistasV2.ID_Costo_Esp,Costos_EspecialistasV2.Costo_Especialista
FROM AgendaCitas_EspecialistasV3,EspecialidadesV2,EspecialistasV2,Sucursales_CampañasV2,Fechas_EspecialistasV2,Horarios_Citas_especialistasV2,
Costos_EspecialistasV2 WHERE
AgendaCitas_EspecialistasV3.Fk_Especialidad = EspecialidadesV2.ID_Especialidad AND AgendaCitas_EspecialistasV3.Fk_Especialista =EspecialistasV2.ID_Especialista AND
AgendaCitas_EspecialistasV3.Fk_Sucursal =Sucursales_CampañasV2.ID_SucursalC AND
AgendaCitas_EspecialistasV3.Fk_Fecha = Fechas_EspecialistasV2.ID_Fecha_Esp AND
AgendaCitas_EspecialistasV3.Fk_Hora = Horarios_Citas_especialistasV2.ID_Horario AND
AgendaCitas_EspecialistasV3.Fk_Costo =  Costos_EspecialistasV2.ID_Costo_Esp AND 
 Fechas_EspecialistasV2.Fecha_Disponibilidad BETWEEN CURDATE() and CURDATE() + INTERVAL 3 DAY AND

AgendaCitas_EspecialistasV3.ID_H_O_D='".$row['ID_H_O_D']."'  order by Horarios_Citas_especialistasV2.Horario_Disponibilidad ASC";

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
    <div class="text-center">
	<div class="table-responsive">
	<table id="CampanasV2" class="table table-hover">
<thead>
   
    <th>Especialidad</th>
	<th>Paciente</th>
	
	<th>Sucursal</th>
    <th>Fecha | Hora</th>
   
    

	

	



</thead>
<?php while ($Especialista=$query->fetch_array()):?>
<tr>
    <td><?php echo $Especialista["Nombre_Especialidad"]; ?> </td>
	<td><?php echo $Especialista["Nombre_Paciente"]; ?></td>
	<td><?php echo $Especialista["Nombre_Sucursal"]; ?></td>

	<td><?php echo fechaCastellano($Especialista["Fecha_Disponibilidad"]); ?><br>
	<?php echo date('h:i A', strtotime($Especialista["Horario_Disponibilidad"])); ?>
</td>

<!-- <td>
		 
<button class="btn btn-info dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-info-circle"></i></button>

<div class="dropdown-menu">
    <div class="text-center">
<a class="dropdown-item" >Cita</a>
<button class="btn btn-default btn-sm" style="echo $Especialista['ColorEstatusCita'];?>">echo $Especialista["Estatus_cita"]; ?></button> 
<div class="dropdown-divider"></div>
<a class="dropdown-item" >Pago</a>
<button class="btn btn-default btn-sm" style=" $Especialista['Color_Pago'];?>"> echo $Especialista["Estatus_pago"]; ?></button>
<div class="dropdown-divider"></div>
<a class="dropdown-item" >Seguimiento</a>
<button class="btn btn-default btn-sm" style=" $Especialista['Color_Seguimiento'];?>"> echo $Especialista["Estatus_Seguimiento"]; ?></button>
</div>
</div>

	 </td>
 -->     
	

	
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
 <!--  -->