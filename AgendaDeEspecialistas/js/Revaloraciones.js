function CargaRevaloraciones() {
    // Mostrar el overlay de carga
    $("#loading-overlay").show();
    
    $.ajax({
        url: "https://saludapos.com/AgendaDeCitas/Consultas/RevaloracionesAgendadas.php",
        method: "POST",
        data: "",
        success: function(data) {
            $("#CitasDeRevaloracion").html(data);
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar revaloraciones:", error);
            $("#CitasDeRevaloracion").html("<div class='alert alert-danger'>Error al cargar los datos. Por favor, intente nuevamente.</div>");
        },
        complete: function() {
            // Ocultar el overlay de carga
            $("#loading-overlay").hide();
        }
    });
}

// Cargar datos después de que el DOM esté listo
$(document).ready(function() {
    CargaRevaloraciones();
});