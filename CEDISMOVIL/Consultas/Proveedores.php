<script type="text/javascript">
$(document).ready( function () {
    $('#Empleados').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[10,50,200, -1], [10,50,200, "Todos"]],   
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
$sql1="SELECT * FROM Proveedores_POS WHERE ID_H_O_D='".$row['ID_H_O_D']."' AND  Estatus != 'Prospecto' ORDER BY `ID_Proveedor` DESC";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="Empleados" class="table table-hover">
<thead>
  <th>Folio proveedor</th>

    <th>Nombre proveedor</th>
    <th>Clave </th>
   
    

<th>Vigencia</th>

	<th >Accciones</th>
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>
<td > <?php echo $Usuarios["ID_Proveedor"]; ?></td>
 
  <td > <?php echo $Usuarios["Nombre_Proveedor"]; ?></td>
  <td > <?php echo $Usuarios["Clave_Proveedor"]; ?></td>
    
      <td> <button style="<?echo $Usuarios['CodigoEstatus'];?>" class="btn btn-default btn-sm" > <?php echo $Usuarios["Estatus"]; ?></button></td>
    <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo  $Usuarios["ID_Proveedor"];?>" class="btn-edit dropdown-item" >Datos de contacto <i class="fas fa-address-card"></i></a>
<a data-id="<?php echo $Usuarios["ID_Proveedor"];?>" class="btn-edit2 dropdown-item" >Editar datos <i class="fas fa-pencil-alt"></i></a>
  <a data-id="<?php echo $Usuarios["ID_Proveedor"];?>" class="btn-edit3 dropdown-item" >Detalles <i class="fas fa-info-circle"></i></a>

<a data-id="<?php echo $Usuarios["ID_Proveedor"];?>" class="btn-historial dropdown-item" >Movimientos <i class="fas fa-history"></i></a>
 
 
</div>
<!-- Basic dropdown -->
	 </td>
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay proveedores registrados para <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/CEDIS/Modales/ContactoProveedor.php","id="+id,function(data){
  			$("#form-edit").html(data);
          $("#Titulo").html("Medios disponibles para contactar al proveedor");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#Di").addClass("modal-dialog  modal-notify modal-info");
  		});
  		$('#editModal').modal('show');
  	});
    $(".btn-edit2").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/CEDIS/Modales/EditaProveedor.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Editar datos de empleado");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
    });
    $(".btn-edit3").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/CEDIS/Modales/DetallesProveedor.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Detalles de proveedor");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
    });
    $(".btn-historial").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/CEDIS/Modales/HistorialProveedores.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Editar datos de empleado");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").addClass("modal-dialog modal-xl modal-notify modal-primary");
  		});
  		$('#editModal').modal('show');
    });
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold">Estimado usuario, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-edit"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->