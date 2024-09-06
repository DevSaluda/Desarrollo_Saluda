<?php

include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

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
         Programacion_MedicosExt.Hora_inicio, Programacion_MedicosExt.Hora_Fin, Programacion_MedicosExt.Intervalo, Programacion_MedicosExt.Sistema, 
         Programacion_MedicosExt.ID_H_O_D, SucursalesCorre.ID_SucursalC, SucursalesCorre.Nombre_Sucursal, Personal_Medico_Express.Medico_ID, 
         Personal_Medico_Express.Nombre_Apellidos 
         FROM Personal_Medico_Express, SucursalesCorre, Programacion_MedicosExt 
         WHERE Personal_Medico_Express.Medico_ID = Programacion_MedicosExt.FK_Medico 
         AND SucursalesCorre.ID_SucursalC = Programacion_MedicosExt.Fk_Sucursal 
         AND Programacion_MedicosExt.ID_Programacion = ".$_POST["id"];

$query = $conn->query($sql1);
$Especialistas = null;

if ($query->num_rows > 0) {
    while ($r = $query->fetch_object()) {
        $Especialistas = $r;
        break;
    }
}
?>
<?php if($Especialistas != null): ?>


<div id="AutorizaFin">
    <form action="javascript:void(0)" method="post" id="ProgramaHorasNuevas">
        <div class="row">
            <div class="col">
                <label for="exampleFormControlInput1">Médico<span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
                    </div>
                    <input type="text" class="form-control" readonly value="<?php echo $Especialistas->Nombre_Apellidos; ?>">
                </div>
            </div>
            <div class="col">
                <label for="exampleFormControlInput1">Sucursal<span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
                    </div>
                    <input type="text" class="form-control" readonly value="<?php echo $Especialistas->Nombre_Sucursal; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="FechaSeleccionada">Fecha<span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Tarjeta"><i class="fas fa-calendar"></i></span>
                    </div>
                    <select id="FechaSeleccionada" class="form-control" name="FechaSeleccionada" required>
                        <?php
                        $query = $conn->query("SELECT ID_Fecha_Esp, Fecha_Disponibilidad FROM Fechas_EspecialistasExt WHERE Fk_Programacion=$Especialistas->ID_Programacion");
                        while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="'.$valores["ID_Fecha_Esp"].'">'.fechaCastellano($valores["Fecha_Disponibilidad"]).'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col">
                <label for="HoraSeleccionada">Hora disponible<span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Tarjeta"><i class="fas fa-clock"></i></span>
                    </div>
                    <select id="HoraSeleccionada" class="form-control" name="HoraSeleccionada" required>
                        <option value="">Selecciona una hora</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <label for="NuevaHora">Nueva hora<span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="Tarjeta"><i class="fas fa-clock"></i></span>
                    </div>
                    <input type="time" class="form-control" name="NuevaHora" required>
                </div>
            </div>
        </div>

        <input type="text" class="form-control" hidden name="MedicoHoras[]" readonly value="<?php echo $Especialistas->FK_Medico; ?>">
        <input type="text" class="form-control" hidden name="NumberProgramaHoras[]" readonly value="<?php echo $Especialistas->ID_Programacion; ?>">
        <input type="text" class="form-control" hidden name="UsuarioHoras[]" readonly value=" <?php echo $row['Nombre_Apellidos']?>">
        <input type="text" class="form-control" hidden name="EmpresaHoras[]" readonly value=" <?php echo $row['ID_H_O_D']?>">
        <input type="text" class="form-control" hidden name="SistemaHoras[]" readonly value="<?php echo $row['Nombre_rol']?>">

        <div class="modal-footer justify-content-center">
            <button type="submit" id="EnviarDatos" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
        </div>
    </form>
</div>

<script>
    document.getElementById('FechaSeleccionada').addEventListener('change', function() {
        var fecha_id = this.value;

        // Realiza una petición AJAX para obtener las horas disponibles asociadas a la fecha seleccionada
        $.ajax({
            url: 'https://saludapos.com/AgendaDeCitas/Consultas/ObtenerHoraPorFecha.php', // Archivo PHP que devuelve las horas correspondientes a la fecha
            method: 'POST',
            data: { fecha_id: fecha_id },
            success: function(data) {
                var horaSelect = document.getElementById('HoraSeleccionada');
                horaSelect.innerHTML = ''; // Limpiar opciones previas
                var horas = JSON.parse(data);

                horas.forEach(function(hora) {
                    var option = document.createElement('option');
                    option.value = hora;
                    option.text = hora;
                    horaSelect.appendChild(option);
                });
            }
        });
    });
</script>
<?php else: ?>
<p class="alert alert-danger">404 No se encuentra</p>
<?php endif; ?>
