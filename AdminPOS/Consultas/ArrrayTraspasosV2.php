


<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "mcript.php";

$sql = "SELECT Traspasos_generadosV2.ID_Traspaso_Generado,Traspasos_generadosV2.Folio_Traspaso,
Traspasos_generadosV2.ID_Prod_POS,
Traspasos_generadosV2.Cod_Barra,Traspasos_generadosV2.Nombre_Prod,
Traspasos_generadosV2.Fk_sucursal,Traspasos_generadosV2.Precio_Venta,Traspasos_generadosV2.Precio_Compra,
Traspasos_generadosV2.Total_compra,Traspasos_generadosV2.TotalVenta,Traspasos_generadosV2.Cantidad_Enviada,Traspasos_generadosV2.AgregadoPor,Traspasos_generadosV2.AgregadoEl,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM
SucursalesCorre,Traspasos_generadosV2 WHERE Traspasos_generadosV2.Fk_sucursal=SucursalesCorre.ID_SucursalC GROUP by Folio_Traspaso"; 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["FolioTraspaso"] = $fila["Folio_Traspaso"];

    $data[$c]["Fk_sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Cantidad"] = $fila["Cantidad_Enviada"];
    $data[$c]["Total_compra"] = $fila["Total_compra"];
    $data[$c]["TotalVenta"] = $fila["TotalVenta"];
    $data[$c]["Recibio"] =$fila["AgregadoPor"];

    $data[$c]["Acciones"] = ["<button class='btn btn-primary btn-sm dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
    <i class='fas fa-th-list fa-1x'></i></button><div class='dropdown-menu'>
    <a href=https://controlfarmacia.com/AdminPOS/CancelaTraspasoV2?idProd=".base64_encode($fila["Folio_Traspaso"])." class='btn-edit  dropdown-item' >Cancelar Traspaso 
    <i class='fas fa-ban'></i></a><a href=https://controlfarmacia.com/AdminPOS/EstadoTraspaso?Disid=".base64_encode($fila["Folio_Traspaso"])." class='btn-VerDistribucion  dropdown-item' >Ver estado de traspaso 
    <i class='fa-solid fa-list-check'></i> </a>
    <a href=https://controlfarmacia.com/AdminPOS/OrdenTraspasos?Disid=".base64_encode($fila["Folio_Traspaso"])." class='btn-VerDistribucion  dropdown-item' >Ver orden 
    <i class='fa-solid fa-file-invoice'></i> </a>
    </div> "];
    
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