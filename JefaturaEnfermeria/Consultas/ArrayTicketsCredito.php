<?php
header('Content-Type: application/json');
include "db_connection.php";
include "Consultas.php";



function fechaCastellano($fecha) {
    $fecha = substr($fecha, 0, 10);
    $timestamp = strtotime($fecha);
    $numeroDia = date('d', $timestamp);
    $dia = date('l', $timestamp);
    $mes = date('F', $timestamp);
    $anio = date('Y', $timestamp);

    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);

    $meses_ES = array(
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    );
    $meses_EN = array(
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    );

    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio;
}

// Consulta SQL
$sql = "SELECT
Ventas_POS.Folio_Ticket,
Ventas_POS.Fk_Caja,
Ventas_POS.Venta_POS_ID,
Ventas_POS.Identificador_tipo,
Ventas_POS.Cod_Barra,
Ventas_POS.Clave_adicional,
Ventas_POS.Nombre_Prod,
Ventas_POS.Cantidad_Venta,
Ventas_POS.Fk_sucursal,
Ventas_POS.AgregadoPor,
Ventas_POS.AgregadoEl,
Ventas_POS.Total_Venta,
Ventas_POS.Lote,
Ventas_POS.ID_H_O_D,
SucursalesCorre.ID_SucursalC,
SucursalesCorre.Nombre_Sucursal
FROM
Ventas_POS
JOIN
SucursalesCorre ON Ventas_POS.Fk_sucursal = SucursalesCorre.ID_SucursalC
WHERE
Ventas_POS.Fk_sucursal = '".$row['Fk_Sucursal']."'
AND Ventas_POS.ID_H_O_D = '".$row['ID_H_O_D']."'
GROUP BY
Ventas_POS.Folio_Ticket
ORDER BY
Ventas_POS.AgregadoEl DESC; -- Ordena por fecha y hora más reciente dentro del mes";

// Preparar la consulta
$stmt = mysqli_prepare($conn, $sql);

// Verificar si la preparación fue exitosa
if ($stmt) {
    // Enlazar parámetros
    mysqli_stmt_bind_param($stmt, "iss", $fk_sucursal, $fila['AgregadoPor'], $id_h_o_d);

    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);

    // Obtener resultado
    $result = mysqli_stmt_get_result($stmt);

    $data = array();

    while ($fila = mysqli_fetch_assoc($result)) {
        $data[] = [
            "NumberTicket" => $fila["Folio_Ticket"],
            "Fecha" => fechaCastellano($fila["AgregadoEl"]),
            "Hora" => date("g:i:s a", strtotime($fila["AgregadoEl"])),
            "Vendedor" => $fila["AgregadoPor"],
            "Desglose" => '<td><a data-id="' . $fila["Folio_Ticket"] . '" class="btn btn-success btn-sm btn-desglose dropdown-item" style="background-color: #C80096 !important;"><i class="fas fa-receipt"></i> Desglosar ticket</a></td>',
            "Reimpresion" => '<td><a data-id="' . $fila["Folio_Ticket"] . '" class="btn btn-primary btn-sm btn-Reimpresion dropdown-item" style="background-color: #C80096 !important;"><i class="fas fa-print"></i> Reimpresión ticket</a></td>',
        ];
    }

    $results = [
        "sEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
        "aaData" => $data
    ];

    echo json_encode($results);
} else {
    // Manejar error de preparación
    echo json_encode(["error" => "Error de preparación de la consulta"]);
}

// Cerrar la conexión
mysqli_close($conn);
?>
