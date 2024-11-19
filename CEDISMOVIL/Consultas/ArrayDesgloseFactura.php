<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";

// Verifica si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si las variables están seteadas y no son nulas
    if (isset($_POST['Factura'])) {
        // Obtén los valores del formulario
        $factura = $_POST['Factura'];

        // Consulta SQL para obtener los datos del traspaso
        $sql = "SELECT Traspasos_generados.ID_Traspaso_Generado, Traspasos_generados.Folio_Prod_Stock, Traspasos_generados.Fk_SucDestino, Traspasos_generados.Estatus,
                Traspasos_generados.Cod_Barra, Traspasos_generados.Nombre_Prod, Traspasos_generados.Fk_sucursal, Traspasos_generados.Fk_Sucursal_Destino,
                Traspasos_generados.Precio_Venta, Traspasos_generados.Precio_Compra, Traspasos_generados.Total_traspaso, Traspasos_generados.TotalVenta,
                Traspasos_generados.Existencias_R, Traspasos_generados.Cantidad_Enviada, Traspasos_generados.Existencias_D_envio, Traspasos_generados.FechaEntrega,
                Traspasos_generados.Estatus, Traspasos_generados.ID_H_O_D, SucursalesCorre.ID_SucursalC, SucursalesCorre.Nombre_Sucursal
                FROM Traspasos_generados
                JOIN SucursalesCorre ON Traspasos_generados.Fk_sucursal = SucursalesCorre.ID_SucursalC
                WHERE Traspasos_generados.Num_Factura='$factura'";

        $result = mysqli_query($conn, $sql);

        $data = []; // Inicializar $data como un array vacío

        // Inicializar información adicional
        $provider = "CEDIS"; // Proveedor (ejemplo estático, ajusta según sea necesario)
        $destinationBranch = "";
        $invoiceNumber = $factura;
        $transferDate = "";

        // Verifica si la consulta ha devuelto resultados
        if ($result->num_rows > 0) {
            $c = 0;
            while ($fila = $result->fetch_assoc()) {
                // $data[$c]["IDTraspasoGenerado"] = $fila["ID_Traspaso_Generado"];
                $data[$c]["Cod_Barra"] = $fila["Cod_Barra"];
                $data[$c]["Nombre_Prod"] = $fila["Nombre_Prod"];
                $data[$c]["Cantidad_Prod"] = $fila["Cantidad_Enviada"];
                $data[$c]["FechaEntrega"] = "";

                // Asignar valores adicionales (solo en el primer registro)
                if ($c === 0) {
                    $destinationBranch = $fila["Fk_Sucursal_Destino"];
                    $transferDate = $fila["FechaEntrega"];
                }
                $c++;
            }
        }

        // Construir la respuesta JSON
        $results = [
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data,
            "additionalInfo" => [
                "provider" => $provider,
                "destinationBranch" => $destinationBranch,
                "invoiceNumber" => $invoiceNumber,
                "transferDate" => $transferDate
            ]
        ];

        echo json_encode($results);
    } else {
        // Si alguna de las variables no está seteada o es nula, muestra un mensaje de error
        echo json_encode(["error" => "No se recibieron todas las variables necesarias."]);
    }
}
?>
