<?php
include("db_connection.php");
// Consulta SQL para obtener las estadísticas de venta por sucursal y servicio del día en curso
$query = "SELECT 
            SucursalesCorre.ID_SucursalC AS id_sucursal,
            SucursalesCorre.Nombre_Sucursal AS nombre_sucursal,
            Servicios_POS.Servicio_ID AS id_servicio,
            Servicios_POS.Nom_Serv AS nombre_servicio,
            SUM(Ventas_POS.Cantidad_Venta) AS total_vendido
          FROM 
            SucursalesCorre
          LEFT JOIN 
            Ventas_POS ON SucursalesCorre.ID_SucursalC = Ventas_POS.Fk_sucursal
          LEFT JOIN 
            Servicios_POS ON Ventas_POS.Identificador_tipo = Servicios_POS.Servicio_ID
          WHERE 
            Ventas_POS.Fecha_venta = CURRENT_DATE()
          GROUP BY 
            SucursalesCorre.ID_SucursalC, Servicios_POS.Servicio_ID";

// Ejecutar consulta
$result = $conn->query($query);

// Inicializar un array para almacenar los datos por sucursal y servicio
$data = array();

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Recorrer los resultados y agregarlos al array de datos
    while ($row = $result->fetch_assoc()) {
        $sucursal = $row['nombre_sucursal'];
        $servicio = $row['nombre_servicio'];
        $total_vendido = $row['total_vendido'];
        // Crear un nuevo array para la sucursal si no existe
        if (!isset($data[$sucursal])) {
            $data[$sucursal] = array();
        }
        // Agregar el total vendido para el servicio en la sucursal correspondiente
        $data[$sucursal][$servicio] = $total_vendido;
    }
}

// Cerrar conexión
$conn->close();

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
