<?php
// Ajusta la zona horaria en PHP
date_default_timezone_set('America/Mexico_City');

// Otras variables
$fechaActual = date('Y-m-d');  // Obtiene la fecha actual en el formato 'YYYY-MM-DD'

// ...

// Consulta SQL con la variable de fecha declarada
$sql = "SELECT 
            Cajas_POS.ID_Caja,
            Cajas_POS.Cantidad_Fondo,
            Cajas_POS.Empleado,
            Cajas_POS.Sucursal,
            Cajas_POS.Estatus,
            Cajas_POS.CodigoEstatus,
            Cajas_POS.Turno,
            Cajas_POS.Asignacion,
            IFNULL(DATE_FORMAT(CONVERT_TZ(Cajas_POS.Hora_real_apertura, '+00:00', '-06:00'), '%h:%i %p'), 'N/A') AS Hora_real_apertura_formatted,
            IFNULL(DATE_FORMAT(CONVERT_TZ(Cajas_POS.Hora_apertura, '+00:00', '-06:00'), '%h:%i %p'), 'N/A') AS Hora_apertura_formatted,
            Cajas_POS.Fecha_Apertura,
            Cajas_POS.Valor_Total_Caja,
            Cajas_POS.ID_H_O_D,
            SucursalesCorre.ID_SucursalC,
            SucursalesCorre.Nombre_Sucursal 
        FROM 
            Cajas_POS, SucursalesCorre 
        WHERE 
            Cajas_POS.Sucursal = SucursalesCorre.ID_SucursalC 
            AND DATE(Cajas_POS.Fecha_Apertura) = '$fechaActual'  -- Usa la variable de fecha
            AND Cajas_POS.Sucursal='".$row['Fk_Sucursal']."'
            AND Cajas_POS.Asignacion = 1
            AND Cajas_POS.Estatus='Abierta'
            AND Cajas_POS.Empleado='".$row['Nombre_Apellidos']."'
            AND Cajas_POS.ID_H_O_D='".$row['ID_H_O_D']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$ValorCaja = "";
// Check if the query returned any results
if ($resultset && mysqli_num_rows($resultset) > 0) {
    $ValorCaja = mysqli_fetch_assoc($resultset);

    // Now you can access array elements safely
    // For example, $ValorCaja['ID_Caja'], $ValorCaja['Cantidad_Fondo'], etc.
} else {
    // Handle the case where no results were found
    
}

