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
    console.log("=== AplicarFiltroFechas INICIADA ===");
    
    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_fin = $("#fecha_fin").val();
    
    console.log("Fecha inicio obtenida:", fecha_inicio);
    console.log("Fecha fin obtenida:", fecha_fin);
    
    if (!fecha_inicio || !fecha_fin) {
        alert("Por favor, seleccione ambas fechas");
        console.log("Validación fallida: fechas vacías");
        return false;
    }
    
    if (fecha_inicio > fecha_fin) {
        alert("La fecha de inicio no puede ser mayor que la fecha de fin");
        console.log("Validación fallida: fecha inicio > fecha fin");
        return false;
    }
    
    console.log("Validación exitosa, cerrando modal y redirigiendo...");
    
    // Cerrar el modal
    try {
        $('#FiltraPorFechas').modal('hide');
        console.log("Modal cerrado");
    } catch(e) {
        console.warn("Error al cerrar modal:", e);
    }
    
    // Redirigir a la misma página con los parámetros de fecha en la URL
    var url = window.location.pathname + '?fecha_inicio=' + encodeURIComponent(fecha_inicio) + '&fecha_fin=' + encodeURIComponent(fecha_fin);
    console.log("Redirigiendo a:", url);
    window.location.href = url;
    
    return false;
};

window.AplicarFiltroMes = function(){
    console.log("=== AplicarFiltroMes INICIADA ===");
    
    var mes = $("#mesesSelect").val();
    var anual = $("#añosSelect").val();
    
    console.log("Mes obtenido:", mes);
    console.log("Año obtenido:", anual);
    
    if (!mes || !anual) {
        alert("Por favor, seleccione mes y año");
        console.log("Validación fallida: mes o año vacío");
        return false;
    }
    
    // Calcular fecha inicio y fin del mes
    var fecha_inicio = anual + '-' + mes + '-01';
    var ultimoDia = new Date(anual, mes, 0).getDate();
    var fecha_fin = anual + '-' + mes + '-' + (ultimoDia < 10 ? '0' + ultimoDia : ultimoDia);
    
    console.log("Fecha inicio calculada:", fecha_inicio);
    console.log("Fecha fin calculada:", fecha_fin);
    
    // Cerrar el modal
    try {
        $('#FiltroPorMesSignosVitales').modal('hide');
        console.log("Modal cerrado");
    } catch(e) {
        console.warn("Error al cerrar modal:", e);
    }
    
    // Redirigir a la misma página con los parámetros de fecha en la URL
    var url = window.location.pathname + '?fecha_inicio=' + encodeURIComponent(fecha_inicio) + '&fecha_fin=' + encodeURIComponent(fecha_fin);
    console.log("Redirigiendo a:", url);
    window.location.href = url;
    
    return false;
};

// Asegurar que jQuery esté disponible
$(document).ready(function() {
    console.log("Document ready - RegistroCitasGeneral.js cargado");
    
    // Agregar event listener al botón del modal usando delegación de eventos
    $(document).on('click', '#btnAplicarFiltro', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log("Click detectado en #btnAplicarFiltro desde RegistroCitasGeneral.js");
        if (typeof AplicarFiltroFechas === 'function') {
            AplicarFiltroFechas();
        } else {
            console.error("AplicarFiltroFechas no está disponible");
            alert('Error: La función AplicarFiltroFechas no está disponible. Recargue la página.');
        }
        return false;
    });
    
    // Prevenir submit del formulario
    $(document).on('submit', '#formFiltroFechas', function(e) {
        e.preventDefault();
        AplicarFiltroFechas();
        return false;
    });
    
    // Event listener para filtro por mes
    $(document).on('click', '#btnAplicarFiltroMes', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log("Click detectado en #btnAplicarFiltroMes desde RegistroCitasGeneral.js");
        if (typeof AplicarFiltroMes === 'function') {
            AplicarFiltroMes();
        } else {
            console.error("AplicarFiltroMes no está disponible");
            alert('Error: La función AplicarFiltroMes no está disponible. Recargue la página.');
        }
        return false;
    });
    
    // Prevenir submit del formulario de mes
    $(document).on('submit', '#formFiltroMes', function(e) {
        e.preventDefault();
        AplicarFiltroMes();
        return false;
    });
    
    // La carga de datos se maneja desde el script inline en el HTML
    // para evitar cargas duplicadas y asegurar que funcione con parámetros de URL
});

  
