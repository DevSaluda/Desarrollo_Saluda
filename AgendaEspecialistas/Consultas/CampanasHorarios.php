<script type="text/javascript">
$(document).ready( function () {
$('#Campanas').DataTable({
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
        dom: "B<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>'",
          buttons:[ 
			{
				extend:    'excelHtml5',
				text:      'Exportar a Excel  <i Exportar a Excel class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                title: 'Control de citas ',
				className: 'btn btn-success'
			},
			
			
          
            
        ],
   
	   
        	        
    }); });
</script>
<?php

include ("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "../js/Fecha.php";

$user_id=null;
$sql1="Select Fechas_EspecialistasV2.ID_Fecha_Esp,Fechas_EspecialistasV2.Fecha_Disponibilidad,Fechas_EspecialistasV2.FK_Especialista,Fechas_EspecialistasV2.Estatus_fecha, EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos, EspecialistasV2.Especialidad, EspecialidadesV2.ID_Especialidad,EspecialidadesV2.Nombre_Especialidad, EspecialistasV2.Fk_Sucursal,Horarios_Citas_especialistasV2.ID_Horario,Horarios_Citas_especialistasV2.Horario_Disponibilidad,Horarios_Citas_especialistasV2.Fk_Fecha,
Sucursales_CampañasV2.ID_SucursalC,Sucursales_CampañasV2.Nombre_Sucursal FROM EspecialistasV2,EspecialidadesV2,Fechas_EspecialistasV2,Sucursales_CampañasV2, Horarios_Citas_especialistasV2 WHERE Fechas_EspecialistasV2.Estatus_fecha='Vigente' AND
Fechas_EspecialistasV2.FK_Especialista = EspecialistasV2.ID_Especialista AND EspecialistasV2.Fk_Sucursal = Sucursales_CampañasV2.ID_SucursalC AND EspecialidadesV2.ID_Especialidad = EspecialistasV2.Especialidad AND Horarios_Citas_especialistasV2.FK_Especialista = EspecialistasV2.ID_Especialista";

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
    <div class="text-center">
	<div class="table-responsive">
	<table id="Campanas" class="table table-hover">
<thead>
   
    <th>Especialidad</th>
	<th>Doctor</th>
	
	<th>Sucursal</th>
    <th>Fecha </th>
     <th> Hora</th>
 
	

	



</thead>
<?php while ($Especialista=$query->fetch_array()):?>
<tr>

    <td><?php echo $Especialista["Nombre_Especialidad"]; ?> </td>
	<td><?php echo $Especialista["Nombre_Apellidos"]; ?></td>
	<td><?php echo $Especialista["Nombre_Sucursal"]; ?></td>

	<td><?php echo fechaCastellano($Especialista["Fecha_Disponibilidad"]); ?><br>
	
</td>

<td><?php echo date('h:i A', strtotime($Especialista["Horario_Disponibilidad"])); ?></td>
	

	
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>
