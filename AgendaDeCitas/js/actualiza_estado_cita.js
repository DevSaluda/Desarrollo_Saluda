$(document).on('click', '.btn-cambiar-estado', function() {
    var btn = $(this);
    var id = btn.data('id');
    var estadoActual = btn.data('estado');
    var modalHtml = '<div class="modal fade" id="modalConfirmEstado" tabindex="-1" role="dialog">' +
        '<div class="modal-dialog modal-dialog-centered" role="document">' +
        '<div class="modal-content">' +
        '<div class="modal-header"><h5 class="modal-title">Cambiar estado de la cita</h5>' +
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span></button></div>' +
        '<div class="modal-body">' +
        '<label for="nuevoEstadoSelect">Selecciona el nuevo estado:</label>' +
        '<select id="nuevoEstadoSelect" class="form-control">' +
        '<option value="Pendiente"' + (estadoActual === 'Pendiente' ? ' selected' : '') + '>Pendiente</option>' +
        '<option value="Confirmado"' + (estadoActual === 'Confirmado' ? ' selected' : '') + '>Confirmado</option>' +
        '</select>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>' +
        '<button type="button" class="btn btn-primary" id="confirmarCambioEstado">Confirmar</button>' +
        '</div></div></div></div>';

    // Remueve cualquier modal previo
    $('#modalConfirmEstado').remove();
    $('body').append(modalHtml);
    $('#modalConfirmEstado').modal('show');

    $('#confirmarCambioEstado').off('click').on('click', function() {
        var nuevoEstado = $('#nuevoEstadoSelect').val();
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
                        // Actualiza badge y botón
                        var row = btn.closest('tr');
                        row.find('span.badge').text(data.estado);
                        btn.data('estado', data.estado);
                        $('#modalConfirmEstado').modal('hide');
                    } else {
                        alert('No se pudo actualizar el estado: ' + (data.error || 'Error desconocido'));
                    }
                } catch (e) {
                    alert('Respuesta inesperada del servidor.');
                }
            },
            error: function() {
                alert('Error al actualizar el estado');
            }
        });
    });

    $('#modalConfirmEstado').on('hidden.bs.modal', function() {
        $('#modalConfirmEstado').remove();
    });
});
