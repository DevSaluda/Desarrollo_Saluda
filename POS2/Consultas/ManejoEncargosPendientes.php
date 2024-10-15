<?php
include 'Consultas.php';

function obtenerEncargos($conn, $search = '', $offset = 0, $perPage = 10) {
    // Ajusta la consulta SQL para incluir NombreCliente y TelefonoCliente
    $query = "SELECT IdentificadorEncargo, Fk_sucursal, SUM(MontoAbonado) AS MontoAbonadoTotal, SUM(Precio_Venta * Cantidad) AS TotalVenta, Estado, NombreCliente, TelefonoCliente 
              FROM Encargos_POS 
              WHERE IdentificadorEncargo LIKE '%$search%' OR Fk_sucursal LIKE '%$search%' OR Estado LIKE '%$search%'
              GROUP BY IdentificadorEncargo, Fk_sucursal, Estado, NombreCliente, TelefonoCliente
              LIMIT $offset, $perPage";
    return mysqli_query($conn, $query);
}

function contarEncargos($conn, $search = '') {
    $query = "SELECT COUNT(DISTINCT IdentificadorEncargo) AS total 
              FROM Encargos_POS 
              WHERE IdentificadorEncargo LIKE '%$search%' OR Fk_sucursal LIKE '%$search%' OR Estado LIKE '%$search%'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}


function actualizarEstadoEncargo($conn, $identificadorEncargo, $nuevoEstado) {
    $query = "UPDATE Encargos_POS SET Estado='$nuevoEstado' WHERE IdentificadorEncargo='$identificadorEncargo'";
    return mysqli_query($conn, $query);
}

function abonarEncargo($conn, $identificadorEncargo, $montoAbonado) {
    // Obtener la lista de productos relacionados con el IdentificadorEncargo
    $query = "SELECT Id_Encargo FROM Encargos_POS WHERE IdentificadorEncargo='$identificadorEncargo'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $primero = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $idEncargo = $row['Id_Encargo'];

            // Asignar el monto abonado solo al primer producto
            if ($primero) {
                $query = "UPDATE Encargos_POS SET MontoAbonado = MontoAbonado + '$montoAbonado' WHERE Id_Encargo='$idEncargo'";
                $primero = false;
            } else {
                // No actualizar el monto abonado para los productos subsiguientes
                $query = "UPDATE Encargos_POS SET MontoAbonado = MontoAbonado WHERE Id_Encargo='$idEncargo'";
            }

            if (!mysqli_query($conn, $query)) {
                return false;
            }
        }
        return true;
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idEncargo']) && isset($_POST['accion']) && isset($_POST['productosSeleccionados'])) {
        $identificadorEncargo = $_POST['idEncargo'];
        $productosSeleccionados = $_POST['productosSeleccionados'];
        $accion = $_POST['accion'];

        // Definir nuevo estado para "entregar" o "saldar"
        if ($accion === 'entregar' || $accion === 'saldar') {
            $nuevoEstado = ($accion === 'entregar') ? 'Entregado' : 'Saldado';

            foreach ($productosSeleccionados as $idProducto) {
                $query = "UPDATE Encargos_POS SET Estado='$nuevoEstado' WHERE Id_Encargo='$idProducto'";
                if (!mysqli_query($conn, $query)) {
                    echo json_encode(['error' => 'Error al actualizar el estado del encargo: ' . mysqli_error($conn)]);
                    exit();
                }
            }

            echo json_encode(['success' => 'Estado del encargo actualizado exitosamente.']);
            exit(); // Termina aquí si la acción es "entregar" o "saldar"
        }

        // Manejo de cancelación de productos
        if ($accion === 'cancelar' && isset($_POST['motivoCancelacion'])) {
            $motivo = $_POST['motivoCancelacion'];

            foreach ($productosSeleccionados as $idProducto) {
                // Obtener información del producto
                $query = "SELECT * FROM Encargos_POS WHERE Id_Encargo = '$idProducto'";
                $result = mysqli_query($conn, $query);
                $producto = mysqli_fetch_assoc($result);

                // Insertar en la tabla EncargosCancelados
                $queryCancelacion = "INSERT INTO EncargosCancelados 
                    (Id_Encargo, IdentificadorEncargo, Cod_Barra, Nombre_Prod, EstadoAnterior, EstadoNuevo, MotivoCancelacion, FechaCancelacion, Fk_sucursal, Cantidad, Precio_Venta, ID_H_O_D)
                    VALUES ('{$producto['Id_Encargo']}', '{$producto['IdentificadorEncargo']}', '{$producto['Cod_Barra']}', '{$producto['Nombre_Prod']}', '{$producto['Estado']}', 'Cancelado', '$motivo', NOW(), '{$producto['Fk_sucursal']}', '{$producto['Cantidad']}', '{$producto['Precio_Venta']}', '{$producto['ID_H_O_D']}')";
                mysqli_query($conn, $queryCancelacion);

                // Actualizar el estado del producto en Encargos_POS
                $queryActualizar = "UPDATE Encargos_POS SET Estado = 'Cancelado' WHERE Id_Encargo = '$idProducto'";
                mysqli_query($conn, $queryActualizar);
            }

            echo json_encode(['success' => 'Productos cancelados exitosamente.']);
            exit();
        }
    }
}

?>
