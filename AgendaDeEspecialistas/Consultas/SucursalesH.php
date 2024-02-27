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
$sql1="SELECT * FROM Sucursales_CampañasV2 WHERE Estatus_Sucursal = 'Vencido' AND ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="text-center">
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

	<td><button class="btn btn-default btn-sm" style="<?echo $Sucursales['Color_Sucursal'];?>"><?php echo $Sucursales["Estatus_Sucursal"]; ?></button></td>
	

	
	<td>
		<button data-id="<?php echo $Sucursales["ID_SucursalC"];?>" class="btn-edit btn btn-success"><i class="fas fa-check-circle"></i></button></td>
		
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
  		$.post("https://controlfarmacia.com/ControldecitasV2/Modales/EditaSucursalH.php","id="+id,function(data){
  			$("#form-edit").html(data);
  		});
  		$('#editModal').modal('show');
  	});
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-info">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Cambio de vigencia en sucursales</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario, </span>
                            Antes de continuar verifiqué la información a la cual se aplicaran cambios
                          
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
        <div class="modal-body">
        <div id="form-edit"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->