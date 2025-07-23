$(document).on('click', '.solucion-btn', function() {
    const ticketId = $(this).data('id');
    $('#ticketId').val(ticketId);
    $('#SolucionModal').modal('show');

});

$('#SolucionForm').on('submit', function(e) {
    e.preventDefault();
    console.log($(this).serialize()); // <-- Agrega esto

    $.ajax({
        type: 'POST',
        url: 'https://saludapos.com/AdminPOS/Consultas/ActualizarSolucion.php',
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
