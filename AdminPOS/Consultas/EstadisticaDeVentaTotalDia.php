<?php
include("db_connection.php");

// Consulta SQL para obtener las estadísticas de venta por sucursal del día en curso
$query = "SELECT 
            SucursalesCorre.ID_SucursalC AS id_sucursal,
            SucursalesCorre.Nombre_Sucursal AS nombre_sucursal,
            SUM(CASE 
                    WHEN Ventas_POS.FormaDePago IN ('Efectivo', 'Tarjeta', 'Transferencia') THEN Ventas_POS.Importe 
                    ELSE 0 
                END) AS total_vendido
          FROM 
            SucursalesCorre
          LEFT JOIN 
            Ventas_POS ON SucursalesCorre.ID_SucursalC = Ventas_POS.Fk_sucursal
          LEFT JOIN 
            Servicios_POS ON Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID
          WHERE 
            Ventas_POS.Fecha_venta = CURRENT_DATE()
          GROUP BY 
            SucursalesCorre.ID_SucursalC";

// Ejecutar consulta
$result = $conn->query($query);

// Inicializar un array para almacenar los datos por sucursal
$data = array();

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Recorrer los resultados y agregarlos al array de datos
    while ($row = $result->fetch_assoc()) {
        $sucursal = $row['nombre_sucursal'];
        $total_vendido = $row['total_vendido'];
        // Agregar el total vendido para la sucursal correspondiente
        $data[$sucursal] = $total_vendido;
    }
}

// Cerrar conexión
$conn->close();

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
