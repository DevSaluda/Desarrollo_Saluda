<?php
include "Consultas/Consultas.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Traspasos generados <?php echo $row['ID_H_O_D'] ?> </title>

  <?php include "Header.php"?>
  <style>
    .error {
      color: red;
      margin-left: 5px;

    }
  </style>
</head>
<div id="loading-overlay">
  <div class="loader"></div>
  <div id="loading-text" style="color: white; margin-top: 10px; font-size: 18px;"></div>
</div>
<?php include_once ("Menu.php")?>

<div class="card text-center">
  <div class="card-header" style="background-color:#0057b8 !important;color: white;">
    Traspasos realizados
    <?echo $row['ID_H_O_D']?> al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>
  </div>

  <div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#FiltroTraspasos"
      class="btn btn-default">
      Busqueda por fechas <i class="fas fa-search"></i>
    </button>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#FiltroLabs" class="btn btn-default">
      Nueva orden de traspaso <i class="fas fa-exchange-alt"></i>
    </button>
  </div>
</div>

<div id="tablaProductos"></div>

</div>
</div>
</div>
</div>

<!-- POR CADUCAR -->





<!-- /.content-wrapper -->

<!-- Control Sidebar -->

<!-- Main Footer -->

<?php
include("Modales/BusquedaTraspasosFechas.php");
include("Modales/RealizaNuevaOrdenTraspaso.php");
include("Modales/RealizaNuevaOrdenTraspasoPorSucursales.php");

include("footer.php") ?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="js/ListaDeTraspasos.js"></script>


<?php include "datatables.php"?>


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