function CargaRevaloraciones() {
    // Mostrar el overlay de carga
    $("#loading-overlay").show();
    
    $.ajax({
        url: "https://saludapos.com/AgendaDeCitas/Consultas/RevaloracionesAgendadas.php",
        method: "POST",
        data: {
            draw: 1,
            start: 0,
            length: 10,
            search: { value: '' }
        },
        success: function(data) {
            $("#CitasDeRevaloracion").html(data);
            // Inicializar DataTables después de cargar los datos
            $('#CitasExteriores').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "https://saludapos.com/AgendaDeCitas/Consultas/RevaloracionesAgendadas.php",
                    "type": "POST"
                },
                "order": [[0, "desc"]],
                "pageLength": 10,
                "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
                "language": {
                    "url": "Componentes/Spanish.json"
                },
                "drawCallback": function() {
                    // Reasignar eventos después de cada redibujado de la tabla
                    $(".btn-Asiste").click(function(){
                        var id = $(this).data("id");
                        $.post("https://saludapos.com/AgendaDeCitas/Modales/AsistenciaPacienteRevaloracion.php", 
                            "id=" + id, 
                            function(data){
                                $("#form-editExt").html(data);
                                $("#TituloExt").html("¿El paciente asistió?");
                                $("#DiExt").removeClass("modal-dialog modal-lg modal-notify modal-success");
                                $("#DiExt").addClass("modal-dialog modal-sm modal-notify modal-success");
                            });
                        $('#editModalExt').modal('show');
                    });
                }
            });
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