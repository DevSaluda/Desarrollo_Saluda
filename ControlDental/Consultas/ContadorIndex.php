<?php 
include("db_connection.php");
include "Consultas.php";



$sql ="SELECT COUNT(*) AS Total_Citas
FROM (
    SELECT
        AgendaCitas_EspecialistasExt.ID_Agenda_Especialista,
        Especialidades_Express.ID_Especialidad,
        Especialidades_Express.Nombre_Especialidad,
        Personal_Medico_Express.Medico_ID,
        Personal_Medico_Express.Nombre_Apellidos,
        SucursalesCorre.ID_SucursalC,
        SucursalesCorre.Nombre_Sucursal,
        Fechas_EspecialistasExt.ID_Fecha_Esp,
        Fechas_EspecialistasExt.Fecha_Disponibilidad,
        Horarios_Citas_Ext.ID_Horario,
        Horarios_Citas_Ext.Horario_Disponibilidad,
        AgendaCitas_EspecialistasExt.AgendadoPor,
        AgendaCitas_EspecialistasExt.Nombre_Paciente,
        AgendaCitas_EspecialistasExt.Telefono,
        AgendaCitas_EspecialistasExt.Observaciones,
        AgendaCitas_EspecialistasExt.Fecha_Hora
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
        AND DATE(AgendaCitas_EspecialistasExt.Fecha_Hora) = CURDATE()
) AS Todas_Las_Citas;
";

$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$PacientesGeneralDentalTotal = mysqli_fetch_assoc($resultset);






$sql ="SELECT
COUNT(*) AS Total_Citas
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
(AgendaCitas_EspecialistasExt.Fk_Especialidad = 14 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 15 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 16 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 17 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 18 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 19 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 20 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 65 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 66 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 67 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 68 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 76 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 80 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 81 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 84 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 85 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 86 OR 
 AgendaCitas_EspecialistasExt.Fk_Especialidad = 87)
AND DATE(AgendaCitas_EspecialistasExt.Fecha_Hora) = CURDATE();";

$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TraspasosPendientes = mysqli_fetch_assoc($resultset);




?>