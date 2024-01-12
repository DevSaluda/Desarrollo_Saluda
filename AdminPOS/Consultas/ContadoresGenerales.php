<?

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$sql ="SELECT COUNT(*) as TotalSolicitud FROM Solicitudes_Traspasos WHERE Estatus ='Solicitud enviada' AND ID_H_O_D='".$row['ID_H_O_D']."'"; 
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$SolicitudesPorver = mysqli_fetch_assoc($resultset);


$sql ="SELECT COUNT(*) as TotalAprobados FROM Solicitudes_Traspasos WHERE Estatus ='Autorizado' AND ID_H_O_D='".$row['ID_H_O_D']."'"; 
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$SolicitudesAprobadas = mysqli_fetch_assoc($resultset);


$sql ="SELECT COUNT(*) as TotalRechazadas FROM Solicitudes_Traspasos WHERE Estatus ='Rechazado' AND ID_H_O_D='".$row['ID_H_O_D']."'"; 
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$SolicitudesRechazadas = mysqli_fetch_assoc($resultset);
?>