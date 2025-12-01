// Asegurar que jQuery esté disponible
$(document).ready(function() {
    
    // Función para cargar signos vitales
    window.CargaSignosVitalesLibre = function(fecha_inicio = null, fecha_fin = null){
        // Si no se proporcionan fechas, usar año actual por defecto
        if (!fecha_inicio) {
            fecha_inicio = new Date().getFullYear() + '-01-01';
        }
        if (!fecha_fin) {
            fecha_fin = new Date().getFullYear() + '-12-31';
        }
        
        var url = "https://saludapos.com/ControlDental/Consultas/RegistroLibre.php?fecha_inicio=" + encodeURIComponent(fecha_inicio) + "&fecha_fin=" + encodeURIComponent(fecha_fin);
        
        $.get(url, "", function(data){
            $("#sv").html(data);
        }).fail(function(xhr, status, error) {
            console.error("Error al cargar datos:", error);
            alert("Error al cargar los datos. Por favor, intente nuevamente.");
        });
    };
    
    // Función para aplicar filtro de fechas
    window.AplicarFiltroFechas = function(){
        var fecha_inicio = $("#fecha_inicio").val();
        var fecha_fin = $("#fecha_fin").val();
        
        console.log("Aplicar filtro - Fecha inicio:", fecha_inicio, "Fecha fin:", fecha_fin);
        
        if (!fecha_inicio || !fecha_fin) {
            alert("Por favor, seleccione ambas fechas");
            return;
        }
        
        if (fecha_inicio > fecha_fin) {
            alert("La fecha de inicio no puede ser mayor que la fecha de fin");
            return;
        }
        
        // Cerrar el modal
        $('#FiltraPorFechas').modal('hide');
        
        // Cargar los datos con el filtro
        CargaSignosVitalesLibre(fecha_inicio, fecha_fin);
    };
    
    // Agregar event listener al botón del modal usando delegación de eventos
    // Esto funciona incluso si el modal se carga dinámicamente
    $(document).on('click', '#btnAplicarFiltro', function(e) {
        e.preventDefault();
        e.stopPropagation();
        AplicarFiltroFechas();
    });
    
    // También agregar onclick directo como respaldo
    if (typeof AplicarFiltroFechas === 'function') {
        // La función ya está disponible globalmente
    }
    
    // Cargar datos del año actual al iniciar
    CargaSignosVitalesLibre();
});

  
