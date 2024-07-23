<?php
include 'Consultas.php';

function buscarProducto($conn, $Cod_Barra) {
    $query = "SELECT ID_Prod_POS, Cod_Barra, Clave_adicional, Cod_Enfermeria, Clave_Levic, Nombre_Prod, Precio_Venta, Precio_C, Min_Existencia, Max_Existencia, Porcentaje, Descuento, Precio_Promo, Lote_Med, Fecha_Caducidad, Stock, Vendido, Saldo, Tipo_Servicio, Componente_Activo, Tipo, FkCategoria, FkMarca, FkPresentacion, Proveedor1, Proveedor2, RecetaMedica, Estatus, CodigoEstatus, Sistema, AgregadoPor, AgregadoEl, ID_H_O_D, Cod_Paquete 
              FROM Productos_POS 
              WHERE Cod_Barra='$Cod_Barra'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
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
        $producto = buscarProducto($conn, $Cod_Barra);
        echo json_encode(['producto_encontrado' => $producto]);
    }

    if (isset($_POST['agregar_producto'])) {
        session_start();
        if (!isset($_SESSION['encargo'])) {
            $_SESSION['encargo'] = [];
        }
        $producto = [
            'Cod_Barra' => $_POST['Cod_Barra'],
            'Nombre_Prod' => $_POST['Nombre_Prod'],
            'Precio_Venta' => $_POST['Precio_Venta'],
            'Cantidad' => $_POST['Cantidad'],
            'Total' => $_POST['Precio_Venta'] * $_POST['Cantidad'],
            'Precio_C' => $_POST['Precio_C'],
            'FkPresentacion' => $_POST['FkPresentacion'] ? $_POST['FkPresentacion'] : null,
            'Proveedor1' => $_POST['Proveedor1'] ? $_POST['Proveedor1'] : null,
            'Proveedor2' => $_POST['Proveedor2'] ? $_POST['Proveedor2'] : null
        ];
        $_SESSION['encargo'][] = $producto;
        echo json_encode(['encargo' => $_SESSION['encargo']]);
    }

    if (isset($_POST['eliminar_producto'])) {
        session_start();
        $Cod_Barra = $_POST['Cod_Barra'];
        $_SESSION['encargo'] = array_filter($_SESSION['encargo'], function($producto) use ($Cod_Barra) {
            return $producto['Cod_Barra'] !== $Cod_Barra;
        });
        echo json_encode(['encargo' => array_values($_SESSION['encargo'])]);
    }

    if (isset($_POST['guardar_encargo'])) {
        session_start();
        if (!isset($_SESSION['encargo']) || empty($_SESSION['encargo'])) {
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
        $response = guardarEncargo($conn, $_SESSION['encargo'], $IdentificadorEncargo, $montoAbonado, $fkSucursal, $agregadoPor, $idHOD, $estado, $tipoEncargo);
        if (isset($response['success'])) {
            unset($_SESSION['encargo']);
        }
        echo json_encode($response);
    }
}
?>
