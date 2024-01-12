<script type="text/javascript">
$(document).ready( function () {
    $('#GastosSucursales').DataTable({
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
$sql1="SELECT Otros_Gastos_POS.ID_Gastos,Otros_Gastos_POS.Concepto_Categoria,Otros_Gastos_POS.Importe_Total,Otros_Gastos_POS.Empleado,
Otros_Gastos_POS.Fk_sucursal,Otros_Gastos_POS.Descripcion,Otros_Gastos_POS.ID_H_O_D,
Categorias_Gastos_POS.Cat_Gasto_ID,Categorias_Gastos_POS.Nom_Cat_Gasto,SucursalesCorre.ID_SucursalC,
SucursalesCorre.Nombre_Sucursal FROM Otros_Gastos_POS,Categorias_Gastos_POS,SucursalesCorre 
where Otros_Gastos_POS.Concepto_Categoria = Categorias_Gastos_POS.Cat_Gasto_ID AND Otros_Gastos_POS.Fk_sucursal = SucursalesCorre.ID_SucursalC 
AND Otros_Gastos_POS.ID_H_O_D ='".$row['ID_H_O_D']."' AND Otros_Gastos_POS.Fk_sucursal='".$row['Fk_Sucursal']."'";


$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="GastosSucursales" class="table table-hover">
<thead>
<th>Folio</th>
<th>Concepto</th>
    <th>Importe</th>
    <th>Empleado</th>
   
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>


<td > <?php echo $Usuarios['ID_Gastos']; ?></td>
<td > <?php echo $Usuarios['Nom_Cat_Gasto']; ?></td>
  <td > <?php echo $Usuarios['Importe_Total']; ?></td>
  <td > <?php echo $Usuarios['Empleado']; ?></td>
  

  
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay GastosSucursales registrados para <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-editStock").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/EditaStatusStock.php","id="+id,function(data){
  			$("#form-editGastosSucursalesA").html(data);
          $("#TituloGastosSucursalesA").html("Asignacion de GastosSucursales en otras sucursales");
              $("#DiGastosSucursalesSA").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiGastosSucursalesSA").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiGastosSucursalesSA").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#DiGastosSucursalesSA").addClass("modal-dialog  modal-notify modal-success");
  		});
  		$('#editModalGastosSucursalesA').modal('show');
  	});
    
  </script>
  <div class="modal fade" id="editModalGastosSucursalesA" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="DiGastosSucursalesSA"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloGastosSucursalesA"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="MensajeGastosSucursalesG"class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold">Estimado usuario, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editGastosSucursalesA"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->