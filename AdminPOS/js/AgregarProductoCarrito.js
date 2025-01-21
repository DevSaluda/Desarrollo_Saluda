$(document).ready(function() {
    // Función para cargar productos en el modal
    function cargarProductos(idCarrito) {
        $.ajax({
            url: 'Consultas/ObtenerProductos.php', // Archivo PHP que obtiene los productos según el id_carrito
            method: 'GET',
            data: { id_carrito: idCarrito }, // Pasar el id_carrito como parámetro
            success: function(response) {
                // Procesar la respuesta y actualizar la vista del modal
                $('#productoList').html(response);
            },
            error: function() {
                alert('Error al cargar los productos del carrito');
            }
        });
    }

    // Evento cuando se muestra el modal
    $('#modalAgregarProducto').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var idCarrito = button.data('carrito-id'); // Obtener el id_carrito desde el atributo data-carrito-id
        
        // Cargar productos en el modal
        console.log("ID del Carrito: " + idCarrito);
        cargarProductos(idCarrito);
    });

    // Evento de búsqueda de productos
    $('#buscadorProducto').on('input', function() {
        var query = $(this).val().toLowerCase(); // Obtener el valor del buscador
        $('#productoList tr').each(function() {
            var nombreProducto = $(this).find('td').eq(1).text().toLowerCase(); // Obtener nombre del producto
            if (nombreProducto.includes(query)) {
                $(this).show(); // Mostrar el producto si coincide con la búsqueda
            } else {
                $(this).hide(); // Ocultar el producto si no coincide
            }
        });
    });

    // Evento para agregar producto al carrito
    $(document).on('click', '.agregarProductoBtn', function() {
        var idProducto = $(this).data('id'); // Obtener el ID del producto
        var nombreProducto = $(this).data('nombre'); // Obtener el nombre del producto
        var cantidad = 1; // Se puede cambiar para que el usuario ingrese una cantidad
        var idCarrito = $('#modalAgregarProducto').data('carrito-id'); // Obtener el ID del carrito desde el modal
        
        // Verificar si idCarrito está disponible
        if (!idCarrito) {
            alert('ID de carrito no disponible');
            return;
        }

        // Enviar la solicitud AJAX para agregar el producto al carrito
        $.ajax({
            url: 'Consultas/AgregarProductoACarrito.php', // El archivo que manejará la inserción
            method: 'POST',
            data: {
                id_carrito: idCarrito,
                id_producto: idProducto,
                cantidad: cantidad
            },
            success: function(response) {
                // Actualizar la lista de productos en el carrito
                alert('Producto agregado al carrito');
                location.reload(); // Recargar la página para ver el producto agregado
            },
            error: function() {
                alert('Hubo un error al agregar el producto al carrito');
            }
        });
    });
});
