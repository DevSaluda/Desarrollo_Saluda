<script type="text/javascript">
$(document).ready( function () {
    $('#Tiposdemobiliarios').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[20,30,100, -1], [20,30,100, "Todos"]],   
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
$sql1="SELECT * FROM `Tipos_Mobiliarios_POS` WHERE ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="Tiposdemobiliarios" class="table table-hover">
<thead>

<th>Folio</th>
    <th>Nombre de tipo</th>
    
<th>Estatus</th>
	<th >Accciones</th>
	


</thead>
<?php while ($TiposProd=$query->fetch_array()):?>
<tr>
<td > <?php echo $TiposProd['Tip_Mob_ID']; ?></td>
  <td > <?php echo $TiposProd['Nom_Tip_Mob']; ?></td>
  <td >  <button class="btn btn-default btn-sm" style="<?echo $TiposProd['Cod_Estado'];?>"><?php echo $TiposProd["Estado"]; ?></button> </td>
    <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary  dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo $TiposProd["Tip_Mob_ID"];?>" class="btn-editProd dropdown-item" >Editar datos <i class="fas fa-pencil-alt"></i></a>
  <a data-id="<?php echo $TiposProd["Tip_Mob_ID"];?>" class="btn-editDetailProd dropdown-item" >Detalles <i class="fas fa-info-circle"></i></a>
  <a data-id="<?php echo $TiposProd["Tip_Mob_ID"];?>" class="btn-historialTiPoProd dropdown-item">Movimientos <i class="fas fa-history"></i></a>
 
 
 
</div>
<!-- Basic dropdown -->
	 </td>
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay tipos productos registrados para <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-editProd").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/EditaTipoMobiliario.php","id="+id,function(data){
  			$("#form-editTPMB").html(data);
          $("#TituloTPMB").html("Editar productos");
              $("#DiTPMB").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiTPMB").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiTPMB").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#DiTPMB").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#DiTPMB").addClass("modal-dialog  modal-notify modal-info");
  		});
  		$('#editModalTPMB').modal('show');
  	});
    $(".btn-editDetailProd").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/DetalleTipoProducto.php","id="+id,function(data){
              $("#form-editTPMB").html(data);
              $("#TituloTPMB").html("Detalles del producto");
              $("#DiTPMB").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiTPMB").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiTPMB").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#DiTPMB").addClass("modal-dialog  modal-notify modal-primary");
  		});
  		$('#editModalTPMB').modal('show');
    });

    $(".btn-historialTiPoProd").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/HistorialTiposProducto.php","id="+id,function(data){
              $("#form-editTPMB").html(data);
              $("#TituloTPMB").html("Historial de movimientos");
              $("#DiTPMB").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiTPMB").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiTPMB").addClass("modal-dialog modal-xl modal-notify modal-primary");
  		});
  		$('#editModalTPMB').modal('show');
    });
  </script>
  <div class="modal fade" id="editModalTPMB" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="DiTPMB"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloTPMB"></p>

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
        <div id="form-editTPMB"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->