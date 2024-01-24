<?php
include_once 'db_connection.php';

$contador = count($_POST["pro_FKID"]);
$ProContador = 0;
$query = "INSERT INTO Ventas_POS (ID_Prod_POS, Identificador_tipo, Turno, FolioSucursal, Folio_Ticket, Clave_adicional, Cod_Barra, Nombre_Prod, Cantidad_Venta, Fk_sucursal, Total_Venta, Importe, Total_VentaG, DescuentoAplicado, FormaDePago, CantidadPago, Cambio, Cliente, Fecha_venta, Fk_Caja, Lote, Sistema, AgregadoPor, ID_H_O_D, FolioSignoVital, TicketAnterior) VALUES ";
$queryValues = array();

for ($i = 0; $i < $contador; $i++) {
    if (!empty($_POST["pro_FKID"][$i]) || !empty($_POST["IdentificadorTip"][$i]) || !empty($_POST["TicketVal"])) {
        $ProContador++;
        $values = array(
            mysqli_real_escape_string($conn, $_POST["pro_FKID"][$i]),
            mysqli_real_escape_string($conn, $_POST["IdentificadorTip"][$i]),
            // ... (escapa los demás campos)
        );

        $queryValues[] = "('" . implode("','", $values) . "')";
    }
}

if ($ProContador != 0) {
    $sql = $query . implode(",", $queryValues);
    $resultadocon = mysqli_query($conn, $sql);

    if ($resultadocon) {
        $resultado = "<br><ul class='list-group' style='margin-top:15px;'>
                      <li class='list-group-item'>Registro(s) Agregado Correctamente.</li></ul>";
    } else {
        $resultado = "<br>Error: " . mysqli_error($conn);
    }
}
?>
