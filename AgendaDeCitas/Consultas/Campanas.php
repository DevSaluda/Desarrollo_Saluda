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
$sql1="SELECT AgendaCitas_EspecialistasV2.ID_Agenda_Especialista,AgendaCitas_EspecialistasV2.Fk_Especialidad,
AgendaCitas_EspecialistasV2.Fk_Especialista,AgendaCitas_EspecialistasV2.Fk_Sucursal,
AgendaCitas_EspecialistasV2.Fk_Fecha,AgendaCitas_EspecialistasV2.Fk_Hora,AgendaCitas_EspecialistasV2.Nombre_Paciente,
AgendaCitas_EspecialistasV2.Telefono,AgendaCitas_EspecialistasV2.Tipo_Consulta,
AgendaCitas_EspecialistasV2.Estatus_pago,AgendaCitas_EspecialistasV2.Color_Pago,AgendaCitas_EspecialistasV2.Estatus_cita,
AgendaCitas_EspecialistasV2.Observaciones,AgendaCitas_EspecialistasV2.ColorEstatusCita,AgendaCitas_EspecialistasV2.Estatus_Seguimiento,
AgendaCitas_EspecialistasV2.Color_Seguimiento,AgendaCitas_EspecialistasV2.ID_H_O_D,
EspecialidadesV2.ID_Especialidad,EspecialidadesV2.Nombre_Especialidad,EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos,
Sucursales_CampañasV2.ID_SucursalC ,Sucursales_CampañasV2.Nombre_Sucursal,Fechas_EspecialistasV2.ID_Fecha_Esp,Fechas_EspecialistasV2.Fecha_Disponibilidad,
Horarios_Citas_especialistasV2.ID_Horario,Horarios_Citas_especialistasV2.Horario_Disponibilidad, Costos_EspecialistasV2.ID_Costo_Esp,Costos_EspecialistasV2.Costo_Especialista
FROM AgendaCitas_EspecialistasV2,EspecialidadesV2,EspecialistasV2,Sucursales_CampañasV2,Fechas_EspecialistasV2,Horarios_Citas_especialistasV2,
Costos_EspecialistasV2 WHERE
AgendaCitas_EspecialistasV2.Fk_Especialidad = EspecialidadesV2.ID_Especialidad AND AgendaCitas_EspecialistasV2.Fk_Especialista =EspecialistasV2.ID_Especialista AND
AgendaCitas_EspecialistasV2.Fk_Sucursal =Sucursales_CampañasV2.ID_SucursalC AND
AgendaCitas_EspecialistasV2.Fk_Fecha = Fechas_EspecialistasV2.ID_Fecha_Esp AND
AgendaCitas_EspecialistasV2.Fk_Hora = Horarios_Citas_especialistasV2.ID_Horario AND
AgendaCitas_EspecialistasV2.Fk_Costo =  Costos_EspecialistasV2.ID_Costo_Esp AND
AgendaCitas_EspecialistasV2.ID_H_O_D='".$row['ID_H_O_D']."' order by AgendaCitas_EspecialistasV2.ID_Agenda_Especialista DESC";

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="table-responsive">
	<table id="Campanas" class="table table-striped">
<thead>
   
    <th>Especialidad</th>
	<th>Paciente</th>
	<th>Telefono</th>
	<th>Sucursal</th>
    <th>Fecha | Hora</th>
	<th>Estatus</th>
	
	<th>Detalles</th>
	<th>Cancelar</th>
	



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
	
	<td><button class="<?echo $Especialista['Color_Pago'];?>"><?php echo $Especialista["Estatus_pago"]; ?></button><br>
	<button class="<?echo $Especialista['ColorEstatusCita'];?>"><?php echo $Especialista["Estatus_cita"]; ?></button>
	<button class="<?echo $Especialista['Color_Seguimiento'];?>"><?php echo $Especialista["Estatus_Seguimiento"]; ?></button>
</td>

	<td><button data-id="<?php echo $Especialista["ID_Agenda_Especialista"];?>" class="btn-edit btn btn-info btn-sm"><i class="far fa-eye"></i></button></td>

	<td>	<a href="#" id="del2-<?php echo $Especialista["ID_Agenda_Especialista"];?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a></td>
  <script>
		
		$("#del2-"+<?php echo $Especialista["ID_Agenda_Especialista"];?>).click(function(e){
			$('#modalConfirmDelete').modal('show'); // abrir
			event.preventDefault();//Esto es para cancelar el envio
	
			$("#Celimina").click(function() {
				$.post("https://controlfarmacia.com/Controldecitas/Consultas/CancelaCita.php","id="+<?php echo $Especialista["ID_Agenda_Especialista"];?>,function(data){
					
  
          CargaCampanas();

				});
			})
		});

		</script>

	
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
  		$.post("https://controlfarmacia.com/Controldecitas/Modales/DetallesCita.php","id="+id,function(data){
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