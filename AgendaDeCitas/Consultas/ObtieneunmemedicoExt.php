<?php
include("ConeSelectDinamico.php");

// Verificar si 'sucursalExt' está definido en $_GET
if (isset($_GET['sucursalExt'])) {
    echo "Parámetro 'sucursalExt' recibido correctamente. Valor: " . $_GET['sucursalExt'];
} else {
    echo "Parámetro 'sucursalExt' no definido en la solicitud.";
}
?>
