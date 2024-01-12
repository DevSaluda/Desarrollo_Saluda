<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/AnalisisIndex.php";
$IdBusqueda=base64_decode($_GET['idProd']);

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Eliminar producto </title>

<?include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}

    </style>
</head>
<?include_once ("Menu.php")?>

<div class="card text-center">
  <div class="card-header" style="background-color:#ff3547 !important;color: white;">
  Eliminando productos
  </div>
  <div >
  <button type="button" class="btn btn-outline-info btn-sm" onClick="history.go(-1);" class="btn btn-default">
  <i class="fas fa-long-arrow-alt-left fa-lg"></i> Regresar a productos generales 
</button>

</div>
 
</div>
<?

$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT * FROM Productos_POS WHERE ID_Prod_POS =$IdBusqueda";
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
?>
<? if($Especialistas!=null):?>
  <form enctype="multipart/form-data" id="DeleteProd">
 <div class="text-center">
    <div class="alert alert-danger">
  <strong><i class="fas fa-exclamation-triangle"></i></strong> <p>¿Esta seguro que desea eliminar el producto 
    <?php echo $Especialistas->Nombre_Prod; ?> ? <br>
    Se muestran las sucursales donde el producto se encuentra distribuido <i class="fas fa-level-down-alt"></i>
</p> 
</div>

    <input type="text" class="form-control " hidden name="DestroyProd" value="<? echo $Especialistas->ID_Prod_POS; ?>" >

       

       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-danger">Eliminar <i class="fas fa-minus-circle"></i></button>
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

$user_id=null;
$sql2="SELECT Stock_POS.Folio_Prod_Stock,Stock_POS.Clave_adicional,Stock_POS.ID_Prod_POS,Stock_POS.Cod_Barra,
Stock_POS.Nombre_Prod,Stock_POS.Tipo_Servicio,Stock_POS.Fk_sucursal,Stock_POS.Max_Existencia,Stock_POS.Min_Existencia, 
Stock_POS.Existencias_R,Stock_POS.Proveedor1,Stock_POS.Proveedor2,Stock_POS.CodigoEstatus,Stock_POS.Estatus,Stock_POS.ID_H_O_D, 
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv, Productos_POS.ID_Prod_POS,
Productos_POS.Precio_Venta,Productos_POS.Precio_C FROM Stock_POS,SucursalesCorre,Servicios_POS,Productos_POS WHERE Stock_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND 
Stock_POS.Tipo_Servicio= Servicios_POS.Servicio_ID AND Productos_POS.ID_Prod_POS =Stock_POS.ID_Prod_POS AND Stock_POS.ID_H_O_D ='".$row['ID_H_O_D']."' AND Stock_POS.ID_Prod_POS =$IdBusqueda";
$query2 = $conn->query($sql2);
?>

<?php if($query2->num_rows>0): ?> 
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
	
	


</thead>
<?php while ($Usuarios=$query2->fetch_array()):?>
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

    
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-success">El producto no se encuentra asignado a ninguna sucursal</p>
<?php endif;?>
       </div>     </div>
                                        </form>
                                        <? else:?>
  <p class="alert alert-danger">404 No podemos encontrar los datos que solicitaste</p>
<? endif;?>

<script src="js/DeleteProductos.js"></script>




<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>


<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
</body>
</html>
<?

function fechaCastellano ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
?>