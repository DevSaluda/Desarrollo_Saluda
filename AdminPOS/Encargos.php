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
                                <div class='dropdown'>
                                    <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton{$row['Id_Encargo']}' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Acciones
                                    </button>
                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuButton{$row['Id_Encargo']}'>
                                        <a class='dropdown-item accion-encargo' data-id='{$row['Id_Encargo']}' data-accion='aceptar' href='#'>Aceptar</a>
                                        <a class='dropdown-item accion-encargo' data-id='{$row['Id_Encargo']}' data-accion='rechazar' href='#'>Rechazar</a>
                                        <a class='dropdown-item accion-encargo' data-id='{$row['Id_Encargo']}' data-accion='eliminar' href='#'>Eliminar</a>
                                    </div>
                                </div>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmar Acción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas <span id="modalAction"></span> este encargo?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmBtn">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php");?>
<script>
$(document).ready(function() {
    var idEncargo;
    var accion;

    $('.accion-encargo').click(function() {
        idEncargo = $(this).data('id');
        accion = $(this).data('accion');
        var accionTexto = {
            'aceptar': 'aceptar',
            'rechazar': 'rechazar',
            'eliminar': 'eliminar'
        };
        $('#modalAction').text(accionTexto[accion]);
        $('#confirmModal').modal('show');
    });

    $('#confirmBtn').click(function() {
        $.ajax({
            url: 'Consultas/ManejoEncargos.php',
            type: 'POST',
            data: { idEncargo: idEncargo, accion: accion },
            dataType: 'json',
            success: function(response) {
                $('#confirmModal').modal('hide');
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
