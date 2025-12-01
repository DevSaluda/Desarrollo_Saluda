// Variable global para la instancia de DataTable
var tablaSignosVitales = null;

// Definir funciones globalmente antes de document.ready para que estén disponibles inmediatamente
window.CargaSignosVitalesLibre = function(fecha_inicio, fecha_fin){
    // Si no se proporcionan fechas, usar año actual por defecto
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
    
    // Cargar los datos con el filtro
    CargaSignosVitalesLibre(fecha_inicio, fecha_fin);
    
    return false;
};

// Asegurar que jQuery esté disponible
$(document).ready(function() {
    console.log("Document ready - RegistroCitasGeneral.js cargado");
    
    // Agregar event listener al botón del modal usando delegación de eventos
    $(document).on('click', '#btnAplicarFiltro', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log("Click detectado en #btnAplicarFiltro");
        AplicarFiltroFechas();
        return false;
    });
    
    // Prevenir submit del formulario
    $(document).on('submit', '#formFiltroFechas', function(e) {
        e.preventDefault();
        AplicarFiltroFechas();
        return false;
    });
    
    // Cargar datos del año actual al iniciar
    CargaSignosVitalesLibre();
});

  
