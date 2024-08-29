<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";

$user_id = null;
$sql1 = "SELECT * FROM `Horarios_EspecialistasExt` WHERE Fk_Programacion = ".$_POST["id"];

$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows > 0) {
    while ($r = $query->fetch_object()) {
        $Especialistas = $r;
        break;
    }
}
?>
<?php if ($Especialistas != null): ?>
    <form action="javascript:void(0)" method="post" id="ActualizaHorarios">
        <table class="table">
            <tr>
                <th>Horarios activos o disponibles para editar</th>
            </tr>
            <?php
            $query = $conn->query($sql1);
            while ($r = $query->fetch_object()) {
            ?>
                <tr>
                    <td>
                        <input type="text" class="form-control" name="Horariosporactualizar[]" value="<?php echo $r->Horario_Disponibilidad; ?>">
                        <input type="text" class="form-control" hidden name="Id_Horario[]" value="<?php echo $r->ID_Horario; ?>">
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

        <input type="text" class="form-control" hidden name="Numerodeprogramacion" readonly value="<?php echo $Especialistas->Fk_Programacion; ?>">
        <input type="text" class="form-control" hidden name="UsuarioActualiza" readonly value="<?php echo $row['Nombre_Apellidos'] ?>">

        <button type="submit" id="ActualizarEstadoHorarios" value="Guardar" class="btn btn-success">Actualizar <i class="fas fa-save"></i></button>
    </form>
<?php else: ?>
    <p class="alert alert-danger">Es posible que esta programación ya tenga sus horarios verificados y asignados, por eso no podemos encontrar los datos que requieres. <i class="fas fa-exclamation-triangle"></i></p>
<?php endif; ?>
<script src="js/ActualizaHorariosEspecialidades.js"></script>
