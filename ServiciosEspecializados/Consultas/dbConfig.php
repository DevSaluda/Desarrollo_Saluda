<?php
//DB details
$dbHost = 'localhost';
$dbUsername = 'u155356178_SaludDevCenter';
$dbPassword = 'uE;bAISz;*6c|I4PvEnfSys324\Zavp2zJ:9TLx{]L&QMcmhAdmSCDBSN3iH4UV3D24WMF@2024myV>';
$dbName = 'u155356178_saludapos';

//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if($db->connect_error){
    die("Unable to connect database: " . $db->connect_error);
}