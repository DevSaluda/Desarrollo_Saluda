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
$query = "INSERT INTO Stock_Bajas (`ID_Prod_POS`, `Cod_Barra`, `Nombre_Prod`, `Fk_sucursal`, `Precio_Venta`, `Precio_C`, `Cantidad`, `Lote`, `Fecha_Caducidad`, `MotivoBaja`, `AgregadoPor`, `ID_H_O_D`) VALUES ";

$placeholders = [];
$values = [];
$valueTypes = '';

for ($i = 0; $i < $contador; $i++) {
    // Verificar si los campos relevantes están definidos y no están vacíos antes de procesarlos
    if (!empty($_POST["IdBasedatos"][$i]) || !empty($_POST["CodBarras"][$i]) || !empty($_POST["NombreDelProducto"][$i])) {
        $ProContador++;
        $placeholders[] = "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $values[] = $_POST["IdBasedatos"][$i];
        $values[] = $_POST["CodBarras"][$i];
        $values[] = $_POST["NombreDelProducto"][$i];
        $values[] = $_POST["Fk_sucursal"][$i];
        $values[] = $_POST["PrecioVenta"][$i];
        $values[] = $_POST["PrecioCompra"][$i];
        $values[] = $_POST["Cantidad"][$i]; // Ensure this field is included in the values
        $values[] = $_POST["Lote"][$i];
        $values[] = $_POST["FechaCaducidad"][$i];
        $values[] = $_POST["MotivoBaja"][$i];
        $values[] = $_POST["AgregoElVendedor"][$i];
        $values[] = $_POST["ID_H_O_D"][$i];
        $valueTypes .= 'ssssssssssss'; // Adjust types according to your data types
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
    $response['message'] = 'No se encontraron registros para agregar.';
}

echo json_encode($response);

mysqli_close($conn);
?>
