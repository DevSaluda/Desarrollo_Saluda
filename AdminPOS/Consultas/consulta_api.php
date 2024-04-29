<?php
include("db_connection_Huellas.php");
$sql = "SELECT
            p.Id_pernl AS Id_Pernl,
            p.Cedula AS Cedula,
            p.Nombre_Completo AS Nombre_Completo,
            p.Sexo AS Sexo,
            p.Cargo_rol AS Cargo_rol,
            p.Domicilio AS Domicilio,
            a.Id_asis AS Id_asis,
            a.FechaAsis AS FechaAsis,
            a.Nombre_dia AS Nombre_dia,
            a.HoIngreso AS HoIngreso,
            a.HoSalida AS HoSalida,
            a.Tardanzas AS Tardanzas,
            a.Justifacion AS Justifacion,
            a.tipoturno AS tipoturno,
            a.EstadoAsis AS EstadoAsis,
            a.totalhora_tr AS totalhora_tr
        FROM
            u155356178_SaludaHuellas.personal p
        JOIN u155356178_SaludaHuellas.asistenciaper a
            ON a.Id_Pernl = p.Id_pernl
        WHERE
            DATE(a.FechaAsis) = CURDATE()";

$result = $conn->query($sql);
?>

<?php
if ($result->num_rows > 0) {
    echo '<div class="text-center">';
    echo '<div class="table-responsive">';
    echo '<table id="SalidaEmpleados" class="table table-hover">';
    echo '<thead>';
    echo '<th>ID</th>';
    echo '<th>Nombre completo</th>';
    echo '<th>Puesto</th>';
    echo '<th>Sucursal</th>';
    echo '<th>Fecha de asistencia</th>';
    echo '<th>Fecha de corta</th>';
    echo '<th>Hora de entrada</th>';
    echo '<th>Hora de salida</th>';
    echo '<th>Estado</th>';
    echo '<th>Horas trabajadas</th>';
    echo '</thead>';
    echo '<tbody>';

    while ($Usuarios = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $Usuarios["Id_asis"] . '</td>';
        echo '<td>' . $Usuarios["Nombre_Completo"] . '</td>';
        echo '<td>' . $Usuarios["Cargo_rol"] . '</td>';
        echo '<td>' . $Usuarios["Domicilio"] . '</td>';
        echo '<td>' . fechaCastellano($Usuarios["FechaAsis"]) . '</td>';
        echo '<td>' . $Usuarios["FechaAsis"] . '</td>';
        echo '<td>' . $Usuarios["HoIngreso"] . '</td>';
        echo '<td>' . $Usuarios["HoSalida"] . '</td>';
        echo '<td>' . $Usuarios["EstadoAsis"] . '</td>';
        echo '<td>' . convertirDecimalAHoraMinutosSegundos($Usuarios["totalhora_tr"]) . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
} else {
    echo '<p class="alert alert-warning">No hay resultados</p>';
}

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

function convertirDecimalAHoraMinutosSegundos($decimalHoras)
{
    $horas = floor($decimalHoras); // Parte entera: horas
    $minutosDecimal = ($decimalHoras - $horas) * 60; // Decimal a minutos
    $minutos = floor($minutosDecimal); // Parte entera: minutos
    $segundosDecimal = ($minutosDecimal - $minutos) * 60; // Decimal a segundos
    $segundos = round($segundosDecimal); // Redondear a segundos


    return sprintf("%02d:%02d:%02d", $horas, $minutos, $segundos);  // Formatear como HH:MM:SS
}

