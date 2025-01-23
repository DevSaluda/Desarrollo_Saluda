<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .modal-lg {
            max-width: 80%; /* Ajusta este valor según tus necesidades */
        }
    </style>
</head>
<body>
    <!-- Modal -->
    <div class="modal fade" id="modalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Agregar Producto al Carrito #<span id="carritoId"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Campo oculto para almacenar el id_carrito -->
                    <input type="hidden" id="id_carrito_hidden" value="<?php echo $carrito['ID_CARRITO']; ?>">

                    <!-- Barra de búsqueda -->
                    <div class="form-group">
                        <label for="buscarProducto">Buscar producto:</label>
                        <input type="text" id="buscarProducto" class="form-control" placeholder="Escribe el nombre del producto">
                    </div>
                    <!-- Tabla de productos -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Producto</th>
                                <th>Nombre del Producto</th>
                                <th>Cantidad</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="productoList">
                            <tr>
                                <td colspan="4">Escribe el nombre de un producto para buscar.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
    var debounceTimer;

    // Buscar productos al escribir
    $('#buscarProducto').on('input', function() {
        clearTimeout(debounceTimer);
        var query = $(this).val().trim();

        debounceTimer = setTimeout(function() {
            if (query.length >= 3) {
                buscarProductos(query);
            } else {
                $('#productoList').html('<tr><td colspan="4">Escribe al menos 3 caracteres para buscar productos.</td></tr>');
            }
        }, 300);
    });

    // Función para buscar productos
    function buscarProductos(query) {
        $.ajax({
            url: 'Consultas/ObtenerProductos.php',
            method: 'GET',
            data: {
                busqueda: query // Usamos un solo parámetro "busqueda"
            },
            dataType: 'json',
            success: function(response) {
                let html = '';
                if (response && Array.isArray(response) && response.length > 0) {
                    response.forEach(function(producto) {
                        html += `
                            <tr>
                                <td>${producto.ID_Prod_POS}</td>
                                <td>${producto.Nombre_Prod}</td>
                                <td>
                                    <input type="number" min="1" value="1" class="form-control cantidadProducto" data-id="${producto.ID_Prod_POS}">
                                </td>
                                <td>
                                    <button class="btn btn-primary agregarProductoBtn" 
                                            data-id="${producto.ID_Prod_POS}" 
                                            data-nombre="${producto.Nombre_Prod}">
                                        Agregar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    html = '<tr><td colspan="4">No se encontraron productos con ese nombre.</td></tr>';
                }
                $('#productoList').html(html);
            },
            error: function(xhr, status, error) {
                console.error('Error al buscar los productos:', error);
                $('#productoList').html('<tr><td colspan="4">Error al buscar productos.</td></tr>');
            }
        });
    }

    // Agregar producto al carrito
    $(document).on('click', '.agregarProductoBtn', function() {
        var idProducto = $(this).data('id');
        var nombreProducto = $(this).data('nombre');
        var cantidad = $(this).closest('tr').find('.cantidadProducto').val();
        var idCarrito = $('#id_carrito_hidden').val(); // Obtener id_carrito del campo oculto

        // Validar cantidad
        if (cantidad <= 0) {
            alert('La cantidad debe ser mayor a 0.');
            return;
        }

        // Enviar datos al servidor
        $.ajax({
            url: 'Consultas/AgregarProductoACarrito.php',
            method: 'POST',
            data: {
                id_producto: idProducto,
                cantidad: cantidad,
                id_carrito: idCarrito // Enviar el id_carrito
            },
            success: function(response) {
                alert('Producto agregado con éxito: ' + nombreProducto);
                // Opcional: Actualizar la tabla o realizar otra acción
            },
            error: function() {
                alert('Error al agregar producto.');
            }
        });
    });
});

</script>

</body>
</html>
