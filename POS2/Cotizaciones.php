<?php
include 'Consultas/Consultas.php';
include "Consultas/ConsultaCaja.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cotizaciones | <?php echo $row['Nombre_Sucursal']?> </title>
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
        .content-wrapper {
            margin-left: 15px;
        }
        .content {
            margin-left: -100px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php include_once("Menu.php")?>
<?php if ($ValorCaja): ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h2>Crear Cotización</h2>
            <form id="buscarProductoForm">
                <div class="form-group">
                    <label for="Cod_Barra">Código de Barra o Nombre del Producto</label>
                    <input type="text" class="form-control" id="Cod_Barra" name="Cod_Barra" required>
                    <button type="submit" class="btn btn-primary mt-2">Buscar Producto</button>
                </div>
            </form>
            <div id="productoFormContainer"></div>
            <h3>Productos en la cotización</h3>
            <table class="table table-bordered" id="cotizacionTable">
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
            <h4 class="highlight">Total de la cotización: <span id="totalCotizacion">0</span></h4>
            <form id="guardarCotizacionForm">
                <div class="form-group hidden-field">
                    <input type="hidden" class="form-control" id="FkSucursal" name="FkSucursal" value="<?php echo $row['Fk_Sucursal']?>">
                    <input type="hidden" class="form-control" id="AgregadoPor" name="AgregadoPor" value="<?php echo $row['Nombre_Apellidos']?>">
                    <input type="hidden" class="form-control" id="ID_H_O_D" name="ID_H_O_D" value="<?php echo $row['ID_H_O_D']?>">
                    <input type="hidden" class="form-control" id="Estado" name="Estado" value="Pendiente">
                    <input type="hidden" class="form-control" id="TipoCotizacion" name="TipoCotizacion" value="Producto">
                    <input type="hidden" id="IdentificadorCotizacion" name="IdentificadorCotizacion" value="<?php echo hexdec(uniqid()); ?>">
                    <input type="hidden" id="ID_Caja" name="ID_Caja" value="<?php echo $ValorCaja['ID_Caja']?>">
                </div>

                <div class="form-group">
                    <label for="NombreCliente">Nombre del Paciente</label>
                    <input type="text" class="form-control" id="NombreCliente" name="NombreCliente" autocomplete="off" required>
                    <div id="sugerenciasPacientes" class="list-group"></div>
                </div>

                <div class="form-group">
                    <label for="TelefonoCliente">Teléfono</label>
                    <input type="text" class="form-control" id="TelefonoCliente" name="TelefonoCliente" required>
                </div>

                <button type="submit" class="btn btn-success">Guardar Cotización</button>
            </form>
        </div>
    </section>
</div>
<?php
else:
    echo '<div class="alert alert-warning" style="margin-top: 20px; padding: 15px; background-color: #ffe8a1; border-color: #ffd966; color: #856404; border-radius: 8px;">';
    echo '<strong>¡Ups!</strong> Por el momento no hay una caja abierta o asignada.</div>';
endif;
?>

<?php include("footer.php");?>

<script>
$(document).ready(function() {
    let cotizacion = [];

    function actualizarTablaCotizacion() {
        let total = 0;
        $('#cotizacionTable tbody').empty();
        cotizacion.forEach(function(producto) {
            total += parseFloat(producto.Total);
            $('#cotizacionTable tbody').append(`
                <tr>
                    <td>${producto.Cod_Barra}</td>
                    <td>${producto.Nombre_Prod}</td>
                    <td>${producto.Precio_Venta}</td>
                    <td>${producto.Cantidad || 'N/A'}</td>
                    <td>${producto.Total}</td>
                    <td>
                        <button class="btn btn-danger eliminar-producto" data-nombre-prod="${producto.Nombre_Prod}">Eliminar</button>
                    </td>
                </tr>
            `);
        });
        $('#totalCotizacion').text(total.toFixed(2));
    }

    $('#buscarProductoForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'Consultas/ManejoCotizaciones.php',
            type: 'POST',
            data: { buscar_producto: true, Cod_Barra: $('#Cod_Barra').val() },
            dataType: 'json',
            success: function(response) {
                if (response.productos.length === 1) {
                    const producto = response.productos[0];
                    let esProcedimiento = producto.Cod_Barra.length === 4;

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
                            ${esProcedimiento ? '' : `
                            <div class="form-group">
                                <label for="Cantidad">Cantidad</label>
                                <input type="number" class="form-control" id="Cantidad" name="Cantidad" required>
                            </div>
                            `}
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
                                <input type="hidden" id="CantidadMultiple" name="CantidadMultiple">
                            </div>
                            <button type="submit" class="btn btn-primary">Seleccionar Producto</button>
                        </form>
                    `);
                } else {
                    alert('Producto no encontrado.');
                }
            }
        });
    });

    $(document).on('submit', '#agregarProductoForm', function(e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        let productoData = {};
        formData.forEach(field => {
            productoData[field.name] = field.value;
        });
        
        let esProcedimiento = productoData.Cod_Barra.length === 4;
        productoData.Cantidad = esProcedimiento ? 'N/A' : $('#Cantidad').val();
        productoData.Total = (esProcedimiento ? parseFloat(productoData.Precio_Venta) : parseFloat(productoData.Precio_Venta) * parseFloat(productoData.Cantidad)).toFixed(2);
        
        // Verifica si el producto ya está en la cotización
        let productoExistente = cotizacion.find(prod => prod.Nombre_Prod === productoData.Nombre_Prod);
        if (!productoExistente) {
            cotizacion.push(productoData);
            actualizarTablaCotizacion();
        } else {
            alert('Este producto ya ha sido agregado.');
        }

        $('#productoFormContainer').html('');
        $('#Cod_Barra').val('');
    });

    $(document).on('submit', '#guardarCotizacionForm', function(e) {
        e.preventDefault();
        let productosData = cotizacion.map(producto => {
            return {
                Cod_Barra: producto.Cod_Barra,
                Nombre_Prod: producto.Nombre_Prod,
                Precio_Venta: producto.Precio_Venta,
                Cantidad: producto.Cantidad,
                Total: producto.Total
            };
        });

        let cotizacionData = $(this).serializeArray();
        cotizacionData.push({ name: 'productos', value: JSON.stringify(productosData) });

        $.ajax({
            url: 'Consultas/ManejoCotizaciones.php',
            type: 'POST',
            data: cotizacionData,
            success: function(response) {
                // Lógica para manejar la respuesta y mostrar el PDF generado
                if (response.success) {
                    // Mostrar mensaje de éxito o redirigir
                    alert('Cotización guardada con éxito.');
                } else {
                    alert('Error al guardar la cotización.');
                }
            }
        });
    });

    $(document).on('click', '.eliminar-producto', function() {
        let nombreProducto = $(this).data('nombre-prod');
        cotizacion = cotizacion.filter(prod => prod.Nombre_Prod !== nombreProducto);
        actualizarTablaCotizacion();
    });

});
</script>
</body>
</html>
