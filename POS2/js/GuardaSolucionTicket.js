$(document).on('click', '.solucion-btn', function() {
    const ticketId = $(this).data('id');
    $('#ticketId').val(ticketId);
});

$('#SolucionForm').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: 'https://saludapos.com/POS2/Consultas/ActualizarSolucion.php',
        data: $(this).serialize(),
        success: function(response) {
            const result = JSON.parse(response);

            if (result.statusCode === 200) {
                $('#SolucionModal').modal('hide');
                $('#Tickets').DataTable().ajax.reload(null, false); // Recarga la tabla
                alert('Solución actualizada correctamente');
            } else {
                alert('Error al actualizar la solución');
            }
        },
        error: function() {
            alert('Error en la solicitud');
        }
    });
});
