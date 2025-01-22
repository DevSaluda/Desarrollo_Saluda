<script>
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
                $('#productoList').html('<tr><td colspan="4">Error al cargar los productos.</td></tr>');
            }
        });
    }

    // Evento al abrir el modal para cargar los productos
    $('#modalAgregarProducto').on('show.bs.modal', function() {
        console.log('Modal abierto, cargando productos...');
        cargarProductos();
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
</script>

<!-- Modal HTML -->
<div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-labelledby="modalAgregarProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarProductoLabel">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Buscador -->
                <input type="text" id="buscadorProducto" class="form-control mb-3" placeholder="Buscar producto por nombre...">

                <!-- Contenedor de la tabla -->
                <div style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Producto</th>
                                <th>Nombre del Producto</th>
                                <th>Cantidad</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="productoList">
                            <!-- Aquí se insertarán los productos -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
