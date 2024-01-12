<?

function fechaCastellano ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
?>
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "mcript.php";

$sql = "SELECT Stock_registrosNuevos.Folio_Ingreso,Stock_registrosNuevos.ID_Prod_POS,Stock_registrosNuevos.Fk_sucursal,
Stock_registrosNuevos.Existencias_R,Stock_registrosNuevos.ExistenciaPrev,Stock_registrosNuevos.Recibido,Stock_registrosNuevos.AgregadoPor,Stock_registrosNuevos.AgregadoEl, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Productos_POS.ID_Prod_POS,Productos_POS.Cod_Barra,Productos_POS.Nombre_Prod FROM
Productos_POS,SucursalesCorre,Stock_registrosNuevos WHERE Stock_registrosNuevos.Fk_sucursal = SucursalesCorre.ID_SucursalC and 
Stock_registrosNuevos.ID_Prod_POS = Productos_POS.ID_Prod_POS";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Folio_Ingreso"] = $fila["Folio_Ingreso"];
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    $data[$c]["Existencias_R"] = $fila["Existencias_R"];
    $data[$c]["ExistenciaPrev"] = $fila["ExistenciaPrev"];
    $data[$c]["Recibido"] = $fila["Recibido"];
    $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["AgregadoPor"] = $fila["AgregadoPor"];
    $data[$c]["AgregadoEl"] = $fila["AgregadoEl"];
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
