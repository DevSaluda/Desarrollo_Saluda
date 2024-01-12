<?php
# Iniciando la variable de control que permitirá mostrar o no el modal
$exibirModal = false;
# Verificando si existe o no la cookie
if(!isset($_COOKIE["IngresoAdminEnfer"]))
{
  # Caso no exista la cookie entra aqui
  # Creamos la cookie con la duración que queramos
   
  //$expirar = 3600; // muestra cada 1 hora
  //$expirar = 10800; // muestra cada 3 horas
  //$expirar = 21600; //muestra cada 6 horas
  $expirar = 43200; //muestra cada 12 horas
  //$expirar = 86400;  // muestra cada 24 horas
  setcookie('IngresoAdminEnfer', 'SI', (time() + $expirar)); // mostrará cada 12 horas.
  # Ahora nuestra variable de control pasará a tener el valor TRUE (Verdadero)
  $exibirModal = true;
}
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/ContadorIndex.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Enfermería | Página de inicio  </title>

  <!-- Font Awesome Icons -->
  <?include "Header.php"?>
</head>
<?include_once ("Menu.php")?>
<div class="container-fluid">
        <!-- Small boxes (Stat box) -->
         <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?echo $TotalEnfermeros['Enfermeros']?></h3>

                <p>Enfermeros <br> vigentes</p>
              </div>
              <div class="icon">
              <i class="fas fa-user-nurse"></i>
              </div>
                <a  data-toggle="modal" data-target="#EnferVigentes" class="small-box-footer">Consultar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>  
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?echo $TomaSignosVitales['TotalPacientesdias']?></h3>

                <p>Registros de <br> signos vitales</p>
              </div>
              <div class="icon">
              <i class="fas fa-file-medical-alt"></i>
              </div>
              <a data-toggle="modal" data-target="#SignosVitalesModal" class="small-box-footer">Consultar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <p>Registros de <br> procedimientos</p>

               
              </div>
              <div class="icon">
              <i class="fas fa-procedures"></i>
              </div>
              <a data-toggle="modal" data-target="#ConsulProcedimientos" class="small-box-footer">Consultar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
              <h3><?echo $TotalReportes['totalreportes']?></h3>
              <p>Reportes de <br> incidencias</p>
               
              </div>
              <div class="icon">
              <i class="fas fa-bullhorn"></i>
              </div>
              <a data-toggle="modal" data-target="#ConsultaReportes" class="small-box-footer">Consultar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          </div>
         
    
<div class="card text-center">
  <div class="card-header" style="background-color: #33b5e5 !important;color: white;">
   Citas con especialista del dia , <?php echo FechaCastellano(date('d-m-Y H:i:s'));  ?> 
   </div>
   </div>
  <div class="container">
<div class="row">
<div class="col-md-12">
    
<div id="TablaCampanas"></div>


</div>
</div>
</div>
            
</div>
</div>
</div>             
        <!-- /.row -->
     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?include ("Modales/Ingreso.php");
include ("Modales/Confirmacion.php");
include ("Modales/Exito.php");
include ("Modales/ModalEnfermerosVigentes.php");
include ("Modales/ModalSignosVitales.php");

  include ("footer.php");?>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="js/ControlCampanasDias.js"></script>
<script src="js/Logs.js"></script>
<script src="js/CalculaIMC.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>



</body>
</html>
<?php if($exibirModal === true) : // Si nuestra variable de control "$exibirModal" es igual a TRUE activa nuestro modal y será visible a nuestro usuario. ?>
<script>
$(document).ready(function()
{
  // id de nuestro modal
  $("#Ingreso").modal("show");
});
</script>
<?php endif; ?>
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