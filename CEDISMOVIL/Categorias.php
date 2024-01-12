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

  <title><?echo $row['ID_H_O_D']?> | Control de productos </title>

<?include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}

    </style>
</head>
<?include_once ("Menu.php");?>
<div id="ContadorDeAlmacen"></div>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"> <div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
  Categorías de productos de <?echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div >
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AltaCategorias" class="btn btn-default">
  Añadir nueva categoría  <i class="far fa-plus-square"></i>
</button>
</div>

</div>
<div id="TableCategorias"></div>


</div>

<!-- Tipos_productos -->
<div class="tab-pane fade show " id="pills-TipPro" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
    Tipos de productos de <?echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div >
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AltaTiposProductos" class="btn btn-default">
  Alta de nuevo tipo <i class="fas fa-plus-square"></i>
</button>
</div>
</div>
    
<div id="tablaTiposProductos"></div>

</div>
<!-- Tipos_productos Fin -->

<!-- PRESENTACIONES -->
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  <div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
  Presentaciones de productos de <?echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div >
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AltaPresentacion" class="btn btn-default">
  Añadir nueva presentación  <i class="far fa-plus-square"></i>
</button>
</div>

</div>
<div id="TablePresentaciones"></div>
  </div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
  <div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
  Marcas de productos de <?echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div >
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AltaMarcas" class="btn btn-default">
  Añadir nueva marca <i class="far fa-plus-square"></i>
</button>
</div>
<div id="TableMarcas"></div>
</div>

  </div>
  <div class="tab-pane fade" id="ServiciosS" role="tabpanel" aria-labelledby="pills-contact-tab">
  <div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
  Servicios de <?echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div >
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AltadeServicios" class="btn btn-default">
  Añadir nuevo servicio <i class="far fa-plus-square"></i>
</button>
</div>

</div>
<div id="TableServicios"></div>
  </div>


</div>

    


  
</div>
</div></div>
</div>



  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?
    
  include ("Modales/AltaCategorias.php");
  include ("Modales/AltaPresentaciones.php");
  include ("Modales/AltaServicios.php");
  include ("Modales/AltaMarcas.php");
  include ("Modales/Vacios.php");
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/AltaTipoProductos.php");
  include ("Modales/ExitoActualiza.php");
  include ("footer.php")?>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="js/CargaCategorias.js"></script>
<script src="js/AgregaCategoria.js"></script>
<!-- Requiere presentaciones -->
<script src="js/ControlTipoProductos.js"></script>

<script src="js/AltaTipoProductos.js"></script>

<script src="js/CargaPresentaciones.js"></script>
<script src="js/AgregaPresentaciones.js"></script>

<!-- requiere marcas -->
<script src="js/CargaMarcas.js"></script>
<script src="js/AgregaMarcas.js"></script>

<!-- requiere Servicios -->
<script src="js/ControlServicios.js"></script>
<script src="js/AgregaServicios.js"></script>

<script src="js/ContadorControlAlmacen.js"></script>
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