
<?php
header('Content-Type: application/json');
include("db_connection_Huellas.php");

$sql = "SELECT
p.Id_pernl AS Id_Pernl,
p.Cedula AS Cedula,
p.Nombre_Completo AS Nombre_Completo,
p.Sexo AS Sexo,
p.Cargo_rol AS Cargo_rol,
p.Domicilio AS Domicilio,
a.Id_asis AS Id_asis,
a.FechaAsis AS FechaAsis,
a.Nombre_dia AS Nombre_dia,
a.HoIngreso AS HoIngreso,
a.HoSalida AS HoSalida,
a.Tardanzas AS Tardanzas,
a.Justifacion AS Justifacion,
a.tipoturno AS tipoturno,
a.EstadoAsis AS EstadoAsis,
a.totalhora_tr AS totalhora_tr
FROM
u155356178_SaludaHuellas.personal p
JOIN u155356178_SaludaHuellas.asistenciaper a
ON a.Id_Pernl = p.Id_pernl
WHERE
a.FechaAsis = CURDATE()";




$result = mysqli_query($conn, $sql);

 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Cod_Barra"] = $fila["Id_asis"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Completo"];
    $data[$c]["PrecioCompra"] = $fila["Precio_C"];
    $data[$c]["PrecioVenta"] = $fila["Cargo_rol"];
    $data[$c]["Sucursal"] = $fila["Domicilio"];
    $data[$c]["Turno"] = $fila["FechaAsis"];
    $data[$c]["Cantidad_Venta"] = $fila["FechaAsis"];
    $data[$c]["Importe"] = $fila["HoIngreso"];
    $data[$c]["Total_Venta"] = $fila["HoSalida"];
    $data[$c]["Descuento"] = $fila["EstadoAsis"];
    $data[$c]["FormaPago"] = $fila["totalhora_tr"];
   
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
