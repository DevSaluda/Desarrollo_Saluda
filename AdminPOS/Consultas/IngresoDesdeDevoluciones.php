<?php
include_once 'db_connection.php';

$response = array();

// Verificar si $_POST contiene todos los datos requeridos
if (isset($_POST["IdBasedatos"]) && isset($_POST["CodBarras"]) && isset($_POST["Fk_sucursal"]) && isset($_POST["Diferencia"])) {
    
    // Preparar la consulta de inserción
    $query = "INSERT INTO Stock_registrosNuevos (`ID_Prod_POS`, `Cod_Barras`, `Fk_sucursal`, `Existencias_R`, `ExistenciaPrev`, `Recibido`, `Lote`, `Fecha_Caducidad`, `AgregadoPor`, `ID_H_O_D`, `Factura`, `Precio_compra`, `Total_Factura`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        // Asignar variables para cada parámetro
        $ID_Prod_POS = htmlentities(strip_tags(trim($_POST["IdBasedatos"])));
        $Cod_Barras = htmlentities(strip_tags(trim($_POST["CodBarras"])));
        $Fk_sucursal = htmlentities(strip_tags(trim($_POST["Fk_sucursal"])));
        $Existencias_R = htmlentities(strip_tags(trim($_POST["Diferencia"])));
        $ExistenciaPrev = htmlentities(strip_tags(trim($_POST["StockActual"])));
        $Recibido = htmlentities(strip_tags(trim($_POST["Contabilizado"])));
        $Lote = htmlentities(strip_tags(trim($_POST["Loteeee"])));
        $Fecha_Caducidad = htmlentities(strip_tags(trim($_POST["fechacadd"])));
        $AgregadoPor = htmlentities(strip_tags(trim($_POST["AgregoElVendedor"])));
        $ID_H_O_D = "Saluda"; // Valor constante
        $Factura = htmlentities(strip_tags(trim($_POST["FacturaNumber"])));
        $Precio_compra = htmlentities(strip_tags(trim($_POST["preciocompraAguardar"])));
        $Total_Factura = htmlentities(strip_tags(trim($_POST["CostototalFactura"])));

        // Enlazar los parámetros de manera individual
        mysqli_stmt_bind_param($stmt, 'sssssssssssss', 
            $ID_Prod_POS, 
            $Cod_Barras, 
            $Fk_sucursal, 
            $Existencias_R, 
            $ExistenciaPrev, 
            $Recibido, 
            $Lote, 
            $Fecha_Caducidad, 
            $AgregadoPor, 
            $ID_H_O_D, 
            $Factura, 
            $Precio_compra, 
            $Total_Factura
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
