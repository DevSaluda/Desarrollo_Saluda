<?$fcha = date("Y-m-d");?>
<script type="text/javascript">
$(document).ready( function () {
    $('#Productos').DataTable({
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
                title: 'Sugerencias de compras del cedis <?echo $fcha;?>',
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
$sql1="SELECT * FROM `Productos_POS` WHERE ID_H_O_D ='".$row['ID_H_O_D']."' AND Stock < Min_Existencia";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="Productos" class="table table-hover">
<thead>
<th>Clave alterna</th>
<th>Clave</th>
    <th>Nombre producto</th>
    <th>Proveedor </th>
    <th>Stock </th>
    <th>Vendido </th>
    <th>Saldo </th>

	
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>


<td > <?php echo $Usuarios['Clave_adicional']; ?></td>
<td > <?php echo $Usuarios['Cod_Barra']; ?></td>
  <td > <?php echo $Usuarios['Nombre_Prod']; ?></td>
  <td > <?php echo $Usuarios['Proveedor1']; ?> <br>
  <?php echo $Usuarios['Proveedor2']; ?>
  </td>
  <td > <?php echo $Usuarios['Stock']; ?></td>
  <td > <?php echo $Usuarios['Vendido']; ?></td>
  <td > <?php echo $Usuarios['Saldo']; ?></td>

  
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay productos registrados para <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  <script>
  	$(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/ReasignaProducto.php","id="+id,function(data){
  			$("#form-editProductosG").html(data);
          $("#TituloProductosG").html("Asignacion de productos en otras sucursales");
             
              $("#DiProductosG").removeClass("modal-dialog  modal-xl modal-notify modal-info");
              $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#DiProductosG").addClass("modal-dialog  modal-xl modal-notify modal-success");
  		});
  		$('#editModalProductosG').modal('show');
  	});
    $(".btn-VerDistribucion").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/DistribucionesProductos.php","id="+id,function(data){
  			$("#form-editProductosG").html(data);
          $("#TituloProductosG").html("Distribucion de productos");
             
              $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#DiProductosG").addClass("modal-dialog  modal-xl modal-notify modal-info");
  		});
  		$('#editModalProductosG').modal('show');
  	});
    $(".btn-editProd").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/AdminPOS/Modales/EditaProductosStockGeneral.php","id="+id,function(data){
  			$("#form-editProductosG").html(data);
          $("#TituloProductosG").html("Distribucion de productos");
             
              $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#DiProductosG").addClass("modal-dialog  modal-xl modal-notify modal-info");
  		});
  		$('#editModalProductosG').modal('show');
  	});
   
 
  </script>
  <div class="modal fade" id="editModalProductosG" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="DiProductosG"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloProductosG"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="MensajeProductosG"class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold">Estimado usuario, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editProductosG"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->