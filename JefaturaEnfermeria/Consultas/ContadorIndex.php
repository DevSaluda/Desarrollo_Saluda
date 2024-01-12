<?

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";


$sql ="SELECT Signos_VitalesV2.ID_SignoV,Signos_VitalesV2.Fk_Sucursal,Signos_VitalesV2.FK_ID_H_O_D, Signos_VitalesV2.Fecha_Visita,Signos_VitalesV2.Estatus,Signos_VitalesV2.CodigoEstatus, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,COUNT(*) as TotalPacientesdias FROM Signos_VitalesV2,SucursalesCorre where DATE(Signos_VitalesV2.Fecha_Visita) = DATE_FORMAT(CURDATE(),'%Y-%m-%d') AND Signos_VitalesV2.Fk_Sucursal= SucursalesCorre.ID_SucursalC GROUP BY Signos_VitalesV2.Fk_Sucursal ";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TomaSignosVitales = mysqli_fetch_assoc($resultset);

$sql ="SELECT COUNT(*) as totalreportes, ID_incidencia, Fecha from Incidencias_Express where DATE(Fecha) = DATE_FORMAT(CURDATE(),'%Y-%m-%d')";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalReportes = mysqli_fetch_assoc($resultset);

// $sql ="SELECT Fecha_Apertura,ID_H_O_D,SUM(Valor_Total_Caja - Cantidad_Fondo) as totaldia FROM Cajas_POS WHERE Fecha_Apertura = CURRENT_DATE AND ID_H_O_D='".$row['ID_H_O_D']."'";
// $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
// $TotalGanancia = mysqli_fetch_assoc($resultset);






$sql ="SELECT Estatus,ID_H_O_D,COUNT(*) as Enfermeros FROM Personal_Enfermeria WHERE Fk_Usuario = 4 AND Estatus='Vigente' AND  ID_H_O_D='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalEnfermeros = mysqli_fetch_assoc($resultset);

?>