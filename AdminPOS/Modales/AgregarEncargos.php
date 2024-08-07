<script type="text/javascript">
$(document).ready(function() {
    $('#StockSucursales').DataTable({
        "order": [[ 0, "desc" ]],
        "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "Todos"]],
        "language": {
            "url": "Componentes/Spanish.json"
        }
    });
});
</script>

<?php

include("Consultas/db_connection.php");
include "Consultas/Consultas.php";

$user_id = null;
$sql1 = "SELECT 
        Encargos_POS.Id_Encargo,
        Encargos_POS.IdentificadorEncargo,
        Encargos_POS.Cod_Barra,
        Encargos_POS.Nombre_Prod,
        Encargos_POS.Fk_sucursal,
        Encargos_POS.MetodoDePago,
        Encargos_POS.MontoAbonado,
        Encargos_POS.Precio_Venta,
        Encargos_POS.Precio_C,
        Encargos_POS.Cantidad,
        Encargos_POS.Fecha_Ingreso,
        Encargos_POS.FkPresentacion,
        Encargos_POS.Fk_Caja,
        Encargos_POS.Proveedor1,
        Encargos_POS.Proveedor2,
        Encargos_POS.AgregadoPor,
        Encargos_POS.AgregadoEl,
        Encargos_POS.ID_H_O_D,
        Encargos_POS.Estado,
        Encargos_POS.TipoEncargo,
        SucursalesCorre.ID_SucursalC,
        SucursalesCorre.Nombre_Sucursal
    FROM 
        Encargos_POS
    INNER JOIN 
        SucursalesCorre ON Encargos_POS.Fk_sucursal = SucursalesCorre.ID_SucursalC";
$query = $conn->query($sql1);
?>

<!-- Central Modal Medium Info -->
<div class="modal fade" id="MuestraEncargos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow-y: scroll;">
   <div class="modal-dialog modal-xl modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Consulta de producto</p>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <?php if($query->num_rows > 0): ?>
           <div class="text-center">
             <div class="table-responsive">
               <table id="StockSucursales" class="table table-hover">
                 <thead>
                   <th>Cod barra</th>
                   <th>Nombre producto</th>
                   <th>Sucursal</th>
                   <th>Piezas</th>
                
                   <th>Solicitado por</th>
                 </thead>
                 <tbody>
                   <?php while ($encargo = $query->fetch_array()): ?>
                   <tr>
                     <td><?php echo $encargo['Cod_Barra']; ?></td>
                     <td><?php echo $encargo['Nombre_Prod']; ?></td>
                     <td><?php echo $encargo['Cantidad']; ?></td>
                     <td>$ <?php echo $encargo['AgregadoPor']; ?></td>
                   </tr>
                   <?php endwhile; ?>
                 </tbody>
               </table>
             </div>
           </div>
           <?php else: ?>
           <p class="alert alert-warning">Aún no hay encargos registrados para <?php echo $row['ID_H_O_D']; ?></p>
           <?php endif; ?>
         </div>
       </div>
       <!--/.Content-->
     </div>
   </div>
</div>
