<?php
include_once 'db_connection.php';

$contador = isset($_POST["pro_FKID"]) ? count($_POST["pro_FKID"]) : 0;
$ProContador = 0;

$query = "INSERT INTO Ventas_POS_Pruebas (ID_Prod_POS, Identificador_tipo, Turno, FolioSucursal, Folio_Ticket, Clave_adicional, Cod_Barra, Nombre_Prod, Cantidad_Venta,
        Fk_sucursal, Total_Venta, Importe, Total_VentaG, DescuentoAplicado, FormaDePago, CantidadPago, Cambio, Cliente, Fecha_venta, Fk_Caja, Lote, Estatus,Sistema, AgregadoPor, ID_H_O_D, FolioSignoVital, TicketAnterior) VALUES ";
$queryValues = array();

for ($i = 0; $i < $contador; $i++) {
    if (
        !empty($_POST["pro_FKID"][$i]) &&
        !empty($_POST["IdentificadorTip"][$i]) &&
        !empty($_POST["TicketVal"])
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
            mysqli_real_escape_string($conn, $_POST["EstadoVenta"][$i]),
            mysqli_real_escape_string($conn, $_POST["Sistema"][$i]),
            mysqli_real_escape_string($conn, $_POST["Vendedor"][$i]),
            mysqli_real_escape_string($conn, $_POST["Empresa"][$i]),
            mysqli_real_escape_string($conn, $_POST["foliosv"][$i]),
            mysqli_real_escape_string($conn, $_POST["ticketant"][$i])
        );

        $queryValues[] = "('" . implode("','", $values) . "')";
    }
}

$sql = $query . implode(",", $queryValues);

if ($ProContador > 0) {
    $resultadocon = mysqli_query($conn, $sql);

    if ($resultadocon) {
        $resultado = " <br><ul class='list-group' style='margin-top:15px;'>
           <li class='list-group-item'>Registro(s) Agregado Correctamente.</li></ul>";
    } else {
        $resultado = "Error al ejecutar la consulta: " . mysqli_error($conn);
    }
} else {
    $resultado = "No hay datos válidos para procesar.";
}

echo $resultado;
?>
