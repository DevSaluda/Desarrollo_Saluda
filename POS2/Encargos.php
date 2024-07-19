<?php
include "Consultas/Consultas.php";
session_start();

if (!isset($_SESSION['encargo'])) {
    $_SESSION['encargo'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'buscar_producto') {
        $Cod_Barra = $_POST['Cod_Barra'];
        $query = "SELECT * FROM Productos_POS WHERE Cod_Barra='$Cod_Barra'";
        $result = mysqli_query($conn, $query);
        $producto = mysqli_fetch_assoc($result);

        if ($producto) {
            echo json_encode(['status' => 'found', 'producto' => $producto]);
        } else {
            echo json_encode(['status' => 'not_found', 'Cod_Barra' => $Cod_Barra]);
        }
        exit;
    }

    if (isset($_POST['action']) && $_POST['action'] == 'agregar_producto') {
        $Cod_Barra = $_POST['Cod_Barra'];
        $Nombre_Prod = $_POST['Nombre_Prod'];
        $Precio_Venta = $_POST['Precio_Venta'];
        $Cantidad = (int)$_POST['Cantidad'];

        $producto_existe = false;
        foreach ($_SESSION['encargo'] as &$producto) {
            if ($producto['Cod_Barra'] === $Cod_Barra) {
                $producto['Cantidad'] += $Cantidad;
                $producto['Total'] = $producto['Precio_Venta'] * $producto['Cantidad'];
                $producto_existe = true;
                break;
            }
        }
        if (!$producto_existe) {
            $producto = [
                'Cod_Barra' => $Cod_Barra,
                'Nombre_Prod' => $Nombre_Prod,
                'Precio_Venta' => $Precio_Venta,
                'Cantidad' => $Cantidad,
                'Total' => $Precio_Venta * $Cantidad
            ];
            $_SESSION['encargo'][] = $producto;
        }

        echo json_encode(['status' => 'success', 'encargo' => $_SESSION['encargo']]);
        exit;
    }

    if (isset($_POST['action']) && $_POST['action'] == 'eliminar_producto') {
        $Cod_Barra = $_POST['Cod_Barra'];
        foreach ($_SESSION['encargo'] as $index => $producto) {
            if ($producto['Cod_Barra'] === $Cod_Barra) {
                unset($_SESSION['encargo'][$index]);
                $_SESSION['encargo'] = array_values($_SESSION['encargo']); // Reindexar el array
                break;
            }
        }
        echo json_encode(['status' => 'success', 'encargo' => $_SESSION['encargo']]);
        exit;
    }

    if (isset($_POST['action']) && $_POST['action'] == 'guardar_encargo') {
        $Fk_sucursal = $_POST['Fk_sucursal'];
        $MontoAbonado = $_POST['MontoAbonado'];
        $AgregadoPor = $_POST['AgregadoPor'];
        $ID_H_O_D = $_POST['ID_H_O_D'];
        $Estado = $_POST['Estado'];
        $TipoEncargo = $_POST['TipoEncargo'];
        $Fecha_Ingreso = date('Y-m-d');
        $AgregadoEl = date('Y-m-d');

        foreach ($_SESSION['encargo'] as $producto) {
            $Cod_Barra = $producto['Cod_Barra'];
            $Nombre_Prod = $producto['Nombre_Prod'];
            $Precio_Venta = $producto['Precio_Venta'];
            $Cantidad = $producto['Cantidad'];
            $sql = "INSERT INTO Encargos_POS (Cod_Barra, Nombre_Prod, Fk_sucursal, MontoAbonado, Precio_Venta, Precio_C, Cantidad, Fecha_Ingreso, FkPresentacion, Proveedor1, Proveedor2, AgregadoPor, AgregadoEl, ID_H_O_D, Estado, TipoEncargo)
                    VALUES ('$Cod_Barra', '$Nombre_Prod', '$Fk_sucursal', '$MontoAbonado', '$Precio_Venta', '', '$Cantidad', '$Fecha_Ingreso', '', '', '', '$AgregadoPor', '$AgregadoEl', '$ID_H_O_D', '$Estado', '$TipoEncargo')";
            mysqli_query($conn, $sql);
        }
        $_SESSION['encargo'] = [];
        echo json_encode(['status' => 'success']);
        exit;
    }
}

function calcularTotalEncargo($encargo) {
    $total = 0;
    foreach ($encargo as $producto) {
        $total += $producto['Total'];
    }
    return $total;
}

