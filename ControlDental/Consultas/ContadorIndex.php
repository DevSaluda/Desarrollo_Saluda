<?php 
include("db_connection.php");
include "Consultas.php";



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
AND DATE(AgendaCitas_EspecialistasExt.Fecha_Hora) = CURRENT_DATE ";

$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$PacientesGeneralDentalTotal = mysqli_fetch_assoc($resultset);

$sql ="SELECT Fecha_venta,COUNT(*) Folio_Ticket FROM Ventas_POS WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Fecha_venta=CURRENT_DATE";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$Tickets = mysqli_fetch_assoc($resultset);

$sql ="SELECT Fecha_Apertura,ID_H_O_D,SUM(Valor_Total_Caja - Cantidad_Fondo) as totaldia FROM Cajas_POS WHERE Fecha_Apertura = CURRENT_DATE AND ID_H_O_D='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalGanancia = mysqli_fetch_assoc($resultset);


$sql ="SELECT Estatus,ID_H_O_D,COUNT(*) as Farmaceuticos FROM `PersonalPOS` WHERE Fk_Usuario = 7 AND Estatus='Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalFarmaceuticos = mysqli_fetch_assoc($resultset);

$sql ="SELECT Estatus,ID_H_O_D,COUNT(*) as Enfermeros FROM Personal_Enfermeria WHERE Fk_Usuario = 4 AND Estatus='Vigente' AND  ID_H_O_D='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalEnfermeros = mysqli_fetch_assoc($resultset);

$sql ="SELECT Estatus,ID_H_O_D,COUNT(*) as Medicos FROM Personal_Medico WHERE Estatus='Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalMedicos = mysqli_fetch_assoc($resultset);
$sql ="SELECT Estatus,ID_H_O_D,COUNT(*) as Intendentes FROM Personal_Intendecia WHERE Estatus='Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalLimpieza = mysqli_fetch_assoc($resultset);


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