$(document).ready(function() {
    $('#modalAgregarProducto').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var idCarrito = button.data('carrito-id'); // Extraer información de data-*
        $('#id_carrito').val(idCarrito); // Asignar al campo oculto
    });

    $('#guardarProducto').on('click', function() {
        var formData = $('#formAgregarProducto').serialize(); // Serializar datos del formulario
        $.ajax({
            url: 'Consultas/AgregarProductoACarrito.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('Producto agregado con éxito');
                location.reload(); // Recargar la página o actualizar tabla
            },
            error: function() {
                alert('Error al agregar producto.');
            }
        });
    });
});
