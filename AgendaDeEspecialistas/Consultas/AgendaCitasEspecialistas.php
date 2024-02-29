<script type="text/javascript">
$(document).ready( function () {
    $('#AgendaCitasEspecialistas').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
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
$sql1="Select AgendaCitas_Especialistas.ID_Agenda_Especialista,AgendaCitas_Especialistas.Especialidad,
AgendaCitas_Especialistas.Nombre_Especialista, AgendaCitas_Especialistas.Sucursal,
AgendaCitas_Especialistas.Fecha_Cita,AgendaCitas_Especialistas.Hora_Cita,AgendaCitas_Especialistas.Nombre_Paciente, 
AgendaCitas_Especialistas.Telefono,AgendaCitas_Especialistas.Seguimiento,AgendaCitas_Especialistas.Seguimiento, 
AgendaCitas_Especialistas.Estatus_pago,AgendaCitas_Especialistas.Estatus_cita,AgendaCitas_Especialistas.ID_H_O_D, 
Especialidades.ID_Especialidad,Especialidades.Nombre_Especialidad,Especialistas.ID_Especialista,Especialistas.Nombre_Apellidos 
FROM AgendaCitas_Especialistas,Especialidades,Especialistas where AgendaCitas_Especialistas.Especialidad =Especialidades.ID_Especialidad AND 
AgendaCitas_Especialistas.Nombre_Especialista =Especialistas.ID_Especialista AND AgendaCitas_Especialistas.ID_H_O_D='".$row['ID_H_O_D']."'";

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="table-responsive">
	<table id="AgendaCitasEspecialistas" class="table">
<thead>
    <th>Folio</th>
    <th>Especialidad y Doctor </th>
    <th>Fecha y hora de cita</th>
    <th>Nombre Paciente</th>
    <th>Seguimiento</th>
    <th>Estado de pago</th>
    <th>Estatus cita</th>
	<th>Acciones</th>



</thead>
<?php while ($AgendaCitasEsp=$query->fetch_array()):?>
<tr>
    <td><? echo $AgendaCitasEsp["ID_Agenda_Especialista"]; ?></td>
    <td style="width:200px;"><? echo $AgendaCitasEsp["Nombre_Especialidad"]; ?> - <? echo $AgendaCitasEsp["Nombre_Apellidos"]; ?></td>
	<td style="width:200px;"><? echo fechaCastellano($AgendaCitasEsp["Fecha_Cita"]);?> - <? echo date('h:i A', strtotime($AgendaCitasEsp["Hora_Cita"])); ?></td>
	<td><? echo $AgendaCitasEsp["Nombre_Paciente"]; ?></td>
    <td><? echo $AgendaCitasEsp["Seguimiento"]; ?></td>
    <td><? echo $AgendaCitasEsp["Estatus_pago"]; ?></td>
    <td ><? echo $AgendaCitasEsp["Estatus_cita"]; ?></td>
    


    <td style="width:200px;">
    <td><a class="btn btn-success"  href="https://api.whatsapp.com/send?phone=+52<?echo$row['Telefono']; ?> &text=Hola!%20Quiero%20generar%20mas%20ventas!" target="_blank"><span class="fab fa-whatsapp"></span><span class="hidden-xs"></span></a></td>
    
        <button id="del2-<?php echo $AgendaCitasEsp["ID_Agenda_Especialista"];?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
        <button data-id="<?php echo $AgendaCitasEsp["ID_Agenda_Especialista"];?>" class="btn-edit btn btn-info"><i class="far fa-edit"></i></button>
    
    </td>
		
	
		<script>
		
		$("#del2-"+<?php echo $AgendaCitasEsp["ID_Camp_Esp"];?>).click(function(e){
			$('#Eliminar').modal('show'); // abrir
			event.preventDefault();//Esto es para cancelar el envio
	
			$("#Celimina").click(function() {
				$.post("https://controlfarmacia.com/Controldecitas/Consultas/EliminarCampana.php","id="+<?php echo $AgendaCitasEsp["ID_Agenda_Especialista"];?>,function(data){
                    CargaCitasEspeciales()
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
  		$.post("https://controlfarmacia.com/Controldecitas/Modales/EditaCampana.php","id="+id,function(data){
  			$("#form-edit").html(data);
  		});
  		$('#editModal').modal('show');
  	});
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
		<h4 class="modal-title">Editar Especialidad</h4>
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