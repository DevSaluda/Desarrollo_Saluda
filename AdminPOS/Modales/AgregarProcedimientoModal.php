<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Procedimientos Médicos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Registro de Procedimientos Médicos</h1>
        <div class="mb-3">
            <label for="searchProducto" class="form-label">Buscar Producto</label>
            <input type="text" id="searchProducto" class="form-control" placeholder="Ingrese el nombre del producto">
        </div>
        <div class="mb-3">
            <label for="procedimientoPrincipal" class="form-label">Procedimiento Principal</label>
            <input type="text" id="procedimientoPrincipal" class="form-control" readonly>
            <button class="btn btn-primary mt-2" onclick="seleccionarProcedimientoPrincipal()">Seleccionar</button>
        </div>
        <div class="mb-3">
            <h3>Insumos Seleccionados</h3>
            <ul id="listaInsumos" class="list-group"></ul>
        </div>
        <div class="mb-3">
            <button class="btn btn-success" onclick="guardarProcedimiento()">Guardar Procedimiento</button>
        </div>
    </div>

    <!-- Modal para seleccionar productos -->
    <div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="modalProductosLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProductosLabel">Seleccionar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="listaProductos" class="list-group"></ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>