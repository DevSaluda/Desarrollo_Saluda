<?php
include 'Consultas.php';

function obtenerEncargos($conn) {
    $query = "SELECT * FROM Encargos_POS WHERE Estado IN ('Entregado', 'Pendiente', 'Rechazado')";
    return mysqli_query($conn, $query);
}

function actualizarEstadoEncargo($conn, $idEncargo, $nuevoEstado) {
    $query = "UPDATE Encargos_POS SET Estado='$nuevoEstado' WHERE Id_Encargo='$idEncargo'";
    return mysqli_query($conn, $query);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idEncargo']) && isset($_POST['accion'])) {
        $idEncargo = $_POST['idEncargo'];
        $accion = $_POST['accion'];
        $nuevoEstado = '';

        if ($accion === 'entregar') {
            $nuevoEstado = 'Entregado';
        } elseif ($accion === 'rechazar') {
            $nuevoEstado = 'Rechazado';
        } elseif ($accion === 'eliminar') {
            $query = "DELETE FROM Encargos_POS WHERE Id_Encargo='$idEncargo'";
            if (mysqli_query($conn, $query)) {
                echo json_encode(['success' => 'Encargo eliminado exitosamente.']);
                exit();
            } else {
                echo json_encode(['error' => 'Error al eliminar el encargo: ' . mysqli_error($conn)]);
                exit();
            }
        }

        if ($nuevoEstado && actualizarEstadoEncargo($conn, $idEncargo, $nuevoEstado)) {
            echo json_encode(['success' => 'Estado del encargo actualizado exitosamente.']);
        } else {
            echo json_encode(['error' => 'Error al actualizar el estado del encargo: ' . mysqli_error($conn)]);
        }
    }
}
?>
