<?php 

include("db_connection.php");
include "Consultas.php";



$sql ="SELECT COUNT(ID_Notificacion)as totalnotifi, Estado, Sucursal FROM Area_De_Notificaciones WHERE Sucursal='".$row['Fk_Sucursal']."' and Estado !=0 ";

$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$CambiosdepreciosNuevos = mysqli_fetch_assoc($resultset);

$sql ="SELECT COUNT(Num_Orden) as traspasopendiente,Fk_SucDestino,Estatus FROM Traspasos_generados WHERE Fk_SucDestino='".$row['Fk_Sucursal']."' and Estatus ='Generado'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TraspasosPendientes = mysqli_fetch_assoc($resultset);


$totalmontotraspasos =$CambiosdepreciosNuevos['totalnotifi'] + $TraspasosPendientes['traspasopendiente']; 
echo $totalmontotraspasos; 
?>