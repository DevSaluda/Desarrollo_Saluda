<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

// Verifica si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si las variables están seteadas y no son nulas
    if (isset($_POST['Mes']) && isset($_POST['anual'])) {
        // Obtén los valores del formulario
        $mes = $_POST['Mes'];
        $anual = $_POST['anual'];
        
        // Consulta SQL con parámetros preparados
        $sql = "SELECT 
            Traspasos_generados.ID_Traspaso_Generado,
            Traspasos_generados.Folio_Prod_Stock,
            Traspasos_generados.TraspasoRecibidoPor,
            Traspasos_generados.TraspasoGeneradoPor,
            Traspasos_generados.Num_Orden,
            Traspasos_generados.Num_Factura,
            Traspasos_generados.TotaldePiezas,
            Traspasos_generados.Cod_Barra,
            Traspasos_generados.Nombre_Prod,
            Traspasos_generados.Fk_sucursal,
            Traspasos_generados.Fk_Sucursal_Destino,
            Traspasos_generados.Proveedor1,
            Traspasos_generados.Proveedor2,
            Traspasos_generados.Precio_Venta,
            Traspasos_generados.Precio_Compra,
            Traspasos_generados.Total_traspaso,
            Traspasos_generados.TotalVenta,
            Traspasos_generados.Existencias_R,
            Traspasos_generados.ProveedorFijo,
            Traspasos_generados.Cantidad_Enviada,
            Traspasos_generados.Existencias_D_envio,
            Traspasos_generados.FechaEntrega,
            Traspasos_generados.Estatus,
            Traspasos_generados.ID_H_O_D,
            SucursalesCorre.ID_SucursalC,
            SucursalesCorre.Nombre_Sucursal 
        FROM 
            Traspasos_generados,
            SucursalesCorre 
        WHERE 
            Traspasos_generados.Fk_sucursal = SucursalesCorre.ID_SucursalC 
            AND Traspasos_generados.FechaEntrega BETWEEN ? AND ?";
        
        // Prepara la consulta
        $stmt = $conn->prepare($sql);
        // Asigna los valores y ejecuta la consulta
        $stmt->bind_param("ss", $mes, $anual);
        $stmt->execute();
        // Obtiene los resultados
        $result = $stmt->get_result();
        
        // Procesa los resultados
        $data = [];
        $c = 0;
        while ($fila = $result->fetch_assoc()) {
            $data[$c]["IDTraspasoGenerado"] = $fila["ID_Traspaso_Generado"];
            $data[$c]["NumberOrden"] = $fila["Num_Orden"];
            if (empty($fila["Num_Factura"])) {
                $sucursalDestino = substr($fila["Fk_Sucursal_Destino"], 0, 4);
                $data[$c]["NumberFactura"] = $sucursalDestino  . $fila["Num_Orden"];
            } else {
                $data[$c]["NumberFactura"] = $fila["Num_Factura"];
            }
            $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
            $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
            $data[$c]["ProveedorFijo"] = $fila["ProveedorFijo"];
            $data[$c]["Fk_sucursal"] = $fila["Nombre_Sucursal"];
            $data[$c]["Destino"] = $fila["Fk_Sucursal_Destino"];
            $data[$c]["Cantidad"] = $fila["Cantidad_Enviada"];
            $data[$c]["PrecioCompra"] = $fila["Precio_Venta"];
            $data[$c]["PrecioVenta"] = $fila["Precio_Compra"];
            $data[$c]["TotaldePiezas"] = $fila["TotaldePiezas"];
            $data[$c]["FechaEntrega"] = $fila["FechaEntrega"];
            $data[$c]["Estatus"] = $fila["Estatus"];
            $data[$c]["Envio"] = $fila["TraspasoGeneradoPor"];
            $data[$c]["Recibio"] = $fila["TraspasoRecibidoPor"];
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
