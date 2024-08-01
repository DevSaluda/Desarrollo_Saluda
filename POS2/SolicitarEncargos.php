<?php
include 'Consultas/Consultas.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Encargos | <?php echo $row['Nombre_Sucursal']?> </title>
    <?php include "Header.php"?>
    <style>
        .error {
            color: red;
            margin-left: 5px; 
        }  
        .hidden-field {
            display: none;
        }
        .highlight {
            font-size: 1.2em;
            font-weight: bold;
        }
        .alert {
            margin-top: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php include_once("Menu.php")?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h2>Crear Encargo</h2>
            <form id="buscarProductoForm">
                <div class="form-group">
                    <label for="Cod_Barra">Código de Barra o Nombre del Producto</label>
                    <input type="text" class="form-control" id="Cod_Barra" name="Cod_Barra" required>
                    <button type="submit" class="btn btn-primary mt-2">Buscar Producto</button>
                </div>
            </form>
            <div id="productoFormContainer"></div>
            <h3>Productos en el encargo</h3>
            <table class="table table-bordered" id="encargoTable">
                <thead>
                    <tr>
                        <th>Código de Barra</th>
                        <th>Nombre del Producto</th>
                        <th>Precio de Venta</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <h4 class="highlight">Total del encargo: <span id="totalEncargo">0</span></h4>
            <h4 class="highlight">Pago mínimo requerido: <span id="pagoMinimo">0</span></h4>
            <form id="guardarEncargoForm">
    <div class="form-group hidden-field">
        
        <input type="hidden" class="form-control" id="FkSucursal" name="FkSucursal" value="<?php echo $row['Fk_Sucursal']?>">
        <input type="hidden" class="form-control" id="AgregadoPor" name="AgregadoPor" value="<?php echo $row['Nombre_Apellidos']?>">
        <input type="hidden" class="form-control" id="ID_H_O_D" name="ID_H_O_D" value="<?php echo $row['ID_H_O_D']?>" >
        <input type="hidden" class="form-control" id="Estado" name="Estado" value="Pendiente">
        <input type="hidden" class="form-control" id="TipoEncargo" name="TipoEncargo" value="Producto">
        <input type="hidden" id="IdentificadorEncargo" name="IdentificadorEncargo" value="<?php echo hexdec(uniqid()); ?>"> <!-- Identificador único -->
    </div>
    
    <div class="form-group">
        <label for="MontoAbonado">Monto Abonado</label>
        <input type="number" step="0.01" class="form-control" id="MontoAbonado" name="MontoAbonado" required>
    </div>
    
    <button type="submit" class="btn btn-success">Guardar Encargo</button>
</form>

        </div>
    </section>
</div>
<?php include("footer.php");?>
<script>
$(document).ready(function() {
    let encargo = [];

    function actualizarTablaEncargo() {
        let total = 0;
        $('#encargoTable tbody').empty();
        encargo.forEach(function(producto) {
            total += parseFloat(producto.Total);
            $('#encargoTable tbody').append(`
                <tr>
                    <td>${producto.Cod_Barra}</td>
                    <td>${producto.Nombre_Prod}</td>
                    <td>${producto.Precio_Venta}</td>
                    <td>${producto.Cantidad}</td>
                    <td>${producto.Total}</td>
                    <td>
                        <button class="btn btn-danger eliminar-producto" data-nombre-prod="${producto.Nombre_Prod}">Eliminar</button>
                    </td>
                </tr>
            `);
        });
        $('#totalEncargo').text(total.toFixed(2));
        $('#pagoMinimo').text((total * 0.5).toFixed(2));
    }

    $('#buscarProductoForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'Consultas/ManejoEncargos.php',
            type: 'POST',
            data: { buscar_producto: true, Cod_Barra: $('#Cod_Barra').val() },
            dataType: 'json',
            success: function(response) {
                if (response.productos.length === 1) {
                    const producto = response.productos[0];
                    $('#productoFormContainer').html(`
                        <form id="agregarProductoForm">
                            <input type="hidden" name="Cod_Barra" value="${producto.Cod_Barra}">
                            <input type="hidden" name="Precio_C" value="${producto.Precio_C}">
                            <input type="hidden" name="FkPresentacion" value="${producto.FkPresentacion || ''}">
                            <input type="hidden" name="Proveedor1" value="${producto.Proveedor1 || ''}">
                            <input type="hidden" name="Proveedor2" value="${producto.Proveedor2 || ''}">
                            <div class="form-group">
                                <label for="Nombre_Prod">Nombre del Producto</label>
                                <input type="text" class="form-control" id="Nombre_Prod" name="Nombre_Prod" value="${producto.Nombre_Prod}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="Precio_Venta">Precio de Venta</label>
                                <input type="number" step="0.01" class="form-control" id="Precio_Venta" name="Precio_Venta" value="${producto.Precio_Venta}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="Cantidad">Cantidad</label>
                                <input type="number" class="form-control" id="Cantidad" name="Cantidad" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar Producto</button>
                        </form>
                    `);
                } else if (response.productos.length > 1) {
    let dropdownOptions = response.productos.map(producto => `<option value='${JSON.stringify(producto)}'>${producto.Nombre_Prod}</option>`).join('');
    $('#productoFormContainer').html(`
        <form id="agregarProductoMultipleForm">
            <div class="form-group">
                <label for="ProductoSeleccionado">Seleccionar Producto</label>
                <select class="form-control" id="ProductoSeleccionado" name="ProductoSeleccionado">
                    ${dropdownOptions}
                </select>
            </div>
            <div class="form-group hidden-field">
                <input type="hidden" id="Precio_C_Multiple" name="Precio_C_Multiple">
                <input type="hidden" id="FkPresentacion_Multiple" name="FkPresentacion_Multiple">
                <input type="hidden" id="Proveedor1_Multiple" name="Proveedor1_Multiple">
                <input type="hidden" id="Proveedor2_Multiple" name="Proveedor2_Multiple">
            </div>
            <div class="form-group">
                <label for="Precio_Venta_Multiple">Precio de Venta</label>
                <input type="number" step="0.01" class="form-control" id="Precio_Venta_Multiple" name="Precio_Venta_Multiple" readonly>
            </div>
            <div class="form-group">
                <label for="Cantidad_Multiple">Cantidad</label>
                <input type="number" class="form-control" id="Cantidad_Multiple" name="Cantidad_Multiple" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Producto</button>
        </form>
    `);
    $('#ProductoSeleccionado').change();
}
else {
                    $('#productoFormContainer').html(`
                        <div class="alert alert-danger" role="alert">
                            Producto no encontrado. <button id="solicitarProducto" class="btn btn-warning">Solicitar Producto</button>
                        </div>
                    `);
                }
            }
        });
    });

    $(document).on('change', '#ProductoSeleccionado', function() {
    let productoSeleccionado = JSON.parse($(this).val());
    $('#Precio_Venta_Multiple').val(productoSeleccionado.Precio_Venta);
    $('#Precio_C_Multiple').val(productoSeleccionado.Precio_C);
    $('#FkPresentacion_Multiple').val(productoSeleccionado.FkPresentacion || '');
    $('#Proveedor1_Multiple').val(productoSeleccionado.Proveedor1 || '');
    $('#Proveedor2_Multiple').val(productoSeleccionado.Proveedor2 || '');
});


    $(document).on('click', '#solicitarProducto', function() {
        $('#productoFormContainer').html(`
            <form id="solicitarProductoForm">
                <div class="form-group">
                    <label for="Nombre_Prod_Solicitud">Nombre del Producto</label>
                    <input type="text" class="form-control" id="Nombre_Prod_Solicitud" name="Nombre_Prod_Solicitud" required>
                </div>
                <div class="form-group">
                    <label for="Precio_Venta_Solicitud">Precio de Venta</label>
                    <input type="number" step="0.01" class="form-control" id="Precio_Venta_Solicitud" name="Precio_Venta_Solicitud" required>
                </div>
                <div class="form-group">
                    <label for="Cantidad_Solicitud">Cantidad</label>
                    <input type="number" class="form-control" id="Cantidad_Solicitud" name="Cantidad_Solicitud" required>
                </div>
                <button type="submit" class="btn btn-primary">Agregar Producto</button>
            </form>
        `);
    });

    $(document).on('submit', '#solicitarProductoForm', function(e) {
        e.preventDefault();
        const nuevoProducto = {
            Cod_Barra: '',
            Nombre_Prod: $('#Nombre_Prod_Solicitud').val(),
            Precio_Venta: parseFloat($('#Precio_Venta_Solicitud').val()),
            Cantidad: parseInt($('#Cantidad_Solicitud').val()),
            Total: parseFloat($('#Precio_Venta_Solicitud').val()) * parseInt($('#Cantidad_Solicitud').val())
        };
        encargo.push(nuevoProducto);
        actualizarTablaEncargo();
        $('#productoFormContainer').empty();
    });

    $(document).on('submit', '#agregarProductoForm', function(e) {
    e.preventDefault();
    const producto = {
        Cod_Barra: $(this).find('input[name="Cod_Barra"]').val(),
        Nombre_Prod: $('#Nombre_Prod').val(),
        Precio_Venta: parseFloat($('#Precio_Venta').val()),
        Cantidad: parseInt($('#Cantidad').val()),
        Total: parseFloat($('#Precio_Venta').val()) * parseInt($('#Cantidad').val()),
        Precio_C: $(this).find('input[name="Precio_C"]').val() || 'NULL',
        FkPresentacion: $(this).find('input[name="FkPresentacion"]').val() || 'NULL',
        Proveedor1: $(this).find('input[name="Proveedor1"]').val() || 'NULL',
        Proveedor2: $(this).find('input[name="Proveedor2"]').val() || 'NULL'
    };
    encargo.push(producto);
    actualizarTablaEncargo();
    $('#productoFormContainer').empty();
});


