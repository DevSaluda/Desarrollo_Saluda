<?php
include_once "db_connection.php";
// Verificar si se recibieron los datos esperados
if (isset($_POST['codigo']) && isset($_POST['sucursal'])) {
    // Recibir los datos del formulario
    $codigo = $_POST['codigo'];
    $sucursal = $_POST['sucursal'];

    // Imprimir las variables para verificar que se recibieron correctamente
    echo "Código recibido: " . $codigo . "<br>";
    echo "Sucursal recibida: " . $sucursal . "<br>";
} else {
    // Si no se recibieron los datos esperados, retornar un mensaje de error
    echo "No se recibieron los datos esperados.";
}
?>
