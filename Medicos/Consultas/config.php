<?php
$server = "localhost";
$username = "u155356178_SaludDevCenter";
$password = "uE;bAISz;*6c|I4PvEnfSys324\\Zavp2zJ:9TLx{]L&QMcmhAdmSCDBSN3iH4UV3D24WMF@2024myV>";
$dbname = "u155356178_saludapos";

// creamos la conexion con MySQL
try {
    $db = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8mb4", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Establecer el huso horario a GMT-6
    $sqlSetTimeZone = "SET time_zone = '-6:00'";
    $db->exec($sqlSetTimeZone);
} catch (PDOException $e) {
    die('No se pudo conectar con la base de datos');
}
?>
