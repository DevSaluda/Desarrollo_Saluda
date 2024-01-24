<?php
include_once 'db_connection.php';

// Verificar si la clave del array está definida en $_POST y es un array
if (isset($_POST["pro_FKID"]) && is_array($_POST["pro_FKID"])) {

    $contador = count($_POST["pro_FKID"]);
    $ProContador = 0;

    $query = "INSERT INTO Ventas_POS (ID_Prod_POS, Identificador_tipo, Turno, FolioSucursal, Folio_Ticket, Clave_adicional, Cod_Barra, Nombre_Prod, Cantidad_Venta,
        Fk_sucursal, Total_Venta, Importe, Total_VentaG, DescuentoAplicado, FormaDePago, CantidadPago, Cambio, Cliente, Fecha_venta, Fk_Caja, Lote, Sistema, AgregadoPor, ID_H_O_D, FolioSignoVital, TicketAnterior) VALUES ";

    $queryValues = array();

    for ($i = 0; $i < $contador; $i++) {
        if (
            isset($_POST["pro_FKID"][$i]) &&
            isset($_POST["IdentificadorTip"][$i]) &&
            isset($_POST["TurnoCaja"][$i]) &&
            isset($_POST["TicketSucursalName"]) &&
            isset($_POST["TicketVal"]) &&
            isset($_POST["pro_clavad"][$i]) &&
            isset($_POST["CodBarras"][$i]) &&
            isset($_POST["NombreProd"][$i]) &&
            isset($_POST["CantidadTotal"][$i]) &&
            isset($_POST["Sucursaleventas"][$i]) &&
            isset($_POST["pro_cantidad"][$i]) &&
            isset($_POST["ImporteT"][$i]) &&
            isset($_POST["TotalVentas"][$i]) &&
            isset($_POST["DescuentoAplicado"][$i]) &&
            isset($_POST["FormaPago"][$i]) &&
            isset($_POST["PagoReal"][$i]) &&
            isset($_POST["Cambio"][$i]) &&
            isset($_POST["cliente"][$i]) &&
            isset($_POST["Fecha"][$i]) &&
            isset($_POST["CajaSucursal"][$i]) &&
            isset($_POST["pro_lote"][$i]) &&
            isset($_POST["Sistema"][$i]) &&
            isset($_POST["Vendedor"][$i]) &&
            isset($_POST["Empresa"][$i]) &&
            isset($_POST["foliosv"][$i]) &&
            isset($_POST["ticketant"][$i])
        ) {
            $ProContador++;

            // Escapar y agregar los valores al array $queryValues
            $values = array(
                mysqli_real_escape_string($conn, $_POST["pro_FKID"][$i]),
                mysqli_real_escape_string($conn, $_POST["IdentificadorTip"][$i]),
                mysqli_real_escape_string($conn, $_POST["TurnoCaja"][$i]),
                mysqli_real_escape_string($conn, $_POST["TicketSucursalName"]),
                mysqli_real_escape_string($conn, $_POST["TicketVal"]),
                mysqli_real_escape_string($conn, $_POST["pro_clavad"][$i]),
                mysqli_real_escape_string($conn, $_POST["CodBarras"][$i]),
                mysqli_real_escape_string($conn, $_POST["NombreProd"][$i]),
                mysqli_real_escape_string($conn, $_POST["CantidadTotal"][$i]),
                mysqli_real_escape_string($conn, $_POST["Sucursaleventas"][$i]),
                mysqli_real_escape_string($conn, $_POST["pro_cantidad"][$i]),
                mysqli_real_escape_string($conn, $_POST["ImporteT"][$i]),
                mysqli_real_escape_string($conn, $_POST["TotalVentas"][$i]),
                mysqli_real_escape_string($conn, $_POST["DescuentoAplicado"][$i]),
                mysqli_real_escape_string($conn, $_POST["FormaPago"][$i]),
                mysqli_real_escape_string($conn, $_POST["PagoReal"][$i]),
                mysqli_real_escape_string($conn, $_POST["Cambio"][$i]),
                mysqli_real_escape_string($conn, $_POST["cliente"][$i]),
                mysqli_real_escape_string($conn, $_POST["Fecha"][$i]),
                mysqli_real_escape_string($conn, $_POST["CajaSucursal"][$i]),
                mysqli_real_escape_string($conn, $_POST["pro_lote"][$i]),
                mysqli_real_escape_string($conn, $_POST["Sistema"][$i]),
                mysqli_real_escape_string($conn, $_POST["Vendedor"][$i]),
                mysqli_real_escape_string($conn, $_POST["Empresa"][$i]),
                mysqli_real_escape_string($conn, $_POST["foliosv"][$i]),
                mysqli_real_escape_string($conn, $_POST["ticketant"][$i])
            );

            $queryValues[] = "('" . implode("','", $values) . "')";
        }
    }

    // Combinar la consulta y los valores
    $sql = $query . implode(",", $queryValues);

    if ($ProContador != 0) {
        // Ejecutar la consulta
        $resultadocon = mysqli_query($conn, $sql);

        if ($resultadocon) {
            $resultado = " <br><ul class='list-group' style='margin-top:15px;'>
               <li class='list-group-item'>Registro(s) Agregado Correctamente.</li></ul>";
        } else {
            // Manejar errores de la consulta
            $resultado = "Error al ejecutar la consulta: " . mysqli_error($conn);
        }
    } else {
        // Mensaje si no hay datos para procesar
        $resultado = "No hay datos para procesar.";
    }
} else {
    // La clave del array no está definida en $_POST o no es un array
    // Manejar el error o mostrar un mensaje adecuado
    echo "Error: La clave del array 'pro_FKID' no está definida en \$_POST o no es un array.";
}
?>
