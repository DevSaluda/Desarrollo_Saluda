<?php
include_once("../db_connect.php");
$sql ="SELECT Cajas_POS.ID_Caja,Cajas_POS.Cantidad_Fondo,Cajas_POS.Empleado,Cajas_POS.Sucursal,Cajas_POS.Estatus,Cajas_POS.CodigoEstatus,Cajas_POS.Turno,Cajas_POS.Asignacion,
Cajas_POS.Fecha_Apertura,Cajas_POS.Valor_Total_Caja,Cajas_POS.ID_H_O_D, SucursalesCorre.ID_SucursalC, SucursalesCorre.Nombre_Sucursal 
FROM Cajas_POS,SucursalesCorre where Cajas_POS.Sucursal = SucursalesCorre.ID_SucursalC AND Cajas_POS.Fecha_Apertura = CURRENT_DATE()
 AND Cajas_POS.Sucursal='".$row['Fk_Sucursal']."' AND Cajas_POS.Asignacion = 1 AND
Cajas_POS.Estatus='Abierta'  AND Cajas_POS.Empleado='".$row['Nombre_Apellidos']."'  AND Cajas_POS.ID_H_O_D='".$row['ID_H_O_D']."'"; 
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$ValorCaja = mysqli_fetch_assoc($resultset);

?>