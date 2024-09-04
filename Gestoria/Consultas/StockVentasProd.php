


<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT * FROM Stock_POS WHERE ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="Productos" class="table table-hover">
<thead>
<tr>

    <th>Cod barra</th>
    <th>Nombre producto </th>
<th>Precio</th>
<th>Lote</th>

	

    </tr>
</thead>
<tbody class="BusquedaRapida">
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>
 
  <td > <?php echo $Usuarios['Cod_Barra']; ?></td>
  <td > <?php echo $Usuarios['Nombre_Prod']; ?> </td>
  <td><?php echo $Usuarios['Precio_Venta']; ?></td>
  <td> <?php echo $Usuarios['Lote']; ?></td>
  
  
		
</tr>
<?php endwhile;?>
</tbody>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay productos registrados para <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/POS2/Modales/AñadeAlStock.php","id="+id,function(data){
  			$("#form-editProductosG").html(data);
          $("#TituloProductosG").html("Añadir productos al stock");
              $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#DiProductosG").addClass("modal-dialog  modal-lg modal-notify modal-success");
  		});
  		$('#editModalProductosG').modal('show');
  	});
    $(".btn-edit2").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/POS2/Modales/DetalleProducto.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Detalles del producto");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
    });
  </script>
  <div class="modal fade" id="editModalProductosG" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="DiProductosG"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloProductosG"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="MensajeProductosG"class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold">Estimado usuario, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editProductosG"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->