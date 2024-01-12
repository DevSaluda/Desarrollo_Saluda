<script type="text/javascript">
$(document).ready( function () {
    $('#TPersonal').DataTable({
      "lengthMenu": [[10,50,200, -1], [10,50,200, "Todos"]],   
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
$sql1="SELECT * FROM Datos_Generales_Personal where ID_H_O_D='".$row['ID_H_O_D']."' ORDER BY ID_Personal DESC";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table style="width:100%" id="TPersonal" class="table table-hover">
<thead>

    <th>Nombre y Apellidos</th>
    <th>Curp</th>
    <th>Sexo</th>
    <th>Correo</th>
    <th>Telefono</th>
	<th >Accciones</th>
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>
  <td > <?php echo $Usuarios["Nombre_Apellidos"]; ?></td>
    <td><?php echo $Usuarios["Curp"]; ?></td>
    <td><?php echo $Usuarios["Sexo"]; ?></td>
    <td><?php echo $Usuarios["Correo_Electronico"]; ?></td>
    <td><?php echo $Usuarios["Telefono"]; ?></td>
  
   
    
	<td style="width:200px;" >
		<button data-id="<?php echo $Usuarios["ID_Personal"];?>" class="btn-edit btn btn-info btn-sm"><i class="far fa-edit"></i></button>
    <button data-id="<?php echo $Usuarios["ID_Personal"];?>" class="btn-edit btn btn-info btn-sm"><i class="far fa-edit"></i></button>
    </td>
		
</tr>
<?php endwhile;?>
</table>
</div>
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