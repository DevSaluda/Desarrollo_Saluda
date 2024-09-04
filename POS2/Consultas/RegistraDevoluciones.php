<?php
include_once 'db_connection.php';

// Verificar si $_POST["FacturaNumber"] está definido y es un arreglo antes de contar sus elementos
if(isset($_POST["FacturaNumber"]) && is_array($_POST["FacturaNumber"])) {
    $contador = count($_POST["FacturaNumber"]); 
} else {
    // Manejar el caso en el que $_POST["FacturaNumber"] no está definido o no es un arreglo
    $contador = 0;
}

$ProContador = 0;
$query = "INSERT INTO Devolucion_POS (`Num_Factura`, `Cod_Barra`, `Nombre_Produc`, `Cantidad`, `Fk_Suc_Salida`, `Motivo_Devolucion`, `Fecha`, `Agrego`, `NumOrde`,`NumTicket`) VALUES ";

$placeholders = [];
$values = [];
$valueTypes = '';

for ($i = 0; $i < $contador; $i++) {
    // Verificar si los campos relevantes están definidos y no están vacíos antes de procesarlos
    if (!empty($_POST["FacturaNumber"][$i]) && !empty($_POST["CodBarras"][$i]) && !empty($_POST["NombreDelProducto"][$i]) && !empty($_POST["Cantidad"][$i]) && !empty($_POST["Fk_Suc_Salida"][$i]) && !empty($_POST["MotivoDevolucion"][$i]) && !empty($_POST["Fecha"][$i]) && !empty($_POST["AgregoElVendedor"][$i]) && !empty($_POST["NumberOrden"][$i])) {
        $ProContador++;
        $placeholders[] = "(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $values[] = $_POST["FacturaNumber"][$i];
        $values[] = $_POST["CodBarras"][$i];
        $values[] = $_POST["NombreDelProducto"][$i];
        $values[] = $_POST["Cantidad"][$i];
        $values[] = $_POST["Fk_Suc_Salida"][$i];
        $values[] = $_POST["MotivoDevolucion"][$i];
        $values[] = $_POST["Fecha"][$i];
        $values[] = $_POST["AgregoElVendedor"][$i];
        $values[] = $_POST["NumberOrden"][$i];
        $values[] = $_POST["NumberOrden"][$i];
        $valueTypes .= 'sssssssss'; // Ajustar tipos según corresponda
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
            $response['message'] = 'Error en la consulta de inserción: ' . mysqli_error($conn);
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error en la preparación de la consulta: ' . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    $response['status'] = 'error';
    $response['message'] = 'No se encontraron registros para agregar o faltan campos obligatorios.';
}

echo json_encode($response);

mysqli_close($conn);
?>
