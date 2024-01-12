<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Registro productos| <?echo $row['ID_H_O_D']?> </title>

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
  <div class="card-header" style="background-color: #2bbbad !important;color: white;">
  Administración de caja de <?echo $row['ID_H_O_D']?> 
  </div>
  
  <div >
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ActualizaRegistros" class="btn btn-default">
Registrar Producto <i class="fas fa-prescription-bottle-alt"></i>
</button>
</div>

</div>



<div id="TableStockSucursales"></div>
      </div>
    </div>
  </div>
</div>

</div>
  </div>
</div>

  
         
</div>
</div>

     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?
    
  
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("Modales/ActualizaProductosRegistrados.php");
  include ("footer.php")?>

<!-- ./wrapper -->

<script src="js/BuscaProductosParaActualizar.js"></script>
<script src="js/ControlStockSucursales.js"></script>

<script src="js/ActualizaExistenciasPorVendedor.js"></script>
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