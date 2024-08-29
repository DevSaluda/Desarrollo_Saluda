<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";

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

$user_id = null;
$sql1 = "SELECT Programacion_MedicosExt.ID_Programacion, Programacion_MedicosExt.FK_Medico, Programacion_MedicosExt.Fk_Sucursal, 
    Programacion_MedicosExt.Tipo_Programacion, Programacion_MedicosExt.Fecha_Inicio, Programacion_MedicosExt.Fecha_Fin, 
    Programacion_MedicosExt.Hora_inicio, Programacion_MedicosExt.Hora_Fin, Programacion_MedicosExt.Intervalo, 
    Programacion_MedicosExt.Sistema, Programacion_MedicosExt.ID_H_O_D, SucursalesCorre.ID_SucursalC, 
    SucursalesCorre.Nombre_Sucursal, Personal_Medico_Express.Medico_ID, Personal_Medico_Express.Nombre_Apellidos 
    FROM Personal_Medico_Express
    JOIN SucursalesCorre ON SucursalesCorre.ID_SucursalC = Programacion_MedicosExt.Fk_Sucursal
    JOIN Programacion_MedicosExt ON Personal_Medico_Express.Medico_ID = Programacion_MedicosExt.FK_Medico
    WHERE Programacion_MedicosExt.ID_H_O_D ='".$row['ID_H_O_D']."' AND Programacion_MedicosExt.ID_Programacion = ".$_POST["id"];

$query = $conn->query($sql1);
$Especialistas = null;
if ($query->num_rows > 0) {
    while ($r = $query->fetch_object()) {
        $Especialistas = $r;
        break;
    }
}
?>
<?php if ($Especialistas != null): ?>
    <div class="text-center">
        <b>Marcar como horario completado</b>
        <input type="checkbox" name="check" id="check" value="1" onchange="showContent()" />
    </div>
    <div id="AutorizaFin">
        <form action="javascript:void(0)" method="post" id="ActualizaHorarios">
            <?php
            $inicio = $Especialistas->Hora_inicio;
            $final = $Especialistas->Hora_Fin;
            $incr = $Especialistas->Intervalo;
            $date_obj = new DateTime($inicio);
            $date_incr = $inicio;
            ?>
            <div class="row">
                <div class="col">
                    <label for="exampleFormControlInput1">Médico<span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
                        </div>
                        <input type="text" class="form-control " readonly value="<?php echo $Especialistas->Nombre_Apellidos; ?>" />
                    </div>
                </div>
                <div class="col">
                    <label for="exampleFormControlInput1">Sucursal<span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
                        </div>
                        <input type="text" class="form-control " readonly value="<?php echo $Especialistas->Nombre_Sucursal; ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="exampleFormControlInput1">Fecha<span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
                        </div>
                        <select id="FechasSeleccionadasxd" class="form-control" name="FechaAsignadaParaHoras[]" multiple>
                            <?php
                            $query = $conn->query("SELECT ID_Fecha_Esp, Fecha_Disponibilidad, Fk_Programacion FROM 
                                Fechas_EspecialistasExt WHERE ID_Fecha_Esp NOT IN (SELECT FK_Fecha FROM Horarios_Citas_Ext) 
                                AND Fk_Programacion=$Especialistas->ID_Programacion");
                            while ($valores = $query->fetch_array()) {
                                echo '<option value="'.$valores["ID_Fecha_Esp"].'">'.fechaCastellano($valores["Fecha_Disponibilidad"]).'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label for="exampleFormControlInput1">Horas disponibles<span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
                        </div>
                        <select id="SeleccionHorarios" class="form-control" name="HorasAGuardar[]" multiple>
                            <?php
                            while ($date_incr < $final) {
                                $date_incr = $date_obj->format('H:i:s');
                                echo '<option value="'.$date_incr.'">'.date('h:i A', strtotime($date_incr)).'</option>';
                                $date_obj->modify('+'.$incr.' minutes');
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <input type="text" class="form-control" hidden name="MedicoHoras[]" readonly value="<?php echo $Especialistas->FK_Medico; ?>" />
            <input type="text" class="form-control" hidden name="NumberProgramaHoras[]" readonly value="<?php echo $Especialistas->ID_Programacion; ?>" />
            <input type="text" class="form-control" hidden name="UsuarioHoras[]" readonly value="<?php echo $row['Nombre_Apellidos'] ?>" />
            <input type="text" class="form-control" hidden name="EmpresaHoras[]" readonly value="<?php echo $row['ID_H_O_D'] ?>" />
            <input type="text" class="form-control" hidden name="SistemaHoras[]" readonly value="<?php echo $row['Nombre_rol'] ?>" />

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <button type="submit" id="EnviarDatos" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
            </div>
        </form>
    </div>

    <div id="content" style="display: none;">
        <form action="javascript:void(0)" method="post" id="ActualizaEstadoHoras">
            <div class="modal-body">
                <p>¿Está seguro que se han autorizado todos los horarios para fechas? <br> del médico <?php echo $Especialistas->Nombre_Apellidos; ?> <br> de la sucursal <?php echo $Especialistas->Nombre_Sucursal; ?>  <br> del periodo <?php echo $Especialistas->Fecha_Inicio; ?> al <?php echo $Especialistas->Fecha_Fin; ?> <br>
                <i class="fas fa-calendar-times fa-4x animated rotateIn"></i>
            </div>
            <input type="text" class="form-control" hidden name="ID_ProgramaF" readonly value="<?php echo $Especialistas->ID_Programacion; ?>" />
            <input type="text" class="form-control" hidden name="EstadoProgramacionF" readonly value="Autorizado" />
            <input type="text" class="form-control" hidden name="UsuarioAutorizoF" readonly value="<?php echo $row['Nombre_Apellidos'] ?>" />
            <input type="text" class="form-control" hidden name="SistemaAutorizoF" readonly value="<?php echo $row['Nombre_rol'] ?>" />
            <button type="submit" id="EnviarDatos" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
        </form>
    </div>

<?php else: ?>
    <div class="alert alert-danger" role="alert">
        No se encontraron datos para la programación solicitada.
    </div>
<?php endif; ?>

<script>
    function showContent() {
        var checkBox = document.getElementById("check");
        var content = document.getElementById("content");
        if (checkBox.checked == true) {
            content.style.display = "block";
        } else {
            content.style.display = "none";
        }
    }
</script>
