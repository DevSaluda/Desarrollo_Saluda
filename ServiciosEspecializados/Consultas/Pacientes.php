<script type="text/javascript">
$(document).ready( function () {
    $('#Pacientes').DataTable({
         "order": [[ 0, "desc" ]],
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
      } );
} );
</script>
<?php

include("db_connection.php");


$user_id=null;
$sql1="SELECT ID_resultado,Nombre_paciente,Telefono,ID_Sucursal FROM Resultados_Ultrasonidos order by ID_resultado DESC";

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
	<div class="table-responsive">
	<table id="Pacientes" class="table ">
<thead>
<th>Folio</th>
                <th>Nombre </th>
                <th>Telefono </th>
                <th>Sucursales </th>
        <th>Editar</th>
        <th>Sube ultra</th>
        


</thead>
<?php while ($Ultras=$query->fetch_array()):?>
<tr>
	<td><?php echo $Ultras["ID_resultado"]; ?></td>
	<td><?php echo $Ultras["Nombre_paciente"]; ?></td>
    <td><?php echo $Ultras["Telefono"]; ?></td>
    <td><?php echo $Ultras["ID_Sucursal"]; ?></td>

   
  <td>  <button data-id="<?php echo $Ultras["ID_resultado"];?>" class="btn-edit btn btn-info"><i class="far fa-edit"></i></button></td>
  <td>  <button data-id="<?php echo $Ultras["ID_resultado"];?>" class="btn-edit2 btn btn-success"><i class="fas fa-upload"></i></button></td>
  
             
		
	
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
  		$.post("https://saludapos.com/ServiciosEspecializados/Modales/EditaEstatusUltra.php","id="+id,function(data){
  			$("#form-edit").html(data);
  		});
  		$('#editModal').modal('show');
      });
      $(".btn-edit2").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/ServiciosEspecializados/Modales/SubirUltras.php","id="+id,function(data){
  			$("#form-edit2").html(data);
  		});
  		$('#sube').modal('show');
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

  <div class="modal fade" id="sube" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
        <div id="form-edit2"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->