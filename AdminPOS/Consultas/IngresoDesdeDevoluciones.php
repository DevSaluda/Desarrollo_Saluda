<?php
include_once 'db_connection.php';

$response = array();

// Verificar si $_POST contiene todos los datos requeridos y que no sean "N/A" o vacíos
if (
    !empty($_POST["IdBasedatos"]) && 
    !empty($_POST["CodBarras"]) && 
    !empty($_POST["Fk_sucursal"]) && 
    !empty($_POST["Contabilizado"]) && 
    !empty($_POST["AgregoElVendedor"]) && 
    !empty($_POST["FacturaNumber"]) && $_POST["FacturaNumber"] !== "N/A" && 
    !empty($_POST["preciocompraAguardar"]) && $_POST["preciocompraAguardar"] !== "N/A" && 
    !empty($_POST["CostototalFactura"]) && 
    !empty($_POST["Movimiento"])
) {
    // Preparar la consulta de inserción
    $query = "INSERT INTO Stock_registrosNuevos 
        (ID_Prod_POS, Cod_Barras, Fk_sucursal, Recibido, AgregadoPor, ID_H_O_D, Factura, Precio_compra, Total_Factura, TipoMov) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Asignar variables para cada parámetro
        $ID_Prod_POS = htmlentities(strip_tags(trim($_POST["IdBasedatos"])));
        $Cod_Barras = htmlentities(strip_tags(trim($_POST["CodBarras"])));
        $Fk_sucursal = htmlentities(strip_tags(trim($_POST["Fk_sucursal"])));
        $Recibido = htmlentities(strip_tags(trim($_POST["Contabilizado"])));
        $AgregadoPor = htmlentities(strip_tags(trim($_POST["AgregoElVendedor"])));
        $ID_H_O_D = "Saluda"; // Valor constante
        $Factura = htmlentities(strip_tags(trim($_POST["FacturaNumber"])));

        // Convertir a números los valores que deben serlo
        $Precio_compra = is_numeric($_POST["preciocompraAguardar"]) ? floatval($_POST["preciocompraAguardar"]) : 0;
        $Total_Factura = is_numeric($_POST["CostototalFactura"]) ? floatval($_POST["CostototalFactura"]) : 0;
        
        $TipoMov = htmlentities(strip_tags(trim($_POST["Movimiento"])));

        // Enlazar los parámetros con los tipos correctos (s = string, d = double/decimal)
        mysqli_stmt_bind_param($stmt, 'ssssssssds', 
            $ID_Prod_POS, 
            $Cod_Barras, 
            $Fk_sucursal, 
            $Recibido, 
            $AgregadoPor, 
            $ID_H_O_D, 
            $Factura, 
            $Precio_compra, // Número decimal
            $Total_Factura, // Número decimal
            $TipoMov
        );

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            $response['status'] = 'success';
            $response['message'] = 'Registro agregado correctamente.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error en la consulta de inserción: ' . mysqli_stmt_error($stmt);
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error en la preparación de la consulta: ' . mysqli_error($conn);
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Faltan datos requeridos para la inserción.';
}

// Devolver respuesta en formato JSON
echo json_encode($response);

// Cerrar la conexión
mysqli_close($conn);
?>
