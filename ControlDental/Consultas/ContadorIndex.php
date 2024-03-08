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
$PacientesGeneralDental = mysqli_fetch_assoc($resultset);

$sql ="SELECT Fecha_venta,COUNT(*) Folio_Ticket FROM Ventas_POS WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Fecha_venta=CURRENT_DATE";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$Tickets = mysqli_fetch_assoc($resultset);

$sql ="SELECT Fecha_Apertura,ID_H_O_D,SUM(Valor_Total_Caja - Cantidad_Fondo) as totaldia FROM Cajas_POS WHERE Fecha_Apertura = CURRENT_DATE AND ID_H_O_D='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalGanancia = mysqli_fetch_assoc($resultset);





$sql ="SELECT Estatus,ID_H_O_D,COUNT(*) as TraspasosPendientes FROM Traspasos_generados WHERE Estatus='Generado' AND ID_H_O_D='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TraspasosPendientes = mysqli_fetch_assoc($resultset);


$sql ="SELECT ID_H_O_D,COUNT(*) as TotalTickets FROM Tickets_Incidencias WHERE  ID_H_O_D='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalTickets = mysqli_fetch_assoc($resultset);


$sql ="SELECT Estatus,ID_H_O_D,COUNT(*) as TicketsAsignados FROM Tickets_Incidencias WHERE Estatus='Asignado' AND ID_H_O_D='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TicketsAsignados = mysqli_fetch_assoc($resultset);

$sql ="SELECT Estatus,ID_H_O_D,COUNT(*) as TicketsCerrados FROM Tickets_Incidencias WHERE Estatus='Cerrado' AND ID_H_O_D='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TicketsCerrados = mysqli_fetch_assoc($resultset);

?>