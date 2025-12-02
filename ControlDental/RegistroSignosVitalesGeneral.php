<?php
include "Consultas/Consultas.php";

// Obtener parámetros de fecha de la URL
$fecha_inicio_url = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : null;
$fecha_fin_url = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : null;
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
  <?php 
  if ($fecha_inicio_url && $fecha_fin_url) {
      echo "Registro de signos vitales del " . date('d/m/Y', strtotime($fecha_inicio_url)) . " al " . date('d/m/Y', strtotime($fecha_fin_url));
  } else {
      echo "Registro de pacientes hasta el " . FechaCastellano(date('d-m-Y H:i:s'));
  }
  ?>  
  </div>
  
  <div style="padding: 15px;">
  <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#FiltraPorPaciente" class="btn btn-default" style="margin-right: 10px;">
  Filtrar por nombre de paciente  <i class="fas fa-prescription-bottle"></i>
</button>
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#FiltroPorMesSignosVitales" class="btn btn-default">
  Búsqueda por mes <i class="fas fa-calendar-week"></i>
</button>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#FiltraPorFechas" class="btn btn-default">
  Filtrar por rango de fechas <i class="fas fa-calendar-alt"></i>
</button>
<button type="button" class="btn btn-success btn-sm" onclick="window.location.href=window.location.pathname;" style="margin-left: 10px;">
  Mostrar año actual  <i class="fas fa-sync"></i>
</button>
<?php if ($fecha_inicio_url && $fecha_fin_url): ?>
<button type="button" class="btn btn-warning btn-sm" onclick="window.location.href=window.location.pathname;" style="margin-left: 10px;">
  Limpiar filtro  <i class="fas fa-times"></i>
</button>
<?php endif; ?>
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
  include ("Modales/FiltraPorMesSignosVitales.php");
  include ("footer.php");?>
  
<script>
// Variable global para la instancia de DataTable (si no está definida en el archivo externo)
if (typeof tablaSignosVitales === 'undefined') {
    var tablaSignosVitales = null;
}

// Función para cargar datos cuando la página esté lista
function cargarDatosIniciales() {
    var urlParams = new URLSearchParams(window.location.search);
    var fecha_inicio_url = urlParams.get('fecha_inicio');
    var fecha_fin_url = urlParams.get('fecha_fin');
    
    console.log("cargarDatosIniciales - fecha_inicio:", fecha_inicio_url, "fecha_fin:", fecha_fin_url);
    
    if (fecha_inicio_url && fecha_fin_url) {
        // Cargar con los parámetros de la URL
        console.log("Cargando con parámetros de URL:", fecha_inicio_url, fecha_fin_url);
        if (typeof CargaSignosVitalesLibre === 'function') {
            CargaSignosVitalesLibre(fecha_inicio_url, fecha_fin_url);
        } else {
            console.warn("CargaSignosVitalesLibre no disponible aún, reintentando...");
            setTimeout(cargarDatosIniciales, 200);
        }
    } else {
        // Cargar año actual por defecto
        console.log("No hay parámetros en URL, cargando año actual");
        if (typeof CargaSignosVitalesLibre === 'function') {
            CargaSignosVitalesLibre();
        } else {
            console.warn("CargaSignosVitalesLibre no disponible aún, reintentando...");
            setTimeout(cargarDatosIniciales, 200);
        }
    }
}

