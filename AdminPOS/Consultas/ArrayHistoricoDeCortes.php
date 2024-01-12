
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "mcript.php";


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

$sql = "SELECT 
Cajas_POS.ID_Caja,
Cajas_POS.Cantidad_Fondo,
Cajas_POS.Empleado,
Cajas_POS.Sucursal,
Cajas_POS.Estatus,
Cajas_POS.CodigoEstatus,
Cajas_POS.Turno,
Cajas_POS.Asignacion,
Cajas_POS.Fecha_Apertura,
Cajas_POS.Valor_Total_Caja,
Cajas_POS.ID_H_O_D, 
SucursalesCorre.ID_SucursalC, 
SucursalesCorre.Nombre_Sucursal 
FROM 
Cajas_POS,
SucursalesCorre 
WHERE 
Cajas_POS.Sucursal = SucursalesCorre.ID_SucursalC 
AND Cajas_POS.Estatus = 'Cerrada'  
AND Cajas_POS.ID_H_O_D = '".$row['ID_H_O_D']."'  
AND Cajas_POS.Sucursal = '".$row['Fk_Sucursal']."'
AND YEAR(Cajas_POS.Fecha_Apertura) IN (YEAR(CURRENT_DATE) - 1, YEAR(CURRENT_DATE))
ORDER BY Cajas_POS.Fecha_Apertura DESC";
;
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
    $data[$c]["IdCaja"] = $fila["ID_Caja"];
    $data[$c]["Empleado"] = $fila["Empleado"];
    $data[$c]["CantidadInicial"] = $fila["Cantidad_Fondo"];
    $data[$c]["Fecha"] = fechaCastellano($fila["Fecha_Apertura"]);
    $data[$c]["Estadocaja"] = '<td> <button style="' . $fila['CodigoEstatus'] . '" class="btn btn-default btn-sm" >' . $fila["Estatus"] . '</button></td>';
   
    $data[$c]["Estatus"] = '<button class="btn btn-default btn-sm" style="';

if ($fila['Asignacion'] == 1) {
   $data[$c]["Estatus"] .= "background-color:#007bff!important";
} elseif ($fila['Asignacion'] == 2) {
   $data[$c]["Estatus"] .= "background-color:#001f3f!important";
} else {
   $data[$c]["Estatus"] .= "background-color:#fd7e14!important";
}

$data[$c]["Estatus"] .= '">';

if ($fila['Asignacion'] == 1) {
   $data[$c]["Estatus"] .= "Asignado";
} elseif ($fila['Asignacion'] == 2) {
   $data[$c]["Estatus"] .= "Finalizado";
} else {
   $data[$c]["Estatus"] .= "Sin asignar";
}

$data[$c]["Estatus"] .= '</button>';
    $data[$c]["Turno"] = $fila["Turno"];
   
    $data[$c]["ValorEnCaja"] = $fila["Valor_Total_Caja"];
    $data[$c]["Acciones"] = '
<td>
<a data-id="' . $fila["ID_Caja"] . '" class="btn btn-primary btn-sm btn-edit"><i class="fas fa-print"></i> Desglose Corte </a>


</td>';
    
    
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>


