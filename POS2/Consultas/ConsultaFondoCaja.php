<?
include_once("../db_connect.php");
$sql ="SELECT Fondos_Cajas.ID_Fon_Caja,Fondos_Cajas.Fk_Sucursal,Fondos_Cajas.Fondo_Caja,Fondos_Cajas.ID_H_O_D, Fondos_Cajas.CodigoEstatus,Fondos_Cajas.Estatus, 
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM 
Fondos_Cajas,SucursalesCorre where Fondos_Cajas.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND Fondos_Cajas.Fk_Sucursal='".$row['Fk_Sucursal']."' AND Fondos_Cajas.Estatus ='Asignado' AND 
Fondos_Cajas.ID_H_O_D ='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$ValorFondoCaja = mysqli_fetch_assoc($resultset);

?>