<?php
include 'Consultas/Consultas.php';
include 'Consultas/ManejoEncargos.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Solicitar Encargos | <?php echo $row['Nombre_Sucursal']?> </title>
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
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h2>Encargos Pendientes</h2>
            <table class="table table-bordered" id="encargosTable">
                <thead>
                    <tr>
                        <th>Identificador</th>
                        <th>Sucursal</th>
                        <th>Monto Abonado</th>
                        <th>Estado</th> <!-- Nueva columna -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = obtenerEncargos($conn);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['IdentificadorEncargo']}</td>";
                        echo "<td>{$row['Fk_sucursal']}</td>";
                        echo "<td>{$row['MontoAbonadoTotal']}</td>";
                        echo "<td>{$row['Estado']}</td>"; // Mostrar el estado
                        echo "<td>
                                <a href='detallesEncargo.php?identificador={$row['IdentificadorEncargo']}' class='btn btn-info'>Ver Detalles</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php include("footer.php");?>
</body>
</html>
