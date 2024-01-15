<?php
session_start();


// Mapeo de sesiones a URLs de redirección
$sessionRedirects = [
    "SuperAdmin" => "https://controlfarmacia.com/AdminPOS",
    "VentasPos" => "https://controlfarmacia.com/POS2",
    "AdminPOS" => "https://controlfarmacia.com/AdministracionPOS",
    "LogisticaPOS" => "https://controlfarmacia.com/POSLogistica",
    "ResponsableCedis" => "https://controlfarmacia.com/CEDIS",
    "ResponsableInventarios" => "https://controlfarmacia.com/Inventarios",
    "ResponsableDeFarmacias" => "https://controlfarmacia.com/ResponsableDeFarmacias",
    "CoordinadorDental" => "https://controlfarmacia.com/JefeDental",
    "Supervisor" => "https://controlfarmacia.com/CEDISMOVIL",
    "JefeEnfermeros" => "https://controlfarmacia.com/JefaturaEnfermeria",
];

// Verificar las sesiones y redireccionar
foreach ($sessionRedirects as $sessionKey => $redirectURL) {
    if ($_SESSION[$sessionKey]) {
        header("location: $redirectURL");
        exit();
    }
}

// Redirección predeterminada o mensaje de error
header("location: https://controlfarmacia.com/pagina-de-error");
exit();
?>
