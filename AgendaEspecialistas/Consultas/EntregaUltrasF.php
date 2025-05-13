<script type="text/javascript">
$(document).ready( function () {
    $('#Ultras').DataTable({
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
$sql1="SELECT ID_resultado,Nombre_paciente,Telefono,ID_Sucursal,Estatus,Codigo_color FROM 
Resultados_Ultrasonidos where Estatus='Pendiente' order by ID_resultado DESC";

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  
  <div class="text-center">
	<div class="table-responsive">
	<table id="Ultras" class="table ">
<thead>
<th>Folio</th>
                <th>Nombre </th>
                <th>Telefono </th>
                <th>Estatus </th>
            <th>Descargas de pdf</th>
            <th>Whatsapp</th>
    	<th>Acciones</th>



</thead>
<?php while ($Ultras=$query->fetch_array()):
  $nombreSucursal = ($Ultras['ID_Sucursal'] === "TeaClinica") ? "Teabo Clinica" : $Ultras['ID_Sucursal'];  
?>
<tr>
	<td style="width:50px;" ><?php echo $Ultras["ID_resultado"]; ?></td>
	<td><?php echo $Ultras["Nombre_paciente"]; ?></td>
    <td><?php echo $Ultras["Telefono"]; ?></td>

    <td  > <button class="<?php echo $Ultras['Codigo_color'];?>"><?php echo $Ultras['Estatus'];?></button></td>
     <td><a class="btn btn-warning"  href="EntregaUltra?Nombre_paciente=<?php echo $Ultras["Nombre_paciente"]; ?>"><span class="far fa-file-pdf"></span><span class="hidden-xs"></span></a>
         <a class="btn btn-secondary" target="_blank" href="EntregaUltraM?Nombre_paciente=<?php echo $Ultras["Nombre_paciente"]; ?>"><span class="far fa-file-pdf"></span><span class="hidden-xs"></span></a>
        </td>
	<td>
    <a class="btn btn-success"  href="https://api.whatsapp.com/send?phone=+52<?php echo$Ultras['Telefono']; ?>&text=¡Hola, <?php echo $Ultras['Nombre_paciente']; ?> ✨,%20te enviamos tu ultrasonido realizado en Saluda Centro Médico Familiar <?php echo $nombreSucursal ?> ,quedamos atentos y te recordamos que contamos con farmacia, laboratorio, atención médica 24 horas, especialistas 😊 ¡Quedamos a tus órdenes! 🤗" target="_blank"><span class="fab fa-whatsapp"></span><span class="hidden-xs"></span></a>
    </td>
  <td>  <button data-id="<?php echo $Ultras["ID_resultado"];?>" class="btn-edit btn btn-info"><i class="far fa-edit"></i></button></td>
        
		
	
</tr>
<?php endwhile;?>
</table>
</div></div>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/AgendaDeCitas/Modales/EditaEstatusUltra.php","id="+id,function(data){
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
       
        <p id="show_error"  class="alert alert-danger" style="display: none">Algo salio mal </p>
        <div class="modal-body">
        <div id="form-edit"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->