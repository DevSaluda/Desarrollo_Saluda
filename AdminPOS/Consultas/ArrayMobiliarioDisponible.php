
<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "mcript.php";

$sql = "SELECT Inventario_Mobiliario.Id_inventario,Inventario_Mobiliario.Codigo,Inventario_Mobiliario.Articulo,Inventario_Mobiliario.Descripcion,
Inventario_Mobiliario.Marca,Inventario_Mobiliario.Departamento,Inventario_Mobiliario.Responsables,Inventario_Mobiliario.Categoria,
Inventario_Mobiliario.Sucursal,Inventario_Mobiliario.Valor,Inventario_Mobiliario.Antiguedad,Inventario_Mobiliario.Factura,Inventario_Mobiliario.NSerie,Inventario_Mobiliario.Vigencia,Inventario_Mobiliario.Estado,Inventario_Mobiliario.AgregadoEl,
Inventario_Mobiliario.AgregadoPor,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Inventario_Mobiliario,SucursalesCorre 
WHERE SucursalesCorre.ID_SucursalC = Inventario_Mobiliario.Sucursal AND Inventario_Mobiliario.Sucursal ='".$row['Fk_Sucursal']."'";
 
$result = mysqli_query($conn, $sql);
 
$c=0;
 
while($fila=$result->fetch_assoc()){
 
    $data[$c]["Id_inventario"] = $fila["Id_inventario"];
    $data[$c]["Codigo"] = $fila["Codigo"];
    $data[$c]["Articulo"] = $fila["Articulo"];
    $data[$c]["Descripcion"] = $fila["Descripcion"];
    $data[$c]["Marca"] = $fila["Marca"];
    $data[$c]["Departamento"] = $fila["Departamento"];
    $data[$c]["Responsables"] = $fila["Responsables"];
    $data[$c]["Categoria"] = $fila["Categoria"];
    $data[$c]["Sucursal"] = $fila["Nombre_Sucursal"];
    $data[$c]["Valor"] = $fila["Valor"];
    $data[$c]["Antiguedad"] = $fila["Antiguedad"];
    
    $data[$c]["Factura"] = $fila["Factura"];
    $data[$c]["NSerie"] = $fila["NSerie"];
    $data[$c]["Vigencia"] = $fila["Vigencia"];
    $data[$c]["Estado"] = $fila["Estado"];
    $data[$c]["AgregadoEl"] = $fila["AgregadoEl"];
    $data[$c]["AgregadoPor"] = $fila["AgregadoPor"];
    $data[$c]["Acciones"] = ["<button class='btn btn-primary btn-sm dropdown-toggle' 
    type='button' data-toggle='dropdown' aria-haspopup='true'
     aria-expanded='false'><i class='fas fa-th-list fa-1x'></i></button><div class='dropdown-menu'>
     <a href=https://controlfarmacia.com/AdminPOS/ActualizaOne?idProd=".base64_encode($fila["Folio_Prod_Stock"])." class='btn-edit  dropdown-item' >
     Actualizar existencias <i class='fas fa-edit'></i></a><a href=https://controlfarmacia.com/AdminPOS/CoincidenciaSucursales?Disid=".base64_encode($fila["ID_Prod_POS"])."
      class='btn-VerDistribucion  dropdown-item' >Actualizar existencias en coincidencia <i class='fas fa-equals'></i> </a>
      <a href=https://controlfarmacia.com/AdminPOS/GeneradorTraspasos?idProd=".base64_encode($fila["Folio_Prod_Stock"])." class='btn-editProd dropdown-item' >Traspaso
       <i class='fas fa-exchange-alt'></i></a><a href=https://controlfarmacia.com/AdminPOS/EstadisticaVentas?idProd=".base64_encode($fila["Cod_Barra"])." 
       class='btn-Delete dropdown-item' >Estadisticas de venta <i class='fas fa-chart-line'></i></a></div> "];
    
         $c++; 
 
}
 
$results = ["sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data ];
 
echo json_encode($results);
?>
