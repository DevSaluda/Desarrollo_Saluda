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
$sql1="SELECT Productos_POS.ID_Prod_POS,Productos_POS.Nombre_Prod,Productos_POS.Cod_Barra,Productos_POS.Proveedor1,Productos_POS.Proveedor2,Productos_POS.ID_H_O_D,
Productos_POS.Precio_Venta,Productos_POS.Precio_C,Productos_POS.Stock,Productos_POS.Saldo,Productos_POS.Vendido,Productos_POS.Tipo_Servicio,Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv FROM Productos_POS,Servicios_POS where 
Servicios_POS.Servicio_ID = Productos_POS.Tipo_Servicio AND Productos_POS.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="Productos" class="table table-hover">
<thead>

<th>Clave</th>
    <th>Nombre</th>
    <th>Proveedor </th>
   
    <th>PC</th>
    <th>PV </th>
    <th>Servicio </th>
    <th>Stock </th>
    <th>Vendido </th>
    <th>Saldo </th>

	<th >Accciones</th>
	


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
  <td > <?php echo $Usuarios['Nom_Serv']; ?></td>
  
  <td > <?php echo $Usuarios['Stock']; ?></td>
  <td > <?php echo $Usuarios['Vendido']; ?></td>
  <td > <?php echo $Usuarios['Saldo']; ?></td> 

  <!-- <td >  <button class="btn btn-default btn-sm" style="<?echo $Usuarios['CodigoEstatus'];?>"><?php echo $Usuarios["Estatus"]; ?></button> </td> -->
    <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary btn-sm dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">
<a data-id="<?php echo  $Usuarios["ID_Prod_POS"];?>" class="btn-edit  dropdown-item" >Asignar en mas sucursales <i class="fas fa-paste"></i></a>
<a data-id="<?php echo  $Usuarios["ID_Prod_POS"];?>" class="btn-VerDistribucion  dropdown-item" >Ver distribucion <i class="fas fa-hospital-alt"></i></a>
<a data-id="<?php echo $Usuarios["ID_Prod_POS"];?>" class="btn-editProd dropdown-item" >Editar datos <i class="fas fa-pencil-alt"></i></a>
<a data-id="<?php echo $Usuarios["ID_Prod_POS"];?>" class="btn-History dropdown-item" >Ver movimientos <i class="fas fa-history"></i></a>
<a data-id="<?php echo $Usuarios["ID_Prod_POS"];?>" class="btn-Delete dropdown-item" >Eliminar Producto <i class="fas fa-minus-circle"></i></a>
 
 
</div>
<!-- Basic dropdown -->
	 </td>
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay productos registrados para <?echo $row['ID_H_O_D']?></p>
<?php endif;?>
  
 
<script>
  $(".btn-edit").click(function(){
    id = $(this).data("id");
    $.post("https://saludapos.com/AdminPOS/Modales/ReasignaProducto.php","id="+id,function(data){
        alert($(this).data("id"));
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
    $.post("https://saludapos.com/AdminPOS/Modales/DistribucionesProductos.php","id="+id,function(data){
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
    $.post("https://saludapos.com/AdminPOS/Modales/EditaProductosStockGeneral.php","id="+id,function(data){
        $("#form-editProductosG").html(data);
    $("#TituloProductosG").html("Editar datos");
       
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiProductosG").addClass("modal-dialog  modal-xl modal-notify modal-info");
    });
    $('#editModalProductosG').modal('show');
});
$(".btn-History").click(function(){
    id = $(this).data("id");
    $.post("https://saludapos.com/AdminPOS/Modales/HistorialProductos.php","id="+id,function(data){
        $("#form-editProductosG").html(data);
    $("#TituloProductosG").html("Actualizaciones y movimientos");
       
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiProductosG").addClass("modal-dialog  modal-xl modal-notify modal-info");
    });
    $('#editModalProductosG').modal('show');
});


$(".btn-Delete").click(function(){
    id = $(this).data("id");
    $.post("https://saludapos.com/AdminPOS/Modales/DeleteProductos.php","id="+id,function(data){
        alert($(this).data("id"));
        $("#form-editProductosG").html(data);
    $("#TituloProductosG").html("Eliminar producto");
       
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
        $("#DiProductosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiProductosG").removeClass("modal-dialog  modal-xl modal-notify modal-info");
        $("#DiProductosG").addClass("modal-dialog modal-sm modal-notify modal-danger");
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
       
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editProductosG"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
