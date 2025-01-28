<script type="text/javascript">
    $(document).ready(function () {
        $('#TiposConsultasDoc').DataTable({
            "order": [[0, "desc"]],
            "lengthMenu": [[25, 50, 150, 200, -1], [25, 50, 150, 200, "Todos"]],
            language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Procesando...",
            },
            responsive: "true",
            dom: "<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>",
        });
    });
</script>

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
                <caption>Listado de Procedimientos  </caption>
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
