<?php
include 'Consultas/Consultas.php';
include 'Consultas/ManejoEncargos.php';

$identificador = $_GET['identificador'];
$query = "SELECT * FROM Encargos_POS WHERE IdentificadorEncargo = '$identificador'";
$result = mysqli_query($conn, $query);

$totalVenta = 0;
$montoAbonadoTotal = 0;
$nombreCliente = '';
$telefonoCliente = '';

while ($row = mysqli_fetch_assoc($result)) {
    // Incluir solo el precio de venta de los productos que no están cancelados
    if ($row['Estado'] != 'Cancelado') {
        $totalVenta += $row['Precio_Venta'] * $row['Cantidad'];
    }
    
    // Siempre sumar el monto abonado, sin importar el estado del producto
    $montoAbonadoTotal += $row['MontoAbonado'];

    // Almacenar la información del cliente (si aplica)
    $nombreCliente = $row['NombreCliente'];
    $telefonoCliente = $row['TelefonoCliente'];
}

// Volver a ejecutar la consulta para mostrar todos los productos en la tabla
$result = mysqli_query($conn, $query);
?>
<?php
include 'Consultas/Consultas.php';?>
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
    <h3>Detalles del Encargo: <?php echo $identificador; ?></h3>
    <h4>Nombre del Cliente: <?php echo $nombreCliente; ?></h4>
    <h4>Teléfono del Cliente: <?php echo $telefonoCliente; ?></h4>
    <form id="estadoForm">
        <div class="table-responsive">
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
                        echo "<td><input type='checkbox' name='productosSeleccionados[]' value='{$row['Id_Encargo']}'></td>";
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
        </div>
        <div class="d-flex justify-content-between">
            <button type="button" id="cancelarBtn" class="btn btn-danger flex-grow-1">Cancelar Producto(s)</button>
        </div>
    </form>
    <div id="modalContainer"></div>
</div>

<script>
$(document).ready(function() {
    // Mostrar el modal de cancelación
    $('#cancelarBtn').on('click', function() {
        const productosSeleccionados = $('input[name="productosSeleccionados[]"]:checked').map(function() {
            return $(this).val();
        }).get();

        if (productosSeleccionados.length === 0) {
            alert("Por favor, selecciona al menos un producto.");
            return;
        }

        $('#modalContainer').load('ModalCancelacionEncargo.php', function() {
            $('#cancelarModal').modal('show');
        });
    });

    // Confirmar cancelación
    $('#confirmarCancelacionBtn').on('click', function() {
        const productosSeleccionados = $('input[name="productosSeleccionados[]"]:checked').map(function() {
            return $(this).val();
        }).get();
        const motivo = $('#motivoCancelacion').val();

        if (motivo.trim() === '') {
            alert('Por favor, ingresa un motivo de cancelación.');
            return;
        }

        $.ajax({
            url: 'Consultas/ManejoEncargos.php',
            type: 'POST',
            data: {
                idEncargo: '<?php echo $identificador; ?>',
                productosSeleccionados: productosSeleccionados,
                motivoCancelacion: motivo,
                accion: 'cancelar'
            },
            success: function(response) {
                const result = JSON.parse(response);
                mostrarMensaje(result);
                $('#cancelarModal').modal('hide');
            }
        });
    });

    function mostrarMensaje(result) {
        alert(result.success || result.error);
        if (result.success) {
            setTimeout(function() {
                location.reload();
            }, 2000);
        }
    }
});
</script>

</body>
</html>

<?php include 'Modales/ModalCancelacionEncargo.php'; ?>
