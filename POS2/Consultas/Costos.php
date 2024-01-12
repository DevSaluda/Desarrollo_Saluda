<script type="text/javascript">
$(document).ready( function () {
    $('#Costos').DataTable({
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

$user_id=null;
$sql1="SELECT Costos_Especialistas.ID_Costo_Esp,Costos_Especialistas.Costo_Especialista,Costos_Especialistas.ID_H_O_D,
Costos_Especialistas.FK_Especialista,Costos_Especialistas.Estatus,Costos_Especialistas.Codigocolor,Especialistas.ID_Especialista,Especialistas.Nombre_Apellidos FROM Costos_Especialistas,Especialistas WHERE
Costos_Especialistas.FK_Especialista = Especialistas.ID_Especialista AND Costos_Especialistas.Estatus ='Activo' AND Costos_Especialistas.ID_H_O_D='".$row['ID_H_O_D']."'";
 

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="table-responsive">
	<table id="Costos" class="table table-hover">
<thead>
	<th>Folio</th>
    <th>Nombre especialista</th>
    <th>Costo</th>
    <th>Estatus</th>
	<th>Editar</th>



</thead>
<?php while ($Costo=$query->fetch_array()):?>
<tr>
	<td><?php echo $Costo["ID_Costo_Esp"]; ?></td>
    <td><?php echo $Costo["Nombre_Apellidos"]; ?></td>
    <td>$<?php echo $Costo["Costo_Especialista"]; ?></td>
	
	<td><button class="<?echo $Costo['Codigocolor'];?>"><?php echo $Costo["Estatus"]; ?></button></td>
	
		
	<td>
		<button data-id="<?php echo $Costo["ID_Costo_Esp"];?>" class="btn-edit btn btn-info"><i class="far fa-edit"></i></button></td>
		
	
</tr>
<?php endwhile;?>
</table>
</div>
<?php else:?>
  <h3 class="alert alert-warning">No se encontraron costos <i class="fas fa-exclamation-circle"></i> </h3>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/Controldecitas/Modales/EditaCosto.php","id="+id,function(data){
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
		<span id="error_ActCosto" class="alert alert-danger" style="display: none"></span>
        <p id="show_message" style="display: none">Form data sent. Thanks for your comments.We will update you within 24 hours. </p>
        <p id="show_error"  class="alert alert-danger" style="display: none">Algo salio mal </p>
        <div class="modal-body">
        <div id="form-edit"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
		<h4 class="modal-title">Detalles</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      
		</div>

        <div class="modal-body">
        <div id="form-detail"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->