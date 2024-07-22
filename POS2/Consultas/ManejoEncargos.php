<?php
include 'Consultas/Consultas.php';

function buscarProducto($conn, $Cod_Barra) {
    $query = "SELECT * FROM Productos_POS WHERE Cod_Barra='$Cod_Barra'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function guardarEncargo($conn, $encargo, $montoAbonado, $fkSucursal, $agregadoPor, $idHOD, $estado, $tipoEncargo) {
    $response = [];

    foreach ($encargo as $producto) {
        $Cod_Barra = $producto['Cod_Barra'];
        $Nombre_Prod = $producto['Nombre_Prod'];
        $Precio_Venta = $producto['Precio_Venta'];
        $Cantidad = $producto['Cantidad'];
        $Total = $producto['Total'];

        $query = "INSERT INTO Encargos_POS 
            (Cod_Barra, Nombre_Prod, Fk_sucursal, MontoAbonado, Precio_Venta, Precio_C, Cantidad, Fecha_Ingreso, FkPresentacion, Proveedor1, Proveedor2, AgregadoPor, AgregadoEl, ID_H_O_D, Estado, TipoEncargo) 
            VALUES 
            ('$Cod_Barra', '$Nombre_Prod', '$fkSucursal', '$montoAbonado', '$Precio_Venta', '0', '$Cantidad', NOW(), '0', '0', '0', '$agregadoPor', NOW(), '$idHOD', '$estado', '$tipoEncargo')";

        if (!mysqli_query($conn, $query)) {
            $response['error'] = "Error al guardar el encargo: " . mysqli_error($conn);
            return $response;
        }
    }

    $response['success'] = "Encargo guardado exitosamente.";
    return $response;
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
            // Crear un nuevo objeto producto
            $nuevo_producto = [
                'Cod_Barra' => $Cod_Barra,
                'Nombre_Prod' => $Nombre_Prod,
                'Precio_Venta' => $Precio_Venta,
                'Cantidad' => $Cantidad,
                'Total' => $Precio_Venta * $Cantidad
            ];
            $_SESSION['VentasPOS']['encargo'][] = $nuevo_producto;
        }

        $response['encargo'] = $_SESSION['VentasPOS']['encargo'];
    }

    if (isset($_POST['eliminar_producto'])) {
        $Cod_Barra = $_POST['Cod_Barra'];
        if (isset($_SESSION['VentasPOS']['encargo'])) {
            foreach ($_SESSION['VentasPOS']['encargo'] as $index => $producto) {
                if ($producto['Cod_Barra'] === $Cod_Barra) {
                    unset($_SESSION['VentasPOS']['encargo'][$index]);
                    $_SESSION['VentasPOS']['encargo'] = array_values($_SESSION['VentasPOS']['encargo']); // Reindexar el array
                    break;
                }
            }
        }

        $response['encargo'] = $_SESSION['VentasPOS']['encargo'];
    }

    if (isset($_POST['guardar_encargo'])) {
        $montoAbonado = $_POST['MontoAbonado'];
        $fkSucursal = $_POST['FkSucursal'];
        $agregadoPor = $_POST['AgregadoPor'];
        $idHOD = $_POST['ID_H_O_D'];
        $estado = $_POST['Estado'];
        $tipoEncargo = $_POST['TipoEncargo'];

        if (isset($_SESSION['VentasPOS']['encargo'])) {
            $response = guardarEncargo($conn, $_SESSION['VentasPOS']['encargo'], $montoAbonado, $fkSucursal, $agregadoPor, $idHOD, $estado, $tipoEncargo);
            unset($_SESSION['VentasPOS']['encargo']); // Limpiar el encargo después de guardar
        } else {
            $response['error'] = "No hay productos en el encargo.";
        }
    }

    echo json_encode($response);
    exit;
}
?>
