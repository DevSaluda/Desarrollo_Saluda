<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";


$sql = "SELECT 
p.ID_Prod_POS, p.Nombre_Prod, p.Cod_Barra, p.Cod_Enfermeria, p.Proveedor1, p.Proveedor2,
p.ID_H_O_D, p.Clave_adicional, p.Clave_Levic, p.FkMarca, p.FkCategoria, p.FkPresentacion, p.Tipo,
p.Precio_Venta, p.Precio_C, p.Stock, p.Saldo, p.AgregadoPor, p.Vendido, p.Tipo_Servicio,
s.Servicio_ID, s.Nom_Serv, p.AgregadoEl 
FROM 
Productos_POS p
INNER JOIN 
Servicios_POS s ON s.Servicio_ID = p.Tipo_Servicio
WHERE 
NOT EXISTS (SELECT 1 FROM Stock_POS WHERE Cod_Barra = p.Cod_Barra);
";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
    $data[$c]["IdbD"] = $fila["ID_Prod_POS"];
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    $data[$c]["Clave_interna"] = $fila["Clave_adicional"];
    $data[$c]["Clave_Levic"] = $fila["Clave_Levic"];
    $data[$c]["Cod_Enfermeria"] = $fila["Cod_Enfermeria"];
    $data[$c]["Precio_C"] = $fila["Precio_C"];
    $data[$c]["Precio_Venta"] = $fila["Precio_Venta"];
    $data[$c]["Nom_Serv"] = $fila["Nom_Serv"];
    $data[$c]["Marca"] = $fila["FkMarca"];
    $data[$c]["Tipo"] = $fila["Tipo"];
    $data[$c]["Categoria"] = $fila["FkCategoria"];
    $data[$c]["Presentacion"] = $fila["FkPresentacion"];
    $data[$c]["Proveedor1"] = $fila["Proveedor1"];
    $data[$c]["Proveedor2"] = $fila["Proveedor2"];
    $data[$c]["AgregadoPor"] = $fila["AgregadoPor"];
    $data[$c]["Stock"] = $fila["Stock"];
    $data[$c]["Vendido"] = $fila["Vendido"];
    $data[$c]["Saldo"] = $fila["Saldo"];
   
    $data[$c]["Acciones"] = ["<button class='btn btn-primary btn-sm dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-th-list fa-1x'></i></button><div class='dropdown-menu'>
    <a href=https://saludapos.com/AdminPOS/AsignacionSucursalesStock?idProd=".base64_encode($fila["ID_Prod_POS"])." class='btn-edit  dropdown-item' >Asignar en sucursales <i class='fas fa-clinic-medical'></i></a>
       <a href=https://saludapos.com/AdminPOS/DistribucionSucursales?Disid=".base64_encode($fila["ID_Prod_POS"])." class='btn-VerDistribucion  dropdown-item' >Consultar distribución <i class='fas fa-table'></i> </a> "];
    

    
    
    
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
