<?php
include "Consultas.php";
session_start();

function buscarProducto($conn, $Cod_Barra) {
    $query = "SELECT * FROM Productos_POS WHERE Cod_Barra='$Cod_Barra'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
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
        $Precio_Venta = $_POST['Precio_Venta'];
        $Cantidad = (int)$_POST['Cantidad'];

        $producto_existe = false;
        foreach ($_SESSION['encargo'] as &$producto) {
            if ($producto['Cod_Barra'] === $Cod_Barra) {
                $producto['Cantidad'] += $Cantidad;
                $producto['Total'] = $producto['Precio_Venta'] * $producto['Cantidad'];
                $producto_existe = true;
                break;
            }
        }
        if (!$producto_existe) {
            $producto = [
                'Cod_Barra' => $Cod_Barra,
                'Nombre_Prod' => $Nombre_Prod,
                'Precio_Venta' => $Precio_Venta,
                'Cantidad' => $Cantidad,
                'Total' => $Precio_Venta * $Cantidad
            ];
            $_SESSION['encargo'][] = $producto;
        }

        $response['encargo'] = $_SESSION['encargo'];
    }

    if (isset($_POST['eliminar_producto'])) {
        $Cod_Barra = $_POST['Cod_Barra'];
        foreach ($_SESSION['encargo'] as $index => $producto) {
            if ($producto['Cod_Barra'] === $Cod_Barra) {
                unset($_SESSION['encargo'][$index]);
                $_SESSION['encargo'] = array_values($_SESSION['encargo']); // Reindexar el array
                break;
            }
        }

        $response['encargo'] = $_SESSION['encargo'];
    }

    echo json_encode($response);
    exit;
}

function calcularTotalEncargo($encargo) {
    $total = 0;
    foreach ($encargo as $producto) {
        $total += $producto['Total'];
    }
    return $total;
}

function calcularPagoMinimo($total) {
    return $total * 0.5;
}
?>
