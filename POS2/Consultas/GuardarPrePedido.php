<?php
include("db_connection.php");

// Verifica que la conexión a la base de datos se haya realizado correctamente
if (!$conn) {
    $response['status'] = 'error';
    $response['message'] = 'Error de conexión a la base de datos: ' . mysqli_connect_error();
    echo json_encode($response);
    exit();
}

$contador = count($_POST["CodBarra"]);
$ProContador = 0;
$query = "INSERT INTO Sugerencias_POS (`Cod_Barra`, `Nombre_Prod`, `Fk_sucursal`, `Precio_Venta`, `Precio_C`, `Cantidad`,  `Fecha_Ingreso`,  `FkPresentacion`, `Proveedor1`, `Proveedor2`, `AgregadoPor`, `AgregadoEl`, `ID_H_O_D`) VALUES ";

$placeholders = [];
$values = [];
$valueTypes = '';

for ($i = 0; $i < $contador; $i++) {
    if (!empty($_POST["CodBarra"][$i]) || !empty($_POST["NombreProd"][$i])) {
        $ProContador++;
        $placeholders[] = "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,)";
        $values[] = $_POST["CodBarra"][$i];
        $values[] = $_POST["NombreProd"][$i];
        $values[] = $_POST["Sucursal"][$i];
        $values[] = $_POST["PrecioVenta"][$i];
        $values[] = $_POST["PrecioCompra"][$i];
        $values[] = $_POST["Cantidadd"][$i];
       
        $values[] = $_POST["FechaIngreso"][$i];
      
      
        $values[] = $_POST["FkPresentacion"][$i];
        $values[] = $_POST["Prov1"][$i];
        $values[] = $_POST["Prov2"][$i];
        $values[] = $_POST["AgregadoPor"][$i];
        $values[] = $_POST["AgregadoEl"][$i];
        $values[] = $_POST["ID_H_O_D"][$i];
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
