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

include "../js/Fecha.php";

$user_id=null;
$sql1="SELECT AgendaCitas_Especialistas.ID_Agenda_Especialista,AgendaCitas_Especialistas.Fk_Especialidad,
AgendaCitas_Especialistas.Fk_Especialista,AgendaCitas_Especialistas.Fk_Sucursal,
AgendaCitas_Especialistas.Fk_Fecha,AgendaCitas_Especialistas.Fk_Hora,AgendaCitas_Especialistas.Nombre_Paciente,
AgendaCitas_Especialistas.Telefono,AgendaCitas_Especialistas.Tipo_Consulta,
AgendaCitas_Especialistas.Estatus_pago,AgendaCitas_Especialistas.Color_Pago,AgendaCitas_Especialistas.Estatus_cita,
AgendaCitas_Especialistas.Observaciones,AgendaCitas_Especialistas.ColorEstatusCita,AgendaCitas_Especialistas.Estatus_Seguimiento,
AgendaCitas_Especialistas.Color_Seguimiento,AgendaCitas_Especialistas.ID_H_O_D,AgendaCitas_Especialistas.AgendadoPor,AgendaCitas_Especialistas.Sistema,
Especialidades.ID_Especialidad,Especialidades.Nombre_Especialidad,Especialistas.ID_Especialista,Especialistas.Nombre_Apellidos,
Sucursales_Campañas.ID_SucursalC ,Sucursales_Campañas.Nombre_Sucursal,Fechas_Especialistas.ID_Fecha_Esp,Fechas_Especialistas.Fecha_Disponibilidad,
Horarios_Citas_especialistas.ID_Horario,Horarios_Citas_especialistas.Horario_Disponibilidad, Costos_Especialistas.ID_Costo_Esp,Costos_Especialistas.Costo_Especialista
FROM AgendaCitas_Especialistas,Especialidades,Especialistas,Sucursales_Campañas,Fechas_Especialistas,Horarios_Citas_especialistas,
Costos_Especialistas WHERE
AgendaCitas_Especialistas.Fk_Especialidad = Especialidades.ID_Especialidad AND AgendaCitas_Especialistas.Fk_Especialista =Especialistas.ID_Especialista AND
AgendaCitas_Especialistas.Fk_Sucursal =Sucursales_Campañas.ID_SucursalC AND
AgendaCitas_Especialistas.Fk_Fecha = Fechas_Especialistas.ID_Fecha_Esp AND
AgendaCitas_Especialistas.Fk_Hora = Horarios_Citas_especialistas.ID_Horario AND
AgendaCitas_Especialistas.Fk_Costo =  Costos_Especialistas.ID_Costo_Esp AND
 AgendaCitas_Especialistas.Fk_Sucursal ='".$row['Fk_Sucursal']."' AND
AgendaCitas_Especialistas.ID_H_O_D='".$row['ID_H_O_D']."' order by AgendaCitas_Especialistas.ID_Agenda_Especialista DESC";

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="table-responsive">
	<table id="Campanas" class="table table-hover">
<thead>
   
    <th>Especialidad</th>
	<th>Paciente</th>
	<th>Telefono</th>
	<th>Sucursal</th>
    <th>Fecha | Hora</th>
	<th>Pago</th>
	<th>Estatus cita</th>
	<th>Seguimiento</th>
	

	



</thead>
<?php while ($Especialista=$query->fetch_array()):?>
<tr>
    <td><?php echo $Especialista["Nombre_Especialidad"]; ?></td>
	<td><?php echo $Especialista["Nombre_Paciente"]; ?></td>
	<td><?php echo $Especialista["Telefono"]; ?></td>
	<td><?php echo $Especialista["Nombre_Sucursal"]; ?></td>

	<td><?php echo fechaCastellano($Especialista["Fecha_Disponibilidad"]); ?><br>
	<?php echo date('h:i A', strtotime($Especialista["Horario_Disponibilidad"])); ?>
</td>
	
	<td><button class="<?php echo $Especialista['Color_Pago'];?>"><?php echo $Especialista["Estatus_pago"]; ?></button></td>
	<td><button class="<?php echo $Especialista['ColorEstatusCita'];?>"><?php echo $Especialista["Estatus_cita"]; ?></button></td>
	<td><button class="<?php echo $Especialista['Color_Seguimiento'];?>"><?php echo $Especialista["Estatus_Seguimiento"]; ?></button>
</td>

	

	
</tr>
<?php endwhile;?>
</table>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/Controldecitas/Modales/DetallesCita.php","id="+id,function(data){
  			$("#form-edit").html(data);
  		});
  		$('#editModal').modal('show');
  	});
  </script>
 <div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
		<h4 class="modal-title">Detalles</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      
		</div>
		<span id="error" class="alert alert-danger" style="display: none"></span>
        <p id="show_message" style="display: none">Form data sent. Thanks for your comments.We will update you within 24 hours. </p>
        <p id="show_error"  class="alert alert-danger" style="display: none">Algo salio mal </p>
        <div class="modal-body">
        <div id="form-edit"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->