$(document).on('submit', '#agregarProductoMultipleForm', function(e) {
    e.preventDefault();
    
    const productoSeleccionado = JSON.parse($('#ProductoSeleccionado').val());
    
    const producto = {
        Cod_Barra: productoSeleccionado.Cod_Barra || 'NULL',
        Nombre_Prod: productoSeleccionado.Nombre_Prod || 'NULL',
        Precio_Venta: parseFloat($('#Precio_Venta_Multiple').val()) || 0,
        Cantidad: parseInt($('#Cantidad_Multiple').val()) || 0,
        Total: (parseFloat($('#Precio_Venta_Multiple').val()) || 0) * (parseInt($('#Cantidad_Multiple').val()) || 0),
        Precio_C: $('#Precio_C_Multiple').val() || 'NULL',
        FkPresentacion: $('#FkPresentacion_Multiple').val() || 'NULL',
        Proveedor1: $('#Proveedor1_Multiple').val() || 'NULL',
        Proveedor2: $('#Proveedor2_Multiple').val() || 'NULL'
    };

    encargo.push(producto);
    actualizarTablaEncargo();
    $('#productoFormContainer').empty();
});

    $(document).on('click', '.eliminar-producto', function() {
        const nombreProd = $(this).data('nombre-prod');
        encargo = encargo.filter(producto => producto.Nombre_Prod !== nombreProd);
        actualizarTablaEncargo();
    });

    $('#guardarEncargoForm').submit(function(e) {
    e.preventDefault();
    const formData = $(this).serializeArray();
    formData.push({ name: 'guardar_encargo', value: true });
    formData.push({ name: 'encargo', value: JSON.stringify(encargo) });

    // Enviar a ManejoEncargos.php
    $('#guardarEncargoForm').submit(function(e) {
    e.preventDefault();
    const formData = $(this).serializeArray();
    formData.push({ name: 'guardar_encargo', value: true });
    formData.push({ name: 'encargo', value: JSON.stringify(encargo) });

    $.ajax({
        url: 'Consultas/ManejoEncargos.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $.ajax({
                    url: 'http://localhost:8080/ticket/TicketEncargos.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert("Encargo guardado correctamente y ticket generado.");
                            $('#encargoTable tbody').empty();
                            $('#totalEncargo').text('0');
                            $('#pagoMinimo').text('0');
                            $('#MontoAbonado').val('');
                            encargo = [];
                            location.reload();
                        } else if (response.error) {
                            alert("Encargo guardado, pero hubo un error al generar el ticket: " + response.error);
                            location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert("Encargo guardado, pero no se pudo enviar a TicketEncargos: " + error);
                        location.reload();
                    }
                });
            } else if (response.error) {
                alert(response.error);
                location.reload();
            }
        },
        error: function(xhr, status, error) {
            alert("Error al guardar el encargo: " + error);
            location.reload();
        }
    });
});




});
});
</script>
</body>
</html>