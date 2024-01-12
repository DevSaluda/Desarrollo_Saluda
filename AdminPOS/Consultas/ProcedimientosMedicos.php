<script type="text/javascript">
$(document).ready( function () {
    $('#StockSucursales').DataTable({
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
$sql1="SELECT * FROM Procedimientos_Medicos WHERE ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="StockSucursales" class="table table-hover">
<thead>

<th>Folio</th>
    <th>Codigo procedimiento</th>
    <th>Nombre del procedimiento </th>
    <th>Costo del procedimiento </th>
    <th>Acciones </th>
    
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



<td > <?php echo $Usuarios['ID_Proce']; ?></td>
  <td > <?php echo $Usuarios['Codigo_Procedimiento']; ?></td>
  <td > <?php echo $Usuarios['Nombre_Procedimiento']; ?></td>
  <td > $ <?php echo $Usuarios['Costo_Procedimiento']; ?></td>
 
    <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary btn-sm dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">

<a data-id="<?php echo $Usuarios["ID_Proce"];?>" class="btn-editStock dropdown-item" >Actualizar <i class="fas fa-edit"></i></a>
<a data-id="<?php echo $Usuarios["ID_Proce"];?>" class="btn-EliminaProcedimiento dropdown-item" >Eliminar <i class="fas fa-trash"></i></a>
<a data-id="<?php echo $Usuarios["ID_Proce"];?>" class="btn-HistorialStocksucursaless dropdown-item" >Movimientos <i class="fas fa-history"></i></a>
 
</div>
<!-- Basic dropdown -->
	 </td>
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay Stock Sucursales registrados para <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  <script>


  	$(".btn-editStock").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/ActualizaProcedimiento.php","id="+id,function(data){
  			$("#form-editStockSucursalesA").html(data);
          $("#TituloStockSucursalesA").html("Actualizar datos de procedimiento");
              $("#DiStockSucursalesSA").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiStockSucursalesSA").removeClass("modal-dialog  modal-primary modal-success");
              $("#DiStockSucursalesSA").removeClass("modal-dialog modal-xl modal-notify modal-success");
              $("#DiStockSucursalesSA").removeClass("modal-dialog modal-sm modal-notify modal-warning");
              $("#DiStockSucursalesSA").addClass("modal-dialog  modal-notify modal-success");
  		});
  		$('#editModalStockSucursalesA').modal('show');
  	});

    $(".btn-HistorialStocksucursaless").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/HistorialProcedimiento.php","id="+id,function(data){
  			$("#form-editStockSucursalesA").html(data);
          $("#TituloStockSucursalesA").html("Movimientos de productos");
              $("#DiStockSucursalesSA").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiStockSucursalesSA").removeClass("modal-dialog  modal-notify modal-success");
              $("#DiStockSucursalesSA").removeClass("modal-dialog  modal-primary modal-success");
              $("#DiStockSucursalesSA").addClass("modal-dialog modal-xl modal-notify modal-success");
  		});
  		$('#editModalStockSucursalesA').modal('show');
  	});

      $(".btn-EliminaProcedimiento").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/EliminaProcedimiento.php","id="+id,function(data){
  			$("#form-editStockSucursalesA").html(data);
          $("#TituloStockSucursalesA").html("Eliminar procedimiento");
              $("#DiStockSucursalesSA").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiStockSucursalesSA").removeClass("modal-dialog  modal-notify modal-success");
              $("#DiStockSucursalesSA").removeClass("modal-dialog  modal-primary modal-success");
              $("#DiStockSucursalesSA").addClass("modal-dialog modal-sm modal-notify modal-warning");
  		});
  		$('#editModalStockSucursalesA').modal('show');
  	});

  </script>
  <div class="modal fade" id="editModalStockSucursalesA" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="DiStockSucursalesSA"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloStockSucursalesA"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="MensajeStockSucursalesG"class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold">Estimado usuario, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editStockSucursalesA"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->