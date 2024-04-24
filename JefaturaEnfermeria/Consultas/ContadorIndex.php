<?php 
include("db_connection.php");
include "Consultas.php";



$sql ="SELECT Estatus,ID_H_O_D,Fecha_Apertura,COUNT(*) as CajasAbiertas FROM Cajas_POS WHERE Estatus='Abierta' AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fecha_Apertura=CURRENT_DATE ";

$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$CajasAbiertas = mysqli_fetch_assoc($resultset);

$sql ="SELECT Fecha_venta,COUNT(*) Folio_Ticket FROM Ventas_POS WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Fecha_venta=CURRENT_DATE";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$Tickets = mysqli_fetch_assoc($resultset);

$sql ="SELECT Fecha_Apertura,ID_H_O_D,SUM(Valor_Total_Caja - Cantidad_Fondo) as totaldia FROM Cajas_POS WHERE Fecha_Apertura = CURRENT_DATE AND ID_H_O_D='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalGanancia = mysqli_fetch_assoc($resultset);

$sql ="SELECT Estatus,ID_SignoV,COUNT(*) as SignosVitales FROM Signos_VitalesV2 WHERE Fecha_Visita =CURRENT_DATE;";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalSignosVitales = mysqli_fetch_assoc($resultset);


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