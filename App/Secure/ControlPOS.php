<?php
session_start();
include("Scripts/POS.php");

// Mapeo de sesiones a URLs de redirección
$sessionRedirects = [
    "SuperAdmin" => "https://saludapos.com/AdminPOS",
    "VentasPos" => "https://saludapos.com/POS2",
    "AdminPOS" => "https://saludapos.com/AdministracionPOS",
    "LogisticaPOS" => "https://saludapos.com/POSLogistica",
    "ResponsableCedis" => "https://saludapos.com/CEDIS",
    "ResponsableInventarios" => "https://saludapos.com/Inventarios",
    "ResponsableDeFarmacias" => "https://saludapos.com/ResponsableDeFarmacias",
    "CoordinadorDental" => "https://saludapos.com/JefeDental",
    "Supervisor" => "https://saludapos.com/CEDISMOVIL",
    "JefeEnfermeros" => "https://saludapos.com/JefaturaEnfermeria",
];

// Verificar las sesiones y redireccionar
foreach ($sessionRedirects as $sessionKey => $redirectURL) {
    if ($_SESSION[$sessionKey]) {
        header("location: $redirectURL");
        exit();
    }
}

// Redirección predeterminada o mensaje de error
header("location: https://saludapos.com/pagina-de-error");
exit();
?>
