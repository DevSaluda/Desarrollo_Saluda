<?php
header('Content-Type: application/json');
include("db_connection.php");

// Lista de días festivos en México
$festivos = [
    "2025-01-01", "2025-02-03", "2025-03-21", "2025-05-01", "2025-09-16",
    "2025-11-02", "2025-11-20", "2025-12-25"
];

// Precios por código de barra en días festivos
$precios_festivos = [
    "7001" => 200.00,
    "7001-1" => 200.00,
    "7001-3" => 100.00,
    "7001-4" => 0.00,
    "7094" => 250.00,
    "7094-2" => 300.00,
    "7013" => null,
    "7013-1" => "",
    "7001-7" => 150.00,
   
];
date_default_timezone_set("America/Mexico_City");
$hoy = date("Y-m-d");

if (in_array($hoy, $festivos)) {
    echo "Hoy es festivo. Actualizando precios...\n";
    
    // Guardar precios normales antes de cambiarlos
    foreach ($precios_festivos as $codigo => $precio) {
        $query = "SELECT Precio_Venta FROM Stock_POS WHERE Cod_Barra = '$codigo'";
        $resultado = $conn->query($query);
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $precio_normal = $fila['Precio_Venta'];
            
            // Guardar precio normal en una tabla temporal si no ha sido modificado antes
            $conn->query("INSERT INTO Precios_Originales (Cod_Barra, Precio_Venta, modificado) VALUES ('$codigo', $precio_normal, 1)
                              ON DUPLICATE KEY UPDATE modificado = 1");
            
            // Actualizar con precio festivo
            if ($precio !== null) {
                $conn->query("UPDATE Stock_POS SET Precio_Venta = $precio WHERE Cod_Barra = '$codigo'");
            }
        }
    }
} else {
    echo "Hoy no es festivo. Verificando si hay cambios para restaurar...\n";
    
    // Restaurar precios normales solo si han sido modificados
    $query = "SELECT Cod_Barra, Precio_Venta FROM Precios_Originales WHERE modificado = 1";
    $resultado = $conn->query($query);
    while ($fila = $resultado->fetch_assoc()) {
        $codigo = $fila['Cod_Barra'];
        $precio_normal = $fila['Precio_Venta'];
        
        $conn->query("UPDATE Stock_POS SET Precio_Venta = $precio_normal WHERE Cod_Barra = '$codigo'");
    }
    
    // Marcar precios como restaurados para que no se vuelvan a modificar innecesariamente
    $conn->query("UPDATE Precios_Originales SET modificado = 0");
}

$conn->close();
?>
