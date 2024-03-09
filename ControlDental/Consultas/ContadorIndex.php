<?php 
include("db_connection.php");
include "Consultas.php";



$sql ="SELECT
COUNT(*) AS TotalResultados
FROM
AgendaCitas_EspecialistasExt
LEFT JOIN
Especialidades_Express ON AgendaCitas_EspecialistasExt.Fk_Especialidad = Especialidades_Express.ID_Especialidad
LEFT JOIN
Personal_Medico_Express ON AgendaCitas_EspecialistasExt.Fk_Especialista = Personal_Medico_Express.Medico_ID
LEFT JOIN
SucursalesCorre ON AgendaCitas_EspecialistasExt.Fk_Sucursal = SucursalesCorre.ID_SucursalC
LEFT JOIN
Fechas_EspecialistasExt ON AgendaCitas_EspecialistasExt.Fecha = Fechas_EspecialistasExt.ID_Fecha_Esp
LEFT JOIN
Horarios_Citas_Ext ON AgendaCitas_EspecialistasExt.Hora = Horarios_Citas_Ext.ID_Horario
WHERE
AgendaCitas_EspecialistasExt.Fk_Especialidad IN (14, 15, 16, 17, 18, 19, 20, 65, 66, 67, 68, 76, 80, 81, 84, 85, 86, 87)
AND Fechas_EspecialistasExt.Fecha_Disponibilidad = CURRENT_DATE ";

$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$PacientesGeneralDentalTotal = mysqli_fetch_assoc($resultset);

$sql ="SELECT COUNT(*) AS CreditosVigentes
FROM Creditos_POS
WHERE Saldo <> 0;";

$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$CreditosVigentes = mysqli_fetch_assoc($resultset);


$sql ="SELECT COUNT(*) AS AbonosDelDia
FROM AbonoCreditos_POS
WHERE DATE(AgregadoEl) = CURRENT_DATE ";

$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$AbonosRealizados = mysqli_fetch_assoc($resultset);

$sql ="SELECT COUNT(*) AS VentasDelDia
FROM Ventas_POS
WHERE DATE(Fecha_venta) = CURDATE()
AND Identificador_tipo IN (1, 2, 3);";

$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalProcedimientos = mysqli_fetch_assoc($resultset);


?>