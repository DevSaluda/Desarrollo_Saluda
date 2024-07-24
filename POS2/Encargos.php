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
                    <label for="Cod_Barra">Código de Barra</label>
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
            <form id="buscarProductoForm">
    <div class="form-group">
        <label for="Cod_Barra">Código de Barra</label>
        <input type="text" class="form-control" id="Cod_Barra" name="Cod_Barra">
    </div>
    <div class="form-group">
        <label for="Nombre_Prod">Nombre del Producto</label>
        <input type="text" class="form-control" id="Nombre_Prod" name="Nombre_Prod">
    </div>
    <button type="submit" class="btn btn-primary mt-2">Buscar Producto</button>
</form>

                <div class="form-group hidden-field">
                    <input type="hidden" class="form-control" id="FkSucursal" name="FkSucursal" value="<?php echo $row['Fk_Sucursal']?>">
                    <input type="hidden" class="form-control" id="AgregadoPor" name="AgregadoPor" value="<?php echo $row['Nombre_Apellidos']?>">
                    <input type="hidden" class="form-control" id="ID_H_O_D" name="ID_H_O_D" value="<?php echo $row['ID_H_O_D']?>" >
                    <input type="hidden" class="form-control" id="Estado" name="Estado" value="Pendiente">
                    <input type="hidden" class="form-control" id="TipoEncargo" name="TipoEncargo" value="Producto">
                    <input type="hidden" id="IdentificadorEncargo" name="IdentificadorEncargo" value="<?php echo hexdec(uniqid("ENC_")); ?>"> <!-- Identificador único -->
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
            total += producto.Total;
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
        data: { 
            buscar_producto: true, 
            Cod_Barra: $('#Cod_Barra').val(), 
            Nombre_Prod: $('#Nombre_Prod').val() 
        },
        dataType: 'json',
        success: function(response) {
            if (response.producto_encontrado) {
                const producto = response.producto_encontrado;
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
            } else {
                $('#productoFormContainer').html(`
                    <div class="alert alert-danger" role="alert">
                        Producto no encontrado. <button id="solicitarProducto" class="btn btn-warning">Solicitar Producto</button>
                    </div>
                `);
            }
        }
    });
});


    $(document).on('click', '#solicitarProducto', function() {
        $('#productoFormContainer').html(`
            <form id="solicitarProductoForm">
                <div class="form-group">
                    <label for="Nombre_Prod_Solicitud">Nombre del Producto</label>
                    <input type="text" class="form-control" id="Nombre_Prod_Solicitud" name="Nombre_Prod_Solicitud" required>
                </div>
                <div class="form-group">
                    <label for="Precio_Compra">Precio de Compra</label>
                    <input type="number" step="0.01" class="form-control" id="Precio_Compra" name="Precio_Compra" required>
                </div>
                <div class="form-group">
                    <label for="Precio_Venta_Solicitud">Precio de Venta</label>
                    <input type="number" step="0.01" class="form-control" id="Precio_Venta_Solicitud" name="Precio_Venta_Solicitud" required>
                </div>
                <div class="form-group">
                    <label for="Cantidad_Solicitud">Cantidad</label>
                    <input type="number" class="form-control" id="Cantidad_Solicitud" name="Cantidad_Solicitud" required>
                </div>
                <button type="submit" class="btn btn-primary">Agregar Producto Solicitado</button>
            </form>
        `);
    });

    $(document).on('submit', '#solicitarProductoForm', function(e) {
        e.preventDefault();
        const producto = {
            Nombre_Prod: $('#Nombre_Prod_Solicitud').val(),
            Precio_Compra: parseFloat($('#Precio_Compra').val()),
            Precio_Venta: parseFloat($('#Precio_Venta_Solicitud').val()),
            Cantidad: parseInt($('#Cantidad_Solicitud').val()),
            Total: parseFloat($('#Precio_Venta_Solicitud').val()) * parseInt($('#Cantidad_Solicitud').val()),
            Cod_Barra: '', // Para productos solicitados el código de barra estará vacío.
            Precio_C: $('#Precio_Compra').val(),
            FkPresentacion: null,
            Proveedor1: null,
            Proveedor2: null
        };

        encargo.push(producto);
        actualizarTablaEncargo();
        $('#productoFormContainer').empty();
    });

    $(document).on('submit', '#agregarProductoForm', function(e) {
        e.preventDefault();
        const producto = {
            Cod_Barra: $('input[name="Cod_Barra"]').val(),
            Nombre_Prod: $('#Nombre_Prod').val(),
            Precio_Venta: parseFloat($('#Precio_Venta').val()),
            Cantidad: parseInt($('#Cantidad').val()),
            Total: parseFloat($('#Precio_Venta').val()) * parseInt($('#Cantidad').val()),
            Precio_C: $('input[name="Precio_C"]').val(),
            FkPresentacion: $('input[name="FkPresentacion"]').val(),
            Proveedor1: $('input[name="Proveedor1"]').val(),
            Proveedor2: $('input[name="Proveedor2"]').val()
        };

        let productoExistente = encargo.find(p => p.Cod_Barra === producto.Cod_Barra);
        if (productoExistente) {
            productoExistente.Cantidad += producto.Cantidad;
            productoExistente.Total += producto.Total;
        } else {
            encargo.push(producto);
        }

        actualizarTablaEncargo();
        $('#productoFormContainer').empty();
    });
    
    $(document).on('click', '.eliminar-producto', function() {
        const nomProd = $(this).data('nombre_prod');
        encargo = encargo.find(producto => producto.Nombre_Prod !== nomProd);
        actualizarTablaEncargo();
    });

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
                    alert(response.success);
                    $('#encargoTable tbody').empty();
                    $('#totalEncargo').text('0');
                    $('#pagoMinimo').text('0');
                    encargo = [];
                    location.reload();
                } else if (response.error) {
                    alert(response.error);
                }
            }
        });
    });
});
</script>
</body>
</html>
