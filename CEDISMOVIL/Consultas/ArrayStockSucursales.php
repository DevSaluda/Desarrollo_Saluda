
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "mcript.php";

$sql = "SELECT Stock_POS.Folio_Prod_Stock,Stock_POS.Clave_adicional,Stock_POS.ID_Prod_POS,
Stock_POS.Cod_Barra,Stock_POS.Nombre_Prod,Stock_POS.Tipo_Servicio,Stock_POS.Fk_sucursal,
Stock_POS.Max_Existencia,Stock_POS.Min_Existencia, Stock_POS.Existencias_R,Stock_POS.Proveedor1,
Stock_POS.Proveedor2,Stock_POS.CodigoEstatus,Stock_POS.Estatus,Stock_POS.ID_H_O_D, SucursalesCorre.ID_SucursalC,
SucursalesCorre.Nombre_Sucursal,Servicios_POS.Servicio_ID,Servicios_POS.Nom_Serv, Productos_POS.ID_Prod_POS,
Productos_POS.Precio_Venta,Productos_POS.Precio_C FROM Stock_POS,SucursalesCorre,Servicios_POS,Productos_POS WHERE 
Stock_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND Stock_POS.Tipo_Servicio= Servicios_POS.Servicio_ID AND Productos_POS.ID_Prod_POS =Stock_POS.ID_Prod_POS AND
 Stock_POS.ID_H_O_D ='".$row['ID_H_O_D']."' AND Stock_POS.Fk_Sucursal='".$row['Fk_Sucursal']."'";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
    $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
    $data[$c]["Precio_Venta"] = $fila["Precio_Venta"];
    $data[$c]["Nom_Serv"] = $fila["Nom_Serv"];
    $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Existencias_R"] = $fila["Existencias_R"];
    // $data[$c]["Min_Existencia"] = $fila["Min_Existencia"];
    // $data[$c]["Max_Existencia"] = $fila["Max_Existencia"];
   
    // $data[$c]["Acciones"] = ["<button class='btn btn-primary btn-sm dropdown-toggle' 
    // type='button' data-toggle='dropdown' aria-haspopup='true'
    //  aria-expanded='false'><i class='fas fa-th-list fa-1x'></i></button><div class='dropdown-menu'>
    //  <a href=https://controlfarmacia.com/CEDIS/ActualizaOne?idProd=".base64_encode($fila["Folio_Prod_Stock"])." class='btn-edit  dropdown-item' >
    //  Actualizar existencias <i class='fas fa-edit'></i></a><a href=https://controlfarmacia.com/CEDIS/CoincidenciaSucursales?Disid=".base64_encode($fila["ID_Prod_POS"])."
    //   class='btn-VerDistribucion  dropdown-item' >Actualizar existencias en coincidencia <i class='fas fa-equals'></i> </a>
    //   <a href=https://controlfarmacia.com/CEDIS/GeneradorTraspasos?idProd=".base64_encode($fila["Folio_Prod_Stock"])." class='btn-editProd dropdown-item' >Traspaso
    //    <i class='fas fa-exchange-alt'></i></a><a href=https://controlfarmacia.com/CEDIS/HistorialProducto?idProd=".base64_encode($fila["Folio_Prod_Stock"])." 
    //    class='btn-History dropdown-item' >Ver movimientos <i class='fas fa-history'></i></a><a href=https://controlfarmacia.com/CEDIS/EliminarProductoGeneral?idProd=".base64_encode($fila["ID_Prod_POS"])." 
    //    class='btn-Delete dropdown-item' >Estadisticas de venta <i class='fas fa-chart-line'></i></a></div> "];
    
    $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
