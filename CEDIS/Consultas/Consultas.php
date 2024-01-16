<?php
date_default_timezone_set("America/Monterrey");
session_start();

if (!isset($_SESSION['ResponsableCedis'])) {
    header("Location: Expiro.php");
    exit();
}

include_once("../db_connect.php");

// Evitar inyección SQL utilizando sentencias preparadas
$responsableCedis = mysqli_real_escape_string($conn, $_SESSION['ResponsableCedis']);

$sql = "SELECT PersonalPOS.Pos_ID, PersonalPOS.Nombre_Apellidos, PersonalPOS.file_name, PersonalPOS.Fk_Usuario,
        PersonalPOS.Fk_Sucursal, PersonalPOS.ID_H_O_D, Roles_Puestos.ID_rol, Roles_Puestos.Nombre_rol,
        SucursalesCorre.ID_SucursalC, SucursalesCorre.Nombre_Sucursal
        FROM PersonalPOS
        INNER JOIN Roles_Puestos ON PersonalPOS.Fk_Usuario = Roles_Puestos.ID_rol
        INNER JOIN SucursalesCorre ON PersonalPOS.Fk_Sucursal = SucursalesCorre.ID_SucursalC
        WHERE PersonalPOS.Pos_ID='$responsableCedis'";

$resultset = mysqli_query($conn, $sql);

// Manejo de errores
if (!$resultset) {
    die("Error en la consulta: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($resultset);

$hora = date('G');
if ($hora >= 0 && $hora < 6) {
    $mensaje = "Hola, que tengas una excelente madrugada.";
} elseif ($hora >= 6 && $hora < 12) {
    $mensaje = "Buenos días";
} elseif ($hora >= 12 && $hora < 18) {
    $mensaje = "Buenas tardes";
} else {
    $mensaje = "Buenas noches";
}
?>
