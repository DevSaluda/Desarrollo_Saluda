<?php
include "Consultas/Consultas.php";

session_start();

if (!isset($_SESSION['encargo'])) {
    $_SESSION['encargo'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar_producto'])) {
    $Cod_Barra = $_POST['Cod_Barra'];
    $query = "SELECT * FROM Productos_POS WHERE Cod_Barra='$Cod_Barra'";
    $result = mysqli_query($conn, $query);
    $producto = mysqli_fetch_assoc($result);

    if ($producto) {
        $_SESSION['producto_encontrado'] = $producto;
    } else {
        $_SESSION['producto_no_encontrado'] = $Cod_Barra;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar_producto'])) {
    $producto = [
        'Cod_Barra' => $_POST['Cod_Barra'],
        'Nombre_Prod' => $_POST['Nombre_Prod'],
        'Precio_Venta' => $_POST['Precio_Venta'],
        'Cantidad' => $_POST['Cantidad'],
        'Total' => $_POST['Precio_Venta'] * $_POST['Cantidad']
    ];
    $_SESSION['encargo'][] = $producto;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar_encargo'])) {
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
                <?php unset($_SESSION['producto_encontrado']); ?>
            <?php elseif (isset($_SESSION['producto_no_encontrado'])): ?>
                <div class="alert alert-warning">Producto no encontrado. ¿Desea agregarlo de todos modos?</div>
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
                <?php unset($_SESSION['producto_no_encontrado']); ?>
            <?php endif; ?>

            <h3>Productos en el Encargo</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Código de Barra</th>
                        <th>Nombre del Producto</th>
                        <th>Precio de Venta</th>
                        <th>Cantidad</th>
                        <th>Total</th>
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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php
            $total = calcularTotalEncargo($_SESSION['encargo']);
            $pago_minimo = calcularPagoMinimo($total);
            ?>
            <div class="form-group">
                <label>Total: </label>
                <span><?php echo $total; ?></span>
            </div>
            <div class="form-group">
                <label>Pago Mínimo: </label>
                <span><?php echo $pago_minimo; ?></span>
            </div>

            <h3>Datos del Encargo</h3>
            <form method="post" action="">
                <div class="form-group">
                    <label for="Fk_sucursal">Sucursal</label>
                    <input type="text" class="form-control" id="Fk_sucursal" name="Fk_sucursal" required>
                </div>
                <div class="form-group">
                    <label for="MontoAbonado">Monto Abonado</label>
                    <input type="number" step="0.01" class="form-control" id="MontoAbonado" name="MontoAbonado" required>
                </div>
                <div class="form-group">
                    <label for="AgregadoPor">Agregado Por</label>
                    <input type="text" class="form-control" id="AgregadoPor" name="AgregadoPor" required>
                </div>
                <div class="form-group">
                    <label for="ID_H_O_D">ID H O D</label>
                    <input type="text" class="form-control" id="ID_H_O_D" name="ID_H_O_D" required>
                </div>
                <div class="form-group">
                    <label for="Estado">Estado</label>
                    <input type="text" class="form-control" id="Estado" name="Estado" required>
                </div>
                <div class="form-group">
                    <label for="TipoEncargo">Tipo de Encargo</label>
                    <input type="text" class="form-control" id="TipoEncargo" name="TipoEncargo" required>
                </div>
                <button type="submit" name="guardar_encargo" class="btn btn-success">Guardar Encargo</button>
            </form>
        </div>
    </section>
</div>

<?php
include("Modales/Error.php");
include("Modales/Exito.php");
include("Modales/ExitoActualiza.php");
include("footer.php");
?>

<!-- ./wrapper -->

<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/demo.js"></script>

</body>
</html>

<?php
function fechaCastellano($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
    $dias_EN = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    $meses_EN = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return "$nombredia $numeroDia de $nombreMes de $anio";
}
?>

