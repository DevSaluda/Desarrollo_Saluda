
    // Evento para agregar producto al carrito
    $(document).on('click', '.agregarProductoBtn', function() {
        var idProducto = $(this).data('id'); // Obtener el ID del producto
        var nombreProducto = $(this).data('nombre'); // Obtener el nombre del producto
        var cantidad = $(this).closest('tr').find('.cantidadProducto').val(); // Obtener la cantidad ingresada
        var idCarrito = $('#modalAgregarProducto').data('carrito-id'); // Obtener el ID del carrito desde el modal

        if (!idCarrito) {
            alert('ID de carrito no disponible');
            return;
        }

        $.ajax({
            url: 'Consultas/AgregarProductoACarrito.php',
            method: 'POST',
            data: {
                id_carrito: idCarrito,
                id_producto: idProducto,
                cantidad: cantidad
            },
            success: function(response) {
                alert('Producto agregado al carrito');
                location.reload(); // Recargar la página para ver el producto agregado
            },
            error: function() {
                alert('Hubo un error al agregar el producto al carrito');
            }
        });
    });

