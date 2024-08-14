<?php
include 'Consultas.php';

function obtenerEncargos($conn, $terminoBusqueda, $offset, $itemsPorPagina) {
    $terminoBusqueda = mysqli_real_escape_string($conn, $terminoBusqueda);
    $query = "SELECT IdentificadorEncargo, Fk_sucursal, SUM(MontoAbonado) AS MontoAbonadoTotal, Estado, TelefonoCliente, NumeroCliente
              FROM Encargos_POS 
              WHERE IdentificadorEncargo LIKE '%$terminoBusqueda%' 
                 OR Fk_sucursal LIKE '%$terminoBusqueda%' 
              GROUP BY IdentificadorEncargo, Fk_sucursal, Estado, TelefonoCliente, NumeroCliente
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
