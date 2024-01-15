<?php

/* Database connection start */
$servername = "localhost";
$username = "u155356178_SaludaHuellas";
$password = ";5Kt&rY@fNmPp8/B0VU3wfbI324\Zavp2zJ:9TLx{]L&QMcmh";
$dbname = "u155356178_SaludaCapturad";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("No podemos conectar a la base de datos: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("algo salio mal, no podemos conectarnos a la base de datos %s\n", mysqli_connect_error());
    exit();
}

?>