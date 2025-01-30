$(document).ready(function() {
    // Evento cuando se muestra el modal para agregar un procedimiento médico
    $('#modalAgregarProcedimiento').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var idPaciente = button.data('paciente-id'); // Extraer información de data-* (ID del paciente)
        $('#id_paciente').val(idPaciente); // Asignar al campo oculto del formulario
    });

    // Evento al hacer clic en el botón "Guardar Procedimiento"
    $('#guardarProcedimiento').on('click', function() {
        var formData = $('#formAgregarProcedimiento').serialize(); // Serializar datos del formulario

        // Enviar datos mediante AJAX
        $.ajax({
            url: 'Consultas/AgregarProcedimientoMedico.php', // URL del script PHP que maneja la inserción
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('Procedimiento médico agregado con éxito');
                location.reload(); // Recargar la página o actualizar la tabla de procedimientos
            },
            error: function() {
                alert('Error al agregar el procedimiento médico.');
            }
        });
    });
});