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
    <form action="javascript:void(0)" method="post" id="EliminaHorariosDemedicosEspecialistas">
        <table class="table">
            <tr>
                <th style="background-color: red !important;">Horarios disponibles para eliminar</th>
            </tr>
            <?php
            $query = $conn->query($sql1);
            $row_counter = 0;
            while ($r = $query->fetch_object()) {
                if ($row_counter % 3 == 0) {
                    echo '<tr>';
                }
            ?>
                <td>
                    <input type="text" class="form-control" value="<?php echo $r->Horario_Disponibilidad; ?>">

                    <label>
                        <input type="checkbox" class="form-control checkboxEliminar" name="Id_Horarioeliminar[]" value="<?php echo $r->ID_Horario; ?>">
                        <?php echo $r->ID_Horario; ?> 
                    </label>
                </td>
            <?php
                $row_counter++;
                if ($row_counter % 3 == 0) {
                    echo '</tr>';
                }
            }
            // Cerrar la fila si no se ha cerrado en el bucle anterior
            if ($row_counter % 3 != 0) {
                echo '</tr>';
            }
            ?>
        </table>

        <button type="submit" id="ActualizarEstadoHorarios" value="Guardar" class="btn btn-danger">Eliminar horarios seleccionados <i class="fas fa-save"></i></button>
    </form>
<?php else: ?>
    <p class="alert alert-danger">Es posible que esta programación ya tenga sus horarios verificados y asignados, por eso no podemos encontrar los datos que requieres. <i class="fas fa-exclamation-triangle"></i></p>
<?php endif; ?>
<script src="js/EliminaHorariosEspecialidades.js"></script>
