<script type="text/javascript">
$(document).ready( function () {
    $('#Empleados').DataTable({
      "order": [[ 0, "desc" ]],
      "language": {
        "url": "Componentes/Spanish.json"
		}
		
	  } 
	  
	  );
} );
</script>
<?php
header("Acces-Control-Allow-Origin: *"); 
include("db_connection.php"); 
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT * FROM SucursalesCorre WHERE ID_H_O_D= '".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="Empleados" class="table table-hover">
<thead>
  <th>ID/FOLIO</th>

    <th>Sucursal</th>
    <th>Telefono</th>



	<th >Accciones</th>
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>
<td > <?php echo $Usuarios["ID_SucursalC"]; ?></td>
  
    <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
    <td><?php echo $Usuarios["Telefono"]; ?></td>
    
    <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo $Usuarios["ID_SucursalC"];?>" class="btn-edit2 dropdown-item" >Editar datos <i class="fas fa-pencil-alt"></i></a>
<a data-id="<?php echo $Usuarios["ID_SucursalC"];?>" class="btn-Historial dropdown-item" >Historial <i class="fas fa-history"></i></a>
 
</div>
<!-- Basic dropdown -->
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
  
    $(".btn-edit2").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/EditaSucursal.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Editar datos de empleado");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di").removeClass("modal-dialog  modal-notify modal-primary");
              $("#Di").addClass("modal-dialog  modal-notify modal-primary");

              
  		});
  		$('#editModal').modal('show');
    });

    $(".btn-Historial").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/HistorialSucursales.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Historial datos de empleado");
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