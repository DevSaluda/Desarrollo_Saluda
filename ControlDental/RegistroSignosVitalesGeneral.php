<?php
include "Consultas/Consultas.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Registros de signos vitales en general | </title>

<?php include "Header.php"?>
</head>
<?php include_once ("Menu.php")?>


<div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
  Registro de pacientes hasta el <?php echo FechaCastellano(date('d-m-Y H:i:s')); ?>  
  </div>
  
  <div style="padding: 15px;">
  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#FiltraPorPaciente" class="btn btn-default" style="margin-right: 10px;">
  Filtrar por nombre de paciente  <i class="fas fa-prescription-bottle"></i>
</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#FiltraPorFechas" class="btn btn-default">
  Filtrar por rango de fechas  <i class="fas fa-calendar-alt"></i>
</button>
<button type="button" class="btn btn-info" onclick="CargaSignosVitalesLibre()" style="margin-left: 10px;">
  Mostrar año actual  <i class="fas fa-sync"></i>
</button>
</div>
</div>
    
  


    

<div id="sv"></div>
  

</div></div></div>
<!-- Medicos inicia -->

  <!-- Main Footer -->
  <?php

  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("Modales/FiltraPorPaciente.php");
  include ("Modales/FiltraPorFechas.php");
  include ("footer.php");?>
  
<script>
// Definir funciones aquí como respaldo si el archivo externo no carga
if (typeof CargaSignosVitalesLibre === 'undefined') {
    window.CargaSignosVitalesLibre = function(fecha_inicio, fecha_fin){
        if (!fecha_inicio) {
            fecha_inicio = new Date().getFullYear() + '-01-01';
        }
        if (!fecha_fin) {
            fecha_fin = new Date().getFullYear() + '-12-31';
        }
        var url = "https://saludapos.com/ControlDental/Consultas/RegistroLibre.php?fecha_inicio=" + encodeURIComponent(fecha_inicio) + "&fecha_fin=" + encodeURIComponent(fecha_fin);
        console.log("Cargando datos con URL:", url);
        $.get(url, "", function(data){
            $("#sv").html(data);
        }).fail(function(xhr, status, error) {
            console.error("Error al cargar datos:", error);
            alert("Error al cargar los datos. Por favor, intente nuevamente.");
        });
    };
}

if (typeof AplicarFiltroFechas === 'undefined') {
    window.AplicarFiltroFechas = function(){
        console.log("AplicarFiltroFechas llamada");
        var fecha_inicio = $("#fecha_inicio").val();
        var fecha_fin = $("#fecha_fin").val();
        console.log("Fecha inicio:", fecha_inicio, "Fecha fin:", fecha_fin);
        if (!fecha_inicio || !fecha_fin) {
            alert("Por favor, seleccione ambas fechas");
            return false;
        }
        if (fecha_inicio > fecha_fin) {
            alert("La fecha de inicio no puede ser mayor que la fecha de fin");
            return false;
        }
        $('#FiltraPorFechas').modal('hide');
        CargaSignosVitalesLibre(fecha_inicio, fecha_fin);
        return false;
    };
}
</script>
<script src="js/RegistroCitasGeneral.js" onload="console.log('RegistroCitasGeneral.js cargado')" onerror="console.error('Error al cargar RegistroCitasGeneral.js')"></script>
<script>
// Asegurar que el event listener se agregue después de cargar el script
$(document).ready(function() {
    console.log("Verificando funciones disponibles...");
    console.log("CargaSignosVitalesLibre:", typeof CargaSignosVitalesLibre);
    console.log("AplicarFiltroFechas:", typeof AplicarFiltroFechas);
    
    // Función para inicializar event listeners
    function initEventListeners() {
        if (typeof AplicarFiltroFechas === 'function') {
            console.log("Funciones disponibles, agregando event listeners");
            // Agregar event listener al botón
            $('#btnAplicarFiltro').off('click').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log("Click en botón desde script principal");
                AplicarFiltroFechas();
                return false;
            });
            return true;
        } else {
            console.error("AplicarFiltroFechas no está disponible");
            return false;
        }
    }
    
    // Intentar inicializar inmediatamente
    if (!initEventListeners()) {
        // Si no está disponible, reintentar después de un delay
        setTimeout(function() {
            if (!initEventListeners()) {
                console.warn("Las funciones aún no están disponibles después del timeout");
            }
        }, 500);
    }
});
</script>
<!-- ./wrapper -->
<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<!-- REQUIRED SCRIPTS -->


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