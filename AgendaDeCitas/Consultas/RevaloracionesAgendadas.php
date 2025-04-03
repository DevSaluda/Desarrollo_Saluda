<script type="text/javascript">
$(document).ready(function () {
    $('#CitasExteriores').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "https://saludapos.com/AgendaDeCitas/Consultas/RevaloracionesAgendadas.php",
            "type": "POST"
        },
        "order": [[0, "desc"]],
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
        "language": {
            "url": "Componentes/Spanish.json"
        },
        "drawCallback": function() {
            // Reasignar eventos después de cada redibujado de la tabla
            $(".btn-Asiste").click(function(){
                var id = $(this).data("id");
                $.post("https://saludapos.com/AgendaDeCitas/Modales/AsistenciaPacienteRevaloracion.php", 
                    "id=" + id, 
                    function(data){
                        $("#form-editExt").html(data);
                        $("#TituloExt").html("¿El paciente asistió?");
                        $("#DiExt").removeClass("modal-dialog modal-lg modal-notify modal-success");
                        $("#DiExt").addClass("modal-dialog modal-sm modal-notify modal-success");
                    });
                $('#editModalExt').modal('show');
            });
        }
    });
});
</script>

<?php
function fechaCastellano($fecha) {
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
    return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}

include("db_connection.php");
include "Consultas.php";

// Obtener parámetros de paginación
$start = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;
$search = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

// Consulta optimizada con JOIN explícito y paginación
$sql1 = "SELECT SQL_CALC_FOUND_ROWS 
         a.Id_genda, a.Nombres_Apellidos, a.Telefono, a.Fk_sucursal,
         a.Medico, a.Fecha, a.Asistio, a.Turno, a.Motivo_Consulta,
         a.Agrego, a.AgregadoEl, s.ID_SucursalC, s.Nombre_Sucursal 
         FROM Agenda_revaloraciones a
         INNER JOIN SucursalesCorre s ON s.ID_SucursalC = a.Fk_sucursal";

// Agregar búsqueda si existe
if (!empty($search)) {
    $sql1 .= " WHERE a.Nombres_Apellidos LIKE ? OR a.Telefono LIKE ? OR s.Nombre_Sucursal LIKE ?";
    $searchParam = "%$search%";
}

// Agregar ordenamiento
$sql1 .= " ORDER BY a.Fecha DESC LIMIT ?, ?";

// Preparar y ejecutar la consulta
$stmt = $conn->prepare($sql1);
if (!empty($search)) {
    $stmt->bind_param("sssii", $searchParam, $searchParam, $searchParam, $start, $length);
} else {
    $stmt->bind_param("ii", $start, $length);
}
$stmt->execute();
$query = $stmt->get_result();

// Obtener el total de registros
$totalRecords = $conn->query("SELECT FOUND_ROWS()")->fetch_row()[0];
?>

<?php if ($query->num_rows > 0): ?>
<div class="text-center">
    <div class="table-responsive">
        <table id="CitasExteriores" class="table table-hover">
            <thead>
                <th>Folio</th>
                <th>Paciente</th>
                <th>Teléfono</th>
                <th>Fecha</th>
                <th>Sucursal</th>
                <th>Médico</th>
                <th>Turno</th>
                <th>Motivo Consulta</th>
                <th>Contacto por WhatsApp</th>
                <th>Agendado por</th>
                <th>Agregado el</th>
                <th>Acciones</th>
            </thead>
            <tbody>
            <?php while ($Usuarios = $query->fetch_array()): ?>
            <tr>
                <td><?php echo $Usuarios["Id_genda"]; ?></td>
                <td><?php echo $Usuarios["Nombres_Apellidos"]; ?></td>
                <td><?php echo $Usuarios["Telefono"]; ?></td>
                <td><?php echo fechaCastellano($Usuarios["Fecha"]); ?></td>
                <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
                <td><?php echo $Usuarios["Medico"]; ?></td>
                <td><?php echo $Usuarios["Turno"]; ?></td>
                <td><?php echo $Usuarios["Motivo_Consulta"]; ?></td>
                <td>
                    <a class="btn btn-success" href="https://api.whatsapp.com/send?phone=+52<?php echo $Usuarios["Telefono"]; ?>&text=¡Hola <?php echo $Usuarios["Nombres_Apellidos"]; ?>! Queremos recordarte lo importante que es darle seguimiento a tu salud. 👩🏻‍⚕🧑🏻‍⚕ Te invitamos a tu próxima revaloración, programada para el día *<?php echo fechaCastellano($Usuarios["Fecha"]); ?>* en *Saluda Centro Médico Familiar <?php echo $Usuarios["Nombre_Sucursal"]; ?>*. ¿Confirmamos tu asistencia? Tu bienestar es nuestra prioridad. ¡Gracias por confiar tu salud con nosotros! 🩷" target="_blank"><span class="fab fa-whatsapp"></span><span class="hidden-xs"></span></a>
                </td>
                <td><?php echo $Usuarios["Agrego"]; ?></td>
                <td><?php echo fechaCastellano($Usuarios["AgregadoEl"]); ?></td>
                <td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>
                    <div class="dropdown-menu">
                        <a data-id="<?php echo $Usuarios["Id_genda"]; ?>" class="btn-Asiste dropdown-item">¿El paciente asistió? <i class="far fa-calendar-check"></i></a>
                    </div>
                </td>
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php else: ?>
<p class="alert alert-warning">Por el momento no hay citas</p>
<?php endif; ?>

<div class="modal fade" id="editModalExt" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalExtLabel" aria-hidden="true">
    <div id="DiExt" class="modal-dialog modal-notify modal-success">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading lead" id="TituloExt"></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <div id="Mensaje" class="alert alert-info alert-styled-left text-blue-800 content-group">
                <span id="Aviso" class="text-semibold"><?php echo $row['Nombre_Apellidos'] ?> Verifique los campos antes de realizar alguna acción</span>
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div id="form-editExt"></div>
                </div>
            </div>
        </div>
    </div>
</div>
