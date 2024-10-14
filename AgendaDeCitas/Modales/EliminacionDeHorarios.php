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

<style>
    .modal-dialog {
        max-width: 80%;
        width: 80%;
    }

    .form-control {
        font-size: 1rem;
        height: 40px;
    }

    label {
        font-size: 1.2rem;
    }

    /* Estilo para el contenedor de las horas */
    #HoraCheckboxes {
        max-height: 200px; /* Limita la altura para que no se desborde */
        overflow-y: auto;  /* Añade barra de desplazamiento vertical si hay muchas horas */
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f9f9f9;
    }

    .hora-checkbox {
        display: block;
        margin: 5px 0;
    }
</style>

<div id="EliminarHoras">
    <form action="javascript:void(0)" method="post" id="ProgramaHorasEliminar">
        <div class="row">
            <div class="col">
                <label for="FechaSeleccionada">Fecha<span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    </div>
                    <select id="FechaSeleccionada" class="form-control" name="FechaSeleccionada" required>
                        <option value="" disabled selected>Seleccione una fecha</option> <!-- Opción por defecto -->
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
                <label for="HoraSeleccionada">Horas a eliminar<span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                    <div id="HoraCheckboxes">
                        <!-- Aquí se cargarán las horas como checkboxes -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Campos ocultos para enviar información adicional -->
        <input type="text" class="form-control" hidden name="ID_Programacion" readonly value="<?php echo $Especialistas->ID_Programacion; ?>">
        <input type="text" class="form-control" hidden name="FK_Medico" readonly value="<?php echo $Especialistas->FK_Medico; ?>">

        <div class="modal-footer justify-content-center">
            <button type="submit" id="EliminarDatosUnico" value="Eliminar" class="btn btn-danger">Eliminar <i class="fas fa-trash"></i></button>
        </div>
    </form>
</div>


<script src="js/EliminaHorasProgramacion.js"></script>
<script>
document.getElementById('FechaSeleccionada').addEventListener('change', function() {
    var fecha_id = this.value;

    $.ajax({
        url: 'https://saludapos.com/AgendaDeCitas/Consultas/ObtenerHoraPorFecha.php',
        method: 'POST',
        data: { fecha_id: fecha_id },
        success: function(data) {
            var horaCheckboxes = document.getElementById('HoraCheckboxes');
            horaCheckboxes.innerHTML = '';  // Limpiar cualquier contenido previo
            var horas = JSON.parse(data);

            horas.forEach(function(horaObj) {
                var [hour, minute] = horaObj.Horario_Disponibilidad.split(':').map(Number);
                var date = new Date();
                date.setHours(hour);
                date.setMinutes(minute);
                date.setSeconds(0);

                var time = date.toLocaleTimeString('es-MX', { hour: '2-digit', minute: '2-digit', hour12: true });

                // Crear checkbox para cada hora
                var checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'horasSeleccionadas[]';  // Importante para enviar un array con los valores seleccionados
                checkbox.value = horaObj.ID_Horario;
                checkbox.id = 'hora_' + horaObj.ID_Horario;

                var label = document.createElement('label');
                label.htmlFor = checkbox.id;
                label.className = 'hora-checkbox';
                label.appendChild(checkbox);
                label.appendChild(document.createTextNode(' ' + time));

                horaCheckboxes.appendChild(label);
            });
        }
    });
});
</script>

<?php else: ?>
<p class="alert alert-danger">404 No se encuentra</p>
<?php endif; ?>
