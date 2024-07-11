<?php
include_once 'db_connection.php';

$errores = [];

if (empty($_POST["IdBasedatos"])) {
    $errores[] = 'IdBasedatos';
}
if (empty($_POST["CodBarra"])) {
    $errores[] = 'CodBarra';
}
if (empty($_POST["NombreProd"])) {
    $errores[] = 'NombreDelProducto';
}
if (empty($_POST["Fk_sucursal"])) {
    $errores[] = 'Fk_sucursal';
}
if (empty($_POST["PrecioVenta"])) {
    $errores[] = 'PrecioVenta';
}
if (empty($_POST["PrecioCompra"])) {
    $errores[] = 'PrecioCompra';
}
if (empty($_POST["Cantidad"])) {
    $errores[] = 'Cantidad';
}
if (empty($_POST["Lote"])) {
    $errores[] = 'Lote';
}
if (empty($_POST["FechaCaducidad"])) {
    $errores[] = 'FechaCaducidad';
}
if (empty($_POST["MotivoBaja"])) {
    $errores[] = 'MotivoBaja';
}
if (empty($_POST["AgregoElVendedor"])) {
    $errores[] = 'AgregoElVendedor';
}
if (empty($_POST["ID_H_O_D"])) {
    $errores[] = 'ID_H_O_D';
}

if (empty($errores)) {
    $query = "INSERT INTO Stock_Bajas (`ID_Prod_POS`, `Cod_Barra`, `Nombre_Prod`, `Fk_sucursal`, `Precio_Venta`, `Precio_C`, `Cantidad`, `Lote`, `Fecha_Caducidad`, `MotivoBaja`, `AgregadoPor`, `ID_H_O_D`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Enlace de parámetros
        mysqli_stmt_bind_param(
            $stmt, 
            'ssssssssssss', // Ajusta los tipos de datos según sea necesario
            $_POST["IdBasedatos"],
            $_POST["CodBarra"],
            $_POST["NombreProd"],
            $_POST["Fk_sucursal"],
            $_POST["PrecioVenta"],
            $_POST["PrecioCompra"],
            $_POST["Cantidad"],
            $_POST["Lote"],
            $_POST["FechaCaducidad"],
            $_POST["MotivoBaja"],
            $_POST["AgregoElVendedor"],
            $_POST["ID_H_O_D"]
        );

        // Ejecución de consulta
        $resultadocon = mysqli_stmt_execute($stmt);

        if ($resultadocon) {
            $response['status'] = 'success';
            $response['message'] = 'Registro agregado correctamente.';
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
    $response['message'] = 'Faltan los siguientes datos requeridos: ' . implode(', ', $errores);
}

echo json_encode($response);

mysqli_close($conn);
?>
