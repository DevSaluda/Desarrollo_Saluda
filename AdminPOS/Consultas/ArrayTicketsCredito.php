<?php
header('Content-Type: application/json');
include("db_connection.php");
include "Consultas.php";
session_start();

// Verificar si existe la sesión
if (!isset($_SESSION['ID_H_O_D']) || !isset($_SESSION['Fk_Sucursal']) || !isset($_SESSION['Nombre_Apellidos'])) {
    die(json_encode([
        "error" => true,
        "message" => "No se ha iniciado sesión correctamente",
        "code" => 401
    ]));
}

// Función para formatear fecha en español
function fechaCastellano($fecha) {
    if (empty($fecha)) return '';
    
    $fecha = substr($fecha, 0, 10);
    $timestamp = strtotime($fecha);
    if ($timestamp === false) return $fecha;
    
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

try {
    // Consulta SQL optimizada
    $sql = "SELECT
        v.Folio_Ticket,
        v.AgregadoPor,
        v.AgregadoEl,
        v.Total_Venta,
        s.Nombre_Sucursal
    FROM Ventas_POS v
    JOIN SucursalesCorre s ON v.Fk_sucursal = s.ID_SucursalC
    WHERE v.Fk_sucursal = ? 
    AND v.ID_H_O_D = ?
    AND v.FormaDePago = 'Crédito Enfermería'
    GROUP BY v.Folio_Ticket
    ORDER BY v.AgregadoEl DESC";

    // Preparar la consulta
    $stmt = mysqli_prepare($conn, $sql);
    
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . mysqli_error($conn));
    }

    // Enlazar parámetros
    if (!mysqli_stmt_bind_param($stmt, "ii", $_SESSION['Fk_Sucursal'], $_SESSION['ID_H_O_D'])) {
        throw new Exception("Error al enlazar parámetros");
    }

    // Ejecutar la consulta
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Error al ejecutar la consulta");
    }

    // Obtener resultado
    $result = mysqli_stmt_get_result($stmt);
    
    if (!$result) {
        throw new Exception("Error al obtener resultados");
    }

    $data = array();
    $totalVentas = 0;

    while ($fila = mysqli_fetch_assoc($result)) {
        $totalVentas += floatval($fila['Total_Venta']);
        $data[] = [
            "NumberTicket" => $fila["Folio_Ticket"],
            "Fecha" => fechaCastellano($fila["AgregadoEl"]),
            "Hora" => date("g:i:s a", strtotime($fila["AgregadoEl"])),
            "Vendedor" => $fila["AgregadoPor"],
            "Total" => number_format($fila["Total_Venta"], 2),
            "Sucursal" => $fila["Nombre_Sucursal"],
            "Desglose" => '<td><a data-id="' . $fila["Folio_Ticket"] . '" class="btn btn-success btn-xs btn-desglose dropdown-item" style="background-color: #C80096 !important; padding: 2px 5px; font-size: 12px;" ><i class="fas fa-receipt"></i> Desglosar</a></td>',
            "Reimpresion" => '<td><a data-id="' . $fila["Folio_Ticket"] . '" class="btn btn-primary btn-xs btn-Reimpresion dropdown-item" style="background-color: #C80096 !important; padding: 2px 5px; font-size: 12px;"><i class="fas fa-print"></i> Reimprimir</a></td>',
        ];
    }

    $results = [
        "sEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
        "aaData" => $data,
        "totalVentas" => number_format($totalVentas, 2),
        "success" => true
    ];

    echo json_encode($results);

} catch (Exception $e) {
    echo json_encode([
        "error" => true,
        "message" => $e->getMessage(),
        "code" => 500
    ]);
} finally {
    // Cerrar la conexión
    if (isset($stmt)) {
        mysqli_stmt_close($stmt);
    }
    if (isset($conn)) {
        mysqli_close($conn);
    }
}
?>
