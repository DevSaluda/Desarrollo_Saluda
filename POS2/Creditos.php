<?php
include "Consultas/Consultas.php";
include "Consultas/ConsultaCaja.php";
$fcha = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Apertura de credito|<?php echo $row['ID_H_O_D']?>  <?php echo $row['Nombre_Sucursal']?></title>

<?php include "Header.php"?>
</head>
<?php include_once ("Menu.php")?>


<div class="tab-content" id="pills-tabContent">
<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color: #2bbbad !important;color: white;">
    Creditos en clinicas  al <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div >
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AperturaCredit" class="btn btn-default">
  Apertura de credito <i class="fas fa-address-card"></i>
</button>
</div>
</div>
    
  


    

<div id="tablaCreditos"></div>
</div>

<!-- Tipos_productos -->

 
        <!-- /.row -->
       
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  
 
    <!-- Modal de Mantenimiento -->
    <!-- <div class="modal fade" id="modalMantenimiento" tabindex="-1" role="dialog" aria-labelledby="modalMantenimientoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMantenimientoLabel">Mantenimiento</h5>
                </div>
                <div class="modal-body">
                    <p>Lamentamos las molestias, pero esta sección se encuentra en mantenimiento.</p>
                    Botón para redirigir
                    <img src="lloro.jpg" alt="" style="width: 100%; max-width: 300px; height: auto; display: block; margin: 0 auto;">
                    <p>¡Nuestros programadores están trabajando horas extras sin pizza para corregir los bugs misteriosos que aparecieron en el sistema! 🐞🍕</p>
                            <br>
                            <p>No es necesario reportarlo en tu grupo o con soporte, créeme, ellos están más que enterados de los problemas que se están presentando. 👀😈</p>
                    <button type="button" class="btn btn-primary" onclick="redirigirAInicio()">Ir a Inicio</button>
                </div>
            </div>
        </div>
    </div>


  <script>
  
    var nombreUsuarioPHP = "<?php echo $row['Nombre_Apellidos']; ?>";

   
    if (nombreUsuarioPHP !== 'Eduardo Mutul') {
        $(document).ready(function() {
            $('#modalMantenimiento').modal({
                backdrop: 'static',
                keyboard: false
            });
        });

     
        function redirigirAInicio() {
            
            window.location.href = 'https://saludapos.com/POS2/index';
        }
    }
</script> -->

  <?php include ("Modales/AperturaCredito.php");

  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/AdvierteDeCaja.php");
  include ("Modales/ExitoActualiza.php");
  include ("footer.php");?>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="js/Creditos.js"></script>
<script src="js/Abona.js"></script>

<script src="js/AperturaCredito.js"></script>

<script src="js/ObtieneCostoTratamiento.js"></script>
<script src="js/ObtieneDescuento.js"></script>
<script src="js/ObtieneValorTrata.js"></script>
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