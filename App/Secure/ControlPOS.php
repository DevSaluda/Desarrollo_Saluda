<?php

session_start();
include ("Scripts/POS.php");

// Mapeo de roles a URLs de redirección
$roleRedirects = [
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

// Función para redirigir según el rol
function redirectToRole($role) {
    global $roleRedirects;
    if (isset($roleRedirects[$role])) {
        header("location: " . $roleRedirects[$role]);
        exit();
    }
}

// Verificar sesiones y redirigir
if ($_SESSION["SuperAdmin"]) {
    redirectToRole("SuperAdmin");
} elseif ($_SESSION["VentasPos"]) {
    redirectToRole("VentasPos");
} elseif ($_SESSION["AdminPOS"]) {
    redirectToRole("AdminPOS");
} elseif ($_SESSION["LogisticaPOS"]) {
    redirectToRole("LogisticaPOS");
} elseif ($_SESSION["ResponsableCedis"]) {
    redirectToRole("ResponsableCedis");
} elseif ($_SESSION["ResponsableInventarios"]) {
    redirectToRole("ResponsableInventarios");
} elseif ($_SESSION["ResponsableDeFarmacias"]) {
    redirectToRole("ResponsableDeFarmacias");
} elseif ($_SESSION["CoordinadorDental"]) {
    redirectToRole("CoordinadorDental");
} elseif ($_SESSION["Supervisor"]) {
    redirectToRole("Supervisor");
} elseif ($_SESSION["JefeEnfermeros"]) {
    redirectToRole("JefeEnfermeros");
}
// Agrega aquí cualquier otra lógica que puedas necesitar

// Redirección predeterminada o mensaje de error si ninguna condición se cumple
header("location: https://saludapos.com/pagina-de-error");
exit();
?>
