<?php

/* Database connection start */
$servername = "localhost";
$username = "u155356178_SaludDevCenter";
$password = "uE;bAISz;*6c|I4PvEnfSys324\Zavp2zJ:9TLx{]L&QMcmhAdmSCDBSN3iH4UV3D24WMF@2024myV>";
$dbname = "u155356178_saludapos";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("No podemos conectar a la base de datos: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("algo salio mal, no podemos conectarnos a la base de datos %s\n", mysqli_connect_error());
    exit();
}

?>