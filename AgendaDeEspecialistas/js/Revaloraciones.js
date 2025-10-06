function CargaRevaloraciones() {
    // Mostrar el overlay de carga
    $("#loading-overlay").show();
    
    // Inicializar DataTables
    var tabla = $('#CitasExteriores').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "deferRender": true,
        "ajax": {
            "url": "https://saludapos.com/AgendaDeCitas/Consultas/RevaloracionesAgendadas.php",
            "type": "POST",
            "dataSrc": function(json){
                // Ocultar overlay al recibir datos
                $("#loading-overlay").hide();
                return json.data || [];
            },
            "error": function(){
                // Asegurar que el overlay no bloquee la vista ante errores
                $("#loading-overlay").hide();
            }
        },
        // Mapear por índice (el endpoint regresa arreglo de arreglos)
        "columns": [
            { "data": 0, "title": "Folio" },
            { "data": 1, "title": "Paciente" },
            { "data": 2, "title": "Teléfono" },
            { "data": 3, "title": "Fecha" },
            { "data": 4, "title": "Sucursal" },
            { "data": 5, "title": "Médico" },
            { "data": 6, "title": "Turno" },
            { "data": 7, "title": "Motivo Consulta" },
            { "data": 8, "title": "Contacto por WhatsApp", "orderable": false, "searchable": false },
            { "data": 9, "title": "Agendado por" },
            { "data": 10, "title": "Agregado el" },
            { "data": 11, "title": "Acciones", "orderable": false, "searchable": false }
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
            // Asegurar overlay oculto tras cada draw
            $("#loading-overlay").hide();
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