function calcularPagoMinimo($total) {
    return $total * 0.5;
}
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
    </style>
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

            <div id="productoEncontradoForm" style="display:none;">
                <form id="agregarProductoForm">
                    <input type="hidden" name="Cod_Barra" id="Cod_Barra_Encontrado">
                    <div class="form-group">
                        <label for="Nombre_Prod">Nombre del Producto</label>
                        <input type="text" class="form-control" id="Nombre_Prod" name="Nombre_Prod" readonly>
                    </div>
                    <div class="form-group">
                        <label for="Precio_Venta">Precio de Venta</label>
                        <input type="number" step="0.01" class="form-control" id="Precio_Venta" name="Precio_Venta" readonly>
                    </div>
                    <div class="form-group">
                        <label for="Cantidad">Cantidad</label>
                        <input type="number" class="form-control" id="Cantidad" name="Cantidad" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Producto</button>
                </form>
            </div>

            <div id="productoNoEncontradoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Producto no encontrado</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Producto no encontrado. ¿Desea agregarlo de todos modos?
                        </div>
                        <div class="modal-footer">
                            <form id="agregarProductoNoEncontradoForm">
                                <input type="hidden" name="Cod_Barra" id="Cod_Barra_NoEncontrado">
                                <div class="form-group">
                                    <label for="Nombre_Prod">Nombre del Producto</label>
                                    <input type="text" class="form-control" id="Nombre_Prod_NoEncontrado" name="Nombre_Prod" required>
                                </div>
                                <div class="form-group">
                                    <label for="Precio_Venta">Precio de Venta</label>
                                    <input type="number" step="0.01" class="form-control" id="Precio_Venta_NoEncontrado" name="Precio_Venta" required>
                                </div>
                                <div class="form-group">
                                    <label for="Cantidad">Cantidad</label>
                                    <input type="number" class="form-control" id="Cantidad_NoEncontrado" name="Cantidad" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Agregar Producto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Productos en el Encargo</h3>
            <table class="table table-striped">
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
                <tbody id="productosEncargo">
                    <!-- Aquí se agregarán las filas de productos mediante Ajax -->
                </tbody>
            </table>

            <h4>Total del Encargo: <span id="totalEncargo">0.00</span></h4>
            <h4>Pago Mínimo: <span id="pagoMinimo">0.00</span></h4>

            <form id="guardarEncargoForm">
                <div class="form-group">
                    <label for="Fk_sucursal">Sucursal</label>
                    <input type="text" class="form-control" id="Fk_sucursal" name="Fk_sucursal" required>
                </div>
                <div class="form-group">
                    <label for="MontoAbonado">Monto Abonado</label>
                    <input type="number" step="0.01" class="form-control" id="MontoAbonado" name="MontoAbonado" required>
                </div>
                <input type="hidden" name="AgregadoPor" value="<?php echo $_SESSION['usuario']; ?>">
                <input type="hidden" name="ID_H_O_D" value="1">
                <input type="hidden" name="Estado" value="Pendiente">
                <input type="hidden" name="TipoEncargo" value="Normal">
                <button type="submit" class="btn btn-success">Guardar Encargo</button>
            </form>
        </div>
    </section>
</div>

<?php include("footer.php")?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Función para actualizar la tabla de productos
    function actualizarTablaProductos(encargo) {
        let total = 0;
        let $tbody = $('#productosEncargo');
        $tbody.empty();
        encargo.forEach(producto => {
            let $tr = $('<tr>');
            $tr.append('<td>' + producto.Cod_Barra + '</td>');
            $tr.append('<td>' + producto.Nombre_Prod + '</td>');
            $tr.append('<td>' + producto.Precio_Venta.toFixed(2) + '</td>');
            $tr.append('<td>' + producto.Cantidad + '</td>');
            $tr.append('<td>' + producto.Total.toFixed(2) + '</td>');
            $tr.append('<td><button class="btn btn-danger btn-sm eliminarProducto" data-cod_barra="' + producto.Cod_Barra + '">Eliminar</button></td>');
            $tbody.append($tr);
            total += producto.Total;
        });
        $('#totalEncargo').text(total.toFixed(2));
        $('#pagoMinimo').text((total * 0.5).toFixed(2));
    }

    // Buscar producto
    $('#buscarProductoForm').submit(function(e) {
        e.preventDefault();
        let Cod_Barra = $('#Cod_Barra').val();
        $.post('encargo.php', { action: 'buscar_producto', Cod_Barra: Cod_Barra }, function(response) {
            let data = JSON.parse(response);
            if (data.status === 'found') {
                $('#Cod_Barra_Encontrado').val(data.producto.Cod_Barra);
                $('#Nombre_Prod').val(data.producto.Nombre_Prod);
                $('#Precio_Venta').val(data.producto.Precio_Venta);
                $('#productoEncontradoForm').show();
            } else {
                $('#Cod_Barra_NoEncontrado').val(data.Cod_Barra);
                $('#productoNoEncontradoModal').modal('show');
            }
        });
    });

    // Agregar producto encontrado
    $('#agregarProductoForm').submit(function(e) {
        e.preventDefault();
        let productoData = $(this).serialize() + '&action=agregar_producto';
        $.post('encargo.php', productoData, function(response) {
            let data = JSON.parse(response);
            if (data.status === 'success') {
                actualizarTablaProductos(data.encargo);
                $('#productoEncontradoForm').hide();
                $('#buscarProductoForm')[0].reset();
            }
        });
    });

    // Agregar producto no encontrado
    $('#agregarProductoNoEncontradoForm').submit(function(e) {
        e.preventDefault();
        let productoData = $(this).serialize() + '&action=agregar_producto';
        $.post('encargo.php', productoData, function(response) {
            let data = JSON.parse(response);
            if (data.status === 'success') {
                actualizarTablaProductos(data.encargo);
                $('#productoNoEncontradoModal').modal('hide');
                $('#buscarProductoForm')[0].reset();
            }
        });
    });

    // Eliminar producto del encargo
    $(document).on('click', '.eliminarProducto', function() {
        let Cod_Barra = $(this).data('cod_barra');
        $.post('encargo.php', { action: 'eliminar_producto', Cod_Barra: Cod_Barra }, function(response) {
            let data = JSON.parse(response);
            if (data.status === 'success') {
                actualizarTablaProductos(data.encargo);
            }
        });
    });

    // Guardar encargo
    $('#guardarEncargoForm').submit(function(e) {
        e.preventDefault();
        let encargoData = $(this).serialize() + '&action=guardar_encargo';
        $.post('encargo.php', encargoData, function(response) {
            let data = JSON.parse(response);
            if (data.status === 'success') {
                alert('Encargo guardado exitosamente');
                actualizarTablaProductos([]);
                $('#guardarEncargoForm')[0].reset();
            }
        });
    });
});
</script>
</body>
</html>
