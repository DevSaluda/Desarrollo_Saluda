<?php
include 'Consultas/Consultas.php';
include 'Consultas/ManejoEncargos.php';

$identificador = $_GET['identificador'];
$query = "SELECT * FROM Encargos_POS WHERE IdentificadorEncargo = '$identificador'";
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
    <h3>Detalles del Encargo: <?php echo $identificador; ?></h3>
    <h4>Nombre del Cliente: <?php echo $nombreCliente; ?></h4>
    <h4>Teléfono del Cliente: <?php echo $telefonoCliente; ?></h4>
    <table class="table table-bordered">
        <thead>
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
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
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

</body>
</html>
