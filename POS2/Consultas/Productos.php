<script type="text/javascript">
$(document).ready( function () {
    $('#Productos').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[50,100,500, -1], [50,100,500, "Todos"]],   
      "language": {
        "url": "Componentes/Spanish.json"
		},
 
 
		
	  } 
	  
	  );
} );
</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT Productos_POS.ID_Prod_POS,Productos_POS.Nombre_Prod,Productos_POS.Fk_sucursal,
Productos_POS.Proveedor1,Productos_POS.Proveedor2,Productos_POS.Estatus,Productos_POS.CodigoEstatus,
Productos_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Productos_POS,SucursalesCorre 
WHERE Productos_POS.Fk_sucursal= SucursalesCorre.ID_SucursalC  AND Productos_POS.Fk_sucursal='".$row['Fk_Sucursal']."'  AND Productos_POS.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="Productos" class="table table-hover">
<thead>


    <th>Nombre producto</th>
    <th>Proveedor </th>
<th>Sucursal</th>
<th>Estatus</th>
	<th >Accciones</th>
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>
 
  <td > <?php echo $Usuarios['Nombre_Prod']; ?></td>
  <td > <?php echo $Usuarios['Proveedor1']; ?> <br>
  <?php echo $Usuarios['Proveedor2']; ?>
  </td>
  
  <td > <?php echo $Usuarios['Nombre_Sucursal']; ?></td>
  <td >  <button class="btn btn-default btn-sm" style=<?if($resultado['autorizado'] == 1){
   echo "Autorizado";
} elseif($resultado['autorizado'] == 2) {
   echo "Pendiente";
}else {
   echo "No autorizado";
}
?>><?php echo $Usuarios["Estatus"]; ?></button> </td>
    <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary  dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo  $Usuarios["ID_Prod_POS"];?>" class="btn-edit  dropdown-item" >Añadir en stock <i class="fas fa-paste"></i></a>
<a data-id="<?php echo $Usuarios["ID_Prod_POS"];?>" class="btn-edit2 dropdown-item" >Editar datos <i class="fas fa-pencil-alt"></i></a>
  <a data-id="<?php echo $Usuarios["ID_Prod_POS"];?>" class="btn-edit3 dropdown-item" >Detalles <i class="fas fa-info-circle"></i></a>
 
 
 
</div>
<!-- Basic dropdown -->
	 </td>
	
		
</tr>
<?php endwhile;?>
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