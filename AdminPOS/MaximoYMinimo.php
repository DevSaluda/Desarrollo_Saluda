<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/AnalisisIndex.php";
$IdBusqueda=base64_decode($_GET['Disid']);
$sql1="SELECT Stock_POS.Folio_Prod_Stock,Stock_POS.ID_Prod_POS,Stock_POS.Clave_adicional,Stock_POS.Cod_Barra,Stock_POS.Nombre_Prod,Stock_POS.Fk_sucursal,Stock_POS.Max_Existencia,Stock_POS.Min_Existencia,
Stock_POS.Existencias_R,Stock_POS.Proveedor1,Stock_POS.Proveedor2,Stock_POS.CodigoEstatus,Stock_POS.Estatus,Stock_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal
FROM Stock_POS,SucursalesCorre WHERE Stock_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC  AND Stock_POS.ID_H_O_D ='".$row['ID_H_O_D']."' 
AND Stock_POS.ID_Prod_POS = $IdBusqueda";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Actualizacion de minimos y maximos en productos <?echo $row['ID_H_O_D']?> </title>

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
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
    Productos de <?echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  <div >
  <button type="button" class="btn btn-outline-info btn-sm" onClick="history.go(-1);" class="btn btn-default">
  <i class="fas fa-long-arrow-alt-left fa-lg"></i> Regresar a productos 
</button>

</div>
 
</div>
    
<script type="text/javascript">
$(document).ready( function () {
    var printCounter = 0;
    $('#StockSucursalesDistribucion').DataTable({
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
<?
;


$user_id=null;

$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
    <form action="javascript:void(0)" method="post" id="RegistraConteoDelDia">
  <div class="text-center">
  <button type="submit"  id="EnviaDatosSincroniza" value="Guardar" class="btn btn-success">Actualizar Datos<i class="fas fa-dolly-flatbed"></i></button>
	<div class="table-responsive">
	<table  id="StockSucursalesDistribucion" class="table table-hover">
<thead>
<th>Clav A</th>
<th>Clave</th>
    <th>Nombre producto</th>
  <th>Sucursal </th>
    
  <th>Stock Actual </th>
    <th>Minimo permitido</th>
    <th>Maximo permitido </th>


</thead>
<?php while ($Usuarios=$query->fetch_array()):?>
<tr>


<td > <?php echo $Usuarios['Clave_adicional']; ?></td>
<td > <input type="text" class="form-control" value="<?php echo $Usuarios['Cod_Barra']; ?>" readonly>
<input hidden type="text" class="form-control" name="CodProd[]" value="<?php echo $Usuarios['ID_Prod_POS']; ?>" readonly>
</td>
  <td > <?php echo $Usuarios['Nombre_Prod']; ?></td>
  <td > <?php echo $Usuarios['Nombre_Sucursal']; ?></td>
  <td > <?php echo $Usuarios['Existencias_R']; ?></td>
  <td > <input type="number"  name="MinimoPermitido[]" value="<?php echo $Usuarios['Min_Existencia']; ?>" class="form-control"></td>
  <td > <input type="number" name="MaximoPermitido[]" value="<?php echo $Usuarios['Max_Existencia']; ?>" class="form-control"></td>
  <!-- <td >  <button class="btn btn-default btn-sm" style="<?echo $Usuarios['CodigoEstatus'];?>"><?php echo $Usuarios["Estatus"]; ?></button> </td> -->
  </form> 
	
		
</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
	<p class="alert alert-warning">Aún no hay distribucion para <?echo $row['ID_H_O_D']?></p>
<?php endif;?>








     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?
 
  include ("Modales/ExitoActualiza.php");

  include ("footer.php")?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="js/ActualizaMaximoMinimoGlobal.js"></script>



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
<script>

$('document').ready(function($){
$('#Precarga').modal('toggle'); 
setTimeout(function(){ 
    $('#Precarga').modal('hide') 
}, 5000); // abrir

});	   
</script>
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