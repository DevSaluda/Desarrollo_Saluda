<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/AnalisisIndex.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>ALMACEN | PRODUCTOS | <?echo $row['ID_H_O_D']?> </title>

<?include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}

    </style> 
 
  <script type="text/javascript">
$(function() {
            $("#codbarrap").autocomplete({
                source: "Consultas/BusquedaProductos.php",
                minLength: 2,
                appendTo: "#AltaProductos",  
                select: function(event, ui) {
					event.preventDefault();
                    $('#codbarrap').val(ui.item.codbarrap);
                    $('#clav').val(ui.item.clav);
          $('#nombre_prod').val(ui.item.nombre_prod);
          $('#loteprod').val(ui.item.loteprod);
          $('#fechacaducidad').val(ui.item.fechacaducidad);
          $('#minimo').val(ui.item.minimo);
          $('#maximo').val(ui.item.maximo);
          $('#preciocom').val(ui.item.preciocom);
          $('#precioven').val(ui.item.precioven);
          $('#categoria').val(ui.item.categoria);
          $('#marca').val(ui.item.marca);
          $('#tipo').val(ui.item.tipo);
          $('#presentacion').val(ui.item.presentacion);
          $('#revprovee1').val(ui.item.revprovee1);
          $('#revprovee2').val(ui.item.revprovee2);
          $('#codigosdebarras').val(ui.item.codigosdebarras);
          $('#id_prod_prod').val(ui.item.id_prod_prod);
			     }
            });
        
		});
</script>
</head>
<?include_once ("Menu.php")?>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Stock</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Productos prontos a caducar</a>
  </li>
  
</ul>

<div class="tab-content" id="pills-tabContent">
<div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color:#2bbbad !important;color: white;">
    Productos de <?echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div >
 
</div>
</div>
    
<div id="TableStockSucursales"></div>

</div>


<!-- Tipos_productos -->
<div class="tab-pane fade show " id="pills-contact" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color:#2bbbad !important;color: white;">
    Productos por caducar <?echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div >
 
</div>
</div>
    
<div id="TableProdCaducaPronto"></div>

</div>
<!-- Tipos_productos Fin -->
<!-- PRESENTACIONES -->

</div>

    
</div></div>





     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?
  include ("Modales/AltaStock.php");
  include ("Modales/AltaTipoProductos.php");
  include ("Modales/Vacios.php");
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("footer.php")?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="js/ControlStockSucursales.js"></script>
<script src="js/AgregaEnStock.js"></script>
<script src="js/StockPorVencer.js"></script>


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