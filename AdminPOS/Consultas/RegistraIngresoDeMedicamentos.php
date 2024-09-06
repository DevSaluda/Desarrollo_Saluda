<?php
include_once 'db_connection.php';

// Verificar si $_POST["IdBasedatos"] está definido y es un arreglo antes de contar sus elementos
if (isset($_POST["IdBasedatos"]) && is_array($_POST["IdBasedatos"])) {
    $contador = count($_POST["IdBasedatos"]); 
} else {
    // Manejar el caso en el que $_POST["IdBasedatos"] no está definido o no es un arreglo
    $contador = 0;
}

$ProContador = 0;
$query = "INSERT INTO Stock_registrosNuevos (`ID_Prod_POS`, `Cod_Barras`, `Fk_sucursal`, `Existencias_R`, `ExistenciaPrev`, `Recibido`, `Lote`, `Fecha_Caducidad`, `AgregadoPor`, `ID_H_O_D`, `Factura`, `Precio_compra`, `Total_Factura`) VALUES ";

$placeholders = [];
$values = [];
$valueTypes = '';

for ($i = 0; $i < $contador; $i++) {
    // Verificar si los campos relevantes están definidos y no están vacíos antes de procesarlos
    if (!empty($_POST["IdBasedatos"][$i]) || !empty($_POST["CodBarras"][$i]) || !empty($_POST["Loteeee"][$i])) {
        $ProContador++;
        $placeholders[] = "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $values[] = isset($_POST["IdBasedatos"][$i]) ? $conn->real_escape_string(htmlentities(strip_tags(trim($_POST["IdBasedatos"][$i])))) : null;
        $values[] = isset($_POST["CodBarras"][$i]) ? $conn->real_escape_string(htmlentities(strip_tags(trim($_POST["CodBarras"][$i])))) : null;
        $values[] = isset($_POST["Fk_sucursal"][$i]) ? $conn->real_escape_string(htmlentities(strip_tags(trim($_POST["Fk_sucursal"][$i])))) : null;
        $values[] = isset($_POST["Diferencia"][$i]) ? $conn->real_escape_string(htmlentities(strip_tags(trim($_POST["Diferencia"][$i])))) : null;
        $values[] = isset($_POST["StockActual"][$i]) ? $conn->real_escape_string(htmlentities(strip_tags(trim($_POST["StockActual"][$i])))) : null;
        $values[] = isset($_POST["Contabilizado"][$i]) ? $conn->real_escape_string(htmlentities(strip_tags(trim($_POST["Contabilizado"][$i])))) : null;
        $values[] = isset($_POST["Loteeee"][$i]) ? $conn->real_escape_string(htmlentities(strip_tags(trim($_POST["Loteeee"][$i])))) : null;
        $values[] = isset($_POST["fechacadd"][$i]) ? $conn->real_escape_string(htmlentities(strip_tags(trim($_POST["fechacadd"][$i])))) : null;
        $values[] = isset($_POST["AgregoElVendedor"][$i]) ? $conn->real_escape_string(htmlentities(strip_tags(trim($_POST["AgregoElVendedor"][$i])))) : null;
        $values[] = $conn->real_escape_string(htmlentities(strip_tags(trim("Saluda")))); // Esto es constante
        $values[] = isset($_POST["FacturaNumber"][$i]) ? $conn->real_escape_string(htmlentities(strip_tags(trim($_POST["FacturaNumber"][$i])))) : null;
        $values[] = isset($_POST["preciocompraAguardar"][$i]) ? $conn->real_escape_string(htmlentities(strip_tags(trim($_POST["preciocompraAguardar"][$i])))) : null;
        $values[] = isset($_POST["CostototalFactura"][$i]) ? $conn->real_escape_string(htmlentities(strip_tags(trim($_POST["CostototalFactura"][$i])))) : null;
        
        $valueTypes .= 'sssssssssssss'; // Ajustar tipos según corresponda
    }
}

$response = array();

if ($ProContador != 0) {
    $query .= implode(', ', $placeholders);
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Enlace de parámetros
        mysqli_stmt_bind_param($stmt, $valueTypes, ...$values);

        // Ejecución de consulta
        $resultadocon = mysqli_stmt_execute($stmt);

        if ($resultadocon) {
            $response['status'] = 'success';
            $response['message'] = 'Registro(s) agregado(s) correctamente.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error en la consulta de inserción: ' . mysqli_stmt_error($stmt);
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error en la preparación de la consulta: ' . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    $response['status'] = 'error';
    $response['message'] = 'No se encontraron registros para agregar.';
}

echo json_encode($response);

mysqli_close($conn);
?>
