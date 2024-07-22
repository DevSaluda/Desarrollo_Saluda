<?php
include "Consultas.php";

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

    echo json_encode($response);
    exit;
}
?>
