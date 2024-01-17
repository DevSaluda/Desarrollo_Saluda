<script type="text/javascript">
$(document).ready( function () {
    $('#StockSucursales').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[50,100,500, -1], [50,100,500, "Todos"]],   
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
$sql1="SELECT Stock_POS.Folio_Prod_Stock,Stock_POS.Clave_adicional,Stock_POS.ID_Prod_POS,Stock_POS.Cod_Barra,Stock_POS.Nombre_Prod,Stock_POS.Tipo_Servicio,Stock_POS.Fk_sucursal,Stock_POS.Max_Existencia,Stock_POS.Min_Existencia, Stock_POS.Existencias_R,Stock_POS.Proveedor1,Stock_POS.Proveedor2,Stock_POS.CodigoEstatus,Stock_POS.Estatus,Stock_POS.ID_H_O_D, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv, Productos_POS.ID_Prod_POS,Productos_POS.Precio_Venta,Productos_POS.Precio_C FROM Stock_POS,SucursalesCorre,Servicios_POS,Productos_POS WHERE Stock_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND Stock_POS.Tipo_Servicio= Servicios_POS.Servicio_ID AND Productos_POS.ID_Prod_POS =Stock_POS.ID_Prod_POS AND Stock_POS.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
	<div class="table-responsive">
	<table  id="StockSucursales" class="table table-hover">
<thead>

<th>Clave</th>
    <th>Nombre producto</th>
    <th>Servicio </th>
    
    <th>Stock </th>
    <th>Precio compra </th>
    <th>Precio venta </th>
    
    <th>Sucursal </th>
<th>Estatus</th>
	<th >Accciones</th>
	


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>



<td > <?php echo $Usuarios['Cod_Barra']; ?></td>
  <td > <?php echo $Usuarios['Nombre_Prod']; ?></td>
  <td > <?php echo $Usuarios['Nom_Serv']; ?></td>
  
  <td > <?php echo $Usuarios['Existencias_R']; ?></td>
  <td > <?php echo $Usuarios['Precio_C']; ?></td>
  <td > <?php echo $Usuarios['Precio_Venta']; ?></td>
  <td > <?php echo $Usuarios['Nombre_Sucursal']; ?></td>

  <td >  <button class="btn btn-default btn-sm" style=<?if($Usuarios['Existencias_R'] < $Usuarios['Min_Existencia']){
   echo "background-color:#ff1800!important";
} elseif($Usuarios['Existencias_R'] > $Usuarios['Max_Existencia']) {
  echo "background-color:#fd7e14!important";
}else {
   echo "background-color:#2bbb1d!important";
}
?>><?if($Usuarios['Existencias_R'] < $Usuarios['Min_Existencia']){
  echo "Resurtir";
} elseif($Usuarios['Existencias_R'] > $Usuarios['Max_Existencia']) {
 echo "Exceso de producto";
}else {
  echo "Completo";
}
?></button> </td>

    <td>
		 <!-- Basic dropdown -->
<button class="btn btn-primary btn-sm dropdown-toggle " type="button" data-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

<div class="dropdown-menu">

<a data-id="<?php echo $Usuarios["Folio_Prod_Stock"];?>" class="btn-Detalles dropdown-item" >Detalles <i class="fas fa-info-circle"></i></a>
<a data-id="<?php echo $Usuarios["ID_Prod_POS"];?>" class="btn-editStock dropdown-item" >Actualizar <i class="fas fa-edit"></i></a>
<a data-id="<?php echo $Usuarios["Folio_Prod_Stock"];?>" class="btn-Traspaso dropdown-item" >Traspaso <i class="fas fa-exchange-alt"></i></a>
<a data-id="<?php echo $Usuarios["Folio_Prod_Stock"];?>" class="btn-HistorialStocksucursaless dropdown-item" >Movimientos <i class="fas fa-history"></i></a>
 
</div>
<!-- Basic dropdown -->
	 </td>
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay Stock Sucursales registrados para <?php echo $row['ID_H_O_D']?></p>
<?php endif;?>
  <!-- Modal -->
  <script>

$(".btn-Detalles").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/CEDIS/Modales/DetallesStockSucursales.php","id="+id,function(data){
  			$("#form-editStockSucursalesA").html(data);
          $("#TituloStockSucursalesA").html("Datos de productos");
          $("#DiStockSucursalesSA").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiStockSucursalesSA").removeClass("modal-dialog  modal-primary modal-success");
              $("#DiStockSucursalesSA").removeClass("modal-dialog modal-xl modal-notify modal-success");
              $("#DiStockSucursalesSA").addClass("modal-dialog  modal-notify modal-success");
  		});
  		$('#editModalStockSucursalesA').modal('show');
  	});

  	$(".btn-editStock").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/CEDIS/Modales/ActualizaDataStock.php","id="+id,function(data){
  			$("#form-editStockSucursalesA").html(data);
          $("#TituloStockSucursalesA").html("Actualizar datos de productos");
              $("#DiStockSucursalesSA").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiStockSucursalesSA").removeClass("modal-dialog  modal-primary modal-success");
              $("#DiStockSucursalesSA").removeClass("modal-dialog modal-xl modal-notify modal-success");
              $("#DiStockSucursalesSA").addClass("modal-dialog  modal-lg modal-notify modal-success");
  		});
  		$('#editModalStockSucursalesA').modal('show');
  	});

    $(".btn-HistorialStocksucursaless").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/CEDIS/Modales/HistorialStockSucursales.php","id="+id,function(data){
  			$("#form-editStockSucursalesA").html(data);
          $("#TituloStockSucursalesA").html("Movimientos de productos");
              $("#DiStockSucursalesSA").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#DiStockSucursalesSA").removeClass("modal-dialog  modal-notify modal-success");
              $("#DiStockSucursalesSA").removeClass("modal-dialog  modal-primary modal-success");
              $("#DiStockSucursalesSA").addClass("modal-dialog modal-xl modal-notify modal-success");
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