<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/Conexion_selects.php";
include "Consultas/ConeSelectDinamico.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title> Enfermería |<?echo $row['Nombre_Sucursal']?></title>

  <? include "Header.php"?>
</head>
<?include_once ("Menu.php")?>

<div class="card text-center">
  <div class="card-header" style="background-color: #0057b8 !important; color: white;">
  Registro de pacientes al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  <div >
  
</div>

</div>
  
<?
$phoneNumber1 = "529991432948";
$phoneNumber2 = "529994424745";
?>

<style>  
  div.whatsapp-container {
    text-align: center;
    background-color: #fff; 
    padding: 20px; 
  }

  .whatsapp-button {
    display: inline-block;
    margin: 10px;
    padding: 10px 20px;
    background-color: #fff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
    display: flex;
    align-items: center; 
  }

  .whatsapp-button i {
    font-size: 20px; 
    margin-right: 10px; 
  }

  .whatsapp-button:hover {
    background-color: #25d366;
  }
</style>


<div class="whatsapp-container">
  <div class="whatsapp-button" id="whatsapp-button1">
    <a href="https://api.whatsapp.com/send?phone=<?php echo $phoneNumber1; ?>" target="_blank" aria-label="Contactar por WhatsApp (Número 1)">
      <i class="fab fa-whatsapp"></i> 
      <span> Contactar a Jefatura de Enfermería por Whatsapp </span>
    </a>
  </div>
  <div class="whatsapp-button" id="whatsapp-button2">
    <a href="https://api.whatsapp.com/send?phone=<?php echo $phoneNumber2; ?>" target="_blank" aria-label="Contactar por WhatsApp (Número 2)">
      <i class="fab fa-whatsapp"></i> 
      <span> Contactar a Gestores de Procesos por Whatsapp </span>
    </a>
  </div>
</div>  


<div class="col-md-12">
    
<div id="sv"></div>


</div>
</div>
</div>


  <!-- Main Footer -->
  <?
include ("Modales/AltaCitaSucursal.php");
include ("Modales/Exito.php");
  include ("footer.php");?>
<!-- ./wrapper -->

<script src="js/ControlSignosVitales.js"></script>
<script src="js/GuardaCita.js"></script>
<script src="js/Capturadata.js"></script>
<script src="js/CalculaIMC.js"></script>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->

<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>


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