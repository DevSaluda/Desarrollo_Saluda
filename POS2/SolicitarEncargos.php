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
        .content-wrapper {
            margin-left: 15px;
        }
        .content
        {
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
                    <input type="hidden" class="form-control" id="ID_H_O_D" name="ID_H_O_D" value="<?php echo $row['ID_H_O_D']?>">
                    <input type="hidden" class="form-control" id="Estado" name="Estado" value="Pendiente">
                    <input type="hidden" class="form-control" id="TipoEncargo" name="TipoEncargo" value="Producto">
                    <input type="hidden" id="IdentificadorEncargo" name="IdentificadorEncargo" value="<?php echo hexdec(uniqid()); ?>"> <!-- Identificador único -->
                    <input type="hidden" id="ID_Caja" name="ID_Caja" value="<?php echo $ValorCaja['ID_Caja']?>"> <!-- ID_Caja añadido -->
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
                
                <div class="form-group">
                    <label for="MontoAbonado">Monto Abonado</label>
                    <input type="number" step="0.01" class="form-control" id="MontoAbonado" name="MontoAbonado" required>
                </div>

                <div class="form-group">
                    <label for="MetodoDePago">Método de Pago</label>
                    <select class="form-control" id="MetodoDePago" name="MetodoDePago" required>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Tarjeta">Tarjeta</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" id="RequiereCambio" name="RequiereCambio"> ¿Requiere cambio?
                    </label>
                </div>

                <div class="form-group hidden-field" id="CambioContainer">
                    <label for="Cambio">Cambio</label>
                    <input type="number" step="0.01" class="form-control" id="Cambio" name="Cambio" readonly>
                </div>
                
                <button type="submit" class="btn btn-success">Guardar Encargo</button>
            </form>
        </div>
    </section>
</div>
<?php
else:
    // Mensaje en caso de que no haya caja abierta o asignada
    echo '<div class="alert alert-warning" style="margin-top: 20px; padding: 15px; background-color: #ffe8a1; border-color: #ffd966; color: #856404; border-radius: 8px;">';
    echo '<strong>¡Ups!</strong> Por el momento no hay una caja abierta o asignada.</div>';
endif;
?>

<?php include("footer.php");?>
<script>
$(document).ready(function() {
    let encargo = [];
    let typingTimer; // Temporizador para la función de validación

function calcularCambio() {
    let totalEncargo = parseFloat($('#totalEncargo').text()); // Total del encargo
    let minimoAbonar = totalEncargo * 0.5; // Mínimo a abonar es el 50% del total
    let montoAbonado = parseFloat($('#MontoAbonado').val()); // Monto abonado por el cliente
    let cambio = 0;

    if (montoAbonado < minimoAbonar) {
        alert('El monto abonado no puede ser menor al mínimo requerido.');
        $('#MontoAbonado').val(minimoAbonar.toFixed(2)); // Forzar el monto abonado al mínimo
        montoAbonado = minimoAbonar;
    } else if (montoAbonado >= totalEncargo) {
        cambio = montoAbonado - totalEncargo;
        $('#MontoAbonado').val(totalEncargo.toFixed(2)); // Ajustar el monto abonado al total si es mayor
    } else {
        cambio = 0; // No hay cambio si el monto abonado es válido pero menor al total
    }

    $('#Cambio').val(cambio.toFixed(2)); // Mostrar el cambio calculado
}

$('#MontoAbonado').on('input', function() {
    clearTimeout(typingTimer); // Cancela el temporizador anterior
    typingTimer = setTimeout(calcularCambio, 500); // Ejecuta la función después de 500ms de inactividad
});

$(document).ready(function() {
    $('#NombreCliente').on('input', function() {
        let nombre = $(this).val();
        if (nombre.length > 2) {
            $.ajax({
                url: 'Consultas/BuscarPaciente.php',
                type: 'POST',
                data: { nombre: nombre },
                success: function(data) {
                    $('#sugerenciasPacientes').html(data);
                }
            });
        } else {
            $('#sugerenciasPacientes').empty();
        }
    });

    $(document).on('click', '.paciente-sugerido', function() {
        let nombre = $(this).data('nombre');
        let telefono = $(this).data('telefono');
        $('#NombreCliente').val(nombre);
        $('#TelefonoCliente').val(telefono);
        $('#sugerenciasPacientes').empty();
    });
});


$('#RequiereCambio').change(function() {
    if ($(this).is(':checked')) {
        $('#CambioContainer').removeClass('hidden-field');
        calcularCambio(); // Calcular el cambio si se requiere
    } else {
        $('#CambioContainer').addClass('hidden-field');
        $('#Cambio').val('0'); // Asignar 0 al campo de cambio si no se requiere
    }
});

    $('#MontoAbonado').on('input', function() {
    calcularCambio(); // Recalcular cada vez que cambia el monto abonado
});

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

    $(document).on('submit', '#agregarProductoForm, #agregarProductoMultipleForm', function(e) {
        e.preventDefault();

        let formId = $(this).attr('id');
        let producto = {};

        if (formId === 'agregarProductoForm') {
            producto = {
                Cod_Barra: $('input[name="Cod_Barra"]').val(),
                Nombre_Prod: $('#Nombre_Prod').val(),
                Precio_Venta: parseFloat($('#Precio_Venta').val()),
                Cantidad: parseInt($('#Cantidad').val())
            };
        } else if (formId === 'agregarProductoMultipleForm') {
            let productoSeleccionado = JSON.parse($('#ProductoSeleccionado').val());
            producto = {
                Cod_Barra: productoSeleccionado.Cod_Barra,
                Nombre_Prod: productoSeleccionado.Nombre_Prod,
                Precio_Venta: parseFloat($('#Precio_Venta_Multiple').val()),
                Cantidad: parseInt($('#Cantidad_Multiple').val())
            };
        }

        // Verificar si el producto ya está en el encargo
        let productoExistente = encargo.find(p => p.Cod_Barra === producto.Cod_Barra);

        if (productoExistente) {
            // Si el producto ya existe, sumar la cantidad
            productoExistente.Cantidad += producto.Cantidad;
            productoExistente.Total = (productoExistente.Cantidad * productoExistente.Precio_Venta).toFixed(2);
        } else {
            // Si el producto no existe, añadirlo al encargo
            producto.Total = (producto.Cantidad * producto.Precio_Venta).toFixed(2);
            encargo.push(producto);
        }

        actualizarTablaEncargo();
        $('#productoFormContainer').empty(); // Limpiar el formulario de producto después de agregarlo
    });


    $(document).on('click', '.eliminar-producto', function() {
        const nombreProd = $(this).data('nombre-prod');
        encargo = encargo.filter(producto => producto.Nombre_Prod !== nombreProd);
        actualizarTablaEncargo();
    });

    // Validar el monto abonado antes de enviar el formulario
    $('#guardarEncargoForm').submit(function(e) {
        e.preventDefault();

        let montoAbonado = parseFloat($('#MontoAbonado').val());
        let pagoMinimo = parseFloat($('#pagoMinimo').text());

        // Validar que el monto abonado no sea menor al mínimo requerido
        if (montoAbonado < pagoMinimo) {
            alert("El monto abonado no puede ser menor que el mínimo requerido.");
            return; // No enviar el formulario si la validación falla
        }

        const formData = $(this).serializeArray();
        formData.push({ name: 'guardar_encargo', value: true });
        formData.push({ name: 'encargo', value: JSON.stringify(encargo) });
        formData.push({ name: 'Cambio', value: $('#Cambio').val() }); // Agregar el campo Cambio
        // Enviar a ManejoEncargos.php
        $.ajax({
            url: 'Consultas/ManejoEncargos.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Si el primer envío es exitoso, proceder a enviar a TicketsEncargos
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
                                $('#MontoAbonado').val(''); // Limpia el campo MontoAbonado
                                encargo = [];
                                location.reload();
                            } else if (response.error) {
                                alert("Encargo guardado, pero hubo un error al generar el ticket: " + response.error);
                                location.reload();
                            }
                        },
                        error: function(xhr, status, error) {
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
</script>
</body>
</html>