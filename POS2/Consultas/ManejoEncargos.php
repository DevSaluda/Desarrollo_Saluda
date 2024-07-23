<?php
include 'Consultas.php';

function buscarProducto($conn, $Cod_Barra) {
    $query = "SELECT * FROM Productos_POS WHERE Cod_Barra='$Cod_Barra'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function guardarEncargo($conn, $encargo, $identificadorEncargo, $montoAbonado, $fkSucursal, $agregadoPor, $idHOD, $estado, $tipoEncargo) {
    $response = [];
    
    foreach ($encargo as $producto) {
        $query = "INSERT INTO Encargos_POS (IdentificadorEncargo, Cod_Barra, Nombre_Prod, Fk_sucursal, MontoAbonado, Precio_Venta, Precio_C, Cantidad, Fecha_Ingreso, FkPresentacion, Proveedor1, Proveedor2, AgregadoPor, AgregadoEl, ID_H_O_D, Estado, TipoEncargo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?, NOW(), ?, ?, ?)";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "sssiddddsssssdsd",
            $identificadorEncargo,
            $producto['Cod_Barra'],
            $producto['Nombre_Prod'],
            $fkSucursal,
            $montoAbonado,
            $producto['Precio_Venta'],
            $producto['Precio_C'],
            $producto['Cantidad'],
            $producto['FkPresentacion'],
            $producto['Proveedor1'],
            $producto['Proveedor2'],
            $agregadoPor,
            $idHOD,
            $estado,
            $tipoEncargo
        );

        if ($stmt->execute()) {
            $response['success'] = "Encargo guardado exitosamente.";
        } else {
            $response['error'] = "Error al guardar el encargo: " . $stmt->error;
        }

        $stmt->close();
    }

    return $response;
}

if (isset($_POST['buscar_producto'])) {
    $Cod_Barra = $_POST['Cod_Barra'];
    $producto = buscarProducto($conn, $Cod_Barra);
    if ($producto) {
        echo json_encode(['producto_encontrado' => $producto]);
    } else {
        echo json_encode(['producto_no_encontrado' => true]);
    }
} elseif (isset($_POST['agregar_producto'])) {
    $Cod_Barra = $_POST['Cod_Barra'];
    $Nombre_Prod = $_POST['Nombre_Prod'];
    $Precio_Venta = $_POST['Precio_Venta'];
    $Cantidad = $_POST['Cantidad'];
    
    if (!isset($_SESSION['encargo'])) {
        $_SESSION['encargo'] = [];
    }

    $producto_existente = false;
    foreach ($_SESSION['encargo'] as &$producto) {
        if ($producto['Cod_Barra'] == $Cod_Barra) {
            $producto['Cantidad'] += $Cantidad;
            $producto['Total'] = $producto['Precio_Venta'] * $producto['Cantidad'];
            $producto_existente = true;
            break;
        }
    }

    if (!$producto_existente) {
        $_SESSION['encargo'][] = [
            'Cod_Barra' => $Cod_Barra,
            'Nombre_Prod' => $Nombre_Prod,
            'Precio_Venta' => $Precio_Venta,
            'Cantidad' => $Cantidad,
            'Total' => $Precio_Venta * $Cantidad
        ];
    }

    echo json_encode(['encargo' => $_SESSION['encargo']]);
} elseif (isset($_POST['eliminar_producto'])) {
    $Cod_Barra = $_POST['Cod_Barra'];
    
    if (isset($_SESSION['encargo'])) {
        $_SESSION['encargo'] = array_filter($_SESSION['encargo'], function($producto) use ($Cod_Barra) {
            return $producto['Cod_Barra'] != $Cod_Barra;
        });
    }

    echo json_encode(['encargo' => $_SESSION['encargo']]);
} elseif (isset($_POST['guardar_encargo'])) {
    $identificadorEncargo = $_POST['IdentificadorEncargo'];
    $montoAbonado = $_POST['MontoAbonado'];
    $fkSucursal = $_POST['FkSucursal'];
    $agregadoPor = $_POST['AgregadoPor'];
    $idHOD = $_POST['ID_H_O_D'];
    $estado = $_POST['Estado'];
    $tipoEncargo = $_POST['TipoEncargo'];
    
    if (isset($_SESSION['encargo']) && !empty($_SESSION['encargo'])) {
        $response = guardarEncargo($conn, $_SESSION['encargo'], $identificadorEncargo, $montoAbonado, $fkSucursal, $agregadoPor, $idHOD, $estado, $tipoEncargo);
        unset($_SESSION['encargo']);
    } else {
        $response['error'] = "No hay productos en el encargo para guardar.";
    }

    echo json_encode($response);
}

$conn->close();
?>
