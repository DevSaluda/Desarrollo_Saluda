<?php
include "Consultas/Consultas.php";


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Video Tutorial para las devoluciones de  <?echo $row['ID_H_O_D']?> </title>

<?php include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
  
}
table td {
  word-wrap: break-word;
  max-width: 400px;
}

    </style>
</head>
<?php include_once ("Menu.php")?>



<div class="tab-content" id="pills-tabContent">

<div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  <div class="card text-center">
 
  <div >

</div>
  <div >
 
</div>

</div><div class="col-md-12">
<video id="video-fullscreen" controls autoplay loop>
    <source src="https://saludapos.com/Videotutoriales/Devoluciones.mp4" type="video/mp4">
    Tu navegador no soporta la reproducción de video.
</video>

  </div></div>




    
</div></div>
</div></div>




<style>
  

#video-fullscreen {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

</style>
     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?php 
 
  include ("footer.php")?>



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