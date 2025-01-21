$(document).ready(function() {
    // Función para cargar productos en el modal
    function cargarProductos(idCarrito) {
        $.ajax({
            url: 'Consultas/ObtenerProductos.php', // Archivo PHP que obtiene los productos según el id_carrito
            method: 'GET',
            data: { id_carrito: idCarrito }, // Pasar el id_carrito como parámetro
            success: function(response) {
                let productos = JSON.parse(response); // Parsear el JSON
                let html = '';
                productos.forEach(function(producto) {
                    html += `
                        <tr>
                            <td>${producto.ID_Prod_POS}</td>
                            <td>${producto.Nombre_Prod}</td>
                            <td><input type="number" min="1" value="1" class="form-control cantidadProducto" data-id="${producto.ID_Prod_POS}"></td>
                            <td><button class="btn btn-primary agregarProductoBtn" data-id="${producto.ID_Prod_POS}" data-nombre="${producto.Nombre_Prod}">Agregar</button></td>
                        </tr>
                    `;
                });
                $('#productoList').html(html);
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
        $('#modalAgregarProducto').data('carrito-id', idCarrito); // Guardar el id_carrito en el modal
        cargarProductos(idCarrito); // Cargar productos en el modal
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
});
