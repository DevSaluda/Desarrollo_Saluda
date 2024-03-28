<?php
include "Consultas/Consultas.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Historial de ultrasonidos </title>

<?php include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}

    </style>
</head>
<?php include_once ("Menu.php")?>
<div class="card text-center">
  <div class="card-header" style="background-color: #c80096 !important;color: white;">
  Ultrasonidos pendientes de entrega al  <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  <div >
  
</div>

</div>
  <!-- Content Wrapper. Contains page content -->
  

  <div class="container">
<div class="row">
<div class="collapse" id="collapseExample">
  <div class="card-body">
  <div class="table-responsive">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Descarga pdf</th>
      <th scope="col">Descarga pdf movil</th>
      <th scope="col">Abrir whatsapp</th>
      <th scope="col">Editar informacion</th>
    </tr>
      <td><button class="btn btn-warning"><span class="far fa-file-pdf"></span></button></td>
      <td>  <button class="btn btn-secondary"><span class="far fa-file-pdf"></span></button></td>
      <td>  <button class="btn btn-success"><span class="fab fa-whatsapp"></span></button></td>
     <td>  <button class="btn btn-info"><i class="far fa-edit"></i></button></td>
    </tr>
  </thead>
  <tbody>
</table>
  </div>
  </div>
</div>

</div>
</div>
</div>
 
  

</div>

    
</div></div>





     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?php

  include ("footer.php")?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->



<script src="js/ControlUltras.js"></script>  


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
<?php

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