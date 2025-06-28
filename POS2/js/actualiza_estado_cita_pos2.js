$(document).on('click', '.cambiar-estado-btn', function() {
    var button = $(this);
    var id = button.data('id');
    var estadoActual = button.data('estado');
    // Modal para seleccionar nuevo estado
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
    // Elimina modales previos si existen
    $('#modalConfirmEstado').remove();
    $('body').append(modalHtml);
    $('#modalConfirmEstado').modal('show');

    // Al confirmar, realiza el AJAX
    $('#confirmarCambioEstado').on('click', function() {
        var nuevoEstado = $('#nuevoEstadoSelect').val();
        $.ajax({
            url: 'https://saludapos.com/POS2/Consultas/ActualizaEstadoCitaV3.php',
            method: 'POST',
            data: {
                id: id,
                estado: nuevoEstado
            },
            success: function(response) {
                try {
                    var data = typeof response === 'string' ? JSON.parse(response) : response;
                    if (data.success) {
                        var badge = button.closest('tr').find('span.badge');
                        badge.text(data.estado);
                        badge.css('background-color', data.color);
                        button.data('estado', data.estado);
                        $('#modalConfirmEstado').modal('hide');
                        setTimeout(function() { $('#modalConfirmEstado').remove(); }, 500);
                    } else {
                        alert('Error al actualizar el estado.');
                    }
                } catch (e) {
                    alert('Error en la respuesta del servidor.');
                }
            },
            error: function() {
                alert('No se pudo actualizar el estado.');
            }
        });
    });
    // Eliminar modal del DOM al cerrarse
    $('#modalConfirmEstado').on('hidden.bs.modal', function () {
        $('#modalConfirmEstado').remove();
    });
});

// Guarda el valor previo antes de cambiar
$(document).on('focus', '.estado-cita-select', function() {
    $(this).data('prev', $(this).val());
});
