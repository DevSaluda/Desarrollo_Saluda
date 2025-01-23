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
</head>
<body>
    <!-- Modal -->
    <div class="modal fade" id="modalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_carrito" name="id_carrito">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Producto</th>
                                <th>Nombre del Producto</th>
                                <th>Cantidad</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="productoList">
                            <!-- Productos generados dinámicamente -->
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
            // Evento para cargar productos cuando se abre el modal
            $('#modalAgregarProducto').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Botón que activó el modal
                var idCarrito = button.data('carrito-id'); // Extraer data-carrito-id
                $('#id_carrito').val(idCarrito); // Asignar al campo oculto

                cargarProductos(); // Llamar función para cargar productos
            });

            // Función para cargar productos en la tabla
            function cargarProductos() {
                $.ajax({
                    url: 'Consultas/ObtenerProductos.php',
                    method: 'GET',
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
                            html = '<tr><td colspan="4">No se encontraron productos.</td></tr>';
                        }
                        $('#productoList').html(html); // Insertar filas en la tabla
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al cargar los productos:', error);
                        $('#productoList').html('<tr><td colspan="4">Error al cargar los productos.</td></tr>');
                    }
                });
            }

            // Evento para agregar producto al carrito
            $(document).on('click', '.agregarProductoBtn', function() {
                var idProducto = $(this).data('id');
                var nombreProducto = $(this).data('nombre');
                var cantidad = $(this).closest('tr').find('.cantidadProducto').val();
                var idCarrito = $('#id_carrito').val();

                // Validar que la cantidad sea mayor a 0
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
                        id_carrito: idCarrito
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
