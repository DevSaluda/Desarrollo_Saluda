<?php

/* Database connection start */
$servername = "localhost";
$username = "u155356178_SaludaCapturad";
$password = "z3Z1Huellafo!Tmm]56178";
$dbname = "u155356178_SaludaHuellas";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("No podemos conectar a la base de datos: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("algo salio mal, no podemos conectarnos a la base de datos %s\n", mysqli_connect_error());
    exit();
}

?>