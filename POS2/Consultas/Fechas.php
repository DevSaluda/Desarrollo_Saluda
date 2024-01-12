<script type="text/javascript">
$(document).ready( function () {
    $('#Fechas').DataTable({
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

$user_id=null;
$sql1="SELECT Fechas_Especialistas.ID_Fecha_Esp,Fechas_Especialistas.Fecha_Disponibilidad,Fechas_Especialistas.ID_H_O_D, 
Fechas_Especialistas.FK_Especialista,Fechas_Especialistas.Estatus_fecha,Fechas_Especialistas.CodigoColorFe,
Especialistas.ID_Especialista,Especialistas.Nombre_Apellidos 
FROM Fechas_Especialistas,Especialistas WHERE 
Fechas_Especialistas.FK_Especialista = Especialistas.ID_Especialista AND Fechas_Especialistas.Estatus_fecha = 'Activo' AND 
Fechas_Especialistas.ID_H_O_D='".$row['ID_H_O_D']."'";
 

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="table-responsive">
	<table id="Fechas" class="table table-hover">
<thead>
	<th>Folio</th>
    <th>Nombre especialista</th>
	<th>Fecha</th>
	<th>Estatus</th>
	<th>Editar</th>
	


</thead>
<?php while ($Fecha=$query->fetch_array()):?>
<tr>
	<td><?php echo $Fecha["ID_Fecha_Esp"]; ?></td>
    <td><?php echo $Fecha["Nombre_Apellidos"]; ?></td>
    <td><?php echo $Fecha["Fecha_Disponibilidad"]; ?></td>
	
	<td><button class="<?echo $Fecha['CodigoColorFe'];?>"><?php echo $Fecha["Estatus_fecha"]; ?></button></td>
	

	
	<td>
		<button data-id="<?php echo $Fecha["ID_Fecha_Esp"];?>" class="btn-edit btn btn-info"><i class="far fa-edit"></i></button></td>
		
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
  		$.post("https://controlfarmacia.com/Controldecitas/Modales/EditaFecha.php","id="+id,function(data){
  			$("#form-edit").html(data);
  		});
  		$('#editModal').modal('show');
  	});
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
		<h4 class="modal-title">Editar Horario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      
		</div>
		<span id="error_actualiza" class="alert alert-danger" style="display: none"></span>
        <p id="show_message" style="display: none">Form data sent. Thanks for your comments.We will update you within 24 hours. </p>
        <p id="show_error"  class="alert alert-danger" style="display: none">Algo salio mal </p>
        <div class="modal-body">
        <div id="form-edit"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->