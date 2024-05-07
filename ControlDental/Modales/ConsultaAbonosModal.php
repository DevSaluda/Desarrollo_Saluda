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
        "buttons": [
      {
        extend: 'excelHtml5',
        text: 'Exportar a Excel  <i Exportar a Excel class="fas fa-file-excel"></i> ',
        titleAttr: 'Exportar a Excel',
        title: 'registro de ventas ',
        className: 'btn btn-success',
        exportOptions: {
          columns: ':visible' // Exportar solo las columnas visibles
        }
      }
    ],
    // Personalizar la posición de los elementos del encabezado
    "dom": '<"d-flex justify-content-between"lBf>rtip', // Modificar la disposición aquí
    "responsive": true
       
   
	   
        	        
    });     
});
   
	  
	 
</script>
<?php
include("Consultas/db_connection.php");
include "Consultas/Consultas.php";
$user_id=null;
$sql1="SELECT AbonoCreditos_POS.Folio_Abono,
AbonoCreditos_POS.Fk_Folio_Credito, 
AbonoCreditos_POS.Fk_tipo_Credi,
AbonoCreditos_POS.Nombre_Cred, 
AbonoCreditos_POS.Cant_Apertura,
AbonoCreditos_POS.Cant_Abono,
AbonoCreditos_POS.Fecha_Abono,
AbonoCreditos_POS.Fk_Sucursal, 
AbonoCreditos_POS.Saldo,
AbonoCreditos_POS.Estatus,
AbonoCreditos_POS.CodigoEstatus,
AbonoCreditos_POS.ID_H_O_D, 
Tipos_Credit_POS.ID_Tip_Cred,
Tipos_Credit_POS.Nombre_Tip,
SucursalesCorre.ID_SucursalC,
SucursalesCorre.Nombre_Sucursal 
FROM AbonoCreditos_POS,Tipos_Credit_POS,SucursalesCorre 
WHERE AbonoCreditos_POS.Fk_tipo_Credi = Tipos_Credit_POS.ID_Tip_Cred 
AND DATE(AbonoCreditos_POS.Fecha_Abono) =  CURRENT_DATE()";
$query = $conn->query($sql1);
?>

<!-- Central Modal Medium Info -->
<div class="modal fade" id="AbonosDentalesRealizadosModales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
  
    <th style ="background-color: #0057b8 !important;">N°</th>
    <th style ="background-color: #0057b8 !important;">Tratamiento</th>
    <th style ="background-color: #0057b8 !important;">Titular</th>
    <th style ="background-color: #0057b8 !important;">Fecha abono</th>
    <th style ="background-color: #0057b8 !important;">Saldo anterior</th>
    <th style ="background-color: #0057b8 !important;">Abono</th>
    <th style ="background-color: #0057b8 !important;">Saldo</th>
    <th style ="background-color: #0057b8 !important;">Estatus</th>
    <th style ="background-color: #0057b8 !important;">Acciones</th>
    
	


</thead>
<?php while ($Categorias=$query->fetch_array()):?>
<tr>

<td > <?php echo $Categorias["Folio_Abono"]; ?></td>

  <td > <?php echo $Categorias["Nombre_Tip"]; ?></td>
  <td > <?php echo $Categorias["Nombre_Cred"]; ?></td>
 
  <td > <?php echo $Categorias["Fecha_Abono"]; ?></td>
  <td > $<?php echo $Categorias["Cant_Apertura"]; ?></td>
  <td > $<?php echo $Categorias["Cant_Abono"]; ?></td>
  <td > $<?php echo $Categorias["Saldo"]; ?></td>
  
  <td> <button style="<?echo $Categorias['CodigoEstatus'];?>" class="btn btn-default btn-sm" > <?php echo $Categorias["Estatus"]; ?></button></td>
 
 
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<h3 class="alert alert-warning"> No se encontraron abonos <i class="fas fa-exclamation-circle"></i> </h3>
<?php endif;?>
  
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 </div>

