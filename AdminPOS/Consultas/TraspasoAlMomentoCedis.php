<?php
include_once 'db_connection.php';

// Obtener la fecha actual
$fechaActual = date('Y-m-d H:i:s');

// Verificar si "IdBasedatos" está definida en $_POST y no está vacía
if (isset($_POST["IdBasedatos"]) && !empty($_POST["IdBasedatos"])) {
    $contador = count($_POST["IdBasedatos"]);
    $ProContador = 0;

    $query = "INSERT INTO Traspasos_generados (
        Folio_Prod_Stock, 
        ID_Prod_POS, 
        Num_Orden, 
        Num_Factura, 
        Cod_Barra, 
        Nombre_Prod, 
        Fk_sucursal, 
        Fk_Sucursal_Destino, 
        Fk_SucDestino, 
        Precio_Venta, 
        Precio_Compra, 
        Total_traspaso, 
        TotalVenta, 
        Existencias_R, 
        Cantidad_Enviada, 
        Existencias_D_envio, 
        FechaEntrega, 
        TraspasoGeneradoPor, 
        TraspasoRecibidoPor, 
        Tipo_Servicio, 
        Proveedor1, 
        Proveedor2, 
        ProveedorFijo, 
        Estatus, 
        AgregadoPor, 
        ID_H_O_D, 
        TotaldePiezas
    ) VALUES ";

    $values = [];

    for ($i = 0; $i < $contador; $i++) {
        if (!empty($_POST["IdBasedatos"][$i]) && !empty($_POST["CodBarras"][$i]) && !empty($_POST["NombreDelProducto"][$i])) {
            $ProContador++;
            $values[] = "(
                '" . mysqli_real_escape_string($conn, $_POST["IdBasedatos"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["IdBasedatos"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["NumeroDelTraspaso"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["NumeroDeFacturaTraspaso"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["CodBarras"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["NombreDelProducto"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["Fk_sucursal"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["SucursalTraspasa"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["SucursalDestino"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["PrecioVenta"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["PrecioCompra"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["ImporteGenerado"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["resultadoventas"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["Existencia1"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["Contabilizado"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["Existencia2"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $fechaActual) . "',
                '" . mysqli_real_escape_string($conn, $_POST["GeneradoPor"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["Recibio"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["TipodeServicio"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["Proveedor1"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["Proveedor2"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["ProveedorDelTraspaso"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["Estatus"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["AgregoElVendedor"][$i]) . "',
                '" . mysqli_real_escape_string($conn, $_POST["ID_H_O_D"][$i]) . "',
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
} else {
    echo json_encode(['status' => 'error', 'message' => 'No se enviaron datos.']);
}

mysqli_close($conn);
?>
