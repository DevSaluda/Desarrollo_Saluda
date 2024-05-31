<script type="text/javascript">
$(document).ready(function() {
    $('#CitasExteriores').DataTable({
        "order": [[3, "asc"]],
        "info": false,
        "lengthMenu": [[10, 50, 200, -1], [10, 50, 200, "Todos"]],
        "language": {
            "url": "Componentes/Spanish.json"
        },
        "columnDefs": [
            {
                "targets": 3, // la columna de las fechas
                "type": "date" // asegura que DataTables entienda que es una fecha
            }
        ]
    });
});
</script>

<?php
function fechaISO($fecha) {
    return date('Y-m-d', strtotime($fecha));
}

include("db_connection.php");
include "Consultas.php";

$user_id = null;
$sql1 = "SELECT Agenda_Labs.Id_genda, Agenda_Labs.Nombres_Apellidos, Agenda_Labs.Telefono, Agenda_Labs.Fk_sucursal, Agenda_Labs.Hora,
Agenda_Labs.Fecha, Agenda_Labs.LabAgendado, Agenda_Labs.Asistio, Agenda_Labs.Agrego, Agenda_Labs.AgregadoEl, SucursalesCorre.ID_SucursalC, SucursalesCorre.Nombre_Sucursal FROM
Agenda_Labs, SucursalesCorre WHERE SucursalesCorre.ID_SucursalC = Agenda_Labs.Fk_sucursal ";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows > 0): ?>
<div class="text-center">
    <div class="table-responsive">
        <table id="CitasExteriores" class="table table-hover">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Paciente</th>
                    <th>Telefono</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Sucursal</th>
                    <th>Laboratorio Agendado</th>
                    <th>Agendo</th>
                    <th>¿El paciente asistio?</th>
                    <th>Contacto por whatsaap</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($Usuarios = $query->fetch_array()): ?>
                <tr>
                    <td><?php echo $Usuarios["Id_genda"]; ?></td>
                    <td><?php echo $Usuarios["Nombres_Apellidos"]; ?></td>
                    <td><?php echo $Usuarios["Telefono"]; ?></td>
                    <td data-order="<?php echo fechaISO($Usuarios["Fecha"]); ?>"><?php echo fechaCastellano($Usuarios["Fecha"]); ?></td>
                    <td><?php echo $Usuarios["Hora"]; ?></td>
                    <td><?php echo $Usuarios["Nombre_Sucursal"]; ?></td>
                    <td><?php echo $Usuarios["LabAgendado"]; ?></td>
                    <td><?php echo $Usuarios["Agrego"]; ?></td>
                    <td><?php echo $Usuarios["Asistio"]; ?></td>
                    <td>
                        <a class="btn btn-success" href="https://api.whatsapp.com/send?phone=+52<?php echo $Usuarios["Telefono"]; ?>&text=¡Hola <?php echo $Usuarios["Nombres_Apellidos"]; ?>! 
                        Queremos recordarte lo importante que es darle seguimiento a tu salud. 👩🏻‍⚕🧑🏻‍⚕ 
                        Te invitamos a asistir a tu laboratorio programado para el día <?php echo fechaCastellano($Usuarios["Fecha"]); ?> a las <?php echo $Usuarios["Hora"]; ?> 
                        en Saluda Centro Médico Familiar <?php echo $Usuarios["Nombre_Sucursal"]; ?>. 
                        ¿Podrías confirmar tu asistencia? Tu bienestar es nuestra prioridad.
                        Te recordamos leer las recomendaciones en el reverso de tu hoja de laboratorio. 
                        ¡Gracias por confiar en nosotros para cuidar tu salud! 🩷"
                        target="_blank">
                            <span class="fab fa-whatsapp"></span><span class="hidden-xs"></span>
                        </a>
                    </td>
                    <td>
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>
                        <div class="dropdown-menu">
                            <a data-id="<?php echo $Usuarios["Id_genda"];?>" class="btn-Asiste dropdown-item">¿el paciente asistio? <i class="far fa-calendar-check"></i></a>
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

<script>
$(".btn-Asiste").click(function(){
    id = $(this).data("id");
    $.post("https://saludapos.com/Enfermeria2/Modales/AsistenciaPacienteLaboratorio.php", "id=" + id, function(data){
        $("#form-editExt").html(data);
        $("#TituloExt").html("¿El paciente asistió?");
        $("#DiExt").removeClass("modal-dialog modal-lg modal-notify modal-success");
        $("#DiExt").addClass("modal-dialog modal-sm modal-notify modal-success");
    });
    $('#editModalExt').modal('show');
});
</script>
<div class="modal fade" id="editModalExt" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalExtLabel" aria-hidden="true">
    <div id="DiExt" class="modal-dialog  modal-notify modal-success">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading lead" id="TituloExt"></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <div id="Mensaje" class="alert alert-info alert-styled-left text-blue-800 content-group">
                <span id="Aviso" class="text-semibold"><?php echo $row['Nombre_Apellidos']?>
                Verifique los campos antes de realizar alguna accion</span>
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
