<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Sucursal']) && isset($_POST['FechaInventario'])) {
        $sucursal = $_POST['Sucursal'];
        $fechaInventario = $_POST['FechaInventario'];
        $Destino = $_POST['destino'];
        $DestinoLetras = $_POST['nombreSucursadestinoletras'];
        
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
        LEFT JOIN 
            InventariosStocks_Conteos AS isc ON ic.Folio_Prod_Stock = isc.Folio_Prod_Stock
        WHERE 
            ic.Fk_sucursal = ? 
            AND ic.FechaInventario = ? 
            AND (isc.Comentario != 'Ingreso Por cierre de inventario de la sucursal Tekax' OR isc.Comentario IS NULL)
        LIMIT 50";  // Limita la consulta a 50 resultados
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $sucursal, $fechaInventario);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $data = [];
        $c = 0;
        while ($fila = $result->fetch_assoc()) {
            
            $data[$c]["IdbD"] = '<input type="text" class="form-control form-control-sm" name="CodBarra[]" value="' . $fila["Cod_Barra"] . '" readonly>';
            $data[$c]["Cod_Barra"] = '<input type="text" class="form-control form-control-sm" name="NombreProd[]" value="' . $fila["Nombre_Prod"] . '" readonly>';
            $data[$c]["NombreSucursal"] = '<input type="text" class="form-control form-control-sm" name="Nombre_Sucursal[]" value="' . $fila["Nombre_Sucursal"] . '" readonly>';
            $data[$c]["Destino"] = '<input type="text" class="form-control form-control-sm" name="Nombre_Sucursal[]" value="' .$DestinoLetras . '" readonly>';
          
            $data[$c]["Nombre_Prod"] = '<input type="text" class="form-control form-control-sm" name="Cantidadd[]" value="' . $fila["Contabilizado"] . '" readonly>';
            $data[$c]["Cod_Enfermeria"] = '<input type="text" class="form-control form-control-sm" name="AgregadoPor[]" value="' . $fila["AgregadoPor"] . '" readonly>';
            $data[$c]["FechaInventario"] = '<input type="text" class="form-control form-control-sm" name="FechaInventario[]" value="' . $fila["FechaInventario"] . '" readonly>
             <input type="text" hidden class="form-control" name="Folio_Prod_Stock[]" value="' . $fila["Folio_Prod_Stock"] . '"  readonly>
                <input type="text" hidden class="form-control" name="PrecioVenta[]" value="' . $fila["Precio_Venta"] . '"  readonly>
                 <input type="text" hidden class="form-control" name="SucursalDestino[]"  value="' .$Destino . '"  readonly>
                 <input type="text" hidden class="form-control" name="Sucursal[]"  value="' .$sucursal . '"  readonly>
                 <input type="text" hidden class="form-control" name="ID_H_O_D[]"  value="Saluda"  readonly>
                 <input type="text" hidden class="form-control" name="TipoMov[]"  value="Ingreso Por cierre de inventario de la sucursal ' . $fila["Nombre_Sucursal"] . ' "  readonly>
                <input type="text" hidden class="form-control"  name="PrecioCompra[]" value="' . $fila["Precio_C"] . '" readonly>';
            
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
