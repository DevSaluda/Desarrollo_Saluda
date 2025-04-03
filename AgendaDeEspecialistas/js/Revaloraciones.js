function CargaRevaloraciones() {
    // Mostrar el overlay de carga
    $("#loading-overlay").show();
    
    // Inicializar DataTables
    $('#CitasExteriores').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "https://saludapos.com/AgendaDeCitas/Consultas/RevaloracionesAgendadas.php",
            "type": "POST"
        },
        "columns": [
            { "title": "Folio" },
            { "title": "Paciente" },
            { "title": "Teléfono" },
            { "title": "Fecha" },
            { "title": "Sucursal" },
            { "title": "Médico" },
            { "title": "Turno" },
            { "title": "Motivo Consulta" },
            { "title": "Contacto por WhatsApp" },
            { "title": "Agendado por" },
            { "title": "Agregado el" },
            { "title": "Acciones" }
        ],
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
        },
        "initComplete": function() {
            // Ocultar el overlay de carga cuando la tabla esté lista
            $("#loading-overlay").hide();
        }
    });
}

// Cargar datos después de que el DOM esté listo
$(document).ready(function() {
    CargaRevaloraciones();
});