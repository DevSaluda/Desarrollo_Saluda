<?php
include 'Consultas.php';

function obtenerEncargos($conn, $terminoBusqueda, $offset, $itemsPorPagina) {
    $terminoBusqueda = mysqli_real_escape_string($conn, $terminoBusqueda);
    $query = "SELECT IdentificadorEncargo, Fk_sucursal, SUM(MontoAbonado) AS MontoAbonadoTotal, Estado, TelefonoCliente
              FROM Encargos_POS 
              WHERE IdentificadorEncargo LIKE '%$terminoBusqueda%' 
                 OR Fk_sucursal LIKE '%$terminoBusqueda%' 
              GROUP BY IdentificadorEncargo, Fk_sucursal, Estado, TelefonoCliente
              LIMIT $offset, $itemsPorPagina";
    return mysqli_query($conn, $query);
}

function contarEncargos($conn, $terminoBusqueda) {
    $terminoBusqueda = mysqli_real_escape_string($conn, $terminoBusqueda);
    $query = "SELECT COUNT(DISTINCT IdentificadorEncargo) AS total 
              FROM Encargos_POS 
              WHERE IdentificadorEncargo LIKE '%$terminoBusqueda%' 
                 OR Fk_sucursal LIKE '%$terminoBusqueda%'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

function actualizarEstadoEncargo($conn, $idEncargo, $nuevoEstado) {
    $query = "UPDATE Encargos_POS SET Estado='$nuevoEstado' WHERE Id_Encargo='$idEncargo'";
    return mysqli_query($conn, $query);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idEncargo']) && isset($_POST['accion']) && isset($_POST['productosSeleccionados'])) {
        $idEncargo = $_POST['idEncargo'];
        $accion = $_POST['accion'];
        $productosSeleccionados = $_POST['productosSeleccionados'];

        // Definir nuevo estado para entregar o rechazar
        if ($accion === 'entregar' || $accion === 'rechazar') {
            $nuevoEstado = ($accion === 'entregar') ? 'Entregado' : 'Rechazado';

            foreach ($productosSeleccionados as $idProducto) {
                $query = "UPDATE Encargos_POS SET Estado='$nuevoEstado' WHERE Id_Encargo='$idProducto'";
                if (!mysqli_query($conn, $query)) {
                    echo json_encode(['error' => 'Error al actualizar el estado del encargo: ' . mysqli_error($conn)]);
                    exit();
                }
            }

            echo json_encode(['success' => 'Estado del encargo actualizado exitosamente.']);
            exit();
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

        // Eliminar encargo
        if ($accion === 'eliminar') {
            $query = "DELETE FROM Encargos_POS WHERE Id_Encargo='$idEncargo'";
            if (mysqli_query($conn, $query)) {
                echo json_encode(['success' => 'Encargo eliminado exitosamente.']);
                exit();
            } else {
                echo json_encode(['error' => 'Error al eliminar el encargo: ' . mysqli_error($conn)]);
                exit();
            }
        }
    }
}
?>
