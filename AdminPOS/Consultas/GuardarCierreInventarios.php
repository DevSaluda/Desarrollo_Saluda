<?php
// Desactivar temporalmente la visualización de errores en producción
ini_set('display_errors', 0); 
error_reporting(E_ALL);

include("db_connection.php");

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (isset($_POST["CodBarra"]) && is_array($_POST["CodBarra"])) {
    $contador = count($_POST["CodBarra"]);
} else {
    $contador = 0;
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
        $values[] = $_POST["CodBarra"][$i];
        $values[] = $_POST["NombreProd"][$i];
        $values[] = $_POST["Sucursal"][$i];
        $values[] = $_POST["SucursalDestino"][$i];
        $values[] = $_POST["PrecioVenta"][$i];
        $values[] = $_POST["PrecioCompra"][$i];
        $values[] = $_POST["Cantidadd"][$i];
        $values[] = $_POST["AgregadoPor"][$i];
        $values[] = $_POST["ID_H_O_D"][$i];
        $values[] = $_POST["FechaInventario"][$i];
        $values[] = $_POST["TipoMov"][$i];
        $valueTypes .= 'ssssssssssss';
    }
}

$response = array();
if ($ProContador != 0) {
    $query .= implode(', ', $placeholders);

    if (count($values) != strlen($valueTypes)) {
        $response['status'] = 'error';
        $response['message'] = 'El número de parámetros no coincide con los tipos de datos.';
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, $valueTypes, ...$values);
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

// Enviar la respuesta JSON sin espacios en blanco adicionales
header('Content-Type: application/json');
echo json_encode($response);

mysqli_close($conn);
?>
