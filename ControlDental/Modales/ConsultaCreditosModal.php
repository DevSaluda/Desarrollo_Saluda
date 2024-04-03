<script type="text/javascript">
$(document).ready( function () {
    $('#CreditosDisponibles').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[25,50, 150, 200, -1], [25,50, 150, 200, "Todos"]],   
        language: {
            "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
          
        //para usar los botones   
        responsive: "true",
          dom: "<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>'",
       
          
            
        
     	        
    });  
   
});
   
	  
	 
</script>
<?php
include("Consultas/db_connection.php");
include "Consultas/Consultas.php";
$user_id=null;
$sql1="SELECT Creditos_POS.Folio_Credito,Creditos_POS.Fk_tipo_Credi,Creditos_POS.Nombre_Cred,
Creditos_POS.Cant_Apertura,Creditos_POS.Costo_Tratamiento,Creditos_POS.Fk_Sucursal,Creditos_POS.Validez,
Creditos_POS.Saldo,Creditos_POS.Promocion,Creditos_POS.Costo_Descuento, Creditos_POS.Estatus,
Creditos_POS.CodigoEstatus,Creditos_POS.ID_H_O_D,Tipos_Credit_POS.ID_Tip_Cred, 
Tipos_Credit_POS.Nombre_Tip,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Creditos_POS,Tipos_Credit_POS,SucursalesCorre WHERE
 Creditos_POS.Fk_tipo_Credi=Tipos_Credit_POS.ID_Tip_Cred AND Creditos_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC 
  AND Creditos_POS.Saldo !=0.00 AND Creditos_POS.ID_H_O_D='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<!-- Central Modal Medium Info -->
<div class="modal fade" id="CreditosDentalesModales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-="true" style="overflow-y: scroll;">
   <div class="modal-dialog modal-xl modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Creditos dentales</p>

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
	<table  id="CreditosDisponibles" class="table table-hover">
<thead>
  
    <th style="background-color:#0057b8 !important;">N°</th>
    <th style="background-color:#0057b8 !important;">Tipo de crédito</th>
    <th style="background-color:#0057b8 !important;">Titular</th>
    <th style="background-color:#0057b8 !important;">Sucursal</th>
    <th style="background-color:#0057b8 !important;">Costo tratamiento</th>
    <th style="background-color:#0057b8 !important;">Promocion / Descuento</th>
    <th style="background-color:#0057b8 !important;">Costo total</th>
    <th style="background-color:#0057b8 !important;">Saldo</th>
    <th style="background-color:#0057b8 !important;">Validez</th>
    
	


</thead>
<?php while ($Categorias=$query->fetch_array()):?>
<tr>
<td > <?php echo $Categorias["Folio_Credito"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Tip"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Cred"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Sucursal"]; ?></td>
  <td > $<?php echo $Categorias["Costo_Tratamiento"]; ?></td>
  <td > <?php echo $Categorias["Promocion"]; ?> <br>
  $<?php echo $Categorias["Costo_Descuento"]; ?></td>
  
  <td > $<?php echo $Categorias["Cant_Apertura"]; ?></td>
  <td > $<?php echo $Categorias["Saldo"]; ?></td>
  <td > <?php echo fechaCastellano($Categorias["Validez"]); ?></td>
 
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<h3 class="alert alert-warning"> No se encontraron Especialidades <i class="fas fa-exclamation-circle"></i> </h3>
<?php endif;?>
  
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 </div>

