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
$sql1 = "SELECT * FROM `Tipos_Consultas`"; // Cambiar la tabla a Tipos_Consultas
$query = $conn->query($sql1);
?>

<?php if ($query->num_rows > 0) : ?>
    <div class="text-center">
        <div class="table-responsive">
            <table id="TiposConsultasDoc" class="table table-hover">
                <thead>
                    <th style="background-color:#0057b8 !important;">N°</th>
                    <th style="background-color:#0057b8 !important;">Tipo de Consulta</th>
                    <th style="background-color:#0057b8 !important;">Estatus</th>
                    <th style="background-color:#0057b8 !important;">Agregado el</th>
                    <th style="background-color:#0057b8 !important;">Acciones</th>
                </thead>
                <?php while ($Categorias = $query->fetch_array()) : ?>
                    <tr>
                        <td><?php echo $Categorias["Tipo_ID"]; ?></td>
                        <td><?php echo $Categorias["Nom_Tipo"]; ?></td>
                        <td>
                            <?php
                            $estado = $Categorias["Estado"];
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
                        <td><?php echo fechaCastellano($Categorias["Agregadoel"]); ?></td>
                        <td>
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-list-ul"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a data-id="<?php echo $Categorias["Tipo_ID"]; ?>" class="btn-editTipoConsulta dropdown-item">Editar datos <i class="fas fa-pencil-alt"></i></a>
                                <a data-id="<?php echo $Categorias["Tipo_ID"]; ?>" class="btn-editTipoConsulta2 dropdown-item">Detalles <i class="fas fa-info-circle"></i></a>
                                <a data-id="<?php echo $Categorias["Tipo_ID"]; ?>" class="btn-historialTipoConsulta dropdown-item">Movimientos <i class="fas fa-history"></i></a>
                            </div>
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
