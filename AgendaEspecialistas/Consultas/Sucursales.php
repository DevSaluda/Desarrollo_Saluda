<script type="text/javascript">
$(document).ready( function () {
    $('#Sucursales').DataTable({
	
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
$sql1="SELECT Sucursales_especialistas.ID_Sucursal,Sucursales_especialistas.Nombre_Sucursal,
Sucursales_especialistas.ID_H_O_D,Sucursales_especialistas.FK_Especialista,Sucursales_especialistas.Estatus_Sucursal,
Sucursales_especialistas.CodigoColorSu, Especialistas.ID_Especialista,Especialistas.Nombre_Apellidos FROM Sucursales_especialistas,
Especialistas where Sucursales_especialistas.FK_Especialista = Especialistas.ID_Especialista AND 
Sucursales_especialistas.Estatus_Sucursal = 'Activo' AND Sucursales_especialistas.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="table-responsive">
	<table id="Sucursales" class="table ">
<thead>
	<th>Folio</th>
    <th>Sucursal</th>
    <th>Especialista</th>
	<th>Estatus</th>
	<th>Editar</th>
	


</thead>
<?php while ($Sucursales=$query->fetch_array()):?>
<tr>
	<td><?php echo $Sucursales["ID_Sucursal"]; ?></td>
    <td><?php echo $Sucursales["Nombre_Sucursal"]; ?></td>
    <td><?php echo $Sucursales["Nombre_Apellidos"]; ?></td>
	<td><button class="<?echo $Sucursales['CodigoColorSu'];?>"><?php echo $Sucursales["Estatus_Sucursal"]; ?></button></td>
	

	
	<td>
		<button data-id="<?php echo $Sucursales["ID_Sucursal"];?>" class="btn-edit btn btn-info"><i class="far fa-edit"></i></button></td>
		
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
  		$.post("https://controlfarmacia.com/Controldecitas/Modales/EditaSucursal.php","id="+id,function(data){
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