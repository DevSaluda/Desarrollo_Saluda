<script type="text/javascript">
$(document).ready( function () {
    $('#Ventasday').DataTable({
      "order": [[ 0, "desc" ]],
      "info": false,
      "lengthMenu": [[10,50,200, -1], [10,50,200, "Todos"]],   
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
$sql1="SELECT Ventas_POS.Folio_Ticket,Ventas_POS.Fk_Caja,Ventas_POS.Venta_POS_ID,Ventas_POS.Identificador_tipo,Ventas_POS.Cod_Barra,Ventas_POS.Clave_adicional,
Ventas_POS.Nombre_Prod,Ventas_POS.Cantidad_Venta,Ventas_POS.Fk_sucursal,Ventas_POS.AgregadoPor,Ventas_POS.AgregadoEl,
Ventas_POS.Total_Venta,Ventas_POS.Lote,Ventas_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM 
Ventas_POS,SucursalesCorre WHERE Ventas_POS.Fk_sucursal= SucursalesCorre.ID_SucursalC 
AND Ventas_POS.ID_H_O_D ='".$row['ID_H_O_D']."' GROUP BY (Ventas_POS.Folio_Ticket)";
$query = $conn->query($sql1);
?>

<!-- Central Modal Medium Info -->
<div class="modal fade" id="VentasProd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-="true" style="overflow-y: scroll;">
   <div class="modal-dialog modal-xl modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Cajas abiertas</p>

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
	<table  id="Ventasday" class="table table-hover">
<thead>


<th>N° Ticket</th>
<th>Fecha | Hora</th>
    <th>Vendedor</th>
    
    


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



    <td><?php echo $Usuarios["Folio_Ticket"]; ?></td>
    

      <td><?php echo fechaCastellano($Usuarios["AgregadoEl"]); ?> <br>
      <?php echo date("g:i a",strtotime($Usuarios["AgregadoEl"])); ?>
    </td>
    <td><?php echo $Usuarios["AgregadoPor"]; ?></button></td>
   
     
      
   
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">No hay caja abierta</p>
<?php endif;?>                

  
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 </div>

