<?php
include 'Consultas.php';

function buscarProducto($conn, $Cod_Barra) {
    $query = "SELECT ID_Prod_POS, Cod_Barra, Nombre_Prod, Precio_Venta, Precio_C, FkPresentacion, Proveedor1, Proveedor2 
              FROM Productos_POS 
              WHERE Cod_Barra='$Cod_Barra'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        return [mysqli_fetch_assoc($result)]; // Devuelve un array con un solo producto
    } else {
        $query = "SELECT ID_Prod_POS, Cod_Barra, Nombre_Prod, Precio_Venta, Precio_C, FkPresentacion, Proveedor1, Proveedor2 
                  FROM Productos_POS 
                  WHERE Nombre_Prod LIKE '%$Cod_Barra%'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return []; // Devuelve un array vacío si no se encuentran productos
        }
    }
}
function guardarEncargo($conn, $encargo, $IdentificadorEncargo, $montoAbonado, $fkSucursal, $agregadoPor, $idHOD, $estado, $tipoEncargo) {
    $response = [];

    foreach ($encargo as $producto) {
        $Cod_Barra = $producto['Cod_Barra'];
        $Nombre_Prod = $producto['Nombre_Prod'];
        $Precio_Venta = $producto['Precio_Venta'];
        $Cantidad = $producto['Cantidad'];
        $Precio_C = $producto['Precio_C'];
        $FkPresentacion = $producto['FkPresentacion'] ? "'{$producto['FkPresentacion']}'" : "NULL";
        $Proveedor1 = $producto['Proveedor1'] ? "'{$producto['Proveedor1']}'" : "NULL";
        $Proveedor2 = $producto['Proveedor2'] ? "'{$producto['Proveedor2']}'" : "NULL";

        $query = "INSERT INTO Encargos_POS 
            (IdentificadorEncargo, Cod_Barra, Nombre_Prod, Fk_sucursal, MontoAbonado, Precio_Venta, Precio_C, Cantidad, Fecha_Ingreso, FkPresentacion, Proveedor1, Proveedor2, AgregadoPor, AgregadoEl, ID_H_O_D, Estado, TipoEncargo) 
            VALUES 
            ('$IdentificadorEncargo', '$Cod_Barra', '$Nombre_Prod', '$fkSucursal', '$montoAbonado', '$Precio_Venta', '$Precio_C', '$Cantidad', NOW(), $FkPresentacion, $Proveedor1, $Proveedor2, '$agregadoPor', NOW(), '$idHOD', '$estado', '$tipoEncargo')";

        if (!mysqli_query($conn, $query)) {
            $response['error'] = "Error al guardar el encargo: " . mysqli_error($conn);
            return $response;
        }
    }

    $response['success'] = "Encargo guardado exitosamente.";
    return $response;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['buscar_producto'])) {
        $Cod_Barra = $_POST['Cod_Barra'];
        $producto = buscarProducto($conn, $Cod_Barra, $Cod_Barra);
        echo json_encode(['productos' => $producto]);
    }

    if (isset($_POST['guardar_encargo'])) {
        $encargo = json_decode($_POST['encargo'], true);
        if (empty($encargo)) {
            echo json_encode(['error' => 'No hay productos en el encargo.']);
            exit;
        }

        $IdentificadorEncargo = $_POST['IdentificadorEncargo'];
        $montoAbonado = $_POST['MontoAbonado'];
        $fkSucursal = $_POST['FkSucursal'];
        $agregadoPor = $_POST['AgregadoPor'];
        $idHOD = $_POST['ID_H_O_D'];
        $estado = $_POST['Estado'];
        $tipoEncargo = $_POST['TipoEncargo'];
        
        $response = guardarEncargo($conn, $encargo, $IdentificadorEncargo, $montoAbonado, $fkSucursal, $agregadoPor, $idHOD, $estado, $tipoEncargo);
        echo json_encode($response);
    }
}
?>
