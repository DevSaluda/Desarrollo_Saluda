<?php
include 'Consultas/Consultas.php';
include 'Consultas/ManejoEncargosPendientes.php';

$search = '';
$page = 1;
$perPage = 10; // Número de resultados por página

if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
}

// Calcular el offset para la consulta SQL
$offset = ($page - 1) * $perPage;

$result = obtenerEncargos($conn, $search, $offset, $perPage);
$totalEncargos = contarEncargos($conn, $search);
$totalPages = ceil($totalEncargos / $perPage);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Solicitar Encargos | <?php echo $row['Nombre_Sucursal']?> </title>
    <?php include "Header.php"?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .content-wrapper {
            padding: 20px;
        }
        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .search-form input {
            flex: 1;
            min-width: 200px;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .pagination {
            justify-content: center;
        }
        @media (max-width: 768px) {
            .btn {
                width: 100%;
                margin-top: 10px;
            }
            .search-form {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
<?php include_once("Menu.php")?>
<div class="container my-4">
        <h2 class="mb-4">Detalles del Encargo: <?php echo $identificador; ?></h2>
        
        <div class="table-responsive">
            <form id="estadoForm">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Seleccionar</th> <!-- Añadido -->
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
                                <td>
                                    <input type="checkbox" name="productosSeleccionados[]" value="<?php echo $row['ID_Encargo']; ?>">
                                </td>
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
                <input type="hidden" name="idEncargo" value="<?php echo $identificador; ?>">
                <div class="d-flex justify-content-between">
                    <button type="button" name="accion" value="saldar" class="btn btn-success flex-grow-1 mr-2 estado-btn">Marcar como Saldado</button>
                    <button type="button" name="accion" value="entregar" class="btn btn-success flex-grow-1 estado-btn">Marcar como Entregado</button>
                </div>
            </form>
        </div>

        <div id="responseMessage" class="alert alert-info" style="display: none;"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Manejar los botones de estado (Saldar, Entregar)
            $('.estado-btn').on('click', function() {
                const accion = $(this).val();
                $.ajax({
                    url: 'Consultas/ManejoEncargosPendientes.php',
                    type: 'POST',
                    data: $('#estadoForm').serialize() + '&accion=' + accion,
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

<?php include("footer.php");?>
</body>
</html>
