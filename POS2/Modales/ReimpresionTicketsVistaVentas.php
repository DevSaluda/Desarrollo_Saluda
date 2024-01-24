<script type="text/javascript">
$(document).ready( function () {
    $('#ReimprimirTickets').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[10,100,500, -1], [10,100,500, "Todos"]],   
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


$user_id=null;
$sql1="SELECT Ventas_POS.Folio_Ticket,Ventas_POS.Fk_Caja,Ventas_POS.Venta_POS_ID,Ventas_POS.Identificador_tipo,Ventas_POS.Cod_Barra,Ventas_POS.Clave_adicional,
Ventas_POS.Nombre_Prod,Ventas_POS.Cantidad_Venta,Ventas_POS.Fk_sucursal,Ventas_POS.AgregadoPor,Ventas_POS.AgregadoEl,
Ventas_POS.Total_Venta,Ventas_POS.Lote,Ventas_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM 
Ventas_POS,SucursalesCorre WHERE Ventas_POS.Fk_sucursal= SucursalesCorre.ID_SucursalC AND Ventas_POS.Fk_sucursal='".$row['Fk_Sucursal']."' 
AND Ventas_POS.ID_H_O_D ='".$row['ID_H_O_D']."' GROUP BY (Ventas_POS.Folio_Ticket) ";
$query = $conn->query($sql1);
?>

<!-- Central Modal Medium Info -->
<div class="modal fade" id="ReimprimeVentas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-="true" style="overflow-y: scroll;">
   <div class="modal-dialog modal-xl modal-notify modal-info" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Tickets de venta</p>

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
	<table  id="ReimprimirTickets" class="table table-hover">
<thead>


<th>N° Ticket</th>
<th>Fecha | Hora</th>
    <th>Vendedor</th>
    <th>Acciones</th>
    


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



    <td><?php echo $Usuarios["Folio_Ticket"]; ?></td>
    

      <td><?php echo fechaCastellano($Usuarios["AgregadoEl"]); ?> <br>
      <?php echo date("g:i a",strtotime($Usuarios["AgregadoEl"])); ?>
    </td>
    <td><?php echo $Usuarios["AgregadoPor"]; ?></button></td>
    <td>
    <a data-id="<?php echo $Usuarios["Folio_Ticket"];?>" class="btn-Reimpresion btn btn-info" ><i class="fas fa-print"></i></a> 
	 </td>
     
      
   
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay StockSucursales registrados para <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
<script>
  

$(".btn-Reimpresion").click(function(){
    id = $(this).data("id");
    $.post("https://saludapos.com/POS2/Modales/ReimpresionTicketVenta.php","id="+id,function(data){
        $("#FormCancelacion").html(data);
        $("#TituloCancelacion").html("Editar datos de categoría");
        $("#Di3").removeClass("modal-dialog modal-lg modal-notify modal-info");
        $("#Di3").removeClass("modal-dialog modal-xl modal-notify modal-primary");
        $("#Di3").addClass("modal-dialog modal-xl modal-notify modal-success");
        var modal_lv = 0;
          $('.modal').on('shown.bs.modal', function (e) {
            $('.modal-backdrop:last').css('zIndex', 1051 + modal_lv);
            $(e.currentTarget).css('zIndex', 1052 + modal_lv);
            modal_lv++
          });

          $('.modal').on('hidden.bs.modal', function (e) {
            modal_lv--
          });
    });
    $('#Reimpresion').modal('show');
});
</script>
                                      
<div class="modal fade" id="Reimpresion" tabindex="-2" role="dialog" style="overflow-y: scroll;" aria-labelledby="ReimpresionLabel" aria-hidden="true">
  <div id="Di3" class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloCancelacion">Confirmacion de ticket</p>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
	        <div class="modal-body">
          <div class="text-center">
        <div id="FormCancelacion"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>   </div>
 </div>
 </div>





 