<script type="text/javascript">
$(document).ready( function () {
    $('#Especialistas').DataTable({
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
$sql1="SELECT Especialistas.ID_Especialista,Especialistas.Nombre_Apellidos,Especialistas.Especialidad,Especialistas.Tel,
Especialistas.ID_H_O_D,Especialistas.Estatus_Especialista,Especialistas.CodigoColorEs,Especialistas.Fk_Sucursal,
Especialidades.ID_Especialidad,Especialidades.Nombre_Especialidad,Sucursales_Campañas.ID_SucursalC, Sucursales_Campañas.Nombre_Sucursal FROM Especialistas,Especialidades,Sucursales_Campañas
 WHERE Especialistas.Especialidad = Especialidades.ID_Especialidad AND Especialistas.Fk_Sucursal =Sucursales_Campañas.ID_SucursalC  AND Especialistas.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="table-responsive">
	<table id="Especialistas" class="table ">
<thead>
	<th>Folio</th>
    <th>Nombre especialista</th>
	<th>Especialidad</th>
	<th>Sucursal</th>
	<th>Telefono</th>
	<th>Estatus</th>
	<th>Editar</th>
	


</thead>
<?php while ($Especialista=$query->fetch_array()):?>
<tr>
	<td><?php echo $Especialista["ID_Especialista"]; ?></td>
    <td><?php echo $Especialista["Nombre_Apellidos"]; ?></td>
	<td><?php echo $Especialista["Nombre_Especialidad"]; ?></td>
	<td><?php echo $Especialista["Nombre_Sucursal"]; ?></td>
	<td><?php echo $Especialista["Tel"]; ?></td>
	<td><button class="<?echo $Especialista['CodigoColorEs'];?>"><?php echo $Especialista["Estatus_Especialista"]; ?></button></td>
	
	

	
	<td>
		<button data-id="<?php echo $Especialista["ID_Especialista"];?>" class="btn-edit btn btn-info"><i class="far fa-edit"></i></button></td>
		
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
  		$.post("https://controlfarmacia.com/Controldecitas/Modales/EditaEspecialistaH.php","id="+id,function(data){
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