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
    <title>Detalles Encargos | <?php echo $row['Nombre_Sucursal'] ?></title>
    <?php include "Header.php" ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .highlight {
            font-size: 1.2em;
            font-weight: bold;
        }

        .alert {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php include_once("Menu.php") ?>

    <div class="container my-4">
        <h2 class="mb-4">Detalles del Encargo: <?php echo $identificador; ?></h2>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
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
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['Cod_Barra']; ?></td>
                            <td><?php echo $row['Nombre_Prod']; ?></td>
                            <td><?php echo $row['Fk_sucursal']; ?></td>
                            <td><?php echo $row['MontoAbonado']; ?></td>
                            <td><?php echo $row['Precio_Venta']; ?></td>
                            <td><?php echo $row['Cantidad']; ?></td>
                            <td><?php echo $row['Estado']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="bg-light p-4 rounded">
                    <h4>Total Venta: <span class="highlight"><?php echo $totalVenta; ?></span></h4>
                    <h4>Monto Abonado: <span class="highlight"><?php echo $montoAbonadoTotal; ?></span></h4>
                    <h4>Faltante: <span class="highlight"><?php echo $totalVenta - $montoAbonadoTotal; ?></span></h4>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-light p-4 rounded">
                    <form id="abonarForm" class="mb-3">
                        <input type="hidden" name="idEncargo" value="<?php echo $identificador; ?>">
                        <input type="hidden" name="accion" value="abonar">
                        <div class="form-group">
                            <label for="montoAbonado">Abonar monto:</label>
                            <input type="number" class="form-control" name="montoAbonado" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Abonar</button>
                    </form>
                    <form id="estadoForm">
                        <input type="hidden" name="idEncargo" value="<?php echo $identificador; ?>">
                        <div class="d-flex justify-content-between">
                            <button type="button" name="accion" value="saldar" class="btn btn-success flex-grow-1 mr-2 estado-btn">Marcar como Saldado</button>
                            <button type="button" name="accion" value="entregar" class="btn btn-success flex-grow-1 estado-btn">Marcar como Entregado</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="responseMessage" class="alert alert-info" style="display: none;"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                $.ajax({
                    url: 'Consultas/ManejoEncargosPendientes.php',
                    type: 'POST',
                    data: {
                        idEncargo: '<?php echo $identificador; ?>',
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
