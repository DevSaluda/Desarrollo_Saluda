$(document).on('change', '.estado-cita-select', function() {
    var select = $(this);
    var id = select.data('id');
    var nuevoEstado = select.val();
    var color = '#6c757d';
    if (nuevoEstado === 'Pendiente') color = '#8B5C2A';
    if (nuevoEstado === 'Confirmado') color = '#28a745';
    if (nuevoEstado === 'Agendado') color = '#6c757d';

    $.ajax({
        url: 'https://saludapos.com/AgendaDeCitas/Consultas/ActualizaEstadoCitaV3.php',
        method: 'POST',
        data: {
            id: id,
            estado: nuevoEstado
        },
        success: function(response) {
            try {
                var data = typeof response === 'string' ? JSON.parse(response) : response;
                if (data.success) {
                    var badge = select.closest('tr').find('span.badge');
                    badge.text(data.estado);
                    badge.css('background-color', data.color);
                } else {
                    alert('No se pudo actualizar el estado: ' + (data.error || 'Error desconocido'));
                }
            } catch (e) {
                alert('Respuesta inesperada del servidor.');
            }
            // Opcional: mensaje de éxito
            // alert('Estado actualizado');
        },
        error: function() {
            alert('Error al actualizar el estado');
        }
    });
});
