$(document).on('change', '.estado-cita-select', function() {
    var select = $(this);
    var id = select.data('id');
    var nuevoEstado = select.val();
    // Mostrar modal de confirmación
    var modalHtml = '<div class="modal fade" id="modalConfirmEstado" tabindex="-1" role="dialog">' +
        '<div class="modal-dialog modal-dialog-centered" role="document">' +
        '<div class="modal-content">' +
        '<div class="modal-header"><h5 class="modal-title">Confirmar cambio de estado</h5>' +
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span></button></div>' +
        '<div class="modal-body">¿Deseas cambiar el estado de la cita a <b>' + nuevoEstado + '</b>?</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>' +
        '<button type="button" class="btn btn-primary" id="confirmarCambioEstado">Confirmar</button>' +
        '</div></div></div></div>';
    // Elimina modales previos si existen
    $('#modalConfirmEstado').remove();
    $('body').append(modalHtml);
    $('#modalConfirmEstado').modal('show');

    // Si cancela, regresa el select a su valor anterior
    $('#modalConfirmEstado .btn-secondary').on('click', function() {
        select.val(select.data('prev'));
    });

    // Al confirmar, realiza el AJAX
    $('#confirmarCambioEstado').on('click', function() {
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
                        var badge = select.closest('tr').find('button.btn-default.btn-sm');
                        badge.text(data.estado);
                        badge.css('background-color', data.color);
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
});

// Guarda el valor previo antes de cambiar
$(document).on('focus', '.estado-cita-select', function() {
    $(this).data('prev', $(this).val());
});
