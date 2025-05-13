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
$sql1="SELECT Fechas_EspecialistasV2.ID_Fecha_Esp,Fechas_EspecialistasV2.Fecha_Disponibilidad,Fechas_EspecialistasV2.ID_H_O_D, 
Fechas_EspecialistasV2.FK_Especialista,Fechas_EspecialistasV2.Estatus_fecha,Fechas_EspecialistasV2.CodigoColorFe,
EspecialistasV2.ID_Especialista,EspecialistasV2.Nombre_Apellidos 
FROM Fechas_EspecialistasV2,EspecialistasV2 WHERE 
Fechas_EspecialistasV2.FK_Especialista = EspecialistasV2.ID_Especialista AND Fechas_EspecialistasV2.Estatus_fecha = 'Vencido' AND 
Fechas_EspecialistasV2.ID_H_O_D='".$row['ID_H_O_D']."'";
 

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
    	<div class="table-responsive">
	<table id="Fechas" class="table table-hover">
<thead>
	<th>Folio</th>
    <th>Nombre especialista</th>
	<th>Fecha</th>
	<th>Estatus</th>
	
	


</thead>
<?php while ($Fecha=$query->fetch_array()):?>
<tr>
	<td><?php echo $Fecha["ID_Fecha_Esp"]; ?></td>
    <td><?php echo $Fecha["Nombre_Apellidos"]; ?></td>
    <td><?php echo $Fecha["Fecha_Disponibilidad"]; ?></td>
	
	<td><button class="btn btn-default btn-sm" style="<?echo $Fecha['CodigoColorFe'];?>"><?php echo $Fecha["Estatus_fecha"]; ?></button></td>


		

		
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
  		$.post("https://controlfarmacia.com/ControldecitasV2/Modales/EditaFecha.php","id="+id,function(data){
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