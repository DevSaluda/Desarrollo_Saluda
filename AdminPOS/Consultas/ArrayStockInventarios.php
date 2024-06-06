<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

$sql = "SELECT 
            sp.Folio_Prod_Stock,
            sp.Clave_adicional,
            sp.ID_Prod_POS,
            sp.Cod_Barra,
            sp.Nombre_Prod,
            sp.Tipo_Servicio,
            sp.Fk_sucursal,
            sp.Max_Existencia,
            sp.Min_Existencia,
            sp.Existencias_R,
            sp.Proveedor1,
            sp.Proveedor2,
            sp.CodigoEstatus,
            sp.Estatus,
            sp.ID_H_O_D,
            sc.ID_SucursalC,
            sc.Nombre_Sucursal,
            srv.Servicio_ID,
            srv.Nom_Serv,
            pp.ID_Prod_POS,
            pp.Precio_Venta,
            sp.Precio_C,
            pp.Precio_C,
            sp.Contabilizado,         -- New field
            sp.FechaDeInventario      -- New field
        FROM 
            Stock_POS sp
        JOIN 
            SucursalesCorre sc ON sp.Fk_Sucursal = sc.ID_SucursalC
        JOIN 
            Servicios_POS srv ON sp.Tipo_Servicio = srv.Servicio_ID
        JOIN 
            Productos_POS pp ON sp.ID_Prod_POS = pp.ID_Prod_POS
        WHERE 
            sp.ID_H_O_D = '".$row['ID_H_O_D']."' 
            AND sp.Fk_Sucursal = '".$row['Fk_Sucursal']."'";

$result = mysqli_query($conn, $sql);

$data = [];
$c = 0;

while($fila = $result->fetch_assoc()){
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    $data[$c]["Existencias_R"] = $fila["Existencias_R"];
    $data[$c]["Precio_Venta"] = $fila["Precio_Venta"];
    $data[$c]["Precio_Compra"] = $fila["Precio_C"];
    $data[$c]["Nom_Serv"] = $fila["Nom_Serv"];
    $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Contabilizado"] = $fila["Contabilizado"];       // New field
    $data[$c]["FechaDeInventario"] = $fila["FechaDeInventario"]; // New field

    $c++; 
}

$results = [
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data 
];

echo json_encode($results);
?>
