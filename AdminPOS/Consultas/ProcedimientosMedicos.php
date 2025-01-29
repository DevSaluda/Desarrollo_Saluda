<?php
include("db_connection.php");
include "Consultas.php";

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql1 = "
    SELECT 
        IDProcedimiento,
        Nombre_Procedimiento,
        Estatus
    FROM 
        Procedimientos_POS
";

$query = $conn->query($sql1);
if (!$query) {
    die("Error en la consulta SQL: " . $conn->error);
}
?>

<?php if ($query->num_rows > 0) : ?>
    <div class="text-center">
        <div class="table-responsive">
            <table id="CarritosEnfermeria" class="table table-hover">
                <caption>Listado de Procedimientos</caption>
                <thead>
                    <tr>
                        <th style="background-color:#0057b8 !important;">N° Carrito</th>
                        <th style="background-color:#0057b8 !important;">Nombre Procedimiento</th>
                        <th style="background-color:#0057b8 !important;">Estado</th>
                        <th style="background-color:#0057b8 !important;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $query->fetch_array()) : ?>
                        <tr>
                            <td><?php echo $row["IDProcedimiento"]; ?></td>
                            <td><?php echo $row["Nombre_Procedimiento"]; ?></td>
                            <td><?php echo $row["Estatus"]; ?></td>
                            <td>
                                <a href="DetallesProcedimientos.php?idprocedimiento=<?php echo $row['IDProcedimiento']; ?>" class="btn btn-primary">
                                    <i class="fas fa-eye"></i> Ver detalles
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else : ?>
    <p class="alert alert-warning">No hay resultados</p>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#CarritosEnfermeria').DataTable({
            "pageLength": 10, // Muestra 10 registros por página
            "order": [[0, "desc"]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(filtrado de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Procesando...",
            },
            "responsive": true,
            "dom": "<'row'<'col-md-6'l><'col-md-6'f>>" +
                   "<'row'<'col-sm-12'tr>>" +
                   "<'row'<'col-md-6'i><'col-md-6'p>>"
        });
    });
</script>
