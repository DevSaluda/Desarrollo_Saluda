<?php
include 'Consultas/Consultas.php';

function buscarProducto($conn, $Cod_Barra) {
    $query = "SELECT * FROM Productos_POS WHERE Cod_Barra='$Cod_Barra'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function obtenerUltimoIdentificadorEncargo($conn) {
    $query = "SELECT MAX(IdentificadorEncargo) AS UltimoId FROM Encargos_POS";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['UltimoId'];
}

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['buscar_producto'])) {
        $Cod_Barra = $_POST['Cod_Barra'];
        $producto = buscarProducto($conn, $Cod_Barra);

        if ($producto) {
            $response['producto_encontrado'] = $producto;
        } else {
            $response['producto_no_encontrado'] = $Cod_Barra;
        }
    }

    if (isset($_POST['agregar_producto'])) {
        $Cod_Barra = $_POST['Cod_Barra'];
        $Nombre_Prod = $_POST['Nombre_Prod'];
        $Precio_Venta = (float)$_POST['Precio_Venta'];
        $Cantidad = (int)$_POST['Cantidad'];

        if (!isset($_SESSION['VentasPOS']['encargo'])) {
            $_SESSION['VentasPOS']['encargo'] = [];
        }

        $producto_existe = false;
        foreach ($_SESSION['VentasPOS']['encargo'] as &$producto) {
            if ($producto['Cod_Barra'] === $Cod_Barra) {
                $producto['Cantidad'] += $Cantidad;
                $producto['Total'] = $producto['Precio_Venta'] * $producto['Cantidad'];
                $producto_existe = true;
                break;
            }
        }

        if (!$producto_existe) {
            $_SESSION['VentasPOS']['encargo'][] = [
                'Cod_Barra' => $Cod_Barra,
                'Nombre_Prod' => $Nombre_Prod,
                'Precio_Venta' => $Precio_Venta,
                'Cantidad' => $Cantidad,
                'Total' => $Precio_Venta * $Cantidad
            ];
        }

        $response['encargo'] = $_SESSION['VentasPOS']['encargo'];
    }

    if (isset($_POST['guardar_encargo'])) {
        $IdentificadorEncargo = $_POST['IdentificadorEncargo'];
        $MontoAbonado = $_POST['MontoAbonado'];
        $FkSucursal = $_POST['FkSucursal'];
        $AgregadoPor = $_POST['AgregadoPor'];
        $ID_H_O_D = $_POST['ID_H_O_D'];
        $Estado = $_POST['Estado'];
        $TipoEncargo = $_POST['TipoEncargo'];

        // Guardar el encargo en la base de datos
        foreach ($_SESSION['VentasPOS']['encargo'] as $producto) {
            $query = "INSERT INTO Encargos_POS 
                (IdentificadorEncargo, Cod_Barra, Nombre_Prod, Fk_sucursal, MontoAbonado, Precio_Venta, Precio_C, Cantidad, Fecha_Ingreso, FkPresentacion, Proveedor1, Proveedor2, AgregadoPor, AgregadoEl, ID_H_O_D, Estado, TipoEncargo) 
                VALUES 
                ('$IdentificadorEncargo', '{$producto['Cod_Barra']}', '{$producto['Nombre_Prod']}', '$FkSucursal', '$MontoAbonado', '{$producto['Precio_Venta']}', '{$producto['Precio_Venta']}', '{$producto['Cantidad']}', NOW(), '1', 'Proveedor1', 'Proveedor2', '$AgregadoPor', NOW(), '$ID_H_O_D', '$Estado', '$TipoEncargo')";
            mysqli_query($conn, $query);
        }

        // Limpiar los productos del encargo en la sesión
        unset($_SESSION['VentasPOS']['encargo']);

        $response['success'] = true;
    }

    echo json_encode($response);
}
