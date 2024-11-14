<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

// Verifica si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si las variables están seteadas y no son nulas
    if (isset($_POST['Sucursal']) && isset($_POST['FechaInventario'])) {
        // Obtén los valores del formulario
        $sucursal = $_POST['Sucursal'];
        $fechaInventario = $_POST['FechaInventario'];
        
        // Consulta SQL con parámetros preparados
        $sql = "SELECT 
        ic.Folio_Prod_Stock,
            ic.Cod_Barra, 
            ic.Nombre_Prod, 
            sc.Nombre_Sucursal AS Nombre_Sucursal,
            ic.Precio_Venta,
            ic.Precio_C,
            ic.Precio_Venta * ic.Contabilizado AS Total_Precio_Venta, 
            ic.Precio_C * ic.Contabilizado AS Total_Precio_Compra, 
            ic.Contabilizado, 
            ic.StockEnMomento, 
            ic.Diferencia, 
            ic.Sistema, 
            ic.AgregadoPor, 
            ic.AgregadoEl, 
            ic.ID_H_O_D, 
            ic.FechaInventario
        FROM 
            InventariosStocks_Conteos AS ic
        JOIN 
            SucursalesCorre AS sc ON ic.Fk_sucursal = sc.ID_SucursalC
        WHERE 
            ic.Fk_sucursal = ? AND ic.FechaInventario = ?";
        
        // Prepara la consulta
        $stmt = $conn->prepare($sql);
        // Asigna los valores y ejecuta la consulta
        $stmt->bind_param("ss", $sucursal, $fechaInventario);
        $stmt->execute();
        // Obtiene los resultados
        $result = $stmt->get_result();
        
        // Procesa los resultados
        $data = [];
        $c = 0;
        while ($fila = $result->fetch_assoc()) {
         $data[$c]["Idbddd"] = $fila["Folio_Prod_Stock"];
            $data[$c]["IdbD"] = $fila["Cod_Barra"];
            $data[$c]["Cod_Barra"] = $fila["Nombre_Prod"];
            $data[$c]["NombreSucursal"] = $fila["Nombre_Sucursal"];
            $data[$c]["PrecioVenta"] = $fila["Precio_Venta"];
            $data[$c]["PrecioCompra"] = $fila["Precio_C"];
         
            $data[$c]["Nombre_Prod"] = $fila["Contabilizado"];
         
            $data[$c]["Cod_Enfermeria"] = $fila["AgregadoPor"];
            $data[$c]["FechaInventario"] = $fila["FechaInventario"];
            $c++;
        }
        
        // Formatea los resultados
        $results = [
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data 
        ];
        
        // Imprime los resultados como JSON
        echo json_encode($results);
    } else {
        // Si alguna de las variables no está seteada o es nula, muestra un mensaje de error
        echo json_encode(["error" => "No se recibieron todas las variables necesarias."]);
    }
}
?>
