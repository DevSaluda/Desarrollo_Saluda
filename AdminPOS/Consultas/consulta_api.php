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
$data = '';

if ($result->num_rows > 0) {
    $data .= '<table id="resultados_tabla" class="display">';
    $data .= '<thead><tr><th>ID</th><th>Cedula</th><th>Nombre</th><th>Sexo</th><th>Cargo</th><th>Domicilio</th><th>Fecha Asistencia</th><th>...</th></tr></thead>';
    $data .= '<tbody>';
    while ($row = $result->fetch_assoc()) {
        $data .= '<tr>';
        $data .= '<td>' . $row['Id_Pernl'] . '</td>';
        $data .= '<td>' . $row['Cedula'] . '</td>';
        $data .= '<td>' . $row['Nombre_Completo'] . '</td>';
        $data .= '<td>' . $row['Sexo'] . '</td>';
        $data .= '<td>' . $row['Cargo_rol'] . '</td>';
        $data .= '<td>' . $row['Domicilio'] . '</td>';
        $data .= '<td>' . $row['FechaAsis'] . '</td>';
        // Continuar con las otras columnas...
        $data .= '</tr>';
    }
    $data .= '</tbody></table>';
} else {
    $data .= 'No se encontraron resultados.';
}

$conn->close();

echo $data;
?>
