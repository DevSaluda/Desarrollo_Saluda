 
<?php
// Seteamos la cabecera a JSON
header('Content-Type: application/json');
 
// Configuramos la conexión a la base de datos
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'somosgr1_SHWEB');
define('DB_PASSWORD', 'yH.0a-v?T*1R');
define('DB_NAME', 'somosgr1_Sistema_Hospitalario');
 
// Desplegamos la conexión a la Basde de Datos
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
$mysqli->query("SET NAMES 'utf8'");
 
if(!$mysqli){
	die("La Conexión ha fallado: " . $mysqli->error);
}
 
// Seleccionamos los datos de la tabla postres
$query = sprintf("SELECT Ventas_POS.Turno,Ventas_POS.Fk_sucursal,SUM(Ventas_POS.Importe) as TotalGenerado,Ventas_POS.Fecha_venta,Ventas_POS.AgregadoPor, 
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Ventas_POS,SucursalesCorre WHERE Ventas_POS.Turno='Matutino' AND  Ventas_POS.Fk_sucursal=SucursalesCorre.ID_SucursalC AND 
Fecha_venta =CURDATE() GROUP BY Ventas_POS.AgregadoPor,Ventas_POS.Turno,SucursalesCorre.Nombre_Sucursal,Ventas_POS.Fecha_venta ORDER BY `SucursalesCorre`.`ID_SucursalC` ASC");
 
$result = $mysqli->query($query);
 
// Hacemos un bucle con los datos obntenidos
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
 
// Limpiamos memoria consumida al extraer los datos
$result->close();
 
// Cerramos la conexión a la Base de Datos
$mysqli->close();
 
// Mostramos los datos en formato JSON
echo json_encode($data);
 
//var_dump($data);