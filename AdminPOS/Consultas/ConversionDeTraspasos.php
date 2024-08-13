<?php
include_once 'db_connection.php';

// Obtener la fecha actual
$fechaActual = date('Y-m-d H:i:s');

// Verificar si "IdBasedatos" está definida en $_POST y no está vacía
if (isset($_POST["IdBasedatos"]) && !empty($_POST["IdBasedatos"])) {
    // Obtener y limpiar datos del formulario
    $Folio_Prod_Stock = mysqli_real_escape_string($conn, $_POST["IdBasedatos"]);
    $ID_Prod_POS = mysqli_real_escape_string($conn, $_POST["IdBasedatos"]);
    $Num_Orden = mysqli_real_escape_string($conn, $_POST["NumeroDeFacturaTraspaso"]);
    $Num_Factura = mysqli_real_escape_string($conn, $_POST["NumeroDeFacturaTraspaso"]);
    $Cod_Barra = mysqli_real_escape_string($conn, $_POST["CodBarra"]);
    $Nombre_Prod = mysqli_real_escape_string($conn, $_POST["NombreProd"]);
    $Fk_sucursal = mysqli_real_escape_string($conn, $_POST["Fk_sucursal"]);
    $Fk_Sucursal_Destino = mysqli_real_escape_string($conn, $_POST["selectedSucursal"]);
    $Fk_SucDestino = mysqli_real_escape_string($conn, $_POST["SucursalConOrdenDestino"]);
    $Precio_Venta = mysqli_real_escape_string($conn, $_POST["PrecioVenta"]);
    $Precio_Compra = mysqli_real_escape_string($conn, $_POST["PrecioCompra"]);
    $Total_traspaso = isset($_POST["ImporteGenerado"]) ? mysqli_real_escape_string($conn, $_POST["ImporteGenerado"]) : 0;
    $TotalVenta = isset($_POST["resultadoventas"]) ? mysqli_real_escape_string($conn, $_POST["resultadoventas"]) : 0;
    $Cantidad_Enviada = mysqli_real_escape_string($conn, $_POST["Cantidad"]);
    $FechaEntrega = $fechaActual;
    $TraspasoGeneradoPor = mysqli_real_escape_string($conn, $_POST["GeneradoPor"]);
    $Tipo_Servicio = mysqli_real_escape_string($conn, $_POST["TipodeServicio"]);
    $ProveedorFijo = isset($_POST["ProveedorDelTraspaso"]) ? mysqli_real_escape_string($conn, $_POST["ProveedorDelTraspaso"]) : '';
    $Estatus = isset($_POST["Estatus"]) ? mysqli_real_escape_string($conn, $_POST["Estatus"]) : '';
    $AgregadoPor = mysqli_real_escape_string($conn, $_POST["GeneradoPor"]);
    $ID_H_O_D = mysqli_real_escape_string($conn, $_POST["ID_H_O_D"]);
    $TotaldePiezas = mysqli_real_escape_string($conn, $_POST["Cantidad"]);
    $Movimiento = mysqli_real_escape_string($conn, $_POST["Movimiento"]);
    $$Id_Devolucion = mysqli_real_escape_string($conn, $_POST["IdBasedatos"]);
    // Construir la consulta SQL
    $sql = "INSERT INTO Traspasos_generados (
        Folio_Prod_Stock, ID_Prod_POS, Num_Orden, Num_Factura, Cod_Barra, Nombre_Prod, 
        Fk_sucursal, Fk_Sucursal_Destino, Fk_SucDestino, Precio_Venta, Precio_Compra, 
        Total_traspaso, TotalVenta, Cantidad_Enviada, FechaEntrega, TraspasoGeneradoPor, 
        Tipo_Servicio, ProveedorFijo, Estatus, AgregadoPor, ID_H_O_D, TotaldePiezas,TipoMovimiento,Id_Devolucion
    ) VALUES (
        '$Folio_Prod_Stock', '$ID_Prod_POS', '$Num_Orden', '$Num_Factura', '$Cod_Barra', '$Nombre_Prod', 
        '$Fk_sucursal', '$Fk_Sucursal_Destino', '$Fk_SucDestino', '$Precio_Venta', '$Precio_Compra', 
        '$Total_traspaso', '$TotalVenta', '$Cantidad_Enviada', '$FechaEntrega', '$TraspasoGeneradoPor', 
        '$Tipo_Servicio', '$ProveedorFijo', '$Estatus', '$AgregadoPor', '$ID_H_O_D', '$TotaldePiezas','$Movimiento','$Id_Devolucion'
    )";

    // Ejecutar la consulta
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Registro agregado correctamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No se enviaron datos.']);
}

mysqli_close($conn);
?>
