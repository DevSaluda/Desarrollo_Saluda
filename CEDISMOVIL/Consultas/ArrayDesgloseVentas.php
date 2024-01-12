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

$sql = "SELECT Ventas_POS.Folio_Ticket,Ventas_POS.Fk_Caja,Ventas_POS.Venta_POS_ID,Ventas_POS.Identificador_tipo,
Ventas_POS.Total_Venta,Ventas_POS.Importe,Ventas_POS.Total_VentaG,Ventas_POS.FormaDePago,Ventas_POS.Turno,
Ventas_POS.Cod_Barra,Ventas_POS.Clave_adicional, Ventas_POS.Identificador_tipo,Ventas_POS.Fecha_venta,
Ventas_POS.Nombre_Prod,Ventas_POS.Cantidad_Venta,Ventas_POS.Fk_sucursal,Ventas_POS.AgregadoPor,
Ventas_POS.AgregadoEl, Ventas_POS.Total_Venta,Ventas_POS.Lote,Ventas_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,
SucursalesCorre.Nombre_Sucursal,Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv FROM Ventas_POS,SucursalesCorre,Servicios_POS 
 WHERE  Ventas_POS.Fk_sucursal= SucursalesCorre.ID_SucursalC AND Ventas_POS.Fecha_venta = CURRENT_DATE() AND Ventas_POS.Fk_sucursal='".$row['Fk_Sucursal']."' 
AND Ventas_POS.ID_H_O_D ='".$row['ID_H_O_D']."' AND Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    $data[$c]["FolioTicket"] = $fila["Folio_Ticket"];
    $data[$c]["Turno"] = $fila["Turno"];
    $data[$c]["Cantidad_Venta"] = $fila["Cantidad_Venta"];
    $data[$c]["Importe"] = $fila["Importe"];
    $data[$c]["Total_Venta"] = $fila["Total_Venta"];
    $data[$c]["Descuento"] = $fila["DescuentoAplicado"];
    $data[$c]["FormaPago"] = $fila["FormaDePago"];
    $data[$c]["NomServ"] = $fila["Nom_Serv"];
    $data[$c]["AgregadoEl"] = date('h:i A', strtotime(($fila["AgregadoEl"])));
    $data[$c]["AgregadoEnMomento"] = FechaCastellano($fila["AgregadoEl"]);
    $data[$c]["AgregadoPor"] = $fila["AgregadoPor"];
    $data[$c]["Acciones"] = ["<button class='btn btn-primary btn-sm dropdown-toggle' 
    type='button' data-toggle='dropdown' aria-haspopup='true'
     aria-expanded='false'><i class='fas fa-th-list fa-1x'></i></button><div class='dropdown-menu'>
     <a href=https://controlfarmacia.com/AdminPOS/ActualizaOne?idProd=".base64_encode($fila["Folio_Prod_Stock"])." class='btn-edit  dropdown-item' >
     Actualizar existencias <i class='fas fa-edit'></i></a><a href=https://controlfarmacia.com/AdminPOS/CoincidenciaSucursales?Disid=".base64_encode($fila["ID_Prod_POS"])."
      class='btn-VerDistribucion  dropdown-item' >Actualizar existencias en coincidencia <i class='fas fa-equals'></i> </a>
      <a href=https://controlfarmacia.com/AdminPOS/GeneradorTraspasos?idProd=".base64_encode($fila["Folio_Prod_Stock"])." class='btn-editProd dropdown-item' >Traspaso
       <i class='fas fa-exchange-alt'></i></a><a href=https://controlfarmacia.com/AdminPOS/HistorialProducto?idProd=".$fila["ID_Prod_POS"]." 
       class='btn-History dropdown-item' >Ver movimientos <i class='fas fa-history'></i></a><a href=https://controlfarmacia.com/AdminPOS/EliminarProductoGeneral?idProd=".base64_encode($fila["ID_Prod_POS"])." 
       class='btn-Delete dropdown-item' >Estadisticas de venta <i class='fas fa-chart-line'></i></a></div> "];
    
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
