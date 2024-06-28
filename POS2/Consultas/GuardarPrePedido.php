<?php
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data) && !empty($data)) {
        foreach ($data as $item) {
            $codBarra = $item['Cod_Barra'];
            $nombreProd = $item['Nombre_Prod'];
            $turno = $item['Turno'];
            $importe = $item['Importe'];
            $totalVenta = $item['Total_Venta'];
            $descuento = $item['Descuento'];
            $fkSucursal = $item['Fk_sucursal'];  // Nuevo campo Fk_Sucursal

            $sql = "INSERT INTO Sugerencias_POS (Cod_Barra, Nombre_Prod,Turno, Importe, Total_Venta, Descuento, Fk_Sucursal) 
                    VALUES ('$codBarra', '$nombreProd','$turno', '$importe', '$totalVenta', '$descuento', '$fkSucursal')";

            if (!mysqli_query($conn, $sql)) {
                echo json_encode(["status" => "error", "message" => "Error al insertar: " . mysqli_error($conn)]);
                exit;
            }
        }
        echo json_encode(["status" => "success", "message" => "Datos guardados correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "No se recibieron datos para guardar"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Método no permitido"]);
}

mysqli_close($conn);
?>
