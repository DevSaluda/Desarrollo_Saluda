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

function guardarCotizacion($conn, $cotizacion, $IdentificadorCotizacion, $fkSucursal, $agregadoPor, $idHOD, $estado, $tipoCotizacion, $fkCaja, $nombreCliente, $telefonoCliente) {
    $response = [];

    foreach ($cotizacion as $producto) {
        $Cod_Barra = $producto['Cod_Barra'];
        $Nombre_Prod = $producto['Nombre_Prod'];
        $Precio_Venta = $producto['Precio_Venta'];
        $Cantidad = isset($producto['Cantidad']) ? $producto['Cantidad'] : NULL;
        $Total = $producto['Total'];
        $FkPresentacion = $producto['FkPresentacion'] ?? '';
        $Proveedor1 = $producto['Proveedor1'] ?? '';
        $Proveedor2 = $producto['Proveedor2'] ?? '';

        // Verificar si el producto es un procedimiento (código de barras de 4 dígitos o formato USG-####)
        if (preg_match('/^\d{4}$/', $Cod_Barra) || preg_match('/^USG-\d{4}$/', $Cod_Barra)) {
            $Cantidad = 0; // No asignar cantidad a procedimientos
        }

        $query = "INSERT INTO Cotizaciones_POS (IdentificadorCotizacion, Cod_Barra, Nombre_Prod, Fk_sucursal, Precio_Venta, Cantidad, Total, FkPresentacion, Proveedor1, Proveedor2, AgregadoPor, ID_H_O_D, Estado, TipoCotizacion, ID_Caja, NombreCliente, TelefonoCliente)
                  VALUES ('$IdentificadorCotizacion', '$Cod_Barra', '$Nombre_Prod', '$fkSucursal', '$Precio_Venta', '$Cantidad', '$Total', '$FkPresentacion', '$Proveedor1', '$Proveedor2', '$agregadoPor', '$idHOD', '$estado', '$tipoCotizacion', '$fkCaja', '$nombreCliente', '$telefonoCliente')";

        if (!mysqli_query($conn, $query)) {
            $response['error'] = "Error al guardar la cotización: " . mysqli_error($conn);
            return $response;
        }
    }

    $response['success'] = "Cotización guardada exitosamente.";
    return $response;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['buscar_producto'])) {
        $Cod_Barra = $_POST['Cod_Barra'];
        $producto = buscarProducto($conn, $Cod_Barra);
        echo json_encode(['productos' => $producto]);
    }

    if (isset($_POST['guardar_cotizacion'])) {
        $cotizacionData = $_POST['cotizacion'];

        // Verificar si 'cotizacion' es un array y convertirlo a JSON si es necesario
        if (is_array($cotizacionData)) {
            $cotizacionData = json_encode($cotizacionData);
        }

        $cotizacion = json_decode($cotizacionData, true);
        if (empty($cotizacion)) {
            echo json_encode(['error' => 'No hay productos en la cotización.']);
            exit;
        }
    
        $IdentificadorCotizacion = $_POST['IdentificadorCotizacion'];
        $fkSucursal = $_POST['FkSucursal'];
        $agregadoPor = $_POST['AgregadoPor'];
        $idHOD = $_POST['ID_H_O_D'];
        $estado = $_POST['Estado'];
        $tipoCotizacion = $_POST['TipoCotizacion'];
        $fkCaja = $_POST['ID_Caja']; // Captura ID_Caja
        $nombreCliente = $_POST['NombreCliente']; // Captura el nombre del cliente
        $telefonoCliente = $_POST['TelefonoCliente']; // Captura el teléfono del cliente
    
        $response = guardarCotizacion($conn, $cotizacion, $IdentificadorCotizacion, $fkSucursal, $agregadoPor, $idHOD, $estado, $tipoCotizacion, $fkCaja, $nombreCliente, $telefonoCliente);
        
       

        echo json_encode($response);
    }
}
?>
