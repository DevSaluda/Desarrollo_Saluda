<?php
$servername = 'localhost';
$username = 'u155356178_SaludDevCenter';
$password = 'uE;bAISz;*6c|I4PvEnfSys324\\Zavp2zJ:9TLx{]L&QMcmhAdmSCDBSN3iH4UV3D24WMF@2024myV>';
$database = 'u155356178_saludapos';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

echo 'Connected successfully';
?>
