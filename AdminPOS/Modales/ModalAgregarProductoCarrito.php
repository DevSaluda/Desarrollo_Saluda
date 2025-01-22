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
    <!-- Modal HTML -->
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
                    <form id="formAgregarProducto">
                        <div class="form-group">
                            <label for="producto">Producto</label>
                            <select id="producto" name="producto" class="form-control" required>
                                <!-- Opciones generadas desde el backend -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" id="cantidad" name="cantidad" class="form-control" required>
                        </div>
                    </form>
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
                            <!-- Aquí se insertan las filas dinámicamente -->
                        </tbody>
                    </table>
                    <input type="text" id="buscadorProducto" class="form-control" placeholder="Buscar producto...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="guardarProducto">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Registro del evento para cargar productos al abrir el modal
            $('#modalAgregarProducto').on('show.bs.modal', function() {
                console.log('Modal abierto, intentando cargar productos...');
                cargarProductos(); // Llama a la función para cargar productos
            });

            // Función para cargar productos
            function cargarProductos() {
                $.ajax({
                    url: 'Consultas/ObtenerProductos.php', // Ruta al archivo PHP
                    method: 'GET', // Método de la solicitud
                    dataType: 'json', // Tipo de datos esperados
                    success: function(response) {
                        console.log('Productos cargados:', response); // Verifica que los datos llegan correctamente

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

                        console.log('HTML generado:', html); // Verifica el HTML generado
                        $('#productoList').html(html); // Inserta el contenido en la tabla
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al cargar los productos:', error);
                        console.error('Respuesta del servidor:', xhr.responseText);
                        $('#productoList').html('<tr><td colspan="4">Error al cargar los productos.</td></tr>');
                    }
                });
            }
        });
    </script>
</body>
</html>
