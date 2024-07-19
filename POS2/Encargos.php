<?php
include "Consultas/Consultas.php";
session_start();

if (!isset($_SESSION['encargo'])) {
    $_SESSION['encargo'] = [];
}

function buscarProducto($conn, $Cod_Barra) {
    $query = "SELECT * FROM Productos_POS WHERE Cod_Barra='$Cod_Barra'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buscar_producto'])) {
        $Cod_Barra = $_POST['Cod_Barra'];
        $producto = buscarProducto($conn, $Cod_Barra);

        if ($producto) {
            $_SESSION['producto_encontrado'] = $producto;
        } else {
            $_SESSION['producto_no_encontrado'] = $Cod_Barra;
        }
    }

    if (isset($_POST['agregar_producto'])) {
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

        unset($_SESSION['producto_encontrado']);
        unset($_SESSION['producto_no_encontrado']);
    }

    if (isset($_POST['eliminar_producto'])) {
        $Cod_Barra = $_POST['Cod_Barra'];
        foreach ($_SESSION['encargo'] as $index => $producto) {
            if ($producto['Cod_Barra'] === $Cod_Barra) {
                unset($_SESSION['encargo'][$index]);
                $_SESSION['encargo'] = array_values($_SESSION['encargo']); // Reindexar el array
                break;
            }
        }
    }

    if (isset($_POST['guardar_encargo'])) {
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
        unset($_SESSION['producto_encontrado']);
        unset($_SESSION['producto_no_encontrado']);
        header("Location: " . $_SERVER['PHP_SELF']);
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
            <form method="post" action="">
                <div class="form-group">
                    <label for="Cod_Barra">Código de Barra</label>
                    <input type="text" class="form-control" id="Cod_Barra" name="Cod_Barra" required>
                    <button type="submit" name="buscar_producto" class="btn btn-primary mt-2">Buscar Producto</button>
                </div>
            </form>
            <?php if (isset($_SESSION['producto_encontrado'])): ?>
                <?php $producto = $_SESSION['producto_encontrado']; ?>
                <form method="post" action="">
                    <input type="hidden" name="Cod_Barra" value="<?php echo $producto['Cod_Barra']; ?>">
                    <div class="form-group">
                        <label for="Nombre_Prod">Nombre del Producto</label>
                        <input type="text" class="form-control" id="Nombre_Prod" name="Nombre_Prod" value="<?php echo $producto['Nombre_Prod']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="Precio_Venta">Precio de Venta</label>
                        <input type="number" step="0.01" class="form-control" id="Precio_Venta" name="Precio_Venta" value="<?php echo $producto['Precio_Venta']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="Cantidad">Cantidad</label>
                        <input type="number" class="form-control" id="Cantidad" name="Cantidad" required>
                    </div>
                    <button type="submit" name="agregar_producto" class="btn btn-primary">Agregar Producto</button>
                </form>
            <?php elseif (isset($_SESSION['producto_no_encontrado'])): ?>
                <!-- Modal -->
                <div class="modal fade" id="productoNoEncontradoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <form method="post" action="">
                                    <input type="hidden" name="Cod_Barra" value="<?php echo $_SESSION['producto_no_encontrado']; ?>">
                                    <div class="form-group">
                                        <label for="Nombre_Prod">Nombre del Producto</label>
                                        <input type="text" class="form-control" id="Nombre_Prod" name="Nombre_Prod" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Precio_Venta">Precio de Venta</label>
                                        <input type="number" step="0.01" class="form-control" id="Precio_Venta" name="Precio_Venta" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Cantidad">Cantidad</label>
                                        <input type="number" class="form-control" id="Cantidad" name="Cantidad" required>
                                    </div>
                                    <button type="submit" name="agregar_producto" class="btn btn-primary">Agregar Producto</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#productoNoEncontradoModal').modal('show');
                    });
                </script>
            <?php endif; ?>

            <h3>Productos en el encargo</h3>
            <table class="table table-bordered">
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
                <tbody>
                    <?php foreach ($_SESSION['encargo'] as $producto): ?>
                        <tr>
                            <td><?php echo $producto['Cod_Barra']; ?></td>
                            <td><?php echo $producto['Nombre_Prod']; ?></td>
                            <td><?php echo $producto['Precio_Venta']; ?></td>
                            <td><?php echo $producto['Cantidad']; ?></td>
                            <td><?php echo $producto['Total']; ?></td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="Cod_Barra" value="<?php echo $producto['Cod_Barra']; ?>">
                                    <button type="submit" name="eliminar_producto" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h4 class="highlight">Total del encargo: <?php echo calcularTotalEncargo($_SESSION['encargo']); ?></h4>
            <h4 class="highlight">Pago mínimo requerido: <?php echo calcularPagoMinimo(calcularTotalEncargo($_SESSION['encargo'])); ?></h4>

            <form method="post" action="">
                <div class="form-group">
                    <label for="Fk_sucursal">Sucursal</label>
                    <input type="text" class="form-control" id="Fk_sucursal" name="Fk_sucursal" required>
                </div>
                <div class="form-group">
                    <label for="MontoAbonado">Monto Abonado</label>
                    <input type="number" step="0.01" class="form-control" id="MontoAbonado" name="MontoAbonado" required>
                </div>
                <div class="form-group hidden-field">
                    <input type="hidden" class="form-control" id="AgregadoPor" name="AgregadoPor" value="<?php echo $current_user; ?>">
                    <input type="hidden" class="form-control" id="ID_H_O_D" name="ID_H_O_D" value="<?php echo $current_id_hod; ?>">
                    <input type="hidden" class="form-control" id="Estado" name="Estado" value="Pendiente">
                    <input type="hidden" class="form-control" id="TipoEncargo" name="TipoEncargo" value="Producto">
                </div>
                <button type="submit" name="guardar_encargo" class="btn btn-success">Guardar Encargo</button>
            </form>
        </div>
    </section>
</div>
<?php include("footer.php");?>
</body>
</html>
