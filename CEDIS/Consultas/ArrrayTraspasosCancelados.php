


<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "mcript.php";

$sql = "SELECT Traspasos_generados_Eliminados.ID_Traspaso_Generado,Traspasos_generados_Eliminados.Folio_Prod_Stock,
Traspasos_generados_Eliminados.Cod_Barra, Traspasos_generados_Eliminados.Nombre_Prod,Traspasos_generados_Eliminados.Fk_sucursal,Traspasos_generados_Eliminados.Fk_Sucursal_Destino, 
Traspasos_generados_Eliminados.Precio_Venta,Traspasos_generados_Eliminados.Precio_Compra, Traspasos_generados_Eliminados.Total_traspaso,Traspasos_generados_Eliminados.TotalVenta,Traspasos_generados_Eliminados.Existencias_R,
 Traspasos_generados_Eliminados.Cantidad_Enviada,Traspasos_generados_Eliminados.Existencias_D_envio,Traspasos_generados_Eliminados.FechaEntrega,Traspasos_generados_Eliminados.Estatus,Traspasos_generados_Eliminados.ID_H_O_D,
 SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Traspasos_generados_Eliminados,SucursalesCorre WHERE Traspasos_generados_Eliminados.Fk_sucursal = SucursalesCorre.ID_SucursalC"; 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["IDTraspasoGenerado"] = $fila["ID_Traspaso_Generado"];
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    $data[$c]["Fk_sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Destino"] = $fila["Fk_Sucursal_Destino"];
    $data[$c]["Cantidad"] = $fila["Cantidad_Enviada"];
    $data[$c]["Total_traspaso"] = $fila["Total_traspaso"];
    $data[$c]["TotalVenta"] = $fila["TotalVenta"];
    $data[$c]["FechaEntrega"] = fechaCastellano($fila["FechaEntrega"]);
    $data[$c]["Estatus"] = fechaCastellano($fila["Estatus"]);
      $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>




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