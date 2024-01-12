<?$fcha = date("Y-m-d");?>
<script type="text/javascript">
$(document).ready( function () {
    $('#Productos').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[20,50,150,250,500, -1], [20,50,150,250,500, "Todos"]],   
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

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id=null;
$sql1="SELECT * FROM `Productos_POS_Eliminados` WHERE ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="Productos" class="table table-hover">
<thead>

<th>Clave</th>
    <th>Nombre producto</th>
    <th>Proveedor </th>
   
    <th>Precio Compra </th>
    <th>Precio Venta </th>
   
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>

<td > <?php echo $Usuarios['Cod_Barra']; ?></td>
  <td > <?php echo $Usuarios['Nombre_Prod']; ?></td>
  <td > <?php echo $Usuarios['Proveedor1']; ?> <br>
  <?php echo $Usuarios['Proveedor2']; ?>
  </td>
  <td > <?php echo $Usuarios['Precio_C']; ?></td>
  <td > <?php echo $Usuarios['Precio_Venta']; ?></td>

  
  
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay productos registrados para <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  <!-- <script>
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
  	}); -->
   
  <!-- </script> -->
 