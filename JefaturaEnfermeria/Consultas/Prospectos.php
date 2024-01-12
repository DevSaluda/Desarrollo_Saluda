<script type="text/javascript">
$(document).ready( function () {
    $('#Prospectos').DataTable({
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
$sql1="SELECT * FROM Proveedores_POS WHERE ID_H_O_D='".$row['ID_H_O_D']."' AND  Estatus = 'Prospecto' ORDER BY `ID_Proveedor` DESC";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="Prospectos" class="table table-hover">
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
<a data-id="<?php echo  $Usuarios["ID_Proveedor"];?>" class="btn-edit4 dropdown-item" >Datos de contacto <i class="fas fa-address-card"></i></a>
<a data-id="<?php echo $Usuarios["ID_Proveedor"];?>" class="btn-edit5 dropdown-item" >Asignar como proveedor <i class="fas fa-pencil-alt"></i></a>
  <a data-id="<?php echo $Usuarios["ID_Proveedor"];?>" class="btn-edit6 dropdown-item" >Detalles <i class="fas fa-info-circle"></i></a>
  <a data-id="<?php echo $Usuarios["ID_Proveedor"];?>" class="btn-historialPros dropdown-item" >Movimientos <i class="fas fa-history"></i></a>
 
 
 
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
  	$(".btn-edit4").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/JefaturaEnfermeria/Modales/ContactoProveedor.php","id="+id,function(data){
  			$("#form-edit2").html(data);
          $("#Titulo2").html("Medios disponibles para contactar al proveedor");
              $("#Di2").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di2").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di2").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#Di2").removeClass("modal-dialog modal-lg modal-notify modal-success");
              $("#Di2").addClass("modal-dialog  modal-notify modal-info");
  		});
  		$('#editModal2').modal('show');
  	});
    $(".btn-edit5").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/JefaturaEnfermeria/Modales/EditaProspecto.php","id="+id,function(data){
              $("#form-edit2").html(data);
              $("#Titulo2").html("Asignacion como nuevo proveedor");
              $("#Di2").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di2").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di2").addClass("modal-dialog modal-lg modal-notify modal-success");
  		});
  		$('#editModal2').modal('show');
    });
    $(".btn-edit6").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/JefaturaEnfermeria/Modales/DetallesProspecto.php","id="+id,function(data){
              $("#form-edit2").html(data);
              $("#Titulo2").html("Detalles de proveedor");
              $("#Di2").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di2").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di2").removeClass("modal-dialog modal-lg modal-notify modal-success");
              $("#Di2").addClass("modal-dialog modal-lg modal-notify modal-primary");

  		});
  		$('#editModal2').modal('show');
    });
    $(".btn-historialPros").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/JefaturaEnfermeria/Modales/HistorialProspectos.php","id="+id,function(data){
              $("#form-edit2").html(data);
              $("#Titulo2").html("Editar datos de empleado");
              $("#Di2").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di2").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di2").removeClass("modal-dialog modal-lg modal-notify modal-success");
              $("#Di2").addClass("modal-dialog modal-xl modal-notify modal-primary");
  		});
  		$('#editModal2').modal('show');
    });
  </script>
  <div class="modal fade" id="editModal2" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di2"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo2"></p>

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
        <div id="form-edit2"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->