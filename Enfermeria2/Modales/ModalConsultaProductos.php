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

include("Consultas/db_connection.php");
include "Consultas/Consultas.php";


$user_id=null;
$sql1="SELECT Stock_POS.Folio_Prod_Stock,Stock_POS.Clave_adicional,Stock_POS.Cod_Barra,Stock_POS.Nombre_Prod,Stock_POS.Fk_sucursal,Stock_POS.Max_Existencia,Stock_POS.Min_Existencia,
Stock_POS.Existencias_R,Stock_POS.Proveedor1,Stock_POS.Precio_Venta,Stock_POS.Proveedor2,Stock_POS.CodigoEstatus,Stock_POS.Estatus,Stock_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal
FROM Stock_POS,SucursalesCorre WHERE Stock_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND Stock_POS.Fk_Sucursal='".$row['Fk_Sucursal']."' AND Stock_POS.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<!-- Central Modal Medium Info -->
<div class="modal fade" id="ConsultaProductos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-="true" style="overflow-y: scroll;">
   <div class="modal-dialog modal-xl modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Consulta de producto</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-="true" class="white-text">&times;</span>
         </button>
       </div>
     
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
       
         <?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="StockSucursales" class="table table-hover">
<thead>

<th>Clave</th>
    <th>Nombre producto</th>
    <th>Proveedor </th>
    <!-- <th>Stock </th> -->
    <th>Precio de venta</th>
 
	
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>
<td > <?php echo $Usuarios['Cod_Barra']; ?></td>
  <td > <?php echo $Usuarios['Nombre_Prod']; ?></td>
  <td > <?php echo $Usuarios['Proveedor1']; ?> <br>
  <?php echo $Usuarios['Proveedor2']; ?>
  </td>
  <!-- <td > <?php echo $Usuarios['Existencias_R']; ?></td> -->
  <td > $ <?php echo $Usuarios['Precio_Venta']; ?></td>
 
 
  
 

   
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay StockSucursales registrados para <?php echo $row['ID_H_O_D']?></p>
<?php endif;?>
 
                                      
         
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>


 