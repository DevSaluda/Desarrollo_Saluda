<?php
ini_set('display_errors', 1);  // Habilitar la visualización de errores
error_reporting(E_ALL);        // Mostrar todos los errores

include("db_connection.php");

// Verifica que la conexión a la base de datos se haya realizado correctamente
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Verificar si $_POST["CodBarra"] existe y es un arreglo
if (isset($_POST["CodBarra"]) && is_array($_POST["CodBarra"])) {
    $contador = count($_POST["CodBarra"]);
} else {
    $contador = 0;  // Si no existe o no es un arreglo, establecer contador en 0
}

$ProContador = 0;
$query = "INSERT INTO CierresDeInventarios (`Folio_Prod_Stock`, `Cod_Barra`, `Nombre_Prod`, `Fk_sucursal`, `SucursalDestino`, `Precio_Venta`, `Precio_C`, `Piezas`, `AgregadoPor`, `ID_H_O_D`, `FechaInventario`, `TipoMov`) VALUES ";

$placeholders = [];
$values = [];
$valueTypes = '';

for ($i = 0; $i < $contador; $i++) {
    if (isset($_POST["CodBarra"][$i]) && isset($_POST["NombreProd"][$i])) {
        $ProContador++;
        $placeholders[] = "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $values[] = $_POST["Folio_Prod_Stock"][$i];
        $values[] = $_POST["CodBarra"][$i];        // Cod_Barra
        $values[] = $_POST["NombreProd"][$i];     // Nombre_Prod
        $values[] = $_POST["Sucursal"][$i];       // Fk_sucursal
        $values[] = $_POST["SucursalDestino"][$i];// SucursalDestino
        $values[] = $_POST["PrecioVenta"][$i];    // Precio_Venta
        $values[] = $_POST["PrecioCompra"][$i];   // Precio_C
        $values[] = $_POST["Cantidadd"][$i];      // Piezas
        $values[] = $_POST["AgregadoPor"][$i];    // AgregadoPor
        $values[] = $_POST["ID_H_O_D"][$i];       // ID_H_O_D
        $values[] = $_POST["FechaInventario"][$i];// FechaInventario
        $values[] = $_POST["TipoMov"][$i];        // TipoMov
        $valueTypes .= 'sssssssssssss'; // Ajustar tipos según corresponda
    }
}

$response = array();
if ($ProContador != 0) {
    // Generar la consulta final
    $query .= implode(', ', $placeholders);

    // Depuración: mostrar la consulta y el número de valores
    echo "Consulta SQL: " . $query . "<br>";
    echo "Número de parámetros: " . count($values) . "<br>";
    echo "Tipos de valores: " . $valueTypes . "<br>";
    
    // Verificar el número de parámetros a vincular
    if (count($values) != strlen($valueTypes)) {
        // Si no coinciden los números de parámetros con los tipos, mostrar un error
        $response['status'] = 'error';
        $response['message'] = 'El número de parámetros no coincide con los tipos de datos.';
        echo json_encode($response);
        exit();
    }

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Enlace de parámetros
        mysqli_stmt_bind_param($stmt, $valueTypes, ...$values);

        // Ejecutar la consulta
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
