<?

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";


$sql ="SELECT ID_Sol_Traspaso,Estatus,COUNT(*) As totalsolicitudes FROM Solicitudes_Traspasos WHERE Estatus='Solicitud enviada' ";

$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$CajasAbiertas = mysqli_fetch_assoc($resultset);

$sql ="SELECT Fecha_venta,COUNT(*) Folio_Ticket FROM Ventas_POS WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Fecha_venta=CURRENT_DATE";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$Tickets = mysqli_fetch_assoc($resultset);

$sql ="SELECT Fecha_Apertura,ID_H_O_D,SUM(Valor_Total_Caja - Cantidad_Fondo) as totaldia FROM Cajas_POS WHERE Fecha_Apertura = CURRENT_DATE AND ID_H_O_D='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalGanancia = mysqli_fetch_assoc($resultset);



$sql ="SELECT Estatus,ID_H_O_D,COUNT(*) as TraspasosPendientes FROM Traspasos_generados WHERE Estatus='Generado' AND ID_H_O_D='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TraspasosPendientes = mysqli_fetch_assoc($resultset);




?>