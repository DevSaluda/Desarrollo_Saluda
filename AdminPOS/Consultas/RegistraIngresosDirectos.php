<?php
include "db_connection.php";

// Obtener y sanitizar los datos del formulario
$ID_Prod_POS = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['IdBasedatos']))));
$Cod_Barras = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Cod_Barras']))));
$Fk_sucursal = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Fk_sucursal']))));

$Recibido = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Recibido']))));
$Lote = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Lote']))));
$Fecha_Caducidad = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Fecha_Caducidad']))));
$AgregadoPor = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['AgregadoPor']))));

$ID_H_O_D = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['ID_H_O_D']))));
$Factura = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Factura']))));
$Precio_compra = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Precio_C']))));
$Total_Factura = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Precio_C']))));

// Preparar la consulta SQL para la inserción
$sql = "INSERT INTO `Stock_registrosNuevos` 
        (`ID_Prod_POS`, `Cod_Barras`, `Fk_sucursal`,  `Recibido`, `Lote`, `Fecha_Caducidad`, `AgregadoPor`, `ID_H_O_D`, `Factura`, `Precio_compra`, `Total_Factura`) 
        VALUES ('$ID_Prod_POS', '$Cod_Barras', '$Fk_sucursal',  '$Recibido', '$Lote', '$Fecha_Caducidad', '$AgregadoPor',  '$ID_H_O_D', '$Factura', '$Precio_compra', '$Total_Factura')";

// Ejecutar la consulta y enviar la respuesta en formato JSON
if (mysqli_query($conn, $sql)) {
    echo json_encode(array("status" => "success", "message" => "Registro insertado con éxito."));
} else {
    echo json_encode(array("status" => "error", "message" => "Error al insertar el registro."));
}

// Cerrar la conexión
mysqli_close($conn);
?>
