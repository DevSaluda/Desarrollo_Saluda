<?php
include 'Consultas.php';

function obtenerEncargos($conn) {
    $query = "SELECT IdentificadorEncargo, Fk_sucursal, SUM(MontoAbonado) AS MontoAbonadoTotal, SUM(Precio_Venta * Cantidad) AS TotalVenta 
              FROM Encargos_POS 
              GROUP BY IdentificadorEncargo, Fk_sucursal";
    return mysqli_query($conn, $query);
}

function actualizarEstadoEncargo($conn, $identificadorEncargo, $nuevoEstado) {
    $query = "UPDATE Encargos_POS SET Estado='$nuevoEstado' WHERE IdentificadorEncargo='$identificadorEncargo'";
    return mysqli_query($conn, $query);
}

function abonarEncargo($conn, $identificadorEncargo, $montoAbonado) {
    // Obtener la lista de productos relacionados con el IdentificadorEncargo
    $query = "SELECT ID_Encargo FROM Encargos_POS WHERE IdentificadorEncargo='$identificadorEncargo'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $primero = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $idEncargo = $row['ID_Encargo'];

            // Asignar el monto abonado solo al primer producto
            if ($primero) {
                $query = "UPDATE Encargos_POS SET MontoAbonado = MontoAbonado + '$montoAbonado' WHERE ID_Encargo='$idEncargo'";
                $primero = false;
            } else {
                // No actualizar el monto abonado para los productos subsiguientes
                $query = "UPDATE Encargos_POS SET MontoAbonado = MontoAbonado WHERE ID_Encargo='$idEncargo'";
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
    if (isset($_POST['idEncargo']) && isset($_POST['accion'])) {
        $identificadorEncargo = $_POST['idEncargo'];
        $accion = $_POST['accion'];
        $nuevoEstado = '';

        if ($accion === 'entregar') {
            $nuevoEstado = 'Entregado';
        } elseif ($accion === 'saldar') {
            $nuevoEstado = 'Saldado';
        } elseif ($accion === 'abonar' && isset($_POST['montoAbonado'])) {
            $montoAbonado = $_POST['montoAbonado'];
            if (abonarEncargo($conn, $identificadorEncargo, $montoAbonado)) {
                echo json_encode(['success' => 'Monto abonado exitosamente.']);
            } else {
                echo json_encode(['error' => 'Error al abonar el monto: ' . mysqli_error($conn)]);
            }
            exit();
        } elseif ($accion === 'rechazar') {
            $nuevoEstado = 'Rechazado';
        } elseif ($accion === 'eliminar') {
            $query = "DELETE FROM Encargos_POS WHERE IdentificadorEncargo='$identificadorEncargo'";
            if (mysqli_query($conn, $query)) {
                echo json_encode(['success' => 'Encargo eliminado exitosamente.']);
                exit();
            } else {
                echo json_encode(['error' => 'Error al eliminar el encargo: ' . mysqli_error($conn)]);
                exit();
            }
        }

        if ($nuevoEstado && actualizarEstadoEncargo($conn, $identificadorEncargo, $nuevoEstado)) {
            echo json_encode(['success' => 'Estado del encargo actualizado exitosamente.']);
        } else {
            echo json_encode(['error' => 'Error al actualizar el estado del encargo: ' . mysqli_error($conn)]);
        }
    }
}
?>
