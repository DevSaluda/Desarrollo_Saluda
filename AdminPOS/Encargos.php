<?php
include 'Consultas/Consultas.php';
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        <th>Código de Barra</th>
                        <th>Nombre del Producto</th>
                        <th>Sucursal</th>
                        <th>Monto Abonado</th>
                        <th>Precio de Venta</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = obtenerEncargos($conn);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['IdentificadorEncargo']}</td>";
                        echo "<td>{$row['Cod_Barra']}</td>";
                        echo "<td>{$row['Nombre_Prod']}</td>";
                        echo "<td>{$row['Fk_sucursal']}</td>";
                        echo "<td>{$row['MontoAbonado']}</td>";
                        echo "<td>{$row['Precio_Venta']}</td>";
                        echo "<td>{$row['Cantidad']}</td>";
                        echo "<td>{$row['Estado']}</td>";
                        echo "<td>
                                <button class='btn btn-success accion-encargo' data-id='{$row['Id_Encargo']}' data-accion='aceptar'>Aceptar</button>
                                <button class='btn btn-warning accion-encargo' data-id='{$row['Id_Encargo']}' data-accion='rechazar'>Rechazar</button>
                                <button class='btn btn-danger accion-encargo' data-id='{$row['Id_Encargo']}' data-accion='eliminar'>Eliminar</button>
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
<script>
$(document).ready(function() {
    $('.accion-encargo').click(function() {
        var idEncargo = $(this).data('id');
        var accion = $(this).data('accion');

        $.ajax({
            url: 'Consultas/ManejoEncargos.php',
            type: 'POST',
            data: { idEncargo: idEncargo, accion: accion },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.success);
                    location.reload();
                } else if (response.error) {
                    alert(response.error);
                }
            }
        });
    });
});
</script>
</body>
</html>
