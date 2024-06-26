// Consultas/TraspasoAlMomentoCedis.php

<?php
include_once 'db_connection.php';

$contador = count($_POST["Idprod"]);
$ProContador = 0;

$query = "INSERT INTO Traspasos_generados (Folio_Prod_Stock, ID_Prod_POS, Num_Orden, Num_Factura, Cod_Barra, Nombre_Prod, Fk_sucursal, Fk_Sucursal_Destino, Fk_SucDestino, Precio_Venta, Precio_Compra, Total_traspaso, TotalVenta, Existencias_R, Cantidad_Enviada, Existencias_D_envio, FechaEntrega, TraspasoGeneradoPor, TraspasoRecibidoPor, Tipo_Servicio, Proveedor1, Proveedor2, ProveedorFijo, Estatus, AgregadoPor, ID_H_O_D, TotaldePiezas) VALUES ";

$values = [];

for ($i = 0; $i < $contador; $i++) {
    if (!empty($_POST["Idprod"][$i]) && !empty($_POST["CodBarra"][$i]) && !empty($_POST["NombreProducto"][$i])) {
        $ProContador++;
        $values[] = "(
            '" . mysqli_real_escape_string($conn, $_POST["Idprod"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["Idprod"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["NumeroDelTraspaso"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["NumeroDeFacturaTraspaso"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["CodBarra"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["NombreProducto"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["SucursalTraspasa"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["SucursalDestinoLetras"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["SucursalDestino"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["PrecioVenta"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["PrecioDeCompra"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["resultadocompras"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["resultadoventas"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["Existencia1"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["NTraspasos"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["Existencia2"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["FechaAprox"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["GeneradoPor"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["Recibio"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["TipodeServicio"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["Proveedor1"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["Proveedor2"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["ProveedorDelTraspaso"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["Estatus"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["GeneradoPor"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["Empresa"][$i]) . "',
            '" . mysqli_real_escape_string($conn, $_POST["resultadepiezas"][$i]) . "'
        )";
    }
}

if ($ProContador > 0) {
    $sql = $query . implode(',', $values);
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Registro(s) Agregado Correctamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No se encontraron datos válidos para insertar.']);
}

mysqli_close($conn);
?>
