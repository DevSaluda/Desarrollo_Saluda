// Definir funciones globalmente antes de document.ready para que estén disponibles inmediatamente
window.CargaSignosVitalesLibre = function(fecha_inicio, fecha_fin){
    // Si no se proporcionan fechas, usar año actual por defecto
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

  
