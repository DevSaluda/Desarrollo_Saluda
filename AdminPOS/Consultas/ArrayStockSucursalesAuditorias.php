
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";


$sql = "SELECT 
    a.IdAuditoria,
    a.Folio_Prod_Stock,
    a.ID_Prod_POS,
    a.Clave_adicional,
    a.Clave_Levic,
    a.Cod_Enfermeria,
    a.Cod_Barra,
    a.Nombre_Prod,
    a.Fk_sucursal,
    a.Precio_Venta,
    a.Precio_C,
    a.Max_Existencia,
    a.Min_Existencia,
    a.Existencias_R,
    a.Lote,
    a.Fecha_Caducidad,
    a.Fecha_Ingreso,
    a.Tipo_Servicio,
    a.Tipo,
    a.Proveedor1,
    a.Proveedor2,
    a.Estatus,
    a.CodigoEstatus,
    a.Sistema,
    a.AgregadoPor,
    a.AgregadoEl,
    a.ID_H_O_D,
    a.TipoMov,
    b.ID_SucursalC,
    b.Nombre_Sucursal,
    c.Servicio_ID,
    c.Nom_Serv,
    d.Precio_Venta AS Producto_Precio_Venta,
    d.Precio_C AS Producto_Precio_C
FROM 
    Stock_POS_TablaAuditorias a
JOIN 
    SucursalesCorre b ON a.Fk_sucursal = b.ID_SucursalC
JOIN 
    Servicios_POS c ON a.Tipo_Servicio = c.Servicio_ID
JOIN 
    Productos_POS d ON a.ID_Prod_POS = d.ID_Prod_POS
WHERE 
    a.ID_H_O_D = '".$row['ID_H_O_D']."' 
    AND a.Fk_sucursal = '".$row['Fk_Sucursal']."'
    AND MONTH(a.AgregadoEl) = MONTH(CURDATE())
    AND YEAR(a.AgregadoEl) = YEAR(CURDATE());
";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    $data[$c]["Precio_Venta"] = $fila["Precio_Venta"];
    $data[$c]["Nom_Serv"] = $fila["Nom_Serv"];

 
    $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["UltimoMovimiento"] = $fila["AgregadoEl"];
    $data[$c]["TipoMov"] = $fila["TipoMov"];
    $data[$c]["Existencias_R"] = $fila["Existencias_R"];
    
    

   


    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
