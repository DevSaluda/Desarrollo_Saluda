<?$fcha = date("Y-m-d");?>
<script type="text/javascript">
$(document).ready( function () {
    $('#TotalesSinCortes').DataTable({
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
        dom: "B<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>'",
          buttons:[ 
			{
				extend:    'excelHtml5',
				text:      'Exportar a Excel  <i Exportar a Excel class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                title: 'Totales descargado el  <?echo $fcha;?>  ',
				className: 'btn btn-success'
			},
			
			
          
            
        ],
   
	   
        	        
    });  
	  
	
} );
</script>
<?php

include ("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT Cajas_POS.ID_Caja,Cajas_POS.Fecha_Apertura,Cajas_POS.Cantidad_Fondo,Cajas_POS.Sucursal,
Cajas_POS.Empleado,Cajas_POS.ID_H_O_D, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal ,SUM(Cajas_POS.Valor_Total_Caja- Cajas_POS.Cantidad_Fondo) as
 TotalDeCajas FROM Cajas_POS,SucursalesCorre WHERE Cajas_POS.Fecha_Apertura= CURRENT_DATE() AND Cajas_POS.Sucursal = SucursalesCorre.ID_SucursalC GROUP BY Cajas_POS.Fecha_Apertura,SucursalesCorre.Nombre_Sucursal,Cajas_POS.Empleado";
$query = $conn->query($sql1);
?>

<!-- Central Modal Medium Info -->
<div class="modal fade" id="TotalesporSucursalesindex" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-="true" style="overflow-y: scroll;">
   <div class="modal-dialog modal-xl modal-notify modal-primary" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Totales sin corte de caja por fecha y sucursales</p>

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
	<table  id="TotalesSinCortes" class="table table-hover">
<thead>


<th>Fecha apertura</th>
<th>Cantidad fondo</th>
    <th>Empleado</th>
    <th>Sucursal</th>
    <th>Total</th>
    
    


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



    <td><?php echo $Usuarios["Fecha_Apertura"]; ?></td>
    <td>$ <?php echo $Usuarios["Cantidad_Fondo"]; ?></td>
    <td><?php echo $Usuarios["Empleado"]; ?></td>
    <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
    <td>$ <?php echo $Usuarios["TotalDeCajas"]; ?></td>
    

    
   
     
      
   
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

