<script type="text/javascript">
$(document).ready( function () {
    $('#Especialidades').DataTable({
	
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
$sql1="SELECT Especialidades.ID_Especialidad,Especialidades.Nombre_Especialidad,Especialidades.Fk_Sucursal,
Especialidades.ID_H_O_D,Especialidades.Estatus_Especialidad,Especialidades.Codigocolor,
Sucursales_Campañas.ID_SucursalC,Sucursales_Campañas.Nombre_Sucursal 
FROM Especialidades,Sucursales_Campañas WHERE Especialidades.Fk_Sucursal = Sucursales_Campañas.ID_SucursalC AND Especialidades.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="table-responsive">
	<table id="Especialidades" class="table ">
<thead>
	<th>Folio</th>
	<th>Sucursal</th>
	<th>Especialidad</th>
	<th>Estatus</th>
	<th>Editar</th>
	


</thead>
<?php while ($r=$query->fetch_array()):?>
<tr>
	<td><?php echo $r["ID_Especialidad"]; ?></td>
	<td><?php echo $r["Nombre_Sucursal"]; ?></td>
	<td><?php echo $r["Nombre_Especialidad"]; ?></td>
	<td><button class="<?echo $r['Codigocolor'];?>"><?php echo $r["Estatus_Especialidad"]; ?></button></td>
	

	
	<td>
		<button data-id="<?php echo $r["ID_Especialidad"];?>" class="btn-edit btn btn-info"><i class="far fa-edit"></i></button></td>
		
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
  		$.post("https://controlfarmacia.com/Controldecitas/Modales/EditaEspecialidadH.php","id="+id,function(data){
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
		<span id="error_actualiza" class="alert alert-danger" style="display: none"></span>
	

        <p id="show_error"  class="alert alert-danger" style="display: none">No se puede completar la acción, por favor intenta de nuevo</p>
        <div class="modal-body">
        <div id="form-edit"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->