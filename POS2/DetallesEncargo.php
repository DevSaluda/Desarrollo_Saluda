<?php
include 'Consultas/Consultas.php';
include 'Consultas/ManejoEncargosPendientes.php';

$identificador = $_GET['identificador'];
$query = "SELECT * FROM Encargos_POS WHERE IdentificadorEncargo = '$identificador'";
$result = mysqli_query($conn, $query);

// Calcular el total del encargo y el total abonado
$totalVenta = 0;
$montoAbonadoTotal = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $totalVenta += $row['Precio_Venta'] * $row['Cantidad'];
    $montoAbonadoTotal += $row['MontoAbonado'];
}

// Volver a ejecutar la consulta para mostrar los datos en la tabla
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Detalles Encargos | <?php echo $row['Nombre_Sucursal']?> </title>
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php include_once("Menu.php")?>
<div class="container">
    <h2>Detalles del Encargo: <?php echo $identificador; ?></h2>
    <form id="estadoForm">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>Código de Barra</th>
                    <th>Nombre del Producto</th>
                    <th>Sucursal</th>
                    <th>Monto Abonado</th>
                    <th>Precio de Venta</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='productosSeleccionados[]' value='{$row['ID_Encargo']}'></td>";
                    echo "<td>{$row['Cod_Barra']}</td>";
                    echo "<td>{$row['Nombre_Prod']}</td>";
                    echo "<td>{$row['Fk_sucursal']}</td>";
                    echo "<td>{$row['MontoAbonado']}</td>";
                    echo "<td>{$row['Precio_Venta']}</td>";
                    echo "<td>{$row['Cantidad']}</td>";
                    echo "<td>{$row['Estado']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <input type="hidden" name="idEncargo" value="<?php echo $identificador; ?>">
        <div class="d-flex justify-content-between">
            <button type="button" name="accion" value="saldar" class="btn btn-success flex-grow-1 mr-2 estado-btn">Marcar como Saldado</button>
            <button type="button" name="accion" value="entregar" class="btn btn-success flex-grow-1 estado-btn">Marcar como Entregado</button>
        </div>
    </form>
    <div class="row mt-4">
        <div class="col-md-6">
            <h4>Total Venta: <?php echo $totalVenta; ?></h4>
            <h4>Monto Abonado: <?php echo $montoAbonadoTotal; ?></h4>
            <h4>Faltante: <?php echo $totalVenta - $montoAbonadoTotal; ?></h4>
        </div>
        <div class="col-md-6">
            <form id="abonarForm">
                <input type="hidden" name="idEncargo" value="<?php echo $identificador; ?>">
                <input type="hidden" name="accion" value="abonar">
                <div class="form-group">
                    <label for="montoAbonado">Abonar monto:</label>
                    <input type="number" class="form-control" name="montoAbonado" required>
                </div>
                <button type="submit" class="btn btn-primary">Abonar</button>
            </form>
        </div>
    </div>
    <div id="responseMessage" class="alert alert-info" style="display: none;"></div>
</div>

<script>
$(document).ready(function() {
    // Manejar el envío del formulario de abonar
    $('#abonarForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'Consultas/ManejoEncargosPendientes.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                const result = JSON.parse(response);
                mostrarMensaje(result);
            }
        });
    });

    // Manejar los botones de estado (Saldar, Entregar)
    $('.estado-btn').on('click', function() {
        const accion = $(this).val();
        const productosSeleccionados = $('input[name="productosSeleccionados[]"]:checked').map(function() {
            return $(this).val();
        }).get();

        if (productosSeleccionados.length === 0) {
            alert("Por favor, selecciona al menos un producto.");
            return;
        }

        $.ajax({
            url: 'Consultas/ManejoEncargosPendientes.php',
            type: 'POST',
            data: {
                idEncargo: '<?php echo $identificador; ?>',
                productosSeleccionados: productosSeleccionados,
                accion: accion
            },
            success: function(response) {
                const result = JSON.parse(response);
                mostrarMensaje(result);
            }
        });
    });

    function mostrarMensaje(result) {
        $('#responseMessage').text(result.success || result.error).show();
        if (result.success) {
            $('#responseMessage').removeClass('alert-danger').addClass('alert-success');
            setTimeout(function() {
                location.reload();
            }, 2000);
        } else {
            $('#responseMessage').removeClass('alert-success').addClass('alert-danger');
        }
    }
});
</script>

</body>
</html>
