<script type="text/javascript">
$(document).ready( function () {
    $('#Sucursalescampana').DataTable({
	
      "language": {
        "url": "Componentes/Spanish.json"
		}
		
	  } 
	  
	  );
} );
</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT * FROM Sucursales_Campañas WHERE Estatus_Sucursal = 'Activo' AND ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="table-responsive">
	<table id="Sucursalescampana" class="table ">
<thead>
	<th>Folio</th>
    <th>Sucursal</th>

	<th>Estatus</th>
	<th>Editar</th>



</thead>
<?php while ($Sucursales=$query->fetch_array()):?>
<tr>
	<td><?php echo $Sucursales["ID_SucursalC"]; ?></td>
    <td><?php echo $Sucursales["Nombre_Sucursal"]; ?></td>

	<td><button class="<?echo $Sucursales['Color_Sucursal'];?>"><?php echo $Sucursales["Estatus_Sucursal"]; ?></button></td>
	

	
	<td>
		<button data-id="<?php echo $Sucursales["ID_SucursalC"];?>" class="btn-edit btn btn-info"><i class="far fa-edit"></i></button></td>
		
</tr>
<?php endwhile;?>
</table>
</div>
<?php else:?>
	<h3 class="alert alert-warning">No se encontraron sucursales <i class="fas fa-exclamation-circle"></i> </h3>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/Controldecitas/Modales/EditaSucursalC.php","id="+id,function(data){
  			$("#form-edit").html(data);
  		});
  		$('#editModal').modal('show');
  	});
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
		<h4 class="modal-title">Editar Sucursal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      
		</div>
		<span id="error_actualiza" class="alert alert-danger" style="display: none"></span>
	

        <p id="show_error"  class="alert alert-danger" style="display: none">No se puede completar la acción, por favor intenta de nuevo</p>
        <div class="modal-body">
        <div id="form-edit"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->