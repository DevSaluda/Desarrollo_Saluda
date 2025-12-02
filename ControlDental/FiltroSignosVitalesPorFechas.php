<?php
include "Consultas/Consultas.php";

// Obtener parámetros de fecha de la URL
$fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : date('Y-01-01');
$fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : date('Y-12-31');

// Validar y formatear fechas
$fecha_inicio_formatted = date('Y-m-d', strtotime($fecha_inicio)) . ' 00:00:00';
$fecha_fin_formatted = date('Y-m-d', strtotime($fecha_fin)) . ' 23:59:59';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Signos Vitales Filtrados | </title>

<?php include "Header.php"?>
</head>
<?php include_once ("Menu.php")?>

<div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
  Registro de signos vitales del <?php echo date('d/m/Y', strtotime($fecha_inicio)); ?> al <?php echo date('d/m/Y', strtotime($fecha_fin)); ?>  
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
<button type="button" class="btn btn-success btn-sm" onclick="window.location.href='RegistroSignosVitalesGeneral.php';" style="margin-left: 10px;">
  Volver a vista general  <i class="fas fa-arrow-left"></i>
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
  // Incluir modales con valores actualizados
  // Necesitamos pasar las fechas actuales a los modales
  $_GET['fecha_inicio'] = $fecha_inicio;
  $_GET['fecha_fin'] = $fecha_fin;
  include ("Modales/FiltraPorFechas.php");
  include ("Modales/FiltraPorMesSignosVitales.php");
  include ("footer.php");?>
  
<script>
// Variable global para la instancia de DataTable
var tablaSignosVitales = null;

// Función para cargar signos vitales
function CargaSignosVitalesLibre(fecha_inicio, fecha_fin){
    if (!fecha_inicio) {
        fecha_inicio = '<?php echo $fecha_inicio; ?>';
    }
    if (!fecha_fin) {
        fecha_fin = '<?php echo $fecha_fin; ?>';
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
                // Verificar si ya existe una instancia de DataTable
                if ($.fn.DataTable.isDataTable('#SignosVitales')) {
                    $('#SignosVitales').DataTable().destroy();
                }
                
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
                            title: 'Signos Vitales - <?php echo date("d/m/Y", strtotime($fecha_inicio)); ?> al <?php echo date("d/m/Y", strtotime($fecha_fin)); ?>',
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
}

// Función para aplicar filtro de fechas
function AplicarFiltroFechas(){
    console.log("=== AplicarFiltroFechas INICIADA ===");
    
    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_fin = $("#fecha_fin").val();
    
    console.log("Fecha inicio obtenida:", fecha_inicio);
    console.log("Fecha fin obtenida:", fecha_fin);
    
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
    
    // Redirigir a la vista de filtrado
    var url = 'FiltroSignosVitalesPorFechas.php?fecha_inicio=' + encodeURIComponent(fecha_inicio) + '&fecha_fin=' + encodeURIComponent(fecha_fin);
    console.log("Redirigiendo a:", url);
    window.location.href = url;
    
    return false;
}

// Función para aplicar filtro por mes
function AplicarFiltroMes(){
    console.log("=== AplicarFiltroMes INICIADA ===");
    
    var mes = $("#mesesSelect").val();
    var anual = $("#añosSelect").val();
    
    console.log("Mes obtenido:", mes);
    console.log("Año obtenido:", anual);
    
    if (!mes || !anual) {
        alert("Por favor, seleccione mes y año");
        return false;
    }
    
    // Calcular fecha inicio y fin del mes
    var fecha_inicio = anual + '-' + mes + '-01';
    var ultimoDia = new Date(anual, mes, 0).getDate();
    var fecha_fin = anual + '-' + mes + '-' + (ultimoDia < 10 ? '0' + ultimoDia : ultimoDia);
    
    console.log("Fecha inicio calculada:", fecha_inicio);
    console.log("Fecha fin calculada:", fecha_fin);
    
    // Cerrar el modal
    $('#FiltroPorMesSignosVitales').modal('hide');
    
    // Redirigir a la vista de filtrado
    var url = 'FiltroSignosVitalesPorFechas.php?fecha_inicio=' + encodeURIComponent(fecha_inicio) + '&fecha_fin=' + encodeURIComponent(fecha_fin);
    console.log("Redirigiendo a:", url);
    window.location.href = url;
    
    return false;
}

// Cargar datos al iniciar
$(document).ready(function() {
    console.log("Document ready - Cargando datos iniciales");
    
    // Agregar event listeners
    $(document).on('click', '#btnAplicarFiltro', function(e) {
        e.preventDefault();
        e.stopPropagation();
        AplicarFiltroFechas();
        return false;
    });
    
    $(document).on('click', '#btnAplicarFiltroMes', function(e) {
        e.preventDefault();
        e.stopPropagation();
        AplicarFiltroMes();
        return false;
    });
    
    // Cargar datos con las fechas de la URL
    CargaSignosVitalesLibre('<?php echo $fecha_inicio; ?>', '<?php echo $fecha_fin; ?>');
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

