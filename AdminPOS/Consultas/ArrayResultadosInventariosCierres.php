<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Sucursal']) && isset($_POST['FechaInventario'])) {
        $sucursal = $_POST['Sucursal'];
        $fechaInventario = $_POST['FechaInventario'];
        $Destino = $_POST['destino'];
        $sql = "SELECT 
            ic.Folio_Prod_Stock,
            ic.Cod_Barra, 
            ic.Nombre_Prod, 
            sc.Nombre_Sucursal AS Nombre_Sucursal,
            ic.Precio_Venta,
            ic.Precio_C,
            ic.Contabilizado, 
            ic.AgregadoPor, 
            ic.FechaInventario
        FROM 
            InventariosStocks_Conteos AS ic
        JOIN 
            SucursalesCorre AS sc ON ic.Fk_sucursal = sc.ID_SucursalC
        WHERE 
            ic.Fk_sucursal = ? AND ic.FechaInventario = ?
        LIMIT 50";  // Limita la consulta a 50 resultados
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $sucursal, $fechaInventario);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $data = [];
        $c = 0;
        while ($fila = $result->fetch_assoc()) {
            
            $data[$c]["IdbD"] = '<input type="text" class="form-control form-control-sm" name="Cod_Barra[]" value="' . $fila["Cod_Barra"] . '" readonly>';
            $data[$c]["Cod_Barra"] = '<input type="text" class="form-control form-control-sm" name="Nombre_Prod[]" value="' . $fila["Nombre_Prod"] . '" readonly>';
            $data[$c]["NombreSucursal"] = '<input type="text" class="form-control form-control-sm" name="Nombre_Sucursal[]" value="' . $fila["Nombre_Sucursal"] . '" readonly>';
            $data[$c]["Destino"] = '<input type="text" class="form-control form-control-sm" name="Nombre_Sucursal[]" value="' . $Destino . '" readonly>';
          
            $data[$c]["Nombre_Prod"] = '<input type="text" class="form-control form-control-sm" name="Contabilizado[]" value="' . $fila["Contabilizado"] . '" readonly>';
            $data[$c]["Cod_Enfermeria"] = '<input type="text" class="form-control form-control-sm" name="AgregadoPor[]" value="' . $fila["AgregadoPor"] . '" readonly>';
            $data[$c]["FechaInventario"] = '<input type="text" class="form-control form-control-sm" name="FechaInventario[]" value="' . $fila["FechaInventario"] . '" readonly>
             <input type="text" hidden class="form-control" name="Folio_Prod_Stock[]" value="' . $fila["Folio_Prod_Stock"] . '"  readonly>
                <input type="text" hidden class="form-control" name="Precio_Venta[]" value="' . $fila["Precio_Venta"] . '"  readonly>
                <input type="text" hidden class="form-control"  name="Precio_C[]" value="' . $fila["Precio_C"] . '" readonly>';

            
            $c++;
        }
        
        $results = [
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data 
        ];
        
        echo json_encode($results);
    } else {
        echo json_encode(["error" => "No se recibieron todas las variables necesarias."]);
    }
}
?>
