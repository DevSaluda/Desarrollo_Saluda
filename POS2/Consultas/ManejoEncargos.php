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
        $FkPresentacion = $producto['FkPresentacion'];
        $Proveedor1 = $producto['Proveedor1'];
        $Proveedor2 = $producto['Proveedor2'];
        $Total = $producto['Total'];
        
        $query = "INSERT INTO Encargos_POS 
            (IdentificadorEncargo, Cod_Barra, Nombre_Prod, Fk_sucursal, MontoAbonado, Precio_Venta, Precio_C, Cantidad, Fecha_Ingreso, FkPresentacion, Proveedor1, Proveedor2, AgregadoPor, AgregadoEl, ID_H_O_D, Estado, TipoEncargo) 
            VALUES 
            ('$IdentificadorEncargo', '$Cod_Barra', '$Nombre_Prod', '$fkSucursal', '$montoAbonado', '$Precio_Venta', '$Precio_C', '$Cantidad', NOW(), '$FkPresentacion', '$Proveedor1', '$Proveedor2', '$agregadoPor', NOW(), '$idHOD', '$estado', '$tipoEncargo')";

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
        $IdentificadorEncargo = $_POST['IdentificadorEncargo'];
        if (isset($_SESSION['VentasPOS']['encargo'])) {
            $response = guardarEncargo($conn, $_SESSION['VentasPOS']['encargo'], $IdentificadorEncargo, $montoAbonado, $fkSucursal, $agregadoPor, $idHOD, $estado, $tipoEncargo);
            unset($_SESSION['VentasPOS']['encargo']); // Limpiar el encargo después de guardar
        } else {
            $response['error'] = "No hay productos en el encargo.";
        }
    }
    
    echo json_encode($response);
    exit;
}
?>
