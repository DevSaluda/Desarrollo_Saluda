<?php
include "db_connection.php";

// Obtener y sanitizar los datos del formulario
$ID_BajaProd = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['IdBasedatos']))));
$Cod_Barra = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['CodBarra']))));
$Nombre_Prod = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['NombreProd']))));
$Fk_sucursal = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Fk_sucursal']))));
$Precio_Venta = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Precio_Venta']))));
$Precio_C = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Precio_C']))));
$Cantidad = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['CantidadAregistrar']))));
$Lote = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Lote']))));
$Fecha_Caducidad = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Fecha_Caducidad']))));

$AgregadoPor = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['AgregadoPor']))));

$ID_H_O_D = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['ID_H_O_D']))));

// Preparar la consulta SQL para la inserción
$sql = "INSERT INTO `MedicamentosCaducados` 
        (`ID_BajaProd`, `Cod_Barra`, `Nombre_Prod`, `Fk_sucursal`, `Precio_Venta`, `Precio_C`, `Cantidad`, `Lote`, `Fecha_Caducidad`,  `AgregadoPor`,  `ID_H_O_D`) 
        VALUES ('$ID_BajaProd', '$Cod_Barra', '$Nombre_Prod', '$Fk_sucursal', '$Precio_Venta', '$Precio_C', '$Cantidad', '$Lote', '$Fecha_Caducidad', '$AgregadoPor',  '$ID_H_O_D')";

// Ejecutar la consulta y enviar la respuesta en formato JSON
if (mysqli_query($conn, $sql)) {
    echo json_encode(array("status" => "success", "message" => "Registro insertado con éxito."));
} else {
    echo json_encode(array("status" => "error", "message" => "Error al insertar el registro."));
}

// Cerrar la conexión
mysqli_close($conn);
?>
