
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Cancelaciones de citas </title>

  <? include "Header.php"?>
  <link href='js/fullcalendar/fullcalendar.css' rel='stylesheet' />
</head>
<?include_once ("Menu.php")?>
<form action="javascript:void(0)" method="post" id="RegistraEmpleados" >
  <div class="row">
    <div class="col">
    <label>Numero de empleado:</label> <br>

<input type="text" name="NumeroEmpleado" id="nempleado">
    </div>
    <div class="col">
    <label>Nombre Completo:</label> <br>

    <input type="text" name="Nombre" id="nombreempleado">
    </div>
   
  </div>
  <div class="row">
    <div class="col">
    <label>sucursal:</label> <br>
    <input type="text" name="Sucursal" id="sucursal">
    </div>
    <div class="col">
    <label>area:</label> <br>
    
    <input type="text" name="Puesto" id="puesto">
    </div> </div>
    <div class="row">
    <div class="col">
   

    </div>
    <div class="col">
    <label>Registro:</label>
 
   </select>
    </div>
  </div>
  <div style="display: none;">

 
  <div class="row">
    <div class="col">
    

    </div>
    <div class="col">
    <label>Nombre Completo:</label>
    

    </div>
  </div>
  </div>

  <button type="submit"  id="submit"  class="btn btn-success">Guardar registro <i class="fas fa-check"></i></button>
</form>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <?
   
   include ("Modales/Precarga.php");
 
  include ("footer.php")?>
  <script src="js/CancelacionesEnSucursales.js"></script>
<script src="js/CancelacionesExternas.js"></script>

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