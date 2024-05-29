<?php
include "Consultas/Consultas.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Sugerencias de pedidos</title>
  <?php include "Header.php"?>
  <link href='js/fullcalendar/fullcalendar.css' rel='stylesheet' />
</head>
<?php include_once ("Menu.php")?>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="card text-center">
      <div class="card-header" style="background-color: #2bbbad !important;color: white;">Pedidos</div>
    </div>
    <div id="CitasEnLaSucursal"></div>
  </div>
  <div class="tab-pane fade show active" id="CrediClinicas" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="card text-center">
      <div class="card-header" style="background-color: #2bbbad !important;color: white;">Sugerencias de pedidos</div>
      <div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#PedidoPorDia" class="btn btn-default">Sugerencia por día<i class="fas fa-file-medical"></i></button>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CitaExt" class="btn btn-default">Sugerencia por periodo<i class="fas fa-file-medical"></i></button>
      </div>
    </div>
    
    <div id="TablaPedidos" class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Proveedor</th>
            <th>Nombre comercial</th>
            <th>Ingrediente Activo</th>
            <th>Presentación</th>
            <th>Cantidad a pedir</th>
            <th>Stock actual</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" class="form-control" name="proveedor"></td>
            <td><input type="text" class="form-control" name="nombre_comercial"></td>
            <td><input type="text" class="form-control" name="ingrediente_activo"></td>
            <td><input type="text" class="form-control" name="presentacion"></td>
            <td><input type="number" class="form-control" name="cantidad_pedir"></td>
            <td><input type="number" class="form-control" name="stock_actual"></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<?php 
include ("Modales/Error.php");
include ("Modales/GeneraPedidoPorDia.php");
include ("Modales/Exito.php");
include ("Modales/Precarga.php");
include ("Modales/ExitoActualiza.php");
include ("footer.php")?>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<!-- Bootstrap -->
<script src="js/ControlSugerencias"></script>
<script src="js/ControlSugerenciasDias"></script>
<script src="js/ControlSugerenciasPeriodo"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>
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
