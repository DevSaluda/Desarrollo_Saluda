<?$fcha = date("Y-m-d");?>
<script type="text/javascript">
$(document).ready( function () {
    $('#StockSucursales').DataTable({
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
        dom: "B<'#colvis row'><'row'><'row'<'col-md-6'><'col-md-6'>><'bottom'><'clear'>'",
          buttons:[ 
			{
				extend:    'excelHtml5',
				text:      'Exportar a Excel  <i Exportar a Excel class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                title: 'Sugerencias de compras sucursales <?echo $fcha;?>',
				className: 'btn btn-success'
			},
		
			
          
            
        ],
   
	   
        	        
    });     
});
</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT Stock_POS.Folio_Prod_Stock,Stock_POS.Clave_adicional,Stock_POS.Cod_Barra,Stock_POS.Nombre_Prod,Stock_POS.Fk_sucursal,Stock_POS.Max_Existencia,Stock_POS.Min_Existencia,
Stock_POS.Existencias_R,Stock_POS.Proveedor1,Stock_POS.Proveedor2,Stock_POS.CodigoEstatus,Stock_POS.Estatus,Stock_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal
FROM Stock_POS,SucursalesCorre WHERE Stock_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC  AND Stock_POS.Existencias_R < Stock_POS.Min_Existencia AND Stock_POS.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="StockSucursales" class="table table-hover">
<thead>
<th>Clav A</th>
<th>Clave</th>
    <th>Nombre producto</th>
    <th>Proveedor </th>
    <th>Stock </th>
    <th>Sucursal </th>



</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>


<td > <?php echo $Usuarios['Clave_adicional']; ?></td>
<td > <?php echo $Usuarios['Cod_Barra']; ?></td>
  <td > <?php echo $Usuarios['Nombre_Prod']; ?></td>
  <td > <?php echo $Usuarios['Proveedor1']; ?> <br>
  <?php echo $Usuarios['Proveedor2']; ?>
  </td>
  <td > <?php echo $Usuarios['Existencias_R']; ?></td>
  <td > <?php echo $Usuarios['Nombre_Sucursal']; ?></td>

 
		
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
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/EditaStatusStock.php","id="+id,function(data){
  			$("#form-editStockSucursalesA").html(data);
          $("#TituloStockSucursalesA").html("Asignacion de StockSucursales en otras sucursales");
              $("#DiStockSucursalesSA").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiStockSucursalesSA").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiStockSucursalesSA").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#DiStockSucursalesSA").addClass("modal-dialog  modal-notify modal-success");
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