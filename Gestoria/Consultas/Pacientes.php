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
$sql1="SELECT ID_SignoV,Nombre_Paciente,Nombre_Doctor,Fk_Sucursal,FK_ID_H_O_D,Motivo_Consulta
FROM Signos_Vitales WHERE Fk_Sucursal='".$row['ID_Sucursal']."' AND FK_ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="table-responsive">
	<table id="Sucursalescampana" class="table ">
<thead>
    <th>Folio</th>
    <th>Sucursal</th>
    <th>Nombre </th>
    <th>Doctor </th>
    <th>Motivo consulta </th>
	
	


</thead>
<?php while ($Sucursales=$query->fetch_array()):?>
<tr>
    <td><?php echo $Sucursales["ID_SignoV"]; ?></td>
    <td><?php echo $Sucursales["Fk_Sucursal"]; ?></td>
    <td><?php echo $Sucursales["Nombre_Paciente"]; ?></td>
    <td><?php echo $Sucursales["Nombre_Doctor"]; ?></td>
	<td><?php echo $Sucursales["Motivo_Consulta"]; ?></td>
	<td><?php echo $Sucursales["FK_ID_H_O_D"]; ?></td>

	
		
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