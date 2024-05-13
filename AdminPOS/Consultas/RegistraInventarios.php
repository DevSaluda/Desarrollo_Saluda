<?php
include_once 'db_connection.php';

$contador = count($_POST["ID_Prod_POS"]); // Cambiado el nombre del campo según la nueva data
$ProContador = 0;
$query = "INSERT INTO InventariosStocks_Conteos (`ID_Prod_POS`, `Cod_Barra`, `Nombre_Prod`, `Fk_sucursal`, `Precio_Venta`, `Precio_C`, `Contabilizado`, `StockEnMomento`, `Diferencia`, `Sistema`, `AgregadoPor`,  `ID_H_O_D`,`FechaInventario`) VALUES ";

$placeholders = [];
$values = [];
$valueTypes = '';

for ($i = 0; $i < $contador; $i++) {
    if (!empty($_POST["ID_Prod_POS"][$i]) || !empty($_POST["CodBarras"][$i]) || !empty($_POST["NombreDelProducto"][$i])) {
        $ProContador++;
        $placeholders[] = "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $values[] = $_POST["ID_Prod_POS"][$i];
        $values[] = $_POST["CodBarras"][$i];
        $values[] = $_POST["NombreDelProducto"][$i];
        $values[] = $_POST["Fk_sucursal"][$i]; // Cambiado el nombre del campo según la nueva data
        $values[] = $_POST["PrecioVenta"][$i];
        $values[] = $_POST["PrecioCompra"][$i];
        $values[] = $_POST["Contabilizado"][$i];
        $values[] = $_POST["StockActual"][$i]; // Cambiado el nombre del campo según la nueva data
        $values[] = $_POST["Diferencia"][$i];
        $values[] = $_POST["Sistema"][$i]; // Agregar el campo 'Sistema' según la nueva data
        $values[] = $_POST["AgregoElVendedor"][$i];
      
        $values[] = $_POST["ID_H_O_D"][$i];
        $values[] = $_POST["FechaInv"][$i]; // Agregar el campo 'ID_H_O_D' según la nueva data
        $valueTypes .= 'sssssssssss'; // Ajustar tipos según corresponda
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