// Definir funciones aquí como respaldo si el archivo externo no carga
if (typeof CargaSignosVitalesLibre === 'undefined') {
    window.CargaSignosVitalesLibre = function(fecha_inicio, fecha_fin){
        if (!fecha_inicio) {
            fecha_inicio = new Date().getFullYear() + '-01-01';
        }
        if (!fecha_fin) {
            fecha_fin = new Date().getFullYear() + '-12-31';
        }
        var url = "https://saludapos.com/ControlDental/Consultas/RegistroLibreTabla.php?fecha_inicio=" + encodeURIComponent(fecha_inicio) + "&fecha_fin=" + encodeURIComponent(fecha_fin);
        console.log("Cargando datos con URL:", url);
        
        // Mostrar indicador de carga
        $("#sv").html('<div class="text-center"><i class="fas fa-spinner fa-spin fa-3x"></i><p>Cargando datos...</p></div>');
        
        $.get(url, "", function(data){
            // Destruir DataTable si existe
            if (tablaSignosVitales !== null) {
                try {
                    tablaSignosVitales.destroy();
                    tablaSignosVitales = null;
                } catch(e) {
                    console.warn("Error al destruir DataTable:", e);
                }
            }
            
            // Limpiar el contenedor
            $("#sv").html(data);
            
            // Inicializar DataTable después de cargar los datos
            setTimeout(function() {
                if ($('#SignosVitales').length > 0) {
                    tablaSignosVitales = $('#SignosVitales').DataTable({
                        "order": [[ 0, "desc" ]],
                        "language": {
                            "url": "Componentes/Spanish.json"
                        },
                        "buttons": [
                            {
                                extend: 'excelHtml5',
                                text: 'Exportar a Excel <i class="fas fa-file-excel"></i>',
                                titleAttr: 'Exportar a Excel',
                                title: 'Signos Vitales - ' + fecha_inicio + ' al ' + fecha_fin,
                                className: 'btn btn-success',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            }
                        ],
                        "dom": '<"d-flex justify-content-between"lBf>rtip',
                        "pageLength": 25,
                        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                        "responsive": true,
                        "autoWidth": false
                    });
                    console.log("DataTable inicializado correctamente");
                }
            }, 100);
        }).fail(function(xhr, status, error) {
            console.error("Error al cargar datos:", error);
            $("#sv").html('<div class="alert alert-danger">Error al cargar los datos. Por favor, intente nuevamente.</div>');
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
        // Cerrar el modal
        $('#FiltraPorFechas').modal('hide');
        
        // Redirigir a la misma página con los parámetros de fecha en la URL
        var url = window.location.pathname + '?fecha_inicio=' + encodeURIComponent(fecha_inicio) + '&fecha_fin=' + encodeURIComponent(fecha_fin);
        window.location.href = url;
        
        return false;
    };
}

if (typeof AplicarFiltroMes === 'undefined') {
    window.AplicarFiltroMes = function(){
        console.log("AplicarFiltroMes llamada");
        var mes = $("#mesesSelect").val();
        var anual = $("#añosSelect").val();
        console.log("Mes:", mes, "Año:", anual);
        if (!mes || !anual) {
            alert("Por favor, seleccione mes y año");
            return false;
        }
        // Calcular fecha inicio y fin del mes
        var fecha_inicio = anual + '-' + mes + '-01';
        var ultimoDia = new Date(anual, mes, 0).getDate();
        var fecha_fin = anual + '-' + mes + '-' + (ultimoDia < 10 ? '0' + ultimoDia : ultimoDia);
        // Cerrar el modal
        $('#FiltroPorMesSignosVitales').modal('hide');
        // Redirigir a la misma página con los parámetros de fecha en la URL
        var url = window.location.pathname + '?fecha_inicio=' + encodeURIComponent(fecha_inicio) + '&fecha_fin=' + encodeURIComponent(fecha_fin);
        window.location.href = url;
        return false;
    };
}
</script>
<script src="js/RegistroCitasGeneral.js" onload="console.log('RegistroCitasGeneral.js cargado'); setTimeout(cargarDatosIniciales, 100);" onerror="console.error('Error al cargar RegistroCitasGeneral.js')"></script>
<script>
// Asegurar que el event listener se agregue después de cargar el script
$(document).ready(function() {
    console.log("Verificando funciones disponibles...");
    console.log("CargaSignosVitalesLibre:", typeof CargaSignosVitalesLibre);
    console.log("AplicarFiltroFechas:", typeof AplicarFiltroFechas);
    
    // Verificar que las funciones estén disponibles
    console.log("AplicarFiltroFechas disponible:", typeof AplicarFiltroFechas);
    console.log("AplicarFiltroMes disponible:", typeof AplicarFiltroMes);
    
    // Agregar event listeners adicionales como respaldo (el onclick directo también funciona)
    $(document).on('click', '#btnAplicarFiltro', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log("Click en #btnAplicarFiltro desde event listener");
        if (typeof AplicarFiltroFechas === 'function') {
            AplicarFiltroFechas();
        } else {
            alert('Error: La función AplicarFiltroFechas no está disponible. Recargue la página.');
        }
        return false;
    });
    
    $(document).on('click', '#btnAplicarFiltroMes', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log("Click en #btnAplicarFiltroMes desde event listener");
        if (typeof AplicarFiltroMes === 'function') {
            AplicarFiltroMes();
        } else {
            alert('Error: La función AplicarFiltroMes no está disponible. Recargue la página.');
        }
        return false;
    });
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