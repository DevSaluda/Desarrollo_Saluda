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

$user_id = null;
// Query para obtener datos de las tablas relacionadas
$sql1 = "
    SELECT 
        c.ID_CARRITO,
        c.ID_SUCURSAL,
        s.Nombre_Sucursal,
        c.Estado,
        c.Agregadoel
    FROM 
        CarritosEnfermeria AS c
    INNER JOIN 
        SucursalesCorre AS s
    ON 
        c.ID_SUCURSAL = s.ID_SucursalC
";


$query = $conn->query($sql1);
?>

<?php if ($query->num_rows > 0) : ?>
    <div class="text-center">
        <div class="table-responsive">
            <table id="TiposConsultasDoc" class="table table-hover">
                <thead>
                    <th style="background-color:#0057b8 !important;">N° Carrito</th>
                    <th style="background-color:#0057b8 !important;">Sucursal</th>
                    <th style="background-color:#0057b8 !important;">Estado</th>
                    <th style="background-color:#0057b8 !important;">Agregado el</th>
                    <th style="background-color:#0057b8 !important;">Acciones</th>
                </thead>
                <?php while ($row = $query->fetch_array()) : ?>
                    <tr>
                        <td><?php echo $row["ID_CARRITO"]; ?></td>
                        <td><?php echo $row["Nombre_Sucursal"]; ?></td>
                        <td>
                            <?php
                            $estado = $row["Estado"];
                            $btn_color = '';
                            switch ($estado) {
                                case 'Próximamente':
                                    $btn_color = '#ff6c0c';
                                    break;
                                case 'Vigente':
                                    $btn_color = '#2BBB1D';
                                    break;
                                case 'Descontinuado':
                                    $btn_color = '#828681';
                                    break;
                                default:
                                    $btn_color = '';
                                    break;
                            }
                            ?>
                            <button style="background-color: <?php echo $btn_color; ?> !important;" class="btn btn-default btn-sm">
                                <?php echo $estado; ?>
                            </button>
                        </td>
                        <td><?php echo fechaCastellano($row["Agregadoel"]); ?></td>
                        <td>
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-list-ul"></i>
                            </button>
                            <td>
    <a href="detalle_carrito.php?id_carrito=<?php echo $row['ID_CARRITO']; ?>" class="btn btn-primary">
        Ver detalles
    </a>
</td>

                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
<?php else : ?>
    <p class="alert alert-warning">No hay resultados</p>
<?php endif; ?>

<?php

function fechaCastellano($fecha)
{
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio;
}
?>
