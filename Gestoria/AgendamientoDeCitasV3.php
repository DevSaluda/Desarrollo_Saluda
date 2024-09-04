<?php
include "Consultas/Consultas.php";
include "Consultas/Conexion_selects.php";
include "Consultas/ConeSelectDinamico.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Agendamiento de citas </title>

  <?php include "Header.php"?>
  <link href='js/fullcalendar/fullcalendar.css' rel='stylesheet' />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
 
</head>
<?php include_once ("Menu.php")?>

<div class="tab-content" id="pills-tabContent">
<div class="tab-pane fade show " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color: #2bbbad !important;color: white;">
  Citas en sucursal 
  </div>
 
  <div >
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CitaEspecialistaDeSucursal" class="btn btn-default">
  Agendar nueva cita<i class="fas fa-user-plus"></i>
</button>
</div>

</div>


    
<div id="CitasEnLaSucursal"></div>
</div>
<div class="tab-pane fade show active" id="CrediClinicas" role="tabpanel" aria-labelledby="pills-home-tab">
<div class="card text-center">
  <div class="card-header" style="background-color: #2bbbad !important;color: white;">
Citas de especialistas
  </div>
 
  <div >
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CitaExt" class="btn btn-default">
  Agendar nueva cita <i class="fas fa-file-medical"></i>
</button>
</div>

</div>
<div id="CitasEnLaSucursalExt"></div>
</div>
</div>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <?php 
   include ("Modales/Error.php");
  
   include ("Modales/Exito.php");

   include ("Modales/Precarga.php");
   include ("Modales/ExitoActualiza.php");
   include ("Modales/EstatusAgendaGuardado.php");
  include ("Modales/AgendarCitasExt.php");

  include ("footer.php")?>


<script src="js/CampanasExpress.js"></script>
<script src="js/AgregaEspecialidad.js"></script>
<script src="js/BuscaDataPacientes.js"></script>
<script src="js/BuscaDataPacientesExt.js"></script>
<script src="js/AgregaEspecialista.js"></script>
<script src="js/ObtieneEspecialidadMedicoSucursal.js"></script>
<script src="js/ObtieneMedicoDeSucursal.js"></script>
<script src="js/ObtieneFechas.js"></script>
<script src="js/ObtieneHoras.js"></script>
<script src="js/ObtieneEspecialidadMedicoExt.js"></script>
<script src="js/ObtieneTipoDeConsulta.js"></script>
<script src="js/ObtieneMedicoDeSucursalExt.js"></script>
<script src="js/ObtieneFechasExt.js"></script>
<script src="js/ObtieneHorasExt.js"></script>
<script src="js/ValidacionGuardarCitasEspecialistasFinal.js"></script>

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
<!-- <div class="modal-dialog modal-notify modal-primary" role="document">
    <div class="modal fade" id="modalavisoterminado" tabindex="-1" role="dialog" aria-labelledby="modalMantenimientoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMantenimientoLabel" style="color:white;">¡Aviso! 🚨🔧</h5>
                </div>
                <div class="modal-body">
                   
                    <p>Hola, <?php echo $row['Nombre_Apellidos']?>. Te informamos que las sucursales que cuentan con créditos dentales ya pueden realizar aperturas y cobros. 🎉💳🦷</p>

                    <img src="hey.jpg" alt="" style="width: 100%; max-width: 300px; height: auto; display: block; margin: 0 auto;">
                    <p>¡Nuestros programadores han trabajado para habilitar esta funcionalidad! 🚀</p>
                    <br>
                    <p>¡Gracias por tu paciencia!</p> 
                    <p><strong>Recuerda que cualquier problema que se presente puedes reportarlo en tu grupo o con soporte. 🤔💬</strong></p>
                </div>
                <div class="modal-footer">
               
                    <button type="button" class="btn btn-primary" onclick="redirigirEnergiaElectria()">Ir a los creditos dentales</button>
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>  -->

<!-- Agrega este script al final de tu página justo antes de cerrar el cuerpo (</body>) -->
<!-- Script para mostrar y ocultar el modal -->
<!-- <script>
    
    $(document).ready(function() {
        
        $('#modalavisoterminado').modal('show');
    });

    
    function redirigirEnergiaElectria() {
        
        window.location.href = 'https://saludapos.com/POS2/Creditos';
    }
</script>  -->

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