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
$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

echo json_encode($data);
?